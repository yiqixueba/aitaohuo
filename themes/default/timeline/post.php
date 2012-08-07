<?php if($posts): ?>
	<div id="page-nav" class="timeline hide" style="display: none;">
		<a id="page-next" href="<?php echo $nextpage_url;?>" data-reset="<?php echo $resetPage?1:0;?>"></a>
	</div>
	<?php if($timeline_date):?>
		<div class="timeline hide time-con">
			<div class="corner"></div>
			<div class="time"><?php echo $timeline_date;?></div>
		</div>
	<?php endif;?>
	<?php foreach ($posts as $post):?>
		<div class="timeline hide">
			<div class="corner"></div>
			<div class="actions">
				<a href="<?php echo $settings['forum_setting']['bbs_domain'];?>/forum.php?mod=viewthread&tid=<?php echo $post['tid'];?>" class="btn_share"><i></i>去论坛查看</a>
			</div>
			<div class="item-content">
				<div class="from mt10 smalltxt">
					<?php echo friendlyDate($post['dateline']);?> 来自<?php echo $bbsname?$bbsname:'论坛';?> <?php echo $post['name'];?>
				</div>
				
			<?php if($post['images']):?>
			<?php $bbs_path = $settings['forum_setting']['bbs_domain'].'/data/attachment/forum/';
				  $thread_path = $settings['forum_setting']['bbs_domain'].'/forum.php?mod=viewthread&tid='.$post['tid'];
			?>
				<div class="image-cover mt20">
					<a class="image" href="<?php echo $thread_path;?>">
						<img src="<?php echo $bbs_path.$post['images'][0]['attachment'];?>"/>
					</a>
				</div>
				<?php $image_num = array_length($post['images']);?>
				<?php if($image_num>0):?>
				<div class="image-list">
					<?php $num = $image_num>6?6:$image_num;?>
					<?php for ($i = 1; $i < $num; $i++):?>
					<div class="image-square">
						<a href="<?php echo $thread_path;?>" class="trans07">
                		<img src="<?php echo $bbs_path.$post['images'][$i]['attachment'];?>" onerror="this.src='<?php echo base_url().'assets/img/blank.png'?>';">
                		</a>
                	</div>
                	<?php endfor;?>
				</div>
				<?php endif;?>
			<?php endif;?>
				<div class="item-txt mt10">
					<p><strong><?php echo $post['subject'];?></strong></p>
					<p><?php echo sysSubStr($post['message'],1000,true);?></p>
				</div>
				<div class="item-info mt10">
					<p>浏览 <?php echo $post['views'];?> 回复 <?php echo $post['replies'];?></p>
				</div>
			</div>
		</div>
	<?php endforeach;?>
<?php endif;?>