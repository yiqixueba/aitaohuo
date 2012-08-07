<ul class="nav nav-tabs">
  <li<?php echo ($current_action == 'credit_setting') ?  ' class="active"' : ''; ?>><a href="<?php echo spUrl('admin','credit_setting');?>"><?php echo T('credit_setting');?></a></li>
  <li<?php echo ($current_action == 'credit_strategy') ?  ' class="active"' : ''; ?>><a href="<?php echo spUrl('admin','credit_strategy');?>"><?php echo T('credit_strategy');?></a></li>
</ul>