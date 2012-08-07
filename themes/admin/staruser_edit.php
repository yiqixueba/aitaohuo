<?php echo $setting_header;?>
<div class="tablebox_footer">
   <form action="<?php echo spUrl('admin','staruser_list',array('act'=>'edit','starid'=>$star['star_id']));?>" method="post" class="form-horizontal">
   <fieldset>
   <input type="hidden" id="hash" name="hash" value="sKHIIB*&%^(HG"/>
    <div class="control-group">
			      <label class="control-label" for="category_id"><?php echo T('category');?></label>
			      <div class="controls">
			        <select id="category_id" name="category_id">
			            <?php if($categories):?>
			            <?php foreach ($categories as $category):?>
			              <option value="<?php echo $category['category_id'];?>" <?php echo ($category['category_id']==$star['category_id'])?'selected':'';?>><?php echo $category['category_name_cn'];?></option>
			            <?php endforeach;?>
			            <?php endif;?>
			            </select>
			      </div>
	</div>
    <div class="control-group">
      <label class="control-label" for="star_reason"><?php echo T('recommend_reason');?></label>
      <div class="controls">
      	<textarea class="input-xlarge" id="star_reason" name="star_reason" rows="3"><?php echo $star['star_reason'];?></textarea>
         <p class="help-block"><?php echo T('recommend_reason');?></p>
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