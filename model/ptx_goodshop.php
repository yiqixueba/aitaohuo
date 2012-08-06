<?php

class ptx_goodshop extends spModelMulti
{
public $pk = 'shop_id';
public $table = 'ptx_goodshop';
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
var $select_fields = " ptx_goodshop.shop_id,ptx_goodshop.shop_desc,ptx_goodshop.display_order,ptx_goodshop.create_time,user.user_id,user.email,user.nickname,user.user_title,user.total_likes,user.total_shares,user.total_followers,category.category_id,category.category_name_cn ";
private function init_conditions($conditions){
$conditions_user = NULL;
if(isset($conditions['keyword'])){
$keyword = $conditions['keyword'];
$conditions_user .= "AND MATCH (user.nickname) AGAINST ('{$keyword}' IN BOOLEAN MODE) OR MATCH (user.email) AGAINST ('{$keyword}' IN BOOLEAN MODE) ";
}
if(isset($conditions['category_id'])){
$category_id = $this->escape($conditions['category_id']);
$conditions_user .= "AND ptx_goodshop.category_id={$category_id} ";
}
if(strpos($conditions_user,'AND') === 0){
$conditions_user = substr($conditions_user,3);
}
return $conditions_user;
}
public function search($conditions=NULL,$page,$pagesize,$fields = null,$sort=null){
$conditions = $this->init_conditions($conditions);
if(!$sort)
$sort = " ptx_goodshop.shop_id DESC ";
if(!$fields){
$fields = $this->select_fields;
}
return $this->spPager($page,$pagesize)->findAllJoin($conditions,$sort,$fields);
}
public function search_no_page($conditions=NULL,$fields = null,$sort=null,$limit){
$conditions = $this->init_conditions($conditions);
if(!$sort)
$sort = " ptx_goodshop.shop_id DESC ";
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
$this->update_goodshop_cache();
return $id;
}
return false;
}
public function del_one($data){
if($data['shop_id']){
$this->delete(array('shop_id'=>$data['shop_id']));
$this->update_goodshop_cache();
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
public function get_goodshop_cache(){
$results = spAccess('r','goodshop_cache');
if(!$results){
$this->update_goodshop_cache();
$results = spAccess('r','goodshop_cache');
}
return $results;
}
public function update_goodshop_cache(){
$ptx_category = spClass('ptx_category');
$goodshop_categoty = array();
$categories = $ptx_category->findAll(null,' display_order ASC ');
foreach($categories as $cate){
$key = 'category_'.$cate['category_id'];
$goodshop_categoty[$key]['category_id'] = $cate;
$conditions['category_id'] = $cate['category_id'];
$goodshops = $this->search_no_page($conditions,null,' ptx_goodshop.display_order ASC ',5);
$goodshop_categoty[$key]['goodshop'] = $goodshops;
}
spAccess('w','goodshop_cache',$goodshop_categoty);
}
}
?>