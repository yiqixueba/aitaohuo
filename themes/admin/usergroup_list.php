<?php echo $setting_header;?>
<?php echo $usergroup_nav;?>
<div class="tablebox">
   <table class="table table-striped">
        <thead>
          <tr>
            <th><?php echo T('usergroup');?>ID</th>
            <th><?php echo T('grouptitle');?></th>
            <th><?php echo T('credits_range');?></th>
            <th><?php echo T('star_num');?></th>
            <th><?php echo T('operation');?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($usergroups as $usergroup):?>
          <tr>
            <td><?php echo $usergroup['usergroup_id'];?></td>
            <td><?php echo T($usergroup['usergroup_title']).'('.$usergroup['usergroup_title'].')';?></td>
            <td><?php echo $usergroup['credits_lower'];?>~<?php echo $usergroup['credits_higher'];?></td>
            <td><?php echo $usergroup['stars'];?></td>
            <td>
            	<a href="<?php echo spUrl('admin','sys_usergroup',array('act'=>'delete','group_id'=>$usergroup['usergroup_id']));?>"><?php echo T('delete');?></a>
           		<a href="<?php echo spUrl('admin','sys_usergroup',array('act'=>'edit','group_id'=>$usergroup['usergroup_id']));?>"><?php echo T('edit');?></a>
            </td>
          </tr>
        <?php endforeach;?>
        </tbody>
      </table>

</div>

<div class="tablebox_footer">
   <form action="<?php echo spUrl('admin','sys_usergroup',array('act'=>'add'));?>" method="post" class="form-horizontal">
   <fieldset>
   <input type="hidden" id="usergroup_type" name="usergroup_type" value="<?php echo $group_type;?>"/>
   <div class="control-group">
      <label class="control-label" for="usergroup_title"><?php echo T('grouptitle');?></label>
      <div class="controls">
        <input type="text" class="input-small" id="usergroup_title" name="usergroup_title" />
        <p class="help-block"><?php echo T('help_grouptitle');?></p>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="credits_lower"><?php echo T('credits_range');?></label>
      <div class="controls">
        <input type="text" class="input-small" id="credits_lower" name="credits_lower" />~
        <input type="text" class="input-small" id="credits_higher" name="credits_higher" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="stars"><?php echo T('star_num');?></label>
      <div class="controls">
        <input type="text" class="input-small" id="stars" name="stars" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="color"><?php echo T('color');?></label>
      <div class="controls">
        <input type="text" class="input-small" id="color" name="color" />
      </div>
    </div>
    <div class="form-actions">
  <button type="submit" class="btn"><?php echo T('save');?></button>
  </div>
  </fieldset>
</form>
</div>

</body>
</html>