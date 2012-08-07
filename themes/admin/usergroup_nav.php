<ul class="nav nav-tabs">
  <li<?php echo ($group_type == 'member') ?  ' class="active"' : ''; ?>><a href="<?php echo spUrl('admin','sys_usergroup',array('group_type'=>'member'));?>"><?php echo T('normal_usergroup');?></a></li>
  <li<?php echo ($group_type == 'system') ?  ' class="active"' : ''; ?>><a href="<?php echo spUrl('admin','sys_usergroup',array('group_type'=>'system'));?>"><?php echo T('system_usergroup');?></a></li>
</ul>