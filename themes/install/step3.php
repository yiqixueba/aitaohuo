<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>拼图秀-社交版2.5</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Page-Enter" content="blendTrans(Duration=1)"/>
<link rel=”icon” href=”/favicon.ico” href=”/favicon.ico” type=”image/x-icon”>
<link rel=”shortcut icon” href=”/favicon.ico” href=”/favicon.ico” type=”image/x-icon”>
<link href="<?php echo base_url();?>themes/install/css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>themes/install/css/960.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>themes/install/css/install.css" rel="stylesheet" type="text/css" />

<script>
var base_url = '<?php echo base_url();?>';
</script>
<script src="http://lib.sinaapp.com/js/jquery/1.7/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/onightjar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>themes/install/js/nightjar.forms.js" type="text/javascript"></script>
</head>
<body>
<div class="main">
    <form id="install_step3" name="install_step3" action="<?php echo spUrl("install","step3"); ?>" method="post">
    <div class="header">
        <h1><img src="<?php echo base_url();?>themes/install/images/install_logo.png"></h1>
    </div>
    <div class="container">
            <div class="form_box">
            <?php if($install_error): ?>
            <div class="error_info"><?php echo $install_error['msg'];?></div>
            <?php endif;?>
                <h3>填写数据库信息</h3>
                <div>
                    <label>数据库主机*：</label><input name="db_host" type="text" value="localhost">
                </div>
                <div>
                    <label>数据库端口*：</label><input name="db_port" type="text" value="3306">
                </div>
                <div>
                    <label>数据库帐号*：</label><input name="db_login" type="text" value="">
                </div>
                <div>
                    <label>数据库密码*：</label><input name="db_password" type="password" value="">
                </div>
                <div>
                    <label>数据库名称*：</label><input name="db_database" type="text" value="">
                </div>
                <div>
                    <label>数据表前缀：</label><input name="db_prefix" type="text" value="">
                </div>
            </div>
            <div class="form_box">
                <h3>填写帐号信息</h3>
                <div>
                    <label>管理员E-mail*：</label><input id="admin_email"  name="admin_email" type="text">
                </div>
                <div>
                    <label>管理员昵称*：</label><input id="admin_nickname" name="admin_nickname" type="text">
                </div>
                <div>
                    <label>管理员密码*：</label><input id="admin_password" name="admin_password" type="password">
                </div>
                <div>
                    <label>确认密码*：</label><input id="admin_password2" name="admin_password2" type="password">
                </div>
            </div>
   	 </div>
    <div class="action">
    	<a href="<?php echo spUrl("install","step2"); ?>" class="btn btn_submit">上一步</a>
    	<button type="submit" class="btn btn_submit">开始安装</button>
    </div>
    </form>
</div>
</body>
</html>
