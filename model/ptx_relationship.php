<?php

class ptx_relationship extends spModelMulti
{
public $pk = 'relation_id';
public $table = 'ptx_relationship';
var $linker = array(
'user'=>array(
'type'=>'hasone',
'map'=>'user',
'mapkey'=>'user_id',
'fclass'=>'ptx_user',
'fkey'=>'user_id',
'enabled'=>false
),
'friend'=>array(
'type'=>'hasone',
'map'=>'friend',
'mapkey'=>'friend_id',
'fclass'=>'ptx_user',
'fkey'=>'user_id',
'enabled'=>false
)
);
var $select_fields = " * ";
public function search($conditions=NULL,$page,$pagesize,$fields = null,$sort=null){
$this->enable_linker(true);
if(!$sort)
$sort = " ptx_relationship.relation_id DESC ";
if(!$fields){
$fields = $this->select_fields;
}
return $this->spPager($page,$pagesize)->findAllJoin($conditions,$sort,$fields);
}
public function search_no_page($conditions=NULL,$fields = null,$sort=null,$limit){
$this->enable_linker(true);
if(!$sort)
$sort = " ptx_relationship.relation_id DESC ";
if(!$fields){
$fields = $this->select_fields;
}
return $this->findAllJoin($conditions,$sort,$fields,$limit);
}
private function enable_linker($open=false){
$linker = $this->linker;
$linker['user']['enabled'] = $open;
$linker['friend']['enabled'] = $open;
$this->linker = $linker;
}
public function find_one($conditions=NULL){
return $this->findJoin($conditions,null,null);
}
function add_follow($user_id,$friend_id)
{
$being_followed = $this->find_one(array('user_id'=>$friend_id,'friend_id'=>$user_id));
if($being_followed['relation_status']==2||$user_id==$friend_id){
return false;
}
if($being_followed){
$this->update(array('relation_id'=>$being_followed['relation_id']),array('relation_status'=>2));
$ptx_user = spClass('ptx_user');
$ptx_user->add_follow($user_id);
$ptx_user->add_follower($friend_id);
$condition['user_id'] = $user_id;
$condition['friend_id'] = $friend_id;
$data['relation_status'] = 2;
return $this->replace($condition,$data);
}else{
$ptx_user = spClass('ptx_user');
$ptx_user->add_follow($user_id);
$ptx_user->add_follower($friend_id);
$condition['user_id'] = $user_id;
$condition['friend_id'] = $friend_id;
$data['relation_status'] = 1;
return $this->replace($condition,$data);
}
}
function remove_follow($user_id,$friend_id)
{
$condition['user_id'] = $user_id;
$condition['friend_id'] = $friend_id;
$following = $this->find_one($condition);
if($following){
$this->delete($condition);
$condition['user_id'] = $friend_id;
$condition['friend_id'] = $user_id;
$data['relation_status'] = 1;
$this->update($condition,$data);
$ptx_user = spClass('ptx_user');
$ptx_user->remove_follow($user_id);
return $ptx_user->remove_follower($friend_id);
}
return false;
}
function following_count($user_id)
{
$condition['user_id'] = $user_id;
return $this->findCount($condition);
}
function fans_count($user_id)
{
$condition['friend_id'] = $user_id;
return $this->findCount($condition);
}
function get_relation($user_id,$friend_id)
{
$status = 0;
if($user_id &&$friend_id &&$user_id != $friend_id ){
$condition = '(user_id = '.$user_id.' AND friend_id = '.$friend_id.')';
$condition .= ' or (user_id = '.$friend_id.' AND friend_id = '.$user_id.')';
$rs = $this->findAll($condition,null,' user_id ');
foreach ($rs as $r)
{
if($r['user_id'] == $user_id) $status += 1;
if($r['user_id'] == $friend_id) $status += 2;
}
}elseif ($user_id == $friend_id){
$status=4;
}
return $status;
}
}
?>