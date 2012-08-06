<?php

class ptx_apply extends spModelMulti
{
public $pk = 'apply_id';
public $table = 'ptx_apply';
var $linker = array(
'user'=>array(
'type'=>'hasone',
'map'=>'user',
'mapkey'=>'user_id',
'fclass'=>'ptx_user',
'fkey'=>'user_id',
'enabled'=>true
),
'category'=>array(
'type'=>'hasone',
'map'=>'category',
'mapkey'=>'category_id',
'fclass'=>'ptx_category',
'fkey'=>'category_id',
'enabled'=>true
),
);
public function search($conditions=NULL,$page,$pagesize,$fields = null,$sort=null){
if(!$sort)
$sort = " ptx_apply.apply_id DESC ";
return $this->spPager($page,$pagesize)->findAllJoin($conditions,$sort,$fields);
}
public function find_one($conditions=NULL){
return $this->findJoin($conditions);
}
public function add_one($data){
if($this->check_value($data)){
$data['create_time'] = mktime();
$result = $this->create($data);
return $result;
}
return false;
}
public function check_exits($user_id,$type){
$conditions['user_id'] = $user_id;
$conditions['apply_type'] = $type;
return $this->find($conditions,null," ptx_apply.apply_id ");
}
public function add_starapply($user_id,$category_id,$message){
$data['user_id'] = $user_id;
$data['category_id'] = $category_id;
$data['message_txt'] = $message;
$data['apply_type'] = '1';
$data['create_time'] = mktime();
return $this->create($data);
}
public function add_shopapply($user_id,$category_id,$message){
$data['user_id'] = $user_id;
$data['category_id'] = $category_id;
$data['message_txt'] = $message;
$data['apply_type'] = '2';
$data['create_time'] = mktime();
return $this->create($data);
}
private function check_value($data){
if(!is_numeric($data['user_id'])){
return false;
}
return true;
}
public function agree($apply_id)
{
$conditions['apply_id'] = $apply_id;
$apply = $this->find_one($conditions);
if($apply){
$this->update(array('apply_id'=>$apply_id),array('status'=>1));
$ptx_user = spClass("ptx_user");
if($apply['apply_type']==1){
$ptx_user->update_staruser($apply['user_id'],1);
$ptx_staruser = spClass("ptx_staruser");
$data['user_id'] = $apply['user_id'];
$data['category_id'] = $apply['category_id'];
$data['star_reason'] = $apply['message_txt'];
$ptx_staruser->add_one($data);
$ptx_staruser->update_staruser_cache();
}elseif ($apply['apply_type']==2){
$data['user_id'] = $apply['user_id'];
$data['category_id'] = $apply['category_id'];
$data['shop_desc'] = $apply['message_txt'];
$ptx_goodshop = spClass('ptx_goodshop');
$ptx_goodshop->add_one($data);
$ptx_user->update_shopuser($apply['user_id'],1);
}
$this->deleteByPk($apply_id);
}
return;
}
public function disagree($apply_id)
{
$conditions['apply_id'] = $apply_id;
$apply = $this->find_one($conditions);
if($apply){
$this->update(array('apply_id'=>$apply_id),array('status'=>0));
$ptx_user = spClass("ptx_user");
if($apply['apply_type']==1){
$ptx_user->update_staruser($apply['user_id'],0);
$ptx_staruser = spClass("ptx_staruser");
$data['user_id'] = $apply['user_id'];
$data['category_id'] = $apply['category_id'];
$ptx_staruser->delete($data);
$ptx_staruser->update_staruser_cache();
}elseif ($apply['apply_type']==2){
$data['user_id'] = $apply['user_id'];
$data['category_id'] = $apply['category_id'];
$ptx_goodshop = spClass('ptx_goodshop');
$ptx_goodshop->delete($data);
$ptx_goodshop->update_goodshop_cache();
$ptx_user->update_shopuser($apply['user_id'],0);
}
$this->deleteByPk($apply_id);
}
return;
}
}
?>