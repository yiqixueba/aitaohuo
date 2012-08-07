<?php echo $tpl_header; ?>
<div class="clear"></div>
<div class="main mt10">
			<?php foreach ($shops as $shop):?>
			<div class="goodshop-box g480 round-shadow white_bg">
				<div class="goodshop-content">
					<div class="goodshop-avatar f_l mr10">
						<a href="<?php echo spUrl('pub','index',array('uid'=>$shop['user_id']));?>" target="_blank">
							<img src="<?php echo useravatar($shop['user_id'], 'large');?>"  onerror="javascript:this.src = '<?php echo base_url();?>/assets/img/avatar_large.jpg';"/>
						</a>
					</div>
					<div class="goodshop-desc f_l">
						<div class="goodshop-username"><span><a href="<?php echo spUrl('pub','index',array('uid'=>$shop['user_id']));?>" class="f_l"><?php echo $shop['nickname'];?></a><em class="num-pl f_r"><?php echo $shop['total_followers'];?><?php echo T('collect');?></em></span></div>
						<div class="goodshop-title of_h"><span class="f_l"><?php echo $shop['user_title']?$shop['user_title']:'未命名';?></span><span class="f_r"><?php echo $shop['relation_view'];?></span></div>
						<div class="goodshop-txt smalltxt"><?php echo T('goodshop_description').': '.$shop['shop_desc'];?></div>
					</div>
				</div>
				<div class="goodshop-pics">
					<?php foreach ($shop['shares'] as $share):?>
					<div class="goodshop-pic">
						<a href="<?php echo spUrl('detail','index', array('share_id'=>$share['share_id']));?>" class="trans07"><img src="<?php echo base_url($share['image_path'].'_square_like.jpg');?>"></a>
					</div>
					<?php endforeach;?>
				</div>
			</div>
			<?php endforeach;?>
</div>
<div class="clear"></div>
<div class="main mt10">
	<div class="g960 text_c">
		<?php echo $pages;?>
	</div>
</div>
<?php echo $tpl_footer; ?>
