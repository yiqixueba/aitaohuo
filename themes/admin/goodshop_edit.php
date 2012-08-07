<?php echo $setting_header;?>
<div class="tablebox_footer">
   <form action="<?php echo spUrl('admin','goodshop_list',array('act'=>'edit','shopid'=>$shop['shop_id']));?>" method="post" class="form-horizontal">
   <fieldset>
   <input type="hidden" id="hash" name="hash" value="sKHIIB*&%^(HG"/>
    <div class="control-group">
			      <label class="control-label" for="category_id"><?php echo T('category');?></label>
			      <div class="controls">
			        <select id="category_id" name="category_id">
			            <?php if($categories):?>
			            <?php foreach ($categories as $category):?>
			              <option value="<?php echo $category['category_id'];?>" <?php echo ($category['category_id']==$shop['category_id'])?'selected':'';?>><?php echo $category['category_name_cn'];?></option>
			            <?php endforeach;?>
			            <?php endif;?>
			            </select>
			      </div>
	</div>
    <div class="control-group">
      <label class="control-label" for="shop_desc"><?php echo T('goodshop_description');?></label>
      <div class="controls">
      	<textarea class="input-xlarge" id="shop_desc" name="shop_desc" rows="3"><?php echo $shop['shop_desc'];?></textarea>
         <p class="help-block"><?php echo T('goodshop_description');?></p>
      </div>
    </div>
    
           <div class="control-group">
            <label class="control-label" for="display_order"><?php echo T('displayorder');?></label>
            <div class="controls">
              <input type="text"  class="input-xlarge" id="display_order" name="display_order" value="<?php echo $shop['display_order'];?>">
              <p class="help-block"><?php echo T('displayorder');?></p>
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