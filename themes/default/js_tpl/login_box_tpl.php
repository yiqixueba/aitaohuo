<script type="text/template" id="login_box_tpl" data-title="<?php echo T('login_tip');?>">
<div class="login_left">
    <?php if($settings['ucenter_setting']['ucenter_open']&&$lang=='zh_cn'):?>
	<ul id="loginTab" class="nav-tabs">
       <li class="active" style="margin-left: 60px;"><a href="#ptx_login" data-toggle="tab"><?php echo T('pin_user');?></a></li>
		<li><a href="#bbs_login" data-toggle="tab"><?php echo T('bbs_user');?></a></li>
    </ul>
	<?php endif;?>
	<div id="loginTabContent" class="tab-content form">
       <div class="tab-pane fade active in" id="ptx_login">
          <form id="login_form" method="post">
		        <input type="hidden" name="redirectUrl" value="/"/>
		        <ul>
		            <li><label for="email"><?php echo T('user_email');?></label><input id="email" type="text" name="email" value=""/>
		            </li>
		            <li><label for="password"><?php echo T('user_password');?></label><input id="password" type="password" name="password"/></li>
		            <li class="def">
					<label class="checkbox">
		    			<input name="is_remember" type="checkbox" value="1" checked="checked"/> <?php echo T('autologin_next');?>
		  			</label>
		            </li>
		            <li>
		                <button type="submit"><?php echo T('login');?></button>
		                　			<span style="display:none;"><a href="#"><?php echo T('forgot_password');?></a></span>
						<span id="ajax_message" class="ajax_error"></span>
		            </li>
		        </ul>
		    </form>
       </div>
	<?php if($settings['ucenter_setting']['ucenter_open']&&$lang=='zh_cn'):?>
       <div class="tab-pane fade" id="bbs_login">
       		<form id="bbs_login_form" method="post">
		        <ul>
		            <li><label for="bbs_username"><?php echo T('bbs_username');?></label><input id="bbs_username" type="text" name="bbs_username"/>
		            </li>
		            <li><label for="bbs_password"><?php echo T('user_password');?></label><input id="bbs_password" type="password" name="bbs_password"/></li>
					<li>
		                <button type="submit"><?php echo T('login');?></button>
						<span id="ajax_message" class="ajax_error"></span>
		            </li>
		        </ul>
		    </form>
       </div>
	<?php endif;?>
    </div>
 </div>
    <ul class="other">
        <li><strong><?php echo T('other_login');?></strong> <?php echo T('or');?> <strong><a href="javascript:void(0);" data-action="openRegisterDialog"><?php echo T('register');?></a></strong></li>
		<?php if($settings['api_setting']['QQ']['APPKEY']):?>
		<li><a href="<?php echo spUrl('social','go',array('vendor'=>'QQ'));?>"><i class="login_icon_qq"></i>QQ账号</a></li>
		<?php endif;?>
		<?php if($settings['api_setting']['Sina']['APPKEY']):?>
		<li><a href="<?php echo spUrl('social','go',array('vendor'=>'Sina'));?>"><i class="login_icon_sina"></i>新浪微博</a></li>
		<?php endif;?>
		<?php if($settings['api_setting']['Renren']['APPKEY']):?>        
		<li><a href="<?php echo spUrl('social','go',array('vendor'=>'Renren'));?>"><i class="login_icon_renren"></i>人人账号</a></li>
		<?php endif;?>
		<?php if($settings['api_setting']['Taobao']['APPKEY']):?>    
    	<li><a href="<?php echo spUrl('social','go',array('vendor'=>'Taobao'));?>"><i class="login_icon_taobao"></i>淘宝账号</a></li>
		<?php endif;?>   
 	</ul>
</script>