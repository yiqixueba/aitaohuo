<div class="clear"></div>
<div class="main mt10">
	<div class="g960 timeline-hd round-shadow white_bg">
		<div class="g960 inside timeline-banner">
			<img src="<?php echo base_url().$user['avatar_local'].'_banner.jpg';?>" onerror="javascript:this.src = base_url + '/assets/img/default_banner.jpg';"/>
		</div>
		<div class="g960 inside timeline-profile">
			<div class="profile-pic">
					<div class="photo" id="photo">
						<a href="<?php echo spUrl('pub','index',array('uid'=>$user['user_id']));?>">
							<img src="<?php echo useravatar($user['user_id'], 'large');?>" onerror="javascript:this.src = base_url + '/assets/img/avatar_large.jpg';" alt="<?php echo $user['nickname'];?>" title="<?php echo $user['nickname'];?>">
						</a>
					</div>
					<div class="username colordark"><?php echo $user['nickname'];?></div>
					<div class="user-title ml10"><?php echo $user['user_title'];?></div>
					<div class="actions mr20 f_r">
						<?php echo $user['relation'];?>
					</div>
			</div>
			<div class="profile-desc f_l colordark middletxt">
				<p><em class="<?php echo $user['gender'];?>"><?php echo $user['province'];?> <?php echo $user['city'];?></em></p>
				<p class="colorlight"><?php echo $user['bio']?sysSubStr($user['bio'],120,true):T('user_no_description');?></p>
			</div>
			<div class="profile-nav mr20 mt10 f_r">
				<a class="share" href="<?php echo spUrl($controller,"shares",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('pin');?><em>(<?php echo $user['total_shares'];?>)</em></a>
				<a class="usertimeline <?php echo $current_action=='timeline'?'curr':'';?>" href="<?php echo spUrl($controller,"timeline",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('time_line');?><em>(<?php echo $user['total_shares'];?>)</em></a>
				<?php if($forum_open&&$lang=='zh_cn'):?>
				<a class="usertimeline <?php echo $current_action=='forumline'?'curr':'';?>" href="<?php echo spUrl($controller,"forumline",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('forum_line');?></a>
			    <?php endif;?>
				
				<a class="album" href="<?php echo spUrl($controller,"album",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('album');?><em>(<?php echo $user['total_albums'];?>)</em></a>
				<a class="follow" href="<?php echo spUrl($controller,"following",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('follow');?><em>(<?php echo $user['total_follows'];?>)</em></a>
				<a class="fans" href="<?php echo spUrl($controller,"fans",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('fans');?><em>(<?php echo $user['total_followers'];?>)</em></a>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>