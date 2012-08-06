<?php

class forum_attachment extends spModelMulti
{
public $pk = 'aid';
public $table = 'forum_attachment';
var $bbs = true;
var $select_fields = " forum_attachment.* ";
public function search_attach_images($pid){
$attach = $this->find(array('pid'=>$pid)," forum_attachment.aid ASC "," forum_attachment.* ");
if($attach)
return $attachments = $this->findSql("SELECT * FROM {$this->dbpre}forum_attachment_{$attach['tableid']} WHERE pid={$pid} AND isimage='-1'");
}
}
?>