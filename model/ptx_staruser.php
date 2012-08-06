<?php

class ptx_staruser extends spModelMulti
{
public $pk = 'star_id';
public $table = 'ptx_staruser';
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
)
);
var $select_fields = " ptx_staruser.star_id,ptx_staruser.star_cover,ptx_staruser.star_reason,ptx_staruser.create_time,user.user_id,user.email,user.nickname,user.user_title,user.total_likes,user.total_shares,category.category_id,category.category_name_cn ";
private function init_conditions($conditions){
$conditions_user = NULL;
if(isset($conditions['keyword'])){
$keyword = $this->escape($conditions['keyword']);
$conditions_user .= "AND MATCH (user.nickname) AGAINST ('{$keyword}' IN BOOLEAN MODE) OR MATCH (user.email) AGAINST ('{$keyword}' IN BOOLEAN MODE) ";
}
if(isset($conditions['category_id'])){
$category_id = $this->escape($conditions['category_id']);
$conditions_user .= "AND ptx_staruser.category_id={$category_id} ";
}
if(strpos($conditions_user,'AND') === 0){
$conditions_user = substr($conditions_user,3);
}
return $conditions_user;
}
public function search($conditions=NULL,$page,$pagesize,$fields = null,$sort=null){
$conditions = $this->init_conditions($conditions);
if(!$sort)
$sort = " ptx_staruser.star_id DESC ";
if(!$fields){
$fields = $this->select_fields;
}
return $this->spPager($page,$pagesize)->findAllJoin($conditions,$sort,$fields);
}
public function search_no_page($conditions=NULL,$fields = null,$sort=null,$limit){
$conditions = $this->init_conditions($conditions);
if(!$sort)
$sort = " ptx_staruser.star_id DESC ";
if(!$fields){
$fields = $this->select_fields;
}
return $this->findAllJoin($conditions,$sort,$fields,$limit);
}
public function find_one($conditions=NULL){
$fields = $this->select_fields;
return $this->findJoin($conditions,null,$fields);
}
public function add_one($data){
if($this->check_value($data)){
$data['create_time'] = mktime();
$id = $this->create($data);
return $id;
}
return false;
}
public function check_exits($user_id){
return $this->find(array('user_id'=>$user_id))?true:false;
}
public function del_one($data){
if($data['star_id']){
$this->delete(array('star_id'=>$data['star_id']));
return true;
}
return false;
}
private function check_value($data){
if(!is_numeric($data['user_id'])||!is_numeric($data['category_id'])){
return false;
}
return true;
}
public function get_staruser_cache($time=1000){
$results = spAccess('r','staruser_cache');
if(!$results){
$this->update_staruser_cache($time);
$results = spAccess('r','staruser_cache');
}
return $results;
}
public function update_staruser_cache($time=1000){
$ptx_category = spClass('ptx_category');
$staruser_categoty = array();
$categories = $ptx_category->findAll(null,' display_order ASC ');
foreach($categories as $cate){
$key = 'category_'.$cate['category_id'];
$staruser_categoty[$key]['category_id'] = $cate;
$conditions['category_id'] = $cate['category_id'];
$starusers = $this->search_no_page($conditions,null,' user.total_likes DESC ',5);
$staruser_categoty[$key]['staruser'] = $starusers;
}
spAccess('w','staruser_cache',$staruser_categoty,$time);
}
}
?>