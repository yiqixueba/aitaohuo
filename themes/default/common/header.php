<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_title?$page_title.' ':'';?><?php echo $settings['seo_setting']['page_title'];?></title>
<meta name="keywords" content="<?php echo $page_keyword?$page_keyword:'';?> <?php echo $settings['seo_setting']['page_keywords'];?>" />
<meta name="description" content="<?php echo $page_description?$page_description:$settings['seo_setting']['page_description'];?> -Powered by PinTuXiu" />
<meta name="generator" content="爱淘货,aitaohuo" />
<meta name="author" content="AiTaoHuo" />
<meta name="copyright" content="2012-2013 aitaohuo.com" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="icon" href="/favicon.ico" href="/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="/favicon.ico" href="/favicon.ico" type="image/x-icon" />

<link href="<?php echo base_url();?>themes/<?php echo $themes;?>/css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>themes/<?php echo $themes;?>/css/color-<?php echo $settings['ui_styles']['color'];?>.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>themes/<?php echo $themes;?>/css/text.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>themes/<?php echo $themes;?>/css/970_12_10.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>themes/<?php echo $themes;?>/css/layout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>themes/<?php echo $themes;?>/css/pintuxiu_<?php echo $lang;?>.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/imgareaselect-default.css" type="text/css" rel="stylesheet"/>
<!--[if lte IE 6]>
    <link href="<?php echo base_url();?>themes/<?php echo $themes;?>/css/ie6.css" rel="stylesheet"/>
<![endif]-->
<script>
var base_url = '<?php echo base_url();?>';
var min_fetch_width = <?php echo $settings['file_setting']['fetch_image_size_w']?$settings['file_setting']['fetch_image_size_w']:200;?>;
var min_fetch_height = <?php echo $settings['file_setting']['fetch_image_size_h']?$settings['file_setting']['fetch_image_size_h']:200;?>;
var sina_key = '<?php echo $settings['api_setting']['Sina']['APPKEY']?$settings['api_setting']['Sina']['APPKEY']:'3190596186';?>';
var qq_key = '<?php echo $settings['api_setting']['QQ']['APPKEY']?$settings['api_setting']['QQ']['APPKEY']:'100278689';?>';
</script>
<!-- Load: Always -->
<script src="<?php echo base_url();?>assets/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/onightjar.mini.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--[if lt IE 10]>
<script src="<?php echo base_url();?>assets/js/PIE.js" type="text/javascript"></script>
<![endif]-->
<!--[if lte IE 6]>
	<script src="<?php echo base_url();?>assets/js/letskillie6.zh_CN.pack.js"></script>
