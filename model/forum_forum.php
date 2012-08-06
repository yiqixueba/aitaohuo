<?php

class forum_forum extends spModelMulti
{
public $pk = 'fid';
public $table = 'forum_forum';
var $bbs = true;
var $select_fields = " forum_forum.* ";
}
?>