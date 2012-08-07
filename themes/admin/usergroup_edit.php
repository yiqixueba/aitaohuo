<?php echo $setting_header;?>
<?php echo $usergroup_nav;?>
<div class="formbox">
   <form action="<?php echo spUrl('admin','sys_usergroup',array('act'=>'edit'));?>" method="post" class="form-horizontal">
   <fieldset>
   <input type="hidden" id="usergroup_type" name="group_type" value="<?php echo $group_type;?>"/>
   <input type="hidden" id="group_id" name="group_id" value="<?php echo $usergroup['usergroup_id'];?>"/>
    <div class="control-group">
      <label class="control-label" for="credits_lower"><?php echo T('credits_range');?></label>
      <div class="controls">
        <input type="text" class="input-small" id="credits_lower" name="credits_lower" value="<?php echo $usergroup['credits_lower'];?>"/>~
        <input type="text" class="input-small" id="credits_higher" name="credits_higher" value="<?php echo $usergroup['credits_higher'];?>"/>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="stars"><?php echo T('star_num');?></label>
      <div class="controls">
        <input type="text" class="input-small" id="stars" name="stars" value="<?php echo $usergroup['stars'];?>"/>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="color"><?php echo T('color');?></label>
      <div class="controls">
        <input type="text" class="input-small" id="color" name="color" value="<?php echo $usergroup['color'];?>"/>
      </div>
    </div>
    
    
    <div class="control-group">
      <label class="control-label" for="allow_visit"><?php echo T('allow_visit');?></label>
      <div class="controls">
      	<input type="radio" name="allow_visit" value="1" <?php echo $usergroup['allow_visit']?'checked':'';?>><?php echo T('yes');?></input>
        <input type="radio" name="allow_visit" value="0" <?php echo !$usergroup['allow_visit']?'checked':'';?>><?php echo T('no');?></input>
        <p class="help-block"><?php echo T('tip_allow_visit');?></p>
      </div>
    </div>
    
    
    <div class="control-group hide">
      <label class="control-label" for="allow_sendpm"><?php echo T('allow_sendpm');?></label>
      <div class="controls">
      	<input type="radio" name="allow_sendpm" value="1" <?php echo $other_permission['allow_sendpm']?'checked':'';?>><?php echo T('yes');?></input>
        <input type="radio" name="allow_sendpm" value="0" <?php echo !$other_permission['allow_sendpm']?'checked':'';?>><?php echo T('no');?></input>
        <p class="help-block"><?php echo T('tip_allow_sendpm');?></p>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="allow_share"><?php echo T('allow_share');?></label>
      <div class="controls">
      	<input type="radio" name="allow_share" value="1" <?php echo $usergroup['allow_share']?'checked':'';?>><?php echo T('yes');?></input>
        <input type="radio" name="allow_share" value="0" <?php echo !$usergroup['allow_share']?'checked':'';?>><?php echo T('no');?></input>
        <p class="help-block"><?php echo T('tip_allow_share');?></p>
      </div>
    </div>
    
    <div class="control-group hide">
      <label class="control-label" for="allow_invite"><?php echo T('allow_invite');?></label>
      <div class="controls">
      	<input type="radio" name="allow_invite" value="1" <?php echo $other_permission['allow_invite']?'checked':'';?>><?php echo T('yes');?></input>
        <input type="radio" name="allow_invite" value="0" <?php echo !$other_permission['allow_invite']?'checked':'';?>><?php echo T('no');?></input>
        <p class="help-block"><?php echo T('tip_allow_invite');?></p>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="allow_video"><?php echo T('allow_video');?></label>
      <div class="controls">
      	<input type="radio" name="allow_video" value="1" <?php echo $other_permission['allow_video']?'checked':'';?>><?php echo T('yes');?></input>
        <input type="radio" name="allow_video" value="0" <?php echo !$other_permission['allow_video']?'checked':'';?>><?php echo T('no');?></input>
        <p class="help-block"><?php echo T('tip_allow_video');?></p>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="allow_comment"><?php echo T('allow_comment');?></label>
      <div class="controls">
      	<input type="radio" name="allow_comment" value="1" <?php echo $other_permission['allow_comment']?'checked':'';?>><?php echo T('yes');?></input>
        <input type="radio" name="allow_comment" value="0" <?php echo !$other_permission['allow_comment']?'checked':'';?>><?php echo T('no');?></input>
        <p class="help-block"><?php echo T('tip_allow_comment');?></p>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="allow_at_friend"><?php echo T('allow_at_friend');?></label>
      <div class="controls">
      	<input type="radio" name="allow_at_friend" value="1" <?php echo $other_permission['allow_at_friend']?'checked':'';?>><?php echo T('yes');?></input>
        <input type="radio" name="allow_at_friend" value="0" <?php echo !$other_permission['allow_at_friend']?'checked':'';?>><?php echo T('no');?></input>
        <p class="help-block"><?php echo T('tip_allow_at_friend');?></p>
      </div>
    </div>
    
    <div class="control-group hide">
      <label class="control-label" for="allow_smile"><?php echo T('allow_smile');?></label>
      <div class="controls">
      	<input type="radio" name="allow_smile" value="1" <?php echo $other_permission['allow_smile']?'checked':'';?>><?php echo T('yes');?></input>
        <input type="radio" name="allow_smile" value="0" <?php echo !$other_permission['allow_smile']?'checked':'';?>><?php echo T('no');?></input>
        <p class="help-block"><?php echo T('tip_allow_smile');?></p>
      </div>
    </div>
    
    <div class="control-group hide">
      <label class="control-label" for="allow_subdomain"><?php echo T('allow_subdomain');?></label>
      <div class="controls">
      	<input type="radio" name="allow_subdomain" value="1" <?php echo $other_permission['allow_subdomain']?'checked':'';?>><?php echo T('yes');?></input>
        <input type="radio" name="allow_subdomain" value="0" <?php echo !$other_permission['allow_subdomain']?'checked':'';?>><?php echo T('no');?></input>
        <p class="help-block"><?php echo T('tip_allow_subdomain');?></p>
      </div>
    </div>
    
    
    <div class="control-group">
      <label class="control-label" for="need_verify"><?php echo T('need_verify');?></label>
      <div class="controls">
      	<input type="radio" name="need_verify" value="1" <?php echo $usergroup['need_verify']?'checked':'';?>><?php echo T('yes');?></input>
        <input type="radio" name="need_verify" value="0" <?php echo !$usergroup['need_verify']?'checked':'';?>><?php echo T('no');?></input>
        <p class="help-block"><?php echo T('tip_need_verify');?></p>
      </div>
    </div>
    
    <div class="control-group hide">
      <label class="control-label" for="share_maxnum"><?php echo T('share_maxnum');?></label>
      <div class="controls">
     	<input type="text" class="input-small" id="share_maxnum" name="share_maxnum" value="<?php echo $other_permission['share_maxnum'];?>"/>
        <p class="help-block"><?php echo T('tip_share_maxnum');?></p>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="fllow_maxnum"><?php echo T('fllow_maxnum');?></label>
      <div class="controls">
     	<input type="text" class="input-small" id="fllow_maxnum" name="fllow_maxnum" value="<?php echo $other_permission['fllow_maxnum'];?>"/>
        <p class="help-block"><?php echo T('tip_fllow_maxnum');?></p>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="album_maxnum"><?php echo T('album_maxnum');?></label>
      <div class="controls">
     	<input type="text" class="input-small" id="album_maxnum" name="album_maxnum" value="<?php echo $other_permission['album_maxnum'];?>"/>
        <p class="help-block"><?php echo T('tip_album_maxnum');?></p>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="upload_maxnum"><?php echo T('upload_maxnum');?></label>
      <div class="controls">
     	<input type="text" class="input-small" id="upload_maxnum" name="upload_maxnum" value="<?php echo $other_permission['upload_maxnum'];?>"/>
        <p class="help-block"><?php echo T('tip_upload_maxnum');?></p>
      </div>
    </div>
    <div class="control-group hide">
      <label class="control-label" for="upload_maxsize"><?php echo T('upload_maxsize');?></label>
      <div class="controls">
     	<input type="text" class="input-small" id="upload_maxsize" name="upload_maxsize" value="<?php echo $other_permission['upload_maxsize'];?>"/>
        <p class="help-block"><?php echo T('tip_upload_maxsize');?></p>
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