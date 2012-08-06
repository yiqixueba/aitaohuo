<?php

class ptx_tag extends spModelMulti
{
public $pk = 'tag_id';
public $table = 'ptx_tag';
var $linker = array(
array(
'type'=>'hasone',
'map'=>'category',
'mapkey'=>'category_id',
'fclass'=>'ptx_category',
'fkey'=>'category_id',
'enabled'=>true 
)
);
public function get_tag_group($conditions = null,$sort = null,$fields = null,$limit = null){
$results = $this->findAllJoin($conditions,$sort,$fields,$limit);
return $results;
}
}
?>