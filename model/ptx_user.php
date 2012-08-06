<?php

class ptx_user extends spModelMulti
{
public $pk = 'user_id';
public $table = 'ptx_user';
var $addrules = array(
'rule_checknick'=>array('ptx_user','checknick'),
'rule_checkemail'=>array('ptx_user','checkemail'),
);
var $verifier_register = array(
"rules"=>array(
'nickname'=>array(  
'notnull'=>TRUE,
'minlength'=>2,
'maxlength'=>20,
'rule_checknick'=>TRUE,
),
'password'=>array(
'notnull'=>TRUE,
'minlength'=>6,
'maxlength'=>15,
),
'email'=>array(  
'notnull'=>TRUE,
'email'=>TRUE,
'minlength'=>5,
'maxlength'=>30,
'rule_checkemail'=>TRUE,
),
),
"messages"=>array( 
'nickname'=>array(  
'notnull'=>"用户名不能为空",
'minlength'=>"用户名长度不能少于2",
'maxlength'=>"用户名长度不能大于20个字符",
'rule_checknick'=>"用户名已存在",
),
'password'=>array(  
'notnull'=>"密码不能为空",
'minlength'=>"密码长度不能少于6个字符",
'maxlength'=>"密码长度不能大于15个字符",
),
'email'=>array(   
'notnull'=>"电子邮件不能为空",
'email'=>"电子邮件格式不正确",
'minlength'=>"电子邮件长度不能少于5个字符",
'maxlength'=>"电子邮件长度不能大于30个字符",
'rule_checkemail'=>"该电子邮件已注册",
),
),
);
var $verifier_resetpasswd = array(
"rules"=>array(
'password'=>array(
'notnull'=>TRUE,
'minlength'=>6,
'maxlength'=>15,
),
'email'=>array(  
'notnull'=>TRUE,
'email'=>TRUE,
'minlength'=>5,
'maxlength'=>30,
'rule_checkemail'=>TRUE,
),
),
"messages"=>array( 
'password'=>array(  
'notnull'=>"密码不能为空",
'minlength'=>"密码长度不能少于6个字符",
'maxlength'=>"密码长度不能大于15个字符",
),
'email'=>array(   
'notnull'=>"电子邮件不能为空",
'email'=>"电子邮件格式不正确",
'minlength'=>"电子邮件长度不能少于5个字符",
'maxlength'=>"电子邮件长度不能大于30个字符",
'rule_checkemail'=>"该电子邮件已注册",
),
),
);
private function init_conditions($conditions){
$conditions_user = NULL;
if(isset($conditions['keyword'])){
$keyword = $this->escape($conditions['keyword']);
$conditions_user .= "AND MATCH (ptx_user.nickname) AGAINST ({$keyword} IN BOOLEAN MODE) OR MATCH (ptx_user.email) AGAINST ({$keyword} IN BOOLEAN MODE) ";
}
if(isset($conditions['user_type'])){
$user_type = $this->escape($conditions['user_type']);
$conditions_user .= "AND ptx_user.user_type={$user_type} ";
}
if(strpos($conditions_user,'AND') === 0){
$conditions_user = substr($conditions_user,3);
}
return $conditions_user;
}
public function search($conditions=NULL,$page,$pagesize,$fields = null,$sort=null){
$conditions = $this->init_conditions($conditions);
if(!$sort)
$sort = " ptx_user.total_followers DESC ";
if(!$fields)
$fields = " ptx_user.* ";
return $this->spPager($page,$pagesize)->findAllJoin($conditions,$sort,$fields);
}
public function search_no_page($conditions=NULL,$fields = null,$sort=null,$limit){
if(!$sort)
$sort = " ptx_user.total_followers DESC ";
return $this->findAllJoin($conditions,$sort,$fields,$limit);
}
public function find_userid_by_uname($name_arr){
$ret .= is_array($name_arr) ?implode(',',self::quote($name_arr)) : self::quote($name_arr);
return $this->findAll(" ptx_user.nickname in ({$ret}) ",null ,' ptx_user.user_id,ptx_user.nickname ');
}
public function get_user_flashdata($user_id){
$condition['user_id'] = $user_id;
$fields = ' ptx_user.user_type,ptx_user.usergroup_id,ptx_user.credits,ptx_user.ext_credits_1,ptx_user.ext_credits_2,ptx_user.ext_credits_3 ';
return $this->find($condition,null,$fields);
}
public function checknick($val,$right)
{
return false == $this->find(array("nickname"=>$nickname));
}
public function checkemail($val,$right)
{
return false == $this->find(array("email"=>$val));
}
public function login($data)
{
$ucenter = spClass("Ucenter");
$user = $this->find(array('email'=>$data['email']));
if($user){
if($user['user_type']==0){
$response = array('result'=>false,'msg'=>T('account_has_been_banned'));
return $response;
}
if( $user['passwd'] === md5($data['password'])){
$user['password'] = $data['password'];
spClass('UserLib')->set_session($user,$data['is_remember']);
$uc_password = $data['password'];
$uc_username = ($user['uc_nickname'])?strtolower($user['uc_nickname']):strtolower($user['nickname']);
if(UC_OPEN){
list($uid,$username,$password,$email)=$ucenter->uc_user_login($uc_username,$uc_password);
if($uid == -1) {
$reg_uid = $ucenter->uc_user_register($uc_username,$uc_password,$data['email']);
if($reg_uid>0){
$data['uc_nickname'] = $uc_username;
$data['uc_id'] = $reg_uid;
$this->update(array('user_id'=>$user['user_id']),$data);
}
}elseif ($uid>0){
$synlogin_str = $ucenter->uc_user_synlogin($uid);
if(!$user['uc_id'])
$this->updateUCID($user,$uid,$username);
}
}
$response = array('result'=>true,'msg'=>T('login_succeed').$synlogin_str,'data'=>$user);
$event_dispatcher = spClass('event_dispatcher');
$event_dispatcher->invoke('login_everyday',$user['user_id']);
}else {
$response = array('result'=>false,'msg'=>T('password_wrong'));
}
}else{
$response = array('result'=>false,'msg'=>T('user_not_existed'));
}
return $response;
}
public function bbs_login($data)
{
$ucenter = spClass("Ucenter");
$userlib = spClass('UserLib');
$uc_password = $data['bbs_password'];
$uc_username = strtolower($data['bbs_username']);
$response = array('result'=>false,'msg'=>T('illegal_operation'));
if(UC_OPEN){
list($uid,$username,$password,$email)=$ucenter->uc_user_login($uc_username,$uc_password);
if($uid == -1) {
$response = array('result'=>false,'msg'=>T('user_not_existed'));
}elseif ($uid == -2){
$response = array('result'=>false,'msg'=>T('password_wrong'));
}elseif ($uid>0){
if($user = $this->find_by_ucid($uid)){
$user['password'] = $uc_password;
$userlib->set_session($user);
}else{
$user_data['email'] = ($this->checkemail($email,null))?$email:md5(random_string('alnum',5)).'@'.T('domain.com');
$user_data['nickname'] = $this->create_random_nick($username);
$user_data['passwd'] = md5($uc_password);
$user_data['create_time'] = mktime();
$user_data['is_active'] = 1;
$user_data['is_social'] = 0;
$user_data['uc_id'] = $uid;
$user_data['uc_nickname'] = $uc_username;
$user_id = $this->add_one($user_data);
$update_data['avatar_local'] = $userlib->create_default_avatar($user_id);
if($update_data['avatar_local']){
$this->update(array('user_id'=>$user_id),$update_data);
}
$user = $this->getuser_byid($user_id);
$user['password'] = $uc_password;
$userlib->set_session($user);
}
$synlogin_str = $ucenter->uc_user_synlogin($uid);
$response = array('result'=>true,'msg'=>T('login_succeed').$synlogin_str,'data'=>$user);
$event_dispatcher = spClass('event_dispatcher');
$event_dispatcher->invoke('login_everyday',$user['user_id']);
}
}
return $response;
}
public function create_random_nick($start_name){
if($this->checknick($start_name,null)){
return $start_name;
}else{
$start_name .= random_string('numeric',4);
$this->create_random_nick($start_name);
}
}
public function logout($data)
{
logUc("uclogout start");
spClass('UserLib')->remove_session();
$ucenter = spClass("Ucenter");
if(UC_OPEN){
$synlogout_str = $ucenter->uc_user_synlogout();
}
logUc("uclogout end");
return $synlogout_str;
}
public function register($values)
{
$this->verifier = $this->verifier_register;
$verifier_result = $this->spVerifier($values);
if( false == $verifier_result ){
$uc_password = $values['password'];
$uc_username = strtolower($values['nickname']);
$uc_email = strtolower($values['email']);
$values["passwd"] = md5($values["password"]);
$ucenter = spClass("Ucenter");
if(UC_OPEN){
$uc_id = $ucenter->uc_user_register($uc_username,$uc_password,$uc_email);
if($uc_id <= 0) {
if($uc_id == -1) {
$response = array('result'=>false,'msg'=>"用户名不合法");
}elseif($uc_id == -2) {
$response = array('result'=>false,'msg'=>"包含不允许注册的词语");
}elseif($uc_id == -3) {
$response = array('result'=>false,'msg'=>"用户名已经存在");
}elseif($uc_id == -4) {
$response = array('result'=>false,'msg'=>"电子邮件格式有误");
}elseif($uc_id == -5) {
$response = array('result'=>false,'msg'=>"电子邮件不允许注册");
}elseif($uc_id == -6) {
$response = array('result'=>false,'msg'=>"该电子邮件已经被注册");
}else {
$response = array('result'=>false,'msg'=>"未定义错误");
}
return $response;
}
}
$user_id = $this->add_one($values);
$userlib = spClass('UserLib');
$update_data['avatar_local'] = $userlib->create_default_avatar($user_id);
if($update_data['avatar_local']){
$this->update(array('user_id'=>$user_id),$update_data);
}
$user = $this->getuser_byid($user_id);
$this->updateUCID($user,$uc_id,$uc_username);
$user['password'] = $uc_password;
$userlib->set_session($user);
$response = array('result'=>true,'msg'=>T('register_succeed'));
return $response;
}else{
foreach ($verifier_result as $error) {
$msg = $error[0];
}
$response = array('result'=>false,'msg'=>$msg);
return $response;
}
}
public function reset_passwd($userid,$values,$password_uc,$is_social=FALSE){
if($is_social){
$this->verifier = $this->verifier_resetpasswd;
$verifier_result = $this->spVerifier($values);
}else{
$verifier_result = false;
}
if( false == $verifier_result ){
$values['passwd']=md5($values['password']);
$this->update(array('user_id'=>$userid),$values);
$ucenter = spClass("Ucenter");
if(UC_OPEN){
$user = $this->getuser_byid($userid);
if($user['uc_id']){
$ucenter->uc_user_edit($user['nickname'],null,$password_uc,null,1);
}
}
$userlib = spClass('UserLib');
$userlib->refresh_session();
$response = array('result'=>true,'message'=>T('update_succeed'));
return $response;
}else{
foreach ($verifier_result as $error) {
$msg = $error[0];
}
$response = array('result'=>false,'message'=>$msg);
return $response;
}
}
public function uc_login($uc_id){
$ucenter = spClass("Ucenter");
logUc("uclogin start");
if($user = $this->find_by_ucid($uc_id)){
logUc("uclogin in");
$userlib = spClass('UserLib');
$userlib->set_session($user);
logUc("uclogin done");
}
}
public function updateUCID($user,$uc_id,$uc_username){
if($user['user_id']&&!$user['uc_id']){
if($this->find_by_ucid($uc_id)){
return;
}
$this->update(array('user_id'=>$user['user_id']),array('uc_id'=>$uc_id,'uc_nickname'=>$uc_username));
}
}
public function find_by_ucid($uc_id){
return $this->find(array('uc_id'=>$uc_id));
}
public function update_shopuser($user_id,$status=1){
$condition['user_id'] = $user_id;
$data['is_shop'] = $status;
$this->update($condition,$data);
}
public function update_staruser($user_id,$status=1){
$condition['user_id'] = $user_id;
$data['is_star'] = $status;
$this->update($condition,$data);
}
function getuser_byid($uid){
if($uid)
return $this->find(array('user_id'=>$uid));
else
return null;
}
function is_banned($uid){
if($uid){
return $this->find(array('user_id'=>$uid,'user_type'=>0));
}
return false;
}
function ban_user($uid){
if($uid){
return $this->update(array('user_id'=>$uid),array('user_type'=>0,'usergroup_id'=>3));
}
return false;
}
public function add_one($data){
if($this->check_value($data)){
$data['create_time'] = mktime();
return $this->create($data);
}
return false;
}
private function check_value($data){
if(!$data['nickname']){
return false;
}
return true;
}
public function message_count($user_id){
$user = $this->find(array('user_id'=>$user_id),null,' ptx_user.total_messages ');
return $user?$user['total_messages']:0;
}
public function clean_message($user_id,$start_id){
$this->runSql("UPDATE {$this->tbl_name} SET total_messages='0' WHERE user_id='{$user_id}'");
$ptx_message = spClass("ptx_message");
$ptx_message->clean_message($user_id,$start_id);
}
public function add_message($user_id)
{
return $this->runSql("UPDATE {$this->tbl_name} SET total_messages=total_messages+1 WHERE user_id='{$user_id}'");
}
public function add_share($user_id)
{
return $this->runSql("UPDATE {$this->tbl_name} SET total_shares=total_shares+1 WHERE user_id='{$user_id}'");
}
public function del_share($user_id)
{
return $this->runSql("UPDATE {$this->tbl_name} SET total_shares=total_shares-1 WHERE user_id='{$user_id}'");
}
public function add_album($user_id)
{
return $this->runSql("UPDATE {$this->tbl_name} SET total_albums=total_albums+1 WHERE user_id='{$user_id}'");
}
public function del_album($user_id)
{
return $this->runSql("UPDATE {$this->tbl_name} SET total_albums=total_albums-1 WHERE user_id='{$user_id}'");
}
public function add_like($user_id)
{
return $this->runSql("UPDATE {$this->tbl_name} SET total_likes=total_likes+1 WHERE user_id='{$user_id}'");
}
public function add_follow($user_id)
{
return $this->runSql("UPDATE {$this->tbl_name} SET total_follows=total_follows+1 WHERE user_id='{$user_id}'");
}
public function remove_follow($user_id)
{
return $this->runSql("UPDATE {$this->tbl_name} SET total_follows=total_follows-1 WHERE user_id='{$user_id}'");
}
public function add_follower($user_id){
return $this->runSql("UPDATE {$this->tbl_name} SET total_followers=total_followers+1 WHERE user_id='{$user_id}'");
}
public function remove_follower($user_id){
return $this->runSql("UPDATE {$this->tbl_name} SET total_followers=total_followers-1 WHERE user_id='{$user_id}'");
}
}
?>