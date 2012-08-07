<?php echo $setting_header;?>
<div class="formmain">
<?php echo $credit_setting_nav;?>
<div class="formbox">
  <form action="<?php echo spUrl('admin','credit_strategy',array('act'=>'save'));?>" method="post"  class="form-horizontal settingform">
        <fieldset>
        
        <?php foreach ($event_arr as $evt):?>
	      <div class="control-group">
		    <label class="control-label" for="credits_lower"><?php echo T($evt);?>:</label>
		    <div class="controls">
        	<?php for ($i=1;$i<=3;$i++):?>
        		<?php echo T('ext_credits_'.$i);$key_str = $evt.'_credits_'.$i;?>
		        <input type="text" class="input-small" id="<?php echo $key_str;?>" name="<?php echo $key_str;?>" value="<?php echo $vsettings[$key_str];?>"/>
        	<?php endfor;?>
        	</div>
		  </div>
        <?php endforeach;?>
	     
          <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?php echo T('save');?></button>
          </div>
        </fieldset>
      </form>
</div>
</div>
</div>
</body>
</html>
