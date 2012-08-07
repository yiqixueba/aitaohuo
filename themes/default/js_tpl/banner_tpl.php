<script type="text/template" id="banner_tpl" data-title="<?php echo T('set_your_banner');?>">
	 <div id="upload_banner_div" style="height:250px;">
		<div class="banner_div">
			<div id="banner_img_div" class="bglight"><img src="<?php echo base_url().$current_user['avatar_local'].'_banner.jpg';?>" onerror="javascript:this.src = base_url + '/assets/img/default_banner.jpg';"/></div>
		</div>
   		<div id="banner_upload_btn" class="button"><?php echo T('select_file');?></div>
		<input type="hidden" id="banner_upload_file"/>
   		<div class="actions border-top mt10"><button type="submit" data-action="saveBanner" enable="false" class="btn btn_red"><span><?php echo T('submit');?></span></button></div>
	</div>
    <br/>
</script>
