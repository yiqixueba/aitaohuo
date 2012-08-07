<?php if($user['user_id']):?>
<div class="usercontrol pin scroll white_bg">
 	<div class="userbox">
	    <div class="avatar"><a target="_blank" href="javascript:;" data-user-id="<?php echo $user['user_id'];?>" data-user-profile="1"><img src="<?php echo useravatar($user['user_id'], 'middle');?>" onerror="javascript:this.src = base_url + '/assets/img/avatar_middle.jpg';" /></a></div>
	    <div class="info ml20"><a target="_blank" href="javascript:;" data-user-id="<?php echo $user['user_id'];?>" data-user-profile="1"><strong class="colororange"><?php echo $user['nickname'];?></strong></a>
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
  		<a href="<?php echo spUrl("my","following",array('uid'=>$user['user_id']));?>">
	  		<strong class="colororange"><?php echo $user['total_follows'];?></strong>
	  		<span class="colormiddle"><?php echo T('follow');?></span>
  		</a>
  	</li>
  	<li>
  		<a href="<?php echo spUrl("my","fans",array('uid'=>$user['user_id']));?>">
	  		<strong class="colororange"><?php echo $user['total_followers'];?></strong>
	  		<span class="colormiddle"><?php echo T('fans');?></span>
  		</a>
  	</li>
  	<li>
  		<a href="<?php echo spUrl("my","shares",array('uid'=>$user['user_id']));?>">
	  		<strong class="colororange"><?php echo $user['total_shares'];?></strong>
	  		<span class="colormiddle"><?php echo T('share');?></span>
  		</a>
  	</li>
  	<li class="noborder">
  		<a href="<?php echo spUrl("my","album",array('uid'=>$user['user_id']));?>">
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
      <li class="my <?php echo ($current_action=='focus'||$current_action=='shares'||$current_action=='favorite_share'||$current_action=='at_shares'||$current_action=='at_comments')?'active':'';?>"><a href="<?php echo spUrl("my","focus");?>"><i></i><?php echo T('my_pin');?></a>
      	<ul class="menu_child">
        	<li <?php echo ($current_action=='focus')?'class="active"':'';?>><a href="<?php echo spUrl("my","focus");?>"><?php echo T('my_focus_pin');?></a></li>
        	<li <?php echo ($current_action=='shares')?'class="active"':'';?>><a href="<?php echo spUrl("my","shares");?>"><?php echo T('my_share_pin');?></a></li>
            <li <?php echo ($current_action=='favorite_share')?'class="active"':'';?>><a href="<?php echo spUrl("my","favorite_share");?>"><?php echo T('my_love_pin');?></a></li>
            <li <?php echo ($current_action=='at_shares')?'class="active"':'';?>><a href="<?php echo spUrl("my","at_shares");?>">@<?php echo T('my_pin');?></a></li>
            <li <?php echo ($current_action=='at_comments')?'class="active"':'';?>><a href="<?php echo spUrl("my","at_comments");?>">@<?php echo T('my_comment');?></a></li>
       	</ul>
      </li>
      <?php if($can_post):?>
      <li class="share"><a href="javascript:void(0);" data-action="openPublishSelectDialog"><i></i><?php echo T('add_pin');?></a></li>
      <?php endif;?>
      <li class="alb <?php echo (stripos($current_action,'album')!== false)?'active':'';?>"><a href="<?php echo spUrl("my","album");?>"><i></i><?php echo T('album');?></a>
      	<ul class="menu_child">
        	<li <?php echo ($current_action=='album')?'class="active"':'';?>><a href="<?php echo spUrl("my","album");?>"><?php echo T('my_album');?></a></li>
            <li <?php echo ($current_action=='favorite_album')?'class="active"':'';?>><a href="<?php echo spUrl("my","favorite_album");?>"><?php echo T('my_love_album');?></a></li>
       	</ul>
     </li>
     <li class="timeline <?php echo (stripos($current_action,'timeline')!== false)?'active':'';?>"><a href="<?php echo spUrl("my","timeline");?>"><i></i><?php echo T('time_line');?></a>
     <?php if($forum_open&&$lang=='zh_cn'):?>
     <li class="timeline <?php echo (stripos($current_action,'forumline')!== false)?'active':'';?>"><a href="<?php echo spUrl("my","forumline");?>"><i></i><?php echo T('forum_line');?></a>
     <?php endif;?>
     <li class="message <?php echo ($current_action=='message')?'active':'';?>"><a href="<?php echo spUrl("my","message");?>"><i></i><?php echo T('message');?></a>
        <ul class="menu_child">
          <li <?php echo ($current_action=='message')?'class="active"':'';?>><a href="<?php echo spUrl("my","message");?>"><?php echo T('my_message');?></a></li>
        </ul>
     </li> 
      <li class="friend <?php echo ($current_action=='following'||$current_action=='fans')?'active':'';?>"><a href="<?php echo spUrl("my","following");?>"><i></i><?php echo T('my_friends');?></a>
       <ul class="menu_child">
        <li <?php echo ($current_action=='following')?'class="active"':'';?>><a href="<?php echo spUrl("my","following");?>"><?php echo T('my_following');?></a></li>
        <li <?php echo ($current_action=='fans')?'class="active"':'';?>><a href="<?php echo spUrl("my","fans");?>"><?php echo T('my_fans');?></a></li>
       </ul>
     </li>
      <li class="setting <?php echo (stripos($current_action,'setting')!== false)?'active':'';?>"><a href="<?php echo spUrl("my","setting_basic");?>"><i></i><?php echo T('settings');?></a>
        <ul class="menu_child">
	        <li <?php echo ($current_action=='setting_basic')?'class="active"':'';?>><a href="<?php echo spUrl("my","setting_basic");?>"><?php echo T('basic_settings');?></a></li>
	        <?php if($forum_open&&$lang=='zh_cn'):?>
		    <li <?php echo ($current_action=='setting_forum')?'class="active"':'';?>><a href="<?php echo spUrl("my","setting_forum");?>"><?php echo T('bind_forum');?></a></li>
		    <?php endif;?>
	        <?php if($user['is_star']):?>
	        <li <?php echo ($current_action=='setting_star')?'class="active"':'';?>><a href="<?php echo spUrl("my","setting_star");?>"><?php echo T('staruser_setting');?></a></li>
	        <?php endif;?>
	        <?php if($user['is_shop']):?>
	        <li <?php echo ($current_action=='setting_shop')?'class="active"':'';?>><a href="<?php echo spUrl("my","setting_shop");?>"><?php echo T('goodshop_setting');?></a></li>
	        <?php endif;?>
	        <li <?php echo ($current_action=='setting_bind')?'class="active"':'';?>><a href="<?php echo spUrl("my","setting_bind");?>"><?php echo T('bind_settings');?></a></li>
	        <li <?php echo ($current_action=='setting_security')?'class="active"':'';?>><a href="<?php echo spUrl("my","setting_security");?>"><?php echo T('security_settings');?></a></li>
	    </ul>
     </li>
    </ul>
  </div>
</div>
<?php endif;?>