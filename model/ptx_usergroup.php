<?php

class ptx_usergroup extends spModelMulti
{
public $pk = 'usergroup_id';
public $table = 'ptx_usergroup';
private function init_conditions($conditions){
$conditions_str = '';
if(isset($conditions['credits'])){
$conditions_str .= 'AND ptx_usergroup.credits_lower < \''.$conditions['credits'].'\' AND ptx_usergroup.credits_higher >= \''.$conditions['credits'].'\' ';
}
if(isset($conditions['usergroup_type'])){
$conditions_str .= 'AND ptx_usergroup.usergroup_type = '.$this->escape($conditions['usergroup_type']).' ';
}
if(strpos($conditions_str,'AND') === 0){
$conditions_str = substr($conditions_str,3);
}
return $conditions_str;
}
public function search($conditions=NULL,$fields = null,$sort=null){
$conditions = $this->init_conditions($conditions);
if(!$sort)
$sort = " ptx_usergroup.usergroup_id ASC ";
return $this->findAllJoin($conditions,$sort,$fields);
}
public function find_one($conditions=NULL){
$conditions = $this->init_conditions($conditions);
return $this->findJoin($conditions);
}
public function getUsergroups(){
$result = spAccess('r','sys_usergroups');
if(!$result){
return $this->updateUsergroups();
}
return $result;
}
public function updateUsergroups(){
$result = $this->findAll();
$arr = array();
foreach ($result as $usergroup) {
$usergroup['other_permission']=unserialize($usergroup['other_permission']);
$arr[$usergroup['usergroup_id']]=$usergroup;
}
spAccess('w','sys_usergroups',$arr);
return $arr;
}
}
?>