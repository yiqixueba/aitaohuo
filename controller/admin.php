<?php
/**
 *      [PinTuXiu] (C)2001-2099 ONightjar.com Pintuxiu.com.
 *      This is NOT a freeware, use is subject to license terms
 */
class admin extends basecontroller {

	public function __construct() {
		parent::__construct();
		$this->themes = '';
		$this->ptx_settings = spClass('ptx_settings');
		$this->setting_nav = $this->render("/admin/setting_nav.php");
		$this->setting_header = $this->render("/admin/setting_header.php");
		$this->ui_nav = $this->render("/admin/ui_nav.php");
		$this->forum_nav = $this->render("/admin/forum_nav.php");
	}


	public function index()
	{
		if($this->check_admin()){
			$this->action = 'index';
			$this->display("/admin/index.php");
		}
	}

	public function login()
	{
		if($this->is_admin()){
			$this->jump(spUrl('admin', 'index'));
			return;
		}

		$this->user_lib->remove_session();
		if($email = $this->spArgs("email")){
			$password = md5($this->spArgs('password'));
			$ptx_user = spClass('ptx_user');
			$user = $ptx_user->find(array('email'=>$email));
			if($user){
				if( $user['passwd'] == $password&&$user['user_type']==3){
					$this->user_lib->set_session($user,false);
					$this->jump(spUrl('admin', 'index'));
					return true;
				}
			}
		}
		$this->display("/admin/login.php");

	}

	public function logout()
	{
		$this->check_admin();
		$this->user_lib->remove_session();
		$this->jump(spUrl('admin', 'login'));
	}

	public function dashboard()
	{
		if($this->check_admin()){
			$this->action = 'dashboard';
			$this->display("/admin/dashboard.php");
		}
	}

	private function url_rewrite($open=FALSE){
		$config = spClass('Options');
		if($config->load('config.php')){
			$lanuch_rewrite = array(
								'router_prefilter' => array(
			array('spUrlRewrite', 'setReWrite'),
			),
								'function_url' => array(
			array("spUrlRewrite", "getReWrite"),
			),
			);
			if ($open) {
				$config->set_item('launch',$lanuch_rewrite);
				$config->save('config.php');
			}else{
				$config->set_item('launch','');
				$config->save('config.php');
			}
		}
	}

