<?php
/**
 *      [PinTuXiu] (C)2001-2099 ONightjar.com Pintuxiu.com.
 *      This is NOT a freeware, use is subject to license terms
 */
class basecontroller extends spController
{

	public function __construct() {
		parent::__construct();
		$this->session = spClass('Session');
		$this->cookie = spClass('Cookie');
		$this->user_lib = spClass('UserLib');
		$this->ptx_settings = spClass('ptx_settings');
		$this->settings = $this->ptx_settings->getSettings();
		$this->check_language();
		$this->fetch_global();
		$this->current_user = $this->user_lib->get_session();
		$this->themes = $this->settings['ui_styles']['style'];
		$this->version = 'V'.$GLOBALS['G_SP']['product_info']["version"];
		$this->forum_open = $GLOBALS['G_SP']['bbs']["open"];
		$ptx_category = spClass('ptx_category');
		$this->categories = $ptx_category->get_category_top();
		$this->is_editer = $this->is_editer()?true:false;
		$this->hash = random_string(alnum,5);
		$ptx_usergroup = spClass("ptx_usergroup");
		$this->usergroups = $ptx_usergroup->getUsergroups();
		$this->permission = $this->usergroups[$this->current_user['usergroup_id']];
		$this->prepare_parameter();
		if(!$this->permission){
			$this->permission = $this->usergroups['6'];
		}
		if(($this->settings['basic_setting']['site_close']&&!$this->is_admin()&&$this->current_action!='login')||!$this->permission['allow_visit']){
			$this->showError(T('site_closed'));
		}
		if($this->settings['basic_setting']['forbid_user_post']||!$this->permission['allow_share']){
			$this->can_post = ($this->is_editer())?true:false;
		}else{
			$this->can_post = true;
		}
	}
	
	private function check_language(){
		$lang = ($this->settings['basic_setting']['lang'])?$this->settings['basic_setting']['lang']:'zh_cn';
		$this->lang = ($language=$this->session->get_data('lang'))?$language:$lang;
		$this->setLang($this->lang);
	}

	private function showError($message=''){
		$this->message=$message;
		$this->ouput('/errorpage/error.php');
		exit();
	}

	public function fetch_global(){
		GLOBAL $__controller, $__action;
		$this->current_controller = $__controller;
		$this->current_action = $__action;
	}

	public function set_header(){
		if($this->current_user){
			$ptx_user = spClass('ptx_user');
			$this->message_count=$ptx_user->message_count($this->current_user['user_id']);
		}
		$this->prepare_nav();
		$this->tpl_header = $this->render('/common/header.php');
	}

	public function set_footer(){
		$this->set_js_tpl();
		$this->tpl_footer =  $this->render('/common/footer.php');
	}

	public function prepare_nav(){
		$this->tpl_nav = $this->render('/common/nav.php');
	}

	public function set_js_tpl($tpl=null){
		$this->tpl_js = $this->render('/js_tpl/login_box_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/register_box_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/publish_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/comment_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/avatar_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/crop_dialog_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/push_dialog_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/star_open_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/apply_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/banner_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/user_profile_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/tags_pop_tpl.php');
		$this->tpl_js .= $this->render('/js_tpl/forwarding_tpl.php');
	}

	public function render($tpl){
		return $this->display($this->themes.$tpl,false);
	}

	public function ouput($tpl,$need_header_footer=true){
		if($need_header_footer){
			$this->set_header();
			$this->set_footer();
		}
		$this->display($this->themes.$tpl,true);
	}

	public function set_tagcloud(){
		return $this->render('/common/tagcloud.php');
	}

	public function waterfallView($arr,$type='pin'){
		switch ($type) {
			case 'pin':
				$this->shares = $arr;
				break;
			case 'album':
				$this->albums = $arr;
				break;
			case 'user':
				$this->users = $arr;
				break;
		}
		$this->tpl_waterfall = $this->render('/waterfall/'.$type.'.php');
	}

	public function timelineView($arr,$type='pin'){
		$this->shares = $arr;
		$this->tpl_timeline = $this->render('/timeline/'.$type.'.php');
	}

	public function forumlineView($arr,$type='post'){
		$this->posts = $arr;
		$this->tpl_timeline = $this->render('/timeline/'.$type.'.php');
	}


	public function relationView($user_id,$friend_id){
		$ptx_relationship = spClass("ptx_relationship");
		$status = $ptx_relationship->get_relation($user_id,$friend_id);
		$relation['user_id'] = $user_id;
		$relation['friend_id'] = $friend_id;
		$relation['status'] = $status;
		$this->relation = $relation;
		return $this->render('/common/relation.php');
	}


