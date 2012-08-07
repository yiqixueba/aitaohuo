<?php if($user['user_id']):?>
<div class="usercontrol pin scroll white_bg">
 	<div class="userbox">
	    <div class="avatar"><a target="_blank" href="javascript:;" data-user-id="<?php echo $user['user_id'];?>" data-user-profile="1"><img src="<?php echo useravatar($user['user_id'], 'middle');?>" onerror="javascript:this.src = base_url + '/assets/img/avatar_middle.jpg';" /></a></div>
	    <div class="info ml10"><a target="_blank" href="javascript:;" data-user-id="<?php echo $user['user_id'];?>" data-user-profile="1"><strong class="colororange"><?php echo $user['nickname'];?></strong></a>
	      <p class="smalltxt"><?php echo $user['group_title'];?></p>
	      <p class="smalltxt"><?php echo T($user['gender'])?> <?php echo ($user['province']) ? $user['province'].'-'.$user['city'] : T('earth');?></p>
	    </div>
	</div>
	<div class="desc">
		<p class="smalltxt"><?php echo $user['bio']?sysSubStr($user['bio'],120,true):T('user_no_description');?></p>
	</div>
  <div class="nums">
  <ul>
  	<li>
  		<a href="<?php echo spUrl("pub","following",array('uid'=>$user['user_id']));?>">
	  		<strong class="colororange"><?php echo $user['total_follows'];?></strong>
	  		<span class="colormiddle"><?php echo T('follow');?></span>
  		</a>
  	</li>
  	<li>
  		<a href="<?php echo spUrl("pub","fans",array('uid'=>$user['user_id']));?>">
	  		<strong class="colororange"><?php echo $user['total_followers'];?></strong>
	  		<span class="colormiddle"><?php echo T('fans');?></span>
  		</a>
  	</li>
  	<li>
  		<a href="<?php echo spUrl("pub","shares",array('uid'=>$user['user_id']));?>">
	  		<strong class="colororange"><?php echo $user['total_shares'];?></strong>
	  		<span class="colormiddle"><?php echo T('share');?></span>
  		</a>
  	</li>
  	<li class="noborder">
  		<a href="<?php echo spUrl("pub","album",array('uid'=>$user['user_id']));?>">
	  		<strong class="colororange"><?php echo $user['total_albums'];?></strong>
	  		<span class="colormiddle"><?php echo T('album');?></span>
  		</a>
  	</li>
  </ul>
  </div>
  <div class="clear"></div>
 
 <div class="nums boder-t">
  	<dl class="cl">
  		<dt><?php echo $user['credits']['name'];?></dt>
  		<dd><?php echo $user['credits']['value'];?></dd>
  	<?php for ($i = 1; $i <= 3; $i++):?>
  		<dt><?php echo $user['ext_credits_'.$i]['name'];?></dt>
  		<dd><?php echo $user['ext_credits_'.$i]['value'];?></dd>
  	<?php endfor;?>
  	</dl>
  </div> 
 
  <div class="menu">
    <ul>
      <li class="my <?php echo ($current_action=='focus'||$current_action=='shares'||$current_action=='favorite_share')?'active':'';?>"><a href="<?php echo spUrl("pub","shares",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('his_her_pin');?></a>
      </li>
      <li class="alb <?php echo (stripos($current_action,'album')!== false)?'active':'';?>"><a href="<?php echo spUrl("pub","album",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('his_her_album');?></a>
      </li>
     <li class="timeline <?php echo (stripos($current_action,'timeline')!== false)?'active':'';?>"><a href="<?php echo spUrl("pub","timeline",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('his_her_timeline');?></a>
     <?php if($forum_open&&$lang=='zh_cn'):?>
     <li class="timeline <?php echo (stripos($current_action,'forumline')!== false)?'active':'';?>"><a href="<?php echo spUrl("pub","forumline",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('his_her_bbs_timeline');?></a>
     <?php endif;?>
      <li class="friend <?php echo ($current_action=='following'||$current_action=='fans')?'active':'';?>"><a href="<?php echo spUrl("pub","following",array('uid'=>$user['user_id']));?>"><i></i><?php echo T('his_her_friends');?></a>
       <ul class="menu_child">
        <li <?php echo ($current_action=='following')?'class="active"':'';?>><a href="<?php echo spUrl("pub","following",array('uid'=>$user['user_id']));?>"><?php echo T('his_her_following');?></a></li>
        <li <?php echo ($current_action=='fans')?'class="active"':'';?>><a href="<?php echo spUrl("pub","fans",array('uid'=>$user['user_id']));?>"><?php echo T('his_her_fans');?></a></li>
       </ul>
     </li>
    </ul>
  </div>
</div>
<?php endif;?>