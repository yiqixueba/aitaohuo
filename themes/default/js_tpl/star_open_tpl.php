<script type="text/template" id="star_open_tpl" data-crop-url="<?php echo spUrl('staruser','crop_staruser_cover');?>" data-getstar-url="<?php echo spUrl('staruser','get_staruser');?>" data-title="<?php echo T('set_staruser_cover');?>">
{{#data}}
<div style="padding:0px 0px 0px 30px;" class="of_h">
	<div class="category-bd mt10 text_c">
		<img src="{{image_path}}" style="max-height:200px;">
	</div>
	<div class="category-bd mt20 mb10">
		<a href="javascript:void(0);" id="link_star_1" data-action="switchPushStyle" data-params="star_1" class="selected"><?php echo T('style_1');?></a> | 
		<a href="javascript:void(0);" id="link_star_2" data-action="switchPushStyle" data-params="star_2"><?php echo T('style_2');?></a> | 
		<a href="javascript:void(0);" id="link_star_3" data-action="switchPushStyle" data-params="star_3"><?php echo T('style_3');?></a>
	</div>
	
	<div class="staruser-pics push_style of_h" id="push_star_1">
		<div class="staruser-pic-135-170 text_c">
			<a href="javascript:void(0);" data-action="openCrop" class="pos1" data-params="1,135:170">{{#star_cover.s1_image_path}}<img src="<?php echo base_url()?>{{star_cover.s1_image_path}}_star.jpg?{{rand}}" onerror="this.src='<?php echo base_url()?>assets/img/pin_button.png';"/>{{/star_cover.s1_image_path}}{{^star_cover.s1_image_path}}<img src="<?php echo base_url()?>assets/img/pin_button.png" style="margin-top: 70px;">{{/star_cover.s1_image_path}}</a>
		</div>
		<div class="staruser-pic-135-170 text_c">
			<a href="javascript:void(0);" data-action="openCrop" class="pos2" data-params="2,135:170">{{#star_cover.s2_image_path}}<img src="<?php echo base_url()?>{{star_cover.s2_image_path}}_star.jpg?{{rand}}" onerror="this.src='<?php echo base_url()?>assets/img/pin_button.png';"/>{{/star_cover.s2_image_path}}{{^star_cover.s2_image_path}}<img src="<?php echo base_url()?>assets/img/pin_button.png" style="margin-top: 70px;">{{/star_cover.s2_image_path}}</a>
		</div>
		<div class="staruser-pic-135-170 text_c">
			<a href="javascript:void(0);" data-action="openCrop" class="pos3" data-params="3,135:170">{{#star_cover.s3_image_path}}<img src="<?php echo base_url()?>{{star_cover.s3_image_path}}_star.jpg?{{rand}}" onerror="this.src='<?php echo base_url()?>assets/img/pin_button.png';"/>{{/star_cover.s3_image_path}}{{^star_cover.s3_image_path}}<img src="<?php echo base_url()?>assets/img/pin_button.png" style="margin-top: 70px;">{{/star_cover.s3_image_path}}</a>
		</div>
	</div>
	<div class="staruser-pics push_style hide of_h" id="push_star_2">
		<div class="staruser-pic-275-170 text_c">
			<a href="javascript:void(0);" data-action="openCrop" class="pos1" data-params="1,275:170">{{#star_cover.s1_image_path}}<img src="<?php echo base_url()?>{{star_cover.s1_image_path}}_star.jpg?{{rand}}" onerror="this.src='<?php echo base_url()?>assets/img/pin_button.png';"/>{{/star_cover.s1_image_path}}{{^star_cover.s1_image_path}}<img src="<?php echo base_url()?>assets/img/pin_button.png" style="margin-top: 70px;">{{/star_cover.s1_image_path}}</a>
		</div>
		<div class="staruser-pic-135-170 text_c">
			<a href="javascript:void(0);" data-action="openCrop" class="pos2" data-params="2,135:170">{{#star_cover.s2_image_path}}<img src="<?php echo base_url()?>{{star_cover.s2_image_path}}_star.jpg?{{rand}}" onerror="this.src='<?php echo base_url()?>assets/img/pin_button.png';"/>{{/star_cover.s2_image_path}}{{^star_cover.s2_image_path}}<img src="<?php echo base_url()?>assets/img/pin_button.png" style="margin-top: 70px;">{{/star_cover.s2_image_path}}</a>
		</div>
	</div>
	<div class="staruser-pics push_style hide of_h" id="push_star_3">
		<div class="staruser-pic-135-170 text_c">
			<a href="javascript:void(0);" data-action="openCrop" class="pos1" data-params="1,135:170">{{#star_cover.s1_image_path}}<img src="<?php echo base_url()?>{{star_cover.s1_image_path}}_star.jpg?{{rand}}" onerror="this.src='<?php echo base_url()?>assets/img/pin_button.png';"/>{{/star_cover.s1_image_path}}{{^star_cover.s1_image_path}}<img src="<?php echo base_url()?>assets/img/pin_button.png" style="margin-top: 70px;">{{/star_cover.s1_image_path}}</a>
		</div>
		<div class="staruser-pic-275-170 text_c">
			<a href="javascript:void(0);" data-action="openCrop" class="pos2" data-params="2,275:170">{{#star_cover.s2_image_path}}<img src="<?php echo base_url()?>{{star_cover.s2_image_path}}_star.jpg?{{rand}}" onerror="this.src='<?php echo base_url()?>assets/img/pin_button.png';"/>{{/star_cover.s2_image_path}}{{^star_cover.s2_image_path}}<img src="<?php echo base_url()?>assets/img/pin_button.png" style="margin-top: 70px;">{{/star_cover.s2_image_path}}</a>
		</div>
	</div>
	<div class="text_c mt20 mb10 of_h">
	    <button data-action="closePushDialog"><?php echo T('submit');?></button>
	</div>
</div>
{{/data}}
</script>
<script type="text/template" id="star_open_confirm_tpl" data-url="<?php echo spUrl('staruser','save_staruser'); ?>" data-title="<?php echo T('confirm_add_staruser');?>">
{{#data}}
 		<div class="left f_l of_h mt10">
			<img src="{{avatar}}" onerror="javascript:this.src = base_url + '/assets/img/avatar_large.jpg';">
		</div>
		<div class="btn_select f_l ml20" id="star_open_confirm_sdiv">
			<div class="mb10">
				<h6><a href="{{home}}">{{nickname}}</a></h6>
			    <span>{{user_title}}</span>
	        </div>
			<a href="javascript:void(0);" class="listbtn" data-action="categoryListPopup" data-params="star_open_confirm_sdiv"><span class="label"><?php echo T('category');?>：</span><span class="category_select_title">{{category_name_cn}}</span><s><b></b></s></a>
	        <ul style="width: 300px;top:5px;max-height: 160px;">
				<?php foreach ($categories as $category):?>
				<li><a href="javascript:void(0);" data-action="pushStarCatItem" data-params="<?php echo $category['category_id'].','.$category['category_name_cn'].',star_open_confirm_sdiv';?>"><?php echo $category['category_name_cn'];?></a></li>
				<?php endforeach;?>
	        </ul>
	        <input id="push_star_cid" name="category_id" type="hidden" class="category_select_id" value="{{category_id}}"/>
 			<input name="user_id" type="hidden" class="user_id" value="{{user_id}}"/>
			<div class="mt10">
				<?php echo T('recommend_reason');?>：
	        </div>
			<div>
	             <textarea class="star_reason" rows="3" name="star_reason" autocomplete="off" title="<?php echo T('tip_recommend_reason');?>"></textarea>
	        </div>
				<div class="error"></div>
				<div class="mt10 text_c">
					<button type="submit" data-action="starSave" data-params="star_open_confirm_sdiv"><?php echo T('submit');?></button>
				</div>
	    </div>
{{/data}}
</script>