	public function prepare_parameter(){
		$cat_id =  $this->spArgs("cat");
		if($cat_id&&is_numeric($cat_id)){
			$this->category_id = $cat_id;
		}
		$category_id =  $this->spArgs("category_id");
		if($category_id&&is_numeric($category_id)){
			$this->category_id = $category_id;
		}
		$cid =  $this->spArgs("cid");
		if($cid&&is_numeric($cid)){
			$this->category_id = $cid;
		}
		$uid =  $this->spArgs("uid");
		if($uid&&is_numeric($uid)){
			$this->user_id = $uid;
		}
		$album_id =  $this->spArgs("album_id");
		if($album_id&&is_numeric($album_id)){
			$this->album_id = $album_id;
		}
		$aid =  $this->spArgs("aid");
		if($aid&&is_numeric($aid)){
			$this->album_id = $aid;
		}
		$share_id = $this->spArgs("share_id");
		if($share_id&&is_numeric($share_id)){
			$this->share_id = $share_id;
		}
		$post_sid = $this->spArgs("sid",null,'post');
		if($post_sid&&is_numeric($post_sid)){
			$this->share_id = $post_sid;
		}
		$get_sid = $this->spArgs("sid",null,'get');
		if($get_sid&&is_numeric($get_sid)){
			$this->share_id = $get_sid;
		}
		$page = $this->spArgs("page");
		if($page&&is_numeric($page)){
			$this->page = $page;
		}else{
			$this->page = 1;
		}
		$txt = $this->spArgs("txt");
		if($txt){
			$this->txt = $txt;
		}
	}

	function parameter_need($param=''){
		$p = $this->$param;
		if(!$p||$p==NULL){
			spError(T('lost_param'));
		}
	}

	function check_admin()
	{
		if(!$this->is_admin())
		{
			$this->jump(spUrl('admin', 'login'));
			return false;
		}else{
			return true;
		}
	}

	function check_login(){
		if(!$this->is_login())
		{
			$this->jump(spUrl('webuser', 'login'));
			return false;
		}else{
			return true;
		}
	}

	function is_admin(){
		$local_user = $this->current_user;
		if($local_user&&$local_user['user_type']==3){
			return true;
		}else {
			return false;
		}
	}

	function is_editer(){
		$local_user = $this->current_user;
		if($local_user&&$local_user['user_type']>1){
			return true;
		}else {
			return false;
		}
	}

	function is_login()
	{
		if($this->current_user){
			return true;
		}else {
			return false;
		}
	}

	function ajax_check_editer()
	{
		if($this->is_editer()){
			return true;
		}else {
			$response = array('result' => false, 'message' => "no-permission");
			echo json_encode($response);
			die();
		}
	}

	function ajax_check_login()
	{
		if($this->is_login()){
			return true;
		}else {
			$response = array('result' => false, 'message' => "not-login");
			echo json_encode($response);
			die();
		}
	}

	function ajax_check_can_post()
	{
		if(!$this->can_post){
			$response = array('result' => false, 'message' => T('can_not_post'));
			echo json_encode($response);
			die();
		}
	}

	public function update_count(){
		$ptx_share = spClass('ptx_share');
		$result['click'] = $ptx_share->view_count();
		$result['like'] = $ptx_share->like_count();
		$result['share'] = $ptx_share->share_count();
		$result['forwarding'] = $ptx_share->forwarding_count();
		$ptx_comment = spClass('ptx_comment');
		$result['comment'] = $ptx_comment->comment_count();
		$time = $this->settings['setting_optimizer']['cache_time_count'];
		spAccess('w','ptx_count',$result,$time);
	}

	public function userlink($user_id){
		return spUrl('pub','index',array());
	}

	public function parse_at($message,$type='share'){
		if($this->permission['other_permission']['allow_at_friend']) {
			$atlist = $atlist_tmp = array();
			preg_match_all("/@([^\r\n]*?)\s/i", $message.' ', $atlist_tmp);
			$atlist_tmp = array_slice(array_unique($atlist_tmp[1]), 0, 3);

			if(!empty($atlist_tmp)) {
				$ptx_user = spClass('ptx_user');
				$ptx_message = spClass('ptx_message');
				foreach($ptx_user->find_userid_by_uname($atlist_tmp) as $row) {
					$atlist[$row['user_id']] = $row['nickname'];
					$ptx_message->add_at($this->current_user['user_id'],$row['user_id'],$type);
				}
			}

			if($atlist) {
				foreach($atlist as $atuid => $atusername) {
					$atsearch[] = "/@$atusername /i";
					$atreplace[] = "[at=$atuid]@{$atusername}[/at] ";
					$atsearch_str .= "atuser$atuid ";
				}
				$message = preg_replace($atsearch, $atreplace, $message.' ', 1);
			}
		}
		return array('message'=>$message,'atsearch_str'=>$atsearch_str);
	}

	public function parse_tag($message){
		$taglist = $taglist_tmp = array();
		preg_match_all("/#([^\r\n]*?)#/i", $message.' ', $taglist_tmp);
		$taglist_tmp = array_slice(array_unique($taglist_tmp[1]), 0, 6);
		$taglist_tmp = implode($taglist_tmp, ' ');
		return $taglist_tmp;
	}

	public function seo_title($title){
		$this->page_title .= sysSubStr($title,100,false).' ';
	}

	public function seo_description($description){
		$this->page_description .= sysSubStr($description,200,false).' ';
	}

	public function seo_keyword($keyword){
		$this->page_keyword .= sysSubStr($keyword,200,false).' ';
	}
}