<?php

class ptx_event_log extends spModelMulti
{
public $pk = 'event_log_id';
public $table = 'ptx_event_log';
var $select_fields = " ptx_event_log.* ";
public function search($conditions=NULL,$page,$pagesize,$fields = null,$sort=null){
if(!$sort)
$sort = " ptx_event_log.event_log_id DESC ";
if(!$fields){
$fields = $this->select_fields;
}
return $this->spPager($page,$pagesize)->findAllJoin($conditions,$sort,$fields);
}
public function search_no_page($conditions=NULL,$fields = null,$sort=null,$limit = null){
if(!$sort)
$sort = " ptx_event_log.event_log_id DESC ";
if(!$fields){
$fields = $this->select_fields;
}
return $this->findAllJoin($conditions,$sort,$fields,$limit);
}
public function find_one($conditions=NULL){
return $this->findJoin($conditions);
}
public function clean_log($user_id,$create_time){
$user_id = $this->escape($user_id);
$this->delete(" to_user_id={$user_id} AND create_time<{$this->escape($create_time)} AND event_code!='create_avatar'");
}
public function add_one($event,$event_type,$user_id){
$data['create_time'] = mktime();
$data['event_type'] = in_array($event_type,array('warn','alert','reward'))?$event_type:'alert';
$data['event_code'] = $event;
$data['to_user_id'] = $user_id;
$id = $this->create($data);
return $id;
}
}
?>