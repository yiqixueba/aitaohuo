<?php

class forum_post extends spModelMulti
{
public $pk = 'pid';
public $table = 'forum_post';
var $bbs = true;
var $linker = array(
'thread'=>array(
'type'=>'hasone',
'map'=>'thread',
'mapkey'=>'tid',
'fclass'=>'forum_thread',
'fkey'=>'tid',
'enabled'=>true
),
'forum'=>array(
'type'=>'hasone',
'map'=>'forum',
'mapkey'=>'fid',
'fclass'=>'forum_forum',
'fkey'=>'fid',
'enabled'=>true
)
);
var $select_fields = " forum_post.tid,forum_post.pid,forum_post.fid,forum_post.subject,forum_post.message,forum_post.dateline,thread.views,thread.replies,forum.name ";
private function init_conditions($conditions){
$condition_post = array();
if(isset($conditions['lt_time'])){
$condition_post[] = ' forum_post.dateline < \''.$conditions['lt_time'].'\' ';
}
if(isset($conditions['gt_time'])){
$condition_post[] .= ' forum_post.dateline >= \''.$conditions['gt_time'].'\' ';
}
if(isset($conditions['authorid'])){
$condition_post[] .= ' forum_post.authorid= \''.$conditions['authorid'].'\' ';
}
$condition_post[] .= ' forum_post.first=1 ';
return implode(' AND ',$condition_post);
}
public function search($conditions=NULL,$page,$pagesize,$fields = null,$sort=null){
$conditions = $this->init_conditions($conditions);
if(!$sort)
$sort = " forum_post.dateline DESC ";
if(!$fields)
$fields = $this->select_fields;
return $this->spPager($page,$pagesize)->findAllJoin($conditions,$sort,$fields);
}
public function find_one($conditions=NULL,$sort,$fields){
$conditions = $this->init_conditions($conditions);
if(!$sort)
$sort = " forum_post.dateline DESC ";
return $this->findJoin($conditions,$sort,$fields);
}
}
?>