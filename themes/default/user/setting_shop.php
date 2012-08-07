<?php echo $tpl_header; ?>
<?php echo $tpl_user_banner; ?>
<div class="main">
	<div class="g240 scroll-container">
	<?php echo $tpl_usercontrol;?>
	</div>
	
	<div class="g720 right-content white_bg mb30 mt20">
		<div class="page-header">
			<h5><?php echo T('tip_goodshop_settings');?></h5>
  		</div>
  		<div class="page-content">
  		
	  		<div class="alert alert-info">
	        	<?php echo T('tip_goodshop_settings_long');?>
	     	</div>
  		<form id="update_goodshop_form" class="form" next-url="<?php echo spUrl('my','setting_shop');?>" method="post">
		<ul>
		 	
			<li><label for="usertitle"><?php echo T('category');?>:</label>
				<?php echo $shop['category_name_cn'];?>
            </li>
			<li><label for="usertitle"><?php echo T('create_time');?>:</label>
				<?php echo date('Y-m-d',$shop['create_time']);?>
            </li>
            <li><label for="shop_desc"><?php echo T('goodshop_description');?>:</label>
            	<textarea id="shop_desc" name="shop_desc" rows="3" style="width: 300px;height: 100px;"><?php echo $shop['shop_desc'];?></textarea>
            </li>
            <li>
                <button type="submit" class="btn btn_red"><?php echo T('submit');?></button>
				<span id="ajax_share_message" class="ajax_error"></span>
            </li>
        </ul>
    	</form>
    	</div>
	</div>
</div>

<?php echo $tpl_footer; ?>
