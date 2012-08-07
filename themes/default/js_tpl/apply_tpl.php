<script type="text/template" id="apply_tpl" data-title="<?php echo T('type_info_apply');?>">
		<div class="btn_select f_l ml20" id="apply_sdiv">
			<a href="javascript:void(0);" class="listbtn" data-action="categoryListPopup" data-params="apply_sdiv"><span class="label">分类：</span><span class="category_select_title"><?php echo $categories[0]['category_name_cn'];?></span><s><b></b></s></a>
	        <ul style="width: 300px;top:5px;max-height: 160px;">
				<?php foreach ($categories as $category):?>
				<li><a href="javascript:void(0);" data-action="openCatItem" data-params="<?php echo $category['category_id'].','.$category['category_name_cn'].',apply_sdiv';?>"><?php echo $category['category_name_cn'];?></a></li>
				<?php endforeach;?>
	        </ul>
	        <input id="apply_cid" name="category_id" type="hidden" class="category_select_id" value="<?php echo $categories[0]['category_id'];?>"/>
			<div class="mt10">
				<?php echo T('apply_reason');?>
	        </div>
			<div>
	             <textarea class="apply_reason" rows="3" name="txt" autocomplete="off" title="<?php echo T('tip_type_apply');?>"></textarea>
	        </div>
				<div class="error"></div>
				<div class="mt10 text_c">
					<button type="submit" data-action="applySave" data-params="apply_sdiv"><?php echo T('submit');?></button>
				</div>
	    </div>
</script>