	public function setting_basic()
	{
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$basic_setting['site_name'] = $this->spArgs("site_name");
				$basic_setting['site_domain'] = $this->spArgs("site_domain");
				$basic_setting['site_beian'] = $this->spArgs("site_beian");
				$basic_setting['site_tongji'] = stripslashes($this->spArgs("site_tongji",'','POST','false'));
				$basic_setting['site_need_verify'] = $this->spArgs("site_need_verify");
				$basic_setting['forbid_user_post'] = $this->spArgs("forbid_user_post");
				$basic_setting['site_close'] = $this->spArgs("site_close");
				$basic_setting['lang'] = $this->spArgs("lang");
				$this->session->set_data('lang','');
				$this->ptx_settings->set_value('basic_setting',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->success(T('save_success'),spUrl('admin','setting_basic'));
			}else{
				$locals_dir = APP_PATH.'/lang/';
				$file_list = get_dir_file_info($locals_dir);
				$dir = array();
				foreach ($file_list as $d) {
					$dir[] = $d['name'];
				}
				$this->dirs = $dir;
				$this->site_info = $this->settings['basic_setting'];
				$this->display("/admin/setting_basic.php");
			}
		}
	}

	public function setting_optimizer()
	{
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$basic_setting['cache_time_album'] = $this->spArgs("cache_time_album");
				$basic_setting['cache_time_star'] = $this->spArgs("cache_time_star");
				$basic_setting['cache_time_count'] = $this->spArgs("cache_time_count");
				$basic_setting['rewrite_open'] = $this->spArgs("rewrite_open");
				$basic_setting['site_open'] = $this->spArgs("site_open");
				$this->ptx_settings->set_value('optimizer_setting',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->url_rewrite($basic_setting['rewrite_open']);
				$this->success(T('save_success'),spUrl('admin','setting_optimizer'));
			}else{
				$this->vsettings = $this->settings['optimizer_setting'];
				$this->display("/admin/setting_optimizer.php");
			}
		}
	}

	public function setting_seo()
	{
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$basic_setting['page_title'] = $this->spArgs("page_title");
				$basic_setting['page_keywords'] = $this->spArgs("page_keywords");
				$basic_setting['page_description'] = $this->spArgs("page_description");
				$this->ptx_settings->set_value('seo_setting',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->success(T('save_success'),spUrl('admin','setting_seo'));
			}else{
				$this->vsettings = $this->settings['seo_setting'];
				$this->display("/admin/setting_seo.php");
			}
		}
	}


	public function setting_file()
	{
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$basic_setting['upload_file_size'] = $this->spArgs("upload_file_size");
				$basic_setting['upload_file_type'] = $this->spArgs("upload_file_type");
				$basic_setting['upload_image_size_h'] = $this->spArgs("upload_image_size_h");
				$basic_setting['upload_image_size_w'] = $this->spArgs("upload_image_size_w");
				$basic_setting['fetch_image_size_w'] = $this->spArgs("fetch_image_size_w");
				$basic_setting['fetch_image_size_h'] = $this->spArgs("fetch_image_size_h");
				$this->ptx_settings->set_value('file_setting',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->success(T('save_success'),spUrl('admin','setting_file'));
			}else{
				$this->vsettings = $this->settings['file_setting'];
				$this->display("/admin/setting_file.php");
			}
		}
	}
	//12621817
	//deedb91dfa096e1a9defcb688cfb783a
	//31157669
	public function setting_api()
	{
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting =  array(
					'Taobao'=> array(
								'APPKEY'=>$this->spArgs('taobao_appkey'),
								'APPSECRET'=>$this->spArgs('taobao_appsecret'),
								'CALLBACK'=>$this->spArgs('taobao_callback'),
								'PID'=>$this->spArgs('taobao_pid')
				),
					'Sina'=> array(
								'APPKEY'=>$this->spArgs('sina_appkey'),
								'APPSECRET'=>$this->spArgs('sina_appsecret'),
								'CALLBACK'=>$this->spArgs('sina_callback'),
				),
					'Renren'=> array(
								'APPKEY'=>$this->spArgs('renren_appkey'),
								'APPSECRET'=>$this->spArgs('renren_appsecret'),
								'CALLBACK'=>$this->spArgs('renren_callback'),
				),
					'QQ'=> array(
								'APPKEY'=>$this->spArgs('qq_appkey'),
								'APPSECRET'=>$this->spArgs('qq_appsecret'),
								'CALLBACK'=>$this->spArgs('qq_callback'),
				)
				);

				$this->ptx_settings->set_value('api_setting',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->success(T('save_success'),spUrl('admin','setting_api'));
			}else{
				$this->api = $this->settings['api_setting'];
				$this->api_callback = base_url().'index.php?c=social&a=callback&vendor=';
				$this->display("/admin/setting_api.php");
			}
		}
	}


	public function setting_update()
	{
		if($this->check_admin()){

			$this->display("/admin/setting_update.php");
		}
	}

	public function ui_layout(){
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$basic_setting['homepage_ad'] = $this->spArgs("homepage_ad");
				$basic_setting['pin_auto'] = $this->spArgs("pin_auto");
				$basic_setting['album_auto'] = $this->spArgs("album_auto");
				$basic_setting['face_auto'] = $this->spArgs("face_auto");
				$basic_setting['user_pin_auto'] = $this->spArgs("user_pin_auto");
				$basic_setting['pin_pagenum'] = $this->spArgs("pin_pagenum");
				$basic_setting['face_pagenum'] = $this->spArgs("face_pagenum");
				$basic_setting['count_or_lastest'] = $this->spArgs("count_or_lastest",'count');
				$basic_setting['orgin_post'] = $this->spArgs("orgin_post",0);
				$basic_setting['login_reminder'] = $this->spArgs("login_reminder",0);
				$this->ptx_settings->set_value('ui_layout',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->success(T('save_success'),spUrl('admin','ui_layout'));
			}else{
				$this->vsettings = $this->settings['ui_layout'];
				$this->display("/admin/ui_layout.php");
			}

		}
	}

	public function ui_pin(){
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$basic_setting['pin_commentnum'] = $this->spArgs("pin_commentnum");
				$basic_setting['pin_ad'] = $this->spArgs("pin_ad");
				$this->ptx_settings->set_value('ui_pin',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->success(T('save_success'),spUrl('admin','ui_pin'));
			}else{
				$this->vsettings = $this->settings['ui_pin'];
				$this->display("/admin/ui_pin.php");
			}

		}
	}

	public function ui_detail(){
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$basic_setting['detail_album'] = $this->spArgs("detail_album");
				$basic_setting['detail_same_from'] = $this->spArgs("detail_same_from");
				$basic_setting['detail_history'] = $this->spArgs("detail_history");
				$basic_setting['detail_may_like'] = $this->spArgs("detail_may_like");
				$basic_setting['detail_ad'] = $this->spArgs("detail_ad");
				$this->ptx_settings->set_value('ui_detail',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->success(T('save_success'),spUrl('admin','ui_detail'));
			}else{
				$this->vsettings = $this->settings['ui_detail'];
				$this->display("/admin/ui_detail.php");
			}

		}
	}

	public function ui_styles(){
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$basic_setting['style'] = $this->spArgs("style");
				$basic_setting['color'] = $this->spArgs("color");
				$this->ptx_settings->set_value('ui_styles',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->success(T('save_success'),spUrl('admin','ui_styles'));
			}else{
				$themes_dir = APP_PATH.'/themes/';
				$file_list = get_dir_file_info($themes_dir);
				$dir = array();
				foreach ($file_list as $d) {
					if($d['name']!='admin'&&$d['name']!='install'){
						$dir[] = $d['name'];
					}
				}
				$this->dirs = $dir;
				$this->vsettings = $this->settings['ui_styles'];
				$this->display("/admin/ui_styles.php");
			}
		}
	}

	public function ads_manage(){
		if($this->check_admin()){
			$action = $this->spArgs("act");
			$this->positions = array('homepage_ad','pinpage_ad','detailpage_ad');
			if($action=='add'){
				$ad_position = $this->spArgs("ad_position");
				if(in_array($ad_position, $this->positions)){
					$ads = array();
					$ads['key']= mktime();
					$ads['ad_name'] = $this->spArgs("ad_name");
					$ads['width'] = $this->spArgs("width");
					$ads['height'] = $this->spArgs("height");
					$ads['ad_source'] = stripslashes($this->spArgs("ad_source",'','POST','false'));
					$ads_array = $this->settings[$ad_position];
					$ads_array = !$ads_array?array():$ads_array;
					array_push($ads_array, $ads);
					$this->ptx_settings->set_value($ad_position,$ads_array);
					$this->ptx_settings->updateSettings();
				}
				$this->success(T('save_success'),spUrl('admin','ads_manage'));
			}else if($action=='edit'){
				$key = $this->spArgs("key");
				$ad_position = $this->spArgs("ad_position");
				if(in_array($ad_position, $this->positions)){
					$ads_array = $this->settings[$ad_position];
					foreach ($ads_array as $ads){
						if($ads['key'] == $key){
							$ads_edit = $ads;
							break;
						}
					}
					$ads_edit['ad_position']=$ad_position;
					$this->ads_edit = $ads_edit;
					$this->display('/admin/ads_manage_edit.php');
				}
			}else if($action=='edit_submit'){
				$key = $this->spArgs("key");
				$ad_position = $this->spArgs("ad_position");
				if(in_array($ad_position, $this->positions)){
					$ads_array = $this->settings[$ad_position];
					foreach ($ads_array as $i=>$ads){
						if($ads['key'] == $key){
							$index = $i;
							break;
						}
					}
					$ads_array[$index]['key']= mktime();
					$ads_array[$index]['ad_name'] = $this->spArgs("ad_name");
					$ads_array[$index]['width'] = $this->spArgs("width");
					$ads_array[$index]['height'] = $this->spArgs("height");
					$ads_array[$index]['ad_source'] = stripslashes($this->spArgs("ad_source",'','POST','false'));
					$this->ptx_settings->set_value($ad_position,$ads_array);
					$this->ptx_settings->updateSettings();
				}
				$this->success(T('save_success'),spUrl('admin','ads_manage'));
				return;
			}else if($action=='delete'){
				$key = $this->spArgs("key");
				$ad_position = $this->spArgs("ad_position");
				if(in_array($ad_position, $this->positions)){
					$ads_array = $this->settings[$ad_position];
					foreach ($ads_array as $i=>$ads){
						if($ads['key'] == $key){
							$index = $i;
							break;
						}
					}
					array_splice($ads_array, $index,1);
					$this->ptx_settings->set_value($ad_position,$ads_array);
					$this->ptx_settings->updateSettings();
				}
				$this->success(T('del_succeed'),spUrl('admin','ads_manage'));
			}else{
				$this->homepage_ads = $this->settings['homepage_ad'];
				$this->pinpage_ads = $this->settings['pinpage_ad'];
				$this->detailpage_ads = $this->settings['detailpage_ad'];
				$this->display("/admin/ads_manage.php");
			}

		}
	}

	public function sys_usergroup(){
		if($this->check_admin()){
			$act = $this->spArgs("act");
			$group_id = $this->spArgs("group_id");
			$this->group_type = $this->spArgs("group_type",'member');
			$ptx_usergroup = spClass('ptx_usergroup');
			if($group_id){
				$conditions['usergroup_id'] = $group_id;
				$this->usergroup = $ptx_usergroup->find($conditions);
				$this->group_type = $this->usergroup['usergroup_type'];
			}
			$this->usergroup_nav = $this->render("/admin/usergroup_nav.php");
			if($act=='delete'&&$this->usergroup){
				$ptx_usergroup->delete($conditions);
				$ptx_usergroup->updateUsergroups();
				$this->jump(spUrl('admin', 'sys_usergroup'));
				return;
			}else if($act=='edit'&&$this->usergroup){
				if($this->spArgs('group_type')){
					$data['credits_higher'] = $this->spArgs('credits_higher');
					$data['credits_lower'] = $this->spArgs('credits_lower');
					$data['stars'] = $this->spArgs('stars');
					$data['color'] = $this->spArgs('color');

					$data['allow_visit'] = $this->spArgs('allow_visit');
					$data['allow_share'] = $this->spArgs('allow_share');
					$data['need_verify'] = $this->spArgs('need_verify');


					$data['other_permission']['allow_sendpm'] = $this->spArgs('allow_sendpm');
					$data['other_permission']['allow_video'] = $this->spArgs('allow_video');
					$data['other_permission']['allow_comment'] = $this->spArgs('allow_comment');
					$data['other_permission']['allow_at_friend'] = $this->spArgs('allow_at_friend');
					$data['other_permission']['allow_smile'] = $this->spArgs('allow_smile');

					$data['other_permission']['allow_subdomain'] = $this->spArgs('allow_subdomain');
					$data['other_permission']['share_maxnum'] = $this->spArgs('share_maxnum');
					$data['other_permission']['fllow_maxnum'] = $this->spArgs('fllow_maxnum');
					$data['other_permission']['album_maxnum'] = $this->spArgs('album_maxnum');

					$data['other_permission']['upload_maxnum'] = $this->spArgs('upload_maxnum');
					$data['other_permission']['upload_maxsize'] = $this->spArgs('upload_maxsize');

					$data['other_permission']['allow_invite'] = $this->spArgs('allow_invite');
					$data['other_permission'] = serialize($data['other_permission']);
					$ptx_usergroup->update($conditions,$data);
					$ptx_usergroup->updateUsergroups();
					$this->success(T('edit_succeed'),spUrl('admin', 'sys_usergroup',array('group_type'=>$this->group_type)));
					return;
				}else{
					$this->other_permission = unserialize($this->usergroup['other_permission']);
					$this->display("/admin/usergroup_edit.php");
					return;
				}
			}else if($act=='add'){
				$data['usergroup_title'] = $this->spArgs('usergroup_title');
				$data['credits_higher'] = $this->spArgs('credits_higher');
				$data['credits_lower'] = $this->spArgs('credits_lower');
				$data['stars'] = $this->spArgs('stars');
				$data['color'] = $this->spArgs('color');
				$data['usergroup_type']=$this->group_type;
				$ptx_usergroup->create($data);
				$ptx_usergroup->updateUsergroups();
				$this->success(T('save_success'),spUrl('admin', 'sys_usergroup',array('group_type'=>$this->group_type)));
				return;
			}else{
				$conditions_search['usergroup_type'] = $this->group_type;
				$this->usergroups = $ptx_usergroup->search($conditions_search);
				$this->display("/admin/usergroup_list.php");
				return;
			}
		}
	}

	function checkformulasyntax($formula, $operators, $tokens) {
		$var = implode('|', $tokens);
		$operator = implode('', $operators);

		$operator = str_replace(
		array('+', '-', '*', '/', '(', ')', '{', '}', '\''),
		array('\+', '\-', '\*', '\/', '\(', '\)', '\{', '\}', '\\\''),
		$operator
		);
		$str = preg_replace("/($var)/", "\$\\1", $formula);
		if(!empty($formula)) {
			if(!preg_match("/^([$operator\.\d\(\)]|(($var)([$operator\(\)]|$)+))+$/", $formula) || !is_null(eval($str.';'))){
				return false;
			}
		}
		return $str;
	}

	function checkformulacredits($formula) {
		return $this->checkformulasyntax(
		$formula,
		array('+', '-', '*', '/', ' '),
		array('ext_credits_[1-3]', 'total_followers', 'total_shares', 'total_likes')
		);
	}

	public function credit_setting(){
		if($this->check_admin()){
			$this->credit_setting_nav = $this->render("/admin/credit_setting_nav.php");
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$credit_formula = $this->spArgs("credit_formula");
				$basic_setting['credit_formula_exe'] = $this->checkformulacredits($credit_formula);
				$basic_setting['credit_formula'] = $credit_formula;
				$this->ptx_settings->set_value('credit_setting',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->success(T('save_success'),spUrl('admin','credit_setting'));
			}else{
				$this->vsettings = $this->settings['credit_setting'];
				$this->display("/admin/credit_setting.php");
			}
		}
	}

	public function credit_strategy(){
		if($this->check_admin()){
			$this->event_arr = array('login_everyday','post_comment','post_share','post_video','forward_share','been_like','been_like_album','add_like','add_like_album','email_active','create_avatar');
			$this->credit_setting_nav = $this->render("/admin/credit_setting_nav.php");
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				foreach ($this->event_arr as $evt) {
					for ($i=1;$i<=3;$i++){
						$key_str = $evt.'_credits_'.$i;
						$basic_setting[$key_str] = $this->spArgs($key_str);
					};
				}

				$this->ptx_settings->set_value('credit_strategy',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->success(T('save_success'),spUrl('admin','credit_strategy'));
			}else{
				$this->vsettings = $this->settings['credit_strategy'];
				$this->display("/admin/credit_strategy.php");
			}
		}
	}

	public function forum_setting(){
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$basic_setting['open_forumline'] = $this->spArgs("open_forumline");
				$basic_setting['bbs_domain'] = $this->spArgs("bbs_domain");
				$basic_setting['bbs_dbhost'] = $this->spArgs("bbs_dbhost");
				$basic_setting['bbs_dbname'] = $this->spArgs("bbs_dbname");
				$basic_setting['bbs_dbuser'] = $this->spArgs("bbs_dbuser");
				$basic_setting['bbs_dbpre'] = $this->spArgs("bbs_dbpre");
				$basic_setting['bbs_dbpassword'] = $this->spArgs("bbs_dbpassword");
				$this->ptx_settings->set_value('forum_setting',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->forumline($basic_setting);
				$this->success(T('save_success'),spUrl('admin','forum_setting'));
			}else{
				$this->vsettings = $this->settings['forum_setting'];
				$this->display("/admin/forum_setting.php");
			}
		}
	}

	private function forumline($settings){
		$config = spClass('Options');
		if($config->load('config.php')){
			$forum_setting = array (
							    'open' => $settings['open_forumline'],
							    'driver' => 'mysql',
							    'host' => $settings['bbs_dbhost'],
							    'port' => '3306',
							    'login' => $settings['bbs_dbuser'],
							    'password' => $settings['bbs_dbpassword'],
							    'database' => $settings['bbs_dbname'],
							    'prefix' => $settings['bbs_dbpre'],
							    'persistent' => false,
			);
			$config->set_item('bbs',$forum_setting);
			$config->save('config.php');
		}
	}

	public function ucenter_setting(){
		if($this->check_admin()){
			$action = $this->spArgs("act");
			if($action=='save'){
				$basic_setting = array();
				$basic_setting['ucenter_open'] = $this->spArgs("ucenter_open");
				$basic_setting['ucenter_domain'] = $this->spArgs("ucenter_domain");
				$basic_setting['ucenter_dbhost'] = $this->spArgs("ucenter_dbhost");
				$basic_setting['ucenter_dbname'] = $this->spArgs("ucenter_dbname");
				$basic_setting['ucenter_dbpre'] = $this->spArgs("ucenter_dbpre");
				$basic_setting['ucenter_dbuser'] = $this->spArgs("ucenter_dbuser");
				$basic_setting['ucenter_dbpassword'] = $this->spArgs("ucenter_dbpassword");
				$basic_setting['ucenter_appid'] = $this->spArgs("ucenter_appid");
				$basic_setting['ucenter_appkey'] = $this->spArgs("ucenter_appkey");
				$this->ptx_settings->set_value('ucenter_setting',$basic_setting);
				$this->ptx_settings->updateSettings();
				$this->ucenter_config($basic_setting);
				$this->success(T('save_success'),spUrl('admin','ucenter_setting'));
			}else{
				$this->vsettings = $this->settings['ucenter_setting'];
				$this->display("/admin/ucenter_setting.php");
			}
		}
	}

	private function ucenter_config($settings){
		$config = spClass('Options');
		if($config->load('config.php')){
			$forum_setting = array (
						    'UC_OPEN' => $settings['ucenter_open'],
						    'UC_DEBUG' => true,
						    'UC_CONNECT' => 'mysql',
						    'UC_DBHOST' => $settings['ucenter_dbhost'],
						    'UC_DBUSER' => $settings['ucenter_dbuser'],
						    'UC_DBPW' => $settings['ucenter_dbpassword'],
						    'UC_DBNAME' => $settings['ucenter_dbname'],
						    'UC_DBCHARSET' => 'utf8',
						    'UC_DBTABLEPRE' => $settings['ucenter_dbpre'],
						    'UC_DBCONNECT' => 0,
						    'UC_CHARSET' => 'utf-8',
						    'UC_KEY' => $settings['ucenter_appkey'],
						    'UC_API' => $settings['ucenter_domain'],
						    'UC_APPID' => $settings['ucenter_appid'],
						    'UC_IP' => '127.0.0.1',
						    'UC_PPP' => 20,
			);
			$config->set_item('ucenter',$forum_setting);
			$config->save('config.php');
		}
	}

	public function item_list()
	{
		if($this->check_admin()){
			$action = $this->spArgs("act");
			$item_id = $this->spArgs("item_id");
			$this->message = $this->spArgs("message");
			$ptx_item = spClass('ptx_item');
			$ptx_share = spClass('ptx_share');
			if($item_id){
				$conditions['item_id'] = $item_id;
				$this->item = $ptx_item->find($conditions);
				$this->share = $ptx_share->find($conditions);
			}

			if($action=='delete'&&$this->item){
				$ptx_item->update($conditions,array('is_deleted'=>1));
				$this->jump(spUrl('admin', 'item_list'));
				return;
			}else if($action=='push'&&$this->item){
				$ptx_item->update($conditions,array('is_show'=>2));
				$this->jump(spUrl('admin', 'item_list'));
				return;
			}else if($action=='depush'&&$this->item){
				$ptx_item->update($conditions,array('is_show'=>1));
				$this->jump(spUrl('admin', 'item_list'));
				return;
			}else if($action=='verify'&&$this->item){
				$ptx_item->update($conditions,array('is_show'=>1));
				$albums = $ptx_share->find_albums_by_item($item_id);
				$ptx_album = spClass('ptx_album');
				foreach ($albums as $album) {
					$ptx_album->update_album_cover($album['album_id']);
				}
				$this->jump(spUrl('admin', 'item_list'));
				return;
			}else if($action=='deverify'&&$this->item){
				$ptx_item->update($conditions,array('is_show'=>0));
				$this->jump(spUrl('admin', 'item_list'));
				return;
			}else if($action=='edit'&&$this->item){
				$this->display("/admin/item_edit.php");
				return;
			}else if($action=='edit_save'&&$this->item){
				$segment = spClass('Segment');
				$update_data['intro'] = $this->spArgs('intro');
				$segment_str = $segment->segment($update_data['intro']);
				$update_data['intro_search'] = $segment_str['py'];
				$update_data['keywords'] = $segment_str['cn'];

				$update_data['price'] = $this->spArgs("price");
				$update_data['title'] = $this->spArgs("title");
				$update_data['promotion_url'] = $this->spArgs("promotion_url");
				$share_update_data['category_id'] = $this->spArgs("category_id");
				$ptx_share->update($conditions,$share_update_data);
				if($ptx_item->update($conditions,$update_data)){
					$this->jump(spUrl('admin', 'item_list'));
				}else{
					$this->jump(spUrl('admin','item_list', array('act'=>'edit','item_id'=>$item['item_id'],'message'=>'修改失败')));
					return;
				}
				return;
			}else if($action=='search'){
				$conditions['orgin_post']=1;
				$page = $this->spArgs("page",1);
				if(NULL!=$this->spArgs("is_show")){
					$conditions['is_show'] = $this->spArgs("is_show");
				}
				if($category_id = $this->spArgs("category_id")){
					$conditions['category_id'] = $category_id;
				}
				if($keyword = $this->spArgs("keyword")){
					$segment = spClass('Segment');
					$conditions['keyword'] = $segment->convert_to_py($keyword);
				}
				$this->items = $ptx_share->search($conditions,$page,15);
				$conditions['act'] = 'search';
				$this->pages = createPages($ptx_share->spPager()->getPager(), 'admin', 'item_list',$conditions);
				$this->display("/admin/item_list.php");
			}else{

				$conditions['orgin_post']=1;
				//$conditions['is_deleted'] = 0;
				$page = $this->spArgs("page",1);

				$this->items = $ptx_share->search($conditions,$page,15);
				//var_dump($this->shares);
				//$this->items = $ptx_item->spPager($page, 15)->findAll($conditions,' item_id DESC ');
				$this->pages = createPages($ptx_share->spPager()->getPager(), 'admin', 'item_list');
				$this->display("/admin/item_list.php");
			}
		}
	}

	public function smile_list()
	{
		if($this->check_admin()){
			$act = $this->spArgs("act");
			$smile_id = $this->spArgs("smile_id");
			$ptx_smile = spClass('ptx_smile');
			if($smile_id){
				$conditions['smile_id'] = $smile_id;
				$this->smile = $ptx_smile->find($conditions);
			}
			if($act=='delete'&&$this->smile){
				$ptx_smile->delete($conditions);
				$ptx_smile->updateSmiliesCache();
				$this->jump(spUrl('admin', 'smile_list'));
				return;
			}else if($act=='edit'&&$this->smile){
				if($data['code'] = $this->spArgs('code')){
					$data['displayorder'] = $this->spArgs('displayorder');
					$data['url'] = $this->spArgs('url');
					$ptx_smile->update($conditions,$data);
					$ptx_smile->updateSmiliesCache();
					$this->jump(spUrl('admin', 'smile_list'));
					return;
				}else{
					$this->display("/admin/smile_edit.php");
					return;
				}
			}else if($act=='add'){
				$data['code'] = $this->spArgs('code');
				$data['displayorder'] = $this->spArgs('displayorder');
				$data['url'] = $this->spArgs('url');
				$data['typeid'] = 1;
				$ptx_smile->create($data);
				$ptx_smile->updateSmiliesCache();
				$this->jump(spUrl('admin', 'smile_list'));
				return;
			}else{
				$this->smiles = $ptx_smile->findAll();
				$this->display("/admin/smile_list.php");
				return;
			}
		}
	}

	public function category_list()
	{
		if($this->check_admin()){
			$act = $this->spArgs("act");
			$category_id = $this->spArgs("catid");
			$category_model = spClass('ptx_category');
			if($category_id){
				$conditions['category_id'] = $category_id;
				$this->category = $category_model->find($conditions);
			}
			if($act=='delete'&&$this->category){
				$category_model->delete_category($conditions);
				$category_model->update_category_top();
				$this->jump(spUrl('admin', 'category_list'));
				return;
			}else if($act=='edit'&&$this->category){
				if($data['category_name_cn'] = $this->spArgs('category_name_cn')){
					$data['category_name_en'] = $this->spArgs('category_name_en');
					$data['category_hot_words'] = $this->spArgs('category_hot_words');
					$data['display_order'] = $this->spArgs('display_order');
					$data['is_open'] = $this->spArgs('is_open');
					$data['is_home'] = $this->spArgs('is_home');
					$category_model->update($conditions,$data);
					$category_model->update_category_top();
					$this->jump(spUrl('admin', 'category_list'));
					return;
				}else{
					$this->display("/admin/category_edit.php");
					return;
				}
			}else if($act=='add'){
				$data['category_name_cn'] = $this->spArgs('category_name_cn');
				$data['category_name_en'] = $this->spArgs('category_name_en');
				$data['category_hot_words'] = $this->spArgs('category_hot_words');
				$data['display_order'] = $this->spArgs('display_order');
				$category_model->create($data);
				$category_model->update_category_top();
				$this->jump(spUrl('admin', 'category_list'));
				return;
			}else{
				$this->categories = $category_model->get_category();
				$this->display("/admin/category_list.php");
				return;
			}
		}
	}

	public function user_list()
	{
		if($this->check_admin()){
			$act = $this->spArgs("act");
			$user_id = $this->spArgs("uid");
			$ptx_user = spClass('ptx_user');
			$ptx_usergroup = spClass('ptx_usergroup');
			$this->usergroups = $ptx_usergroup->getUsergroups();
			if($user_id){
				$conditions['user_id'] = $user_id;
				$this->user = $ptx_user->getuser_byid($user_id);
			}
			if($act=='delete'&&$this->user){
				$this->jump(spUrl('admin', 'user_list'));
				return;
			}else if($act=='search'){
				$page = $this->spArgs("page",1);
				if(NULL!=$this->spArgs("user_type")){
					$conditions['user_type'] = $this->spArgs("user_type");
				}
				if($search_txt = $this->spArgs("keyword")){
					$conditions['keyword'] = $search_txt;
				}
				$this->users = $ptx_user->search($conditions,$page,15,null,' ptx_user.user_id ASC ');
				$conditions['act'] = 'search';
				$this->pages = createTPages($ptx_user->spPager()->getPager(), 'admin', 'user_list',$conditions);
				$this->display("/admin/user_list.php");
			}else if($act=='edit'&&$this->user){
				if($this->spArgs("hash")){
					if($this->spArgs("password")){
						$data['passwd'] = md5($this->spArgs("password"));
					}
					$data['usergroup_id'] = $this->spArgs("usergroup_id");
					$data['user_type'] = $this->spArgs("user_type");
					$data['user_title'] = $this->spArgs("user_title");
					$data['bio'] = $this->spArgs("bio");
					$ptx_user->update($conditions,$data);
					$this->success(T('save_success'),spUrl('admin','user_list'));
					return;
				}else{
					$this->display("/admin/user_edit.php");
					return;
				}
			}else{
				$page = $this->spArgs("page",1);
				$this->users = $ptx_user->search($conditions,$page,15,null,' ptx_user.user_id ASC ');
				$this->pages = createTPages($ptx_user->spPager()->getPager(), 'admin', 'user_list',$conditions);
				$this->display("/admin/user_list.php");
			}
		}
	}

	public function staruser_list()
	{
		if($this->check_admin()){
			$act = $this->spArgs("act");
			$starid = $this->spArgs("starid");
			$ptx_staruser = spClass('ptx_staruser');
			$ptx_user = spClass('ptx_user');
			if($starid){
				$find_data['star_id'] = $starid;
				$this->star = $ptx_staruser->find_one($find_data);
			}
			if($act=='delete'&&$this->star){
				$ptx_staruser->del_one($find_data);
				$ptx_staruser->update_staruser_cache();
				$ptx_user->update_staruser($this->star['user_id'],0);
				$this->success(T('save_success'),spUrl('admin','staruser_list'));
				return;
			}else if($act=='search'){
				$page = $this->spArgs("page",1);
				if($search_txt = $this->spArgs("keyword")){
					$conditions['keyword'] = $search_txt;
				}
				$this->starusers = $ptx_staruser->search($conditions,$page,15);
				$conditions['act'] = 'search';
				$this->pages = createTPages($ptx_staruser->spPager()->getPager(), 'admin', 'staruser_list',$conditions);
				$this->display("/admin/staruser_list.php");
			}else if($act=='edit'&&$this->star){
				if($this->spArgs('hash')){
					$data['star_reason'] = $this->spArgs("star_reason");
					$data['category_id'] = $this->spArgs("category_id");
					$ptx_staruser->update($find_data,$data);
					$this->success(T('save_success'),spUrl('admin','staruser_list'));
					return;
				}else{
					$this->display("/admin/staruser_edit.php");
					return;
				}
			}else{
				$page = $this->spArgs("page",1);
				$this->starusers = $ptx_staruser->search($conditions,$page,15);
				$this->pages = createTPages($ptx_staruser->spPager()->getPager(), 'admin', 'staruser_list',$conditions);
				$this->display("/admin/staruser_list.php");
			}
		}
	}

	public function goodshop_list()
	{
		if($this->check_admin()){
			$act = $this->spArgs("act");
			$shopid = $this->spArgs("shopid");
			$ptx_goodshop = spClass('ptx_goodshop');
			$ptx_user = spClass('ptx_user');
			if($shopid){
				$find_data['shop_id'] = $shopid;
				$this->shop = $ptx_goodshop->find_one($find_data);
			}
			if($act=='delete'&&$this->shop){
				$ptx_goodshop->del_one($find_data);
				$ptx_goodshop->update_goodshop_cache();
				$ptx_user->update_shopuser($this->shop['user_id'],0);
				$this->success(T('save_success'),spUrl('admin','goodshop_list'));
				return;
			}else if($act=='search'){
				$page = $this->spArgs("page",1);
				if($search_txt = $this->spArgs("keyword")){
					$conditions['keyword'] = $search_txt;
				}
				$this->goodshops = $ptx_goodshop->search($conditions,$page,15);
				$conditions['act'] = 'search';
				$this->pages = createTPages($ptx_goodshop->spPager()->getPager(), 'admin', 'goodshop_list',$conditions);
				$this->display("/admin/goodshop_list.php");
			}else if($act=='edit'&&$this->shop){
				if($this->spArgs('hash')){
					$data['shop_desc'] = $this->spArgs("shop_desc");
					$data['category_id'] = $this->spArgs("category_id");
					$data['display_order'] = $this->spArgs("display_order");
					$ptx_goodshop->update($find_data,$data);
					$this->success(T('save_success'),spUrl('admin','goodshop_list'));
					return;
				}else{
					$this->display("/admin/goodshop_edit.php");
					return;
				}
			}else{
				$page = $this->spArgs("page",1);
				$this->goodshops = $ptx_goodshop->search($conditions,$page,15);
				$this->pages = createTPages($ptx_goodshop->spPager()->getPager(), 'admin', 'goodshop_list',$conditions);
				$this->display("/admin/goodshop_list.php");
			}
		}
	}

	public function apply_list()
	{
		if($this->check_admin()){
			$act = $this->spArgs("act");
			$applyid = $this->spArgs("applyid");
			$ptx_apply = spClass("ptx_apply");
			if($applyid){
				$conditions['apply_id'] = $applyid;
				$apply = $ptx_apply->find_one($conditions);
			}
			if($act=='disagree'&&$apply){
				$ptx_apply->disagree($applyid);
				$ptx_message = spClass("ptx_message");
				$ptx_message->dis_apply($this->current_user['user_id'],$apply['user_id'],$apply['apply_type']);
				$this->jump(spUrl('admin', 'apply_list'));
				return;
			}else if($act=='agreen'&&$apply){
				$ptx_apply->agree($applyid);
				$ptx_message = spClass("ptx_message");
				$ptx_message->add_apply($this->current_user['user_id'],$apply['user_id'],$apply['apply_type']);
				$this->jump(spUrl('admin', 'apply_list'));
				return;
			}else{
				$page = $this->spArgs("page",1);
				$this->applys = $ptx_apply->search(null,$page,20);
				$this->display("/admin/apply_list.php");
			}
		}
	}

	public function update_cache()
	{
		if($this->check_admin()){
			$act = $this->spArgs("act");
			if($act=='update'){
				$cat_cache = $this->spArgs("cat_cache");
				$count_cache = $this->spArgs("count_cache");
				$staruser_cache = $this->spArgs("staruser_cache");
				$goodshop_cache = $this->spArgs("goodshop_cache");
				$smile_cache = $this->spArgs("smile_cache");
				$sys_cache = $this->spArgs("sys_cache");

				if($cat_cache){
					$ptx_category = spClass('ptx_category');
					$ptx_category->update_category_top();
				}
				if($count_cache){
					$this->update_count();
				}
				if($staruser_cache){
					$ptx_staruser = spClass('ptx_staruser');
					$ptx_staruser->update_staruser_cache();
				}
				if($goodshop_cache){
					$ptx_goodshop = spClass('ptx_goodshop');
					$ptx_goodshop->update_goodshop_cache();
				}
				if($sys_cache){
					$ptx_settings = spClass('ptx_settings');
					$ptx_settings->updateSettings();
				}
				if($smile_cache){
					$ptx_smile = spClass('ptx_smile');
					$ptx_smile->updateSmiliesCache();
				}
				$this->success(T('update_succeed'),spUrl('admin','update_cache'));
				return;
			}else{
				$this->display("/admin/update_cache.php");
			}
		}
	}



	public function tag_list()
	{
		if($this->check_admin()){
			$act = $this->spArgs("act");
			$tag_id = $this->spArgs("tagid");
			$tag_model = spClass('ptx_tag');
			$category_model = spClass('ptx_category');
			if($tag_id){
				$conditions['tag_id'] = $tag_id;
				$this->tag = $tag_model->find($conditions);
			}
			$this->categories = $category_model->findAll();

			if($act=='delete'&&$this->tag){
				$tag_model->delete($conditions);
				$this->jump(spUrl('admin', 'tag_list'));
				return;
			}else if($act=='edit'&&$this->tag){
				if($data['tag_group_name_cn'] = $this->spArgs('tag_group_name_cn')){
					$data['category_id'] = $this->spArgs('category_id');
					$data['tag_group_name_en'] = $this->spArgs('tag_group_name_en');
					$data['display_order'] = $this->spArgs('display_order');
					$data['tags'] = $this->spArgs('tags');
					$tag_model->update($conditions,$data);
					$this->jump(spUrl('admin', 'tag_list'));
					return;
				}else{
					$this->display("/admin/tag_edit.php");
					return;
				}

			}else if($act=='add'){
				$data['tag_group_name_cn'] = $this->spArgs('tag_group_name_cn');
				$data['category_id'] = $this->spArgs('category_id');
				$data['tag_group_name_en'] = $this->spArgs('tag_group_name_en');
				$data['display_order'] = $this->spArgs('display_order');
				$data['tags'] = $this->spArgs('tags');
				$tag_model->create($data);
				$this->jump(spUrl('admin', 'tag_list'));
				return;
			}else{
				$this->tags = $tag_model->spLinker()->findAll();
				$this->display("/admin/tag_list.php");
				return;
			}
		}
	}


	public function database_management()
	{
		if($this->check_admin()){
			$db = spClass('dbbackup', array(0=>$GLOBALS['G_SP']['db']));

			$this->table =  $db->showAllTable($this->spArgs('chk',0));
			$this->display("/admin/database_management.php");
		}
	}

	public function database_backup(){
		if($this->check_admin()){
			$db = spClass('dbbackup', array(0=>$GLOBALS['G_SP']['db']));
			$act = $this->spArgs("act");
			$table = $this->spArgs("table");
			if($act=='outall'&&$db){
				$db->outAllData();
			}elseif($act=='optimize'&&$db&&$table){
				$db->optimizeTable($table);
				$this->jump(spUrl('admin', 'database_management'));
			}elseif($act=='repair'&&$db&&$table){
				$db->repairTable($table);
				$this->jump(spUrl('admin', 'database_management'));
			}elseif($act=='outone'&&$db&&$table){
				$db->outTable($table);
			}
		}
	}

	public function database_download(){
		if($this->check_admin()){
			import(APP_PATH.'/include/download_functions.php');
			$file_name = $this->spArgs('fname');
			$dbbackup_dir = APP_PATH.'/data/database';
			$data = file_get_contents($dbbackup_dir."/".$file_name); // 读文件内容
			force_download($file_name, $data);
		}
	}

	public function system_update(){
		if($this->check_admin()){
			$this->version = $GLOBALS['G_SP']['product_info']["version"];
			if(!$this->version)
			$this->version='2.5';

			$this->display("/admin/system_update.php");
		}
	}

	public function frindlink_list()
	{
		if($this->check_admin()){
			$act = $this->spArgs("act");
			$friendlinks = $this->settings['frindlink'];
			if($act=='add'){
				if($link_url = $this->spArgs("link_url")){
					$link = array(
						'key'=>mktime(),
						'link_url'=>$link_url,
						'link_name'=>$this->spArgs("link_name")
					);
					if(!is_array($friendlinks)){
						$friendlinks = array();
					}
					array_push($friendlinks, $link);
					$this->ptx_settings->set_value('frindlink',$friendlinks);
					$this->ptx_settings->updateSettings();
				}
			}elseif($act=='delete'){
				$key = $this->spArgs("key");
				foreach ($friendlinks as $i=>$frindlink){
					if($frindlink['key'] == $key){
						$index = $i;
						break;
					}
				}
				array_splice($friendlinks, $index,1);
				$this->ptx_settings->set_value('frindlink',$friendlinks);
				$this->ptx_settings->updateSettings();
			}
			$this->links = $friendlinks?$friendlinks:array();
			$this->display("/admin/frindlink_list.php");
		}
	}

	function homepage_slide(){
		if($this->check_admin()){
			$act = $this->spArgs("act");
			$homeslide = $this->settings['homeslide'];
			if($act=='add'){
				if($image_url = $this->spArgs("filename")){
					$slide_image = array(
						'key'=>mktime(),
						'image_url'=>'data/attachments/homeslide/'.$image_url,
						'link_url'=>$this->spArgs("link_url"),
						'order'=>$this->spArgs("order"),
						'desc'=>$this->spArgs("desc")
					);

					if(!is_array($homeslide)){
						$homeslide = array();
					}
					array_push($homeslide, $slide_image);
					$homeslide = sysSortArray($homeslide, 'order', 'SORT_ASC','SORT_NUMERIC');
					$this->ptx_settings->set_value('homeslide',$homeslide);
					$this->ptx_settings->updateSettings();
				}
			}elseif($act=='edit'){
				$key = $this->spArgs("key");
				foreach ($homeslide as $slide){
					if($slide['key'] == $key){
						$slide_edit = $slide;
						break;
					}
				}
				$this->slide = $slide_edit;
				$this->display("/admin/homepage_slide_edit.php");
				return;
			}elseif($act=='edit_submit'){
				$key = $this->spArgs("key");
				foreach ($homeslide as $i=>$slide){
					if($slide['key'] == $key){
						$index = $i;
						break;
					}
				}
				$homeslide[$index]['link_url'] = $this->spArgs("link_url");
				$homeslide[$index]['order'] = $this->spArgs("order");
				$homeslide[$index]['desc'] = $this->spArgs("desc");
				$homeslide = sysSortArray($homeslide, 'order', 'SORT_ASC','SORT_NUMERIC');
				$this->ptx_settings->set_value('homeslide',$homeslide);
				$this->ptx_settings->updateSettings();
				$this->jump(spUrl('admin','homepage_slide'));
				return;
			}elseif($act=='upload'){
				import(APP_PATH.'/include/ajaxuploader.php');
				$settings =  $this->settings;
				if($settings['file_setting']){
					$allowedExtensions = explode('|',$settings['file_setting']['upload_file_type']);
					$sizeLimit = $settings['file_setting']['upload_file_size']*1024;
				}else{
					$allowedExtensions = array('jpg','jpeg','gif','png');
					$sizeLimit = 2 * 1024 * 1024;
				}
				$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

				$temp_dir = '/data/attachments/homeslide/';
				(!is_dir(APP_PATH.$temp_dir))&&@mkdir(APP_PATH.$temp_dir,0777,true);
				$result = $uploader->handleUpload(APP_PATH.$temp_dir);
				echo json_encode($result);
				return;
			}elseif($act=='delete'){
				$key = $this->spArgs("key");
				foreach ($homeslide as $i=>$slide){
					if($slide['key'] == $key){
						$index = $i;
						$image_url = $slide['image_url'];
						break;
					}
				}
				array_splice($homeslide, $index,1);
				if($image_url){
					file_exists(APP_PATH.'/'.$image_url) && unlink(APP_PATH.'/'.$image_url);
				}
				$this->ptx_settings->set_value('homeslide',$homeslide);
				$this->ptx_settings->updateSettings();
			}
			$this->slides = $homeslide?$homeslide:array();
			$this->display("/admin/homepage_slide.php");
		}
	}


}

