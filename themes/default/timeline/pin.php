<?php if($shares): ?>
	<div id="page-nav" class="timeline hide" style="display: none;">
		<a id="page-next" href="<?php echo $nextpage_url;?>" data-reset="<?php echo $resetPage?1:0;?>"></a>
	</div>
	<?php if($timeline_date):?>
		<div class="timeline hide time-con">
			<div class="corner"></div>
			<div class="time"><?php echo $timeline_date;?></div>
		</div>
	<?php endif;?>
	<?php foreach ($shares as $share):?>
		<div class="timeline hide" id="<?php echo $share['share_id'];?>">
			<div class="corner"></div>
			<?php if($current_user['user_type']=='3'||$current_user['user_type']=='2'||$share['user_id']==$current_user['user_id']):?>
			<a href="javascript: void(0);" data-action="deleteShare" data-params="<?php echo $share['share_id'];?>" class='deletebox'>X</a>
			<?php endif;?>
			<div class="actions">
				<a href="javascript:void(0);" data-action="addLike" data-params="<?php echo $share['share_id'];?>" class="btn_like"><i></i><?php echo T('like');?></a>
				<a href="javascript:void(0);" data-action="forwarding" data-params="<?php echo $share['share_id'];?>" class="btn_share"><i></i><?php echo T('share');?></a>
				<a href="javascript:void(0);" data-action="<?php echo $current_user?'addCommentBox':'openLoginDialog';?>" data-params="<?php echo $share['share_id'];?>" class="btn_comment"><i></i><?php echo T('comment');?></a>
			</div>
			<div class="item-content">
				<div class="from mt10 smalltxt">
					<?php echo friendlyDate($share['create_time']);?> <?php echo T('from_internet');?>
				</div>
			<?php if($share['share_type']=='video'): ?>
            	<?php $share_attribute=unserialize($share['share_attribute']);?>
            	<div class="share_pic" id="share_detail_image" style="background-color: #000000;" href="<?php echo host_url(spUrl("detail","index", array("share_id"=> $share['share_id'])));?>">
                	<object id="99746" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
                	height="315" width="420" type="application/x-shockwave-flash" 
                	data="<?php echo $share_attribute['video']['flv'];?>">
                	<param name="quality" value="high">
                	<param name="bgcolor" value="#000000">
                	<param name="allowScriptAccess" value="always">
                	<param name="wMode" value="Transparent">
                	<param name="swLiveConnect" value="true">
                	<param name="allowfullscreen" value="true">
                	<param value="<?php echo $share_attribute['video']['flv'];?>" name="movie">
                	<embed src="<?php echo $share_attribute['video']['flv'];?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="Transparent" width="420" height="315" style="visibility: visible;" pluginspage="http://get.adobe.com/cn/flashplayer/">
                	</object>
                	<i class="video_icon hide" orgin_url="<?php echo $share['reference_url'];?>" orgin_src="<?php echo base_url($share['image_path'].'_large.jpg');?>"></i>
                </div>
            <?php else:?>
				<div class="image-cover mt20">
					<a class="image" href="<?php echo spUrl("detail","index", array("share_id"=> $share['share_id']));?>" id="<?php echo $share['share_id']?>_image">
						<img src="<?php echo base_url($share['image_path'].'_large.jpg?'.$hash);?>"/>
					</a>
				</div>
				
				<?php if($share['total_images']>1):?>
				<div class="image-list">
					<?php $images = unserialize($share['images_array']);$i=0;?>
	                <?php foreach ($images as $image):?>
	               		<?php if($i>5) break;?>
	                	<?php if(!$image['cover']):?>
	                	<div class="image-square">
							<a href="<?php echo spUrl("detail","index", array("share_id"=> $share['share_id']));?>" class="trans07">
	                		<img src="<?php echo base_url($image['url'].'_square_like.jpg?'.$hash);?>" onerror="this.src='<?php echo base_url().'assets/img/blank.png'?>';">
	                		</a>
	                	</div>
	                	<?php $i++; endif;?>
	                <?php endforeach;?>
				</div>
				<?php endif;?>
			<?php endif;?>
				<div class="item-txt mt10">
					<p><?php echo parse_message(sysSubStr($share['intro'],2000,true),true);?></p>
				</div>
				<div class="item-info mt10">
					<p><?php echo T('like');?> <?php echo $share['total_likes'];?> <?php echo T('comment');?> <?php echo $share['total_comments'];?> <?php echo T('view');?> <?php echo $share['total_clicks'];?></p>
				</div>
			</div>
		</div>
	<?php endforeach;?>
<?php endif;?>