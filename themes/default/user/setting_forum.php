<?php echo $tpl_header; ?>
<?php echo $tpl_user_banner; ?>
<div class="main">
	<div class="g240 scroll-container">
	<?php echo $tpl_usercontrol;?>
	</div>
	
	<div class="g720 right-content white_bg mb30 mt20">
		<div class="page-header">
			<h5>绑定论坛信息</h5>
  		</div>
  		<div class="page-content">
	  		<div class="alert alert-info">
	        	<strong>现在开始!</strong> 绑定论坛，用时光来展示您的论坛生涯。
	     	</div>
	     	<?php if($user['uc_id']):?>
	     	<div class="alert alert-success">
	        	您已经绑定了 论坛用户：<strong><?php echo $user['uc_nickname']?></strong>  如果需要修改请在下面重新绑定。
	     	</div>
	     	<?php endif;?>
	  		<div class="alert alert-danger">
	        	<strong>警告!</strong> 绑定论坛，将会更改您在拼图秀的密码为论坛密码。
	     	</div>
  		<form id="setting_forum_form" class="form" method="post">
		<ul>
         	<li><label for="bbs_username">论坛用户名</label>
            	<input type="text" id="bbs_username" name="bbs_username" value="<?php echo $user['uc_nickname']?>">
            </li>
          	<li><label for="bbs_password">论坛密码</label>
            <input type="password" id="bbs_password" name="bbs_password">
            </li>
            <li>
                <button type="submit" class="btn btn_red">确认绑定</button>
				<span id="ajax_message" class="ajax_error"></span>
            </li>
        </ul>
    	</form>
    	</div>
	</div>
</div>

<?php echo $tpl_footer; ?>
