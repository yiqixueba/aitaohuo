<?php echo $tpl_header; ?>
<div class="clear"></div>
<div class="main mt10">
	<div class="g960 staruser-hd round-shadow">
		<div class="staruser-hd-left"></div>
		<div class="staruser-hd-right"><span class="apply-btn"><input type="submit" data-action="applyOpen" data-params="star" value="立即申请"/></span></div>
	</div>
</div>
<div class="clear"></div>
<div class="main mt10">
	<div class="g960 round-shadow white_bg staruser-list pb20">
		<div class="mt10 mr30">
			<?php foreach ($starusers as $star):?>
			<div class="staruser-box">
				<div class="staruser-content">
					<div class="staruser-avatar f_l mr10">
						<a href="<?php echo spUrl('pub','index',array('uid'=>$star['user_id']));?>" target="_blank">
							<img src="<?php echo useravatar($star['user_id'], 'middle');?>"  onerror="javascript:this.src = '<?php echo base_url();?>/assets/img/avatar_large.jpg';"/>
						</a>
					</div>
					<div class="staruser-desc f_l">
						<div class="staruser-username"><span><a href="<?php echo spUrl('pub','index',array('uid'=>$star['user_id']));?>" class="f_l"><?php echo $star['nickname'];?></a><em class="num-pl f_r"><?php echo $star['total_likes'];?><?php echo T('like');?></em></span></div>
						<div class="staruser-title of_h"><span class="f_l"><?php echo $star['user_title']?$star['user_title']:T('none');?></span><span class="f_r"><?php echo $star['relation_view'];?></span></div>
						<div class="staruser-txt smalltxt"><?php echo T('recommend_reason');?>：<?php echo $star['star_reason'];?></div>
					</div>
				</div>
				<div class="staruser-pics">
					<?php echo $star['star_view'];?>
				</div>
			</div>
			<?php endforeach;?>
			
		</div>
		<div class="g960 text_c mt10">
			<?php echo $pages;?>
		</div>
	</div>
	
</div>
<?php echo $tpl_footer; ?>