<![endif]-->
<script>
<?php if(!$current_user['user_id']&&in_array($current_controller,array('welcome','pin'))&&$settings['ui_layout']['login_reminder']):?>
$(document).ready(function() {
	($.sclogin()).start();
});
<?php endif;?>
<?php if($current_user['user_id']):?>
$(document).ready(function() {
	//var period_check = setInterval(function(){}, 10000 );
	check_message('reward',true,3000,700);
});
<?php endif;?>
</script>
</head> 
<body id="body">
<div class="main bg_common" id="header">
	<div class="g160 mt20"><a href="<?php echo spUrl("welcome","index"); ?>"><img src="<?php echo base_url("themes/{$themes}/images/logo.png");?>"/></a></div>
	<div class="nav">
		<ul class="nav-items f_l">
			<?php if($current_user['user_id']):?>
	   		<li <?php echo ($current_controller == 'my'&&$current_action == 'timeline')?'class="selected"':'';?>><a href="<?php echo spUrl("my","timeline"); ?>"><?php echo T('time_line');?></a><b></b></li>
	   		<li <?php echo ($current_controller == 'my'&&$current_action == 'focus')?'class="selected"':'';?>><a href="<?php echo spUrl("my","focus"); ?>"><?php echo T('my_pin');?></a><b></b></li>
    		<?php endif;?>
      		<li <?php echo ($current_controller == 'welcome') ? 'class="selected"':'';?>><a href="<?php echo spUrl("welcome","index"); ?>"><?php echo T('home');?></a><b></b></li>
     		<li <?php echo ($current_controller == 'pin' || $current_controller == 'detail')?'class="selected"':'';?>><a href="<?php echo spUrl("pin","index"); ?>"><?php echo T('pin');?></a><b></b></li>
	   		<li <?php echo ($current_controller == 'album')?'class="selected"':'';?>><a href="<?php echo spUrl("album","index");?>"><?php echo T('album');?></a><b></b></li>
	   		<li <?php echo ($current_controller == 'staruser')?'class="selected"':'';?>><a href="<?php echo spUrl("staruser","index"); ?>"><?php echo T('staruser');?></a><b></b></li>
	   		<li <?php echo ($current_controller == 'goodshop')?'class="selected"':'';?>><a href="<?php echo spUrl("goodshop","index"); ?>"><?php echo T('goodshop');?></a><b></b></li>
	   		<li <?php echo ($current_controller == 'facewall')?'class="selected"':'';?>><a href="<?php echo spUrl("facewall","index"); ?>"><?php echo T('facewall');?></a><b></b></li>
	   		<li <?php echo ($current_controller == 'faq')?'class="selected"':'';?>><a href="<?php echo spUrl("faq","fav"); ?>"><?php echo T('others');?></a><b></b></li>
    	</ul>
	</div>
	<div class="mulilanguage">
		<a href="<?php echo spUrl('misc','language',array('lang'=>'zh_cn'));?>" class="zh">&nbsp;</a>
		<a href="<?php echo spUrl('misc','language',array('lang'=>'en'));?>" class="en">&nbsp;</a>
	</div>
	<div class="userbar <?php echo $current_user['user_id']?'logged':''?>" id="userbar" style="display: block; ">
	<?php $userbar_need_scroll = in_array($current_controller,array('welcome','pin','album','staruser','goodshop','facewall'))||($current_action=='timeline');?>
		<ul <?php echo ($userbar_need_scroll)?'class="scroll"':'';?>>
			<?php if(!$current_user['user_id']):?>
			<li class="login menu" data-action="openLoginDialog" id="login_point">
				<a href="javascript:void(0);" class="parent"><?php echo T('login');?></a>
				<ul>
            		<li><a href="javascript:void(0);" data-action="openLoginDialog"><?php echo T('click_login');?></a><b></b></li>
                </ul>
			</li>
         	<li class="register menu" data-action="openRegisterDialog">
         		<a href="javascript:void(0);" class="parent"><?php echo T('register');?></a>
         		<ul>
            		<li><a href="javascript:void(0);" data-action="openRegisterDialog"><?php echo T('join');?></a><b></b></li>
                </ul>
         	</li>
         	<?php else:?>
         	<li class="profile menu">
				<a href="<?php echo spUrl("my","timeline");?>" class="parent"><img src="<?php echo base_url().$current_user['avatar_local'].'_middle.jpg'?>" onerror="javascript:this.src = base_url + '/assets/img/avatar_middle.jpg';"/></a>
				<ul>
            		<li><a href="javascript:void(0);"><?php echo $current_user['nickname'];?></a><b></b></li>
            		<li><a href="<?php echo spUrl("my","timeline");?>"><?php echo T('my_home');?></a></li>
	   				<li><a href="javascript:void(0);" data-action="openAvatar"><?php echo T('avatar_setting');?></a></li>
            		<li><a href="<?php echo spUrl("my","setting_basic"); ?>"><?php echo T('account_setting');?></a></li>
	   				<?php if($current_user['user_type']==3):?>
            		<li><a href="<?php echo spUrl("admin","index"); ?>"><?php echo T('admin_console');?></a></li>
            		<?php endif;?>
                </ul>
			</li>
			<?php if($can_post):?>
			<li class="pinner menu" data-action="openPublishSelectDialog">
				<a href="javascript:void(0);" class="parent"><?php echo T('add_pin')?></a>
				<ul>
            		<li><a href="javascript:void(0);" data-action="openPublishSelectDialog"><?php echo T('add_pin');?></a><b></b></li>
                </ul>
			</li>
			<?php endif;?>
         	<li class="message menu">
				<a href="<?php echo spUrl("my","message");?>" class="parent"><?php echo T('message');?><?php if($message_count):?><i><?php echo $message_count;?></i><?php endif;?></a>
				<ul>
            		<li><a href="<?php echo spUrl("my","message");?>"><?php echo $message_count.' ';?><?php echo T('not_read');?></a><b></b></li>
                </ul>
			</li>
         	<li class="logout menu">
				<a href="<?php echo spUrl('webuser','logout');?>" class="parent"><?php echo T('logout');?></a>
				<ul>
            		<li><a href="<?php echo spUrl('webuser','logout');?>"><?php echo T('logout');?></a><b></b></li>
                </ul>
			</li>
         	
         	<?php endif;?>
		</ul>
    </div>
</div>
<div class="clear">&nbsp;</div>
<div class="container header">
	<div class="main" id="nav-cat">
		<?php echo $tpl_nav;?>
    	<div class="nav-srh f_r">
			<form action="<?php echo spUrl('pin','index');?>" method="post" enctype="application/x-www-form-urlencoded">
            	<input type="text" name="keyword" class="f_l" title="<?php echo T('tip_search');?>" />
            	<button type="submit"><?php echo T('search');?></button>
        	</form>
		</div>
	</div>
	<div class="f_r" style="height: 40px;line-height: 40px;">
			<iframe width="63" height="24" class="mt10 mr10" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0" scrolling="no" border="0" src="http://widget.weibo.com/relationship/followbutton.php?language=zh_cn&width=63&height=24&uid=2664239401&style=1&btn=red&dpc=1"></iframe>
		</div>
</div>

	
