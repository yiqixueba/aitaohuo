<?php if($users): ?>
	<?php foreach ($users as $friend):?>
		<div class="pin friend hide" id="22">
			<?php if($friend['is_star']):?>
			<div class="staruser"></div>
			<?php elseif($friend['is_shop']):?>
			<div class="goodshop"></div>
			<?php endif;?>
			<div class="friend-avatar">
				<a href="<?php echo spUrl('pub','index',array('uid'=>$friend['user_id']));?>"><img src="<?php echo useravatar($friend['user_id'], 'large');?>" onerror="javascript:this.src = base_url + '/assets/img/avatar_large.jpg';"></a>
			</div>
			<div class="friend-desc smalltxt">
				<p class="of_h"><span class="f_l"><a href="<?php echo spUrl('pub','index',array('uid'=>$friend['user_id']));?>" data-user-id="<?php echo $friend['user_id'];?>" data-user-profile="1"><?php echo $friend['nickname'];?></a> <em class="<?php echo $friend['gender'];?> colorlight"><?php echo ($user['province']) ? $user['province'].'-'.$user['city'] : T('earth');?></em></span><em class="num-pl f_r"><?php echo $friend['total_likes'];?></em></p>
				<p class="smalltxt"><?php echo $friend['bio']?sysSubStr($friend['bio'],120,true):T('user_no_description');?></p>
				<p class="smalltxt"><?php echo T('follow');?> <a href="<?php echo spUrl('pub','following',array('uid'=>$friend['user_id']));?>"><?php echo $friend['total_follows'];?></a> <?php echo T('fans');?> <a href="<?php echo spUrl('pub','fans',array('uid'=>$friend['user_id']));?>"><?php echo $friend['total_followers'];?></a> <?php echo T('share');?> <a href="<?php echo spUrl('pub','shares',array('uid'=>$friend['user_id']));?>"><?php echo $friend['total_shares'];?></a></p>
			</div>
			<div class="friend-relation text_c">
				<?php echo $friend['relation_view'];?>
			</div>
		</div>
	<?php endforeach;?>
<?php endif;?>