<?php

class forum_thread extends spModelMulti
{
public $pk = 'tid';
public $table = 'forum_thread';
var $bbs = true;
var $select_fields = " forum_thread.* ";
}
?>