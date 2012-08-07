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
</head>

<body>
<div class="main">
<div class="header">
<h1><img src="<?php echo base_url();?>themes/install/images/install_logo.png" /></h1>
</div>
<div class="container">
<p>环境检查：</p>
<table class="table">
    <thead>
        <tr>
            <th>检查项目</th>
            <th>建议环境</th>
            <th>当前环境</th>
            <th>功能影响</th>
        </tr>
    </thead>
    <tr>
        <td>PHP 版本</td>
        <td>PHP 5.2.0 及以上</td>
        <td><?php echo $env_check['phpversion']['curr_version'] ;?></td>
        <td><?php echo ($env_check['phpversion']['check']) ? '<span class="right">正确</span>': '<span class="wrong">失败</span>';?></td>
    </tr>
    <tr>
        <td>MYSQL 扩展</td>
        <td>必须开启</td>
        <td><?php echo ($func_check['mysql_connect']) ? '<span class="right">√</span>': '<span class="wrong">✕</span>';?></td>
        <td><?php echo ($func_check['mysql_connect']) ? '<span class="right">正确</span>': '<span class="wrong">失败</span>';?></td>
    </tr>
    <tr>
        <td>ICONV 扩展</td>
        <td>必须开启</td>
        <td><?php echo ($func_check['iconv']) ? '<span class="right">√</span>': '<span class="wrong">✕</span>';?></td>
        <td><?php echo ($func_check['iconv']) ? '<span class="right">正确</span>': '<span class="wrong">失败</span>';?></td>
    </tr>
    <tr>
        <td>JSON扩展</td>
        <td>必须开启</td>
        <td><?php echo ($func_check['json_encode']) ? '<span class="right">√</span>': '<span class="wrong">✕</span>';?></td>
        <td><?php echo ($func_check['json_encode']) ? '<span class="right">正确</span>': '<span class="wrong">失败</span>';?></td>
    </tr>
    <tr>
        <td>GD 扩展</td>
        <td>必须开启</td>
        <td><?php echo ($func_check['gd_info']) ? '<span class="right">√</span>': '<span class="wrong">✕</span>';?></td>
        <td><?php echo ($func_check['gd_info']) ? '<span class="right">正确</span>': '<span class="wrong">失败</span>';?></td>
    </tr>
    <tr>
        <td>CURL 扩展</td>
        <td>必须开启</td>
        <td><?php echo ($func_check['curl_init']) ? '<span class="right">√</span>': '<span class="wrong">✕</span>';?></td>
        <td><?php echo ($func_check['curl_init']) ? '<span class="right">正确</span>': '<span class="wrong">失败</span>';?></td>
    </tr>
</table>
<br>
<p>目录权限检查：</p>
<table class="table">
    <thead>
        <tr>
            <th>检查目录</th>
            <th>检查结果</th>
            <th>功能影响</th>
        </tr>
    </thead>
    <?php foreach($dir_check as $key=>$value): ?>
    <tr>
        <td><?php echo $key; ?></td>
        <td><?php echo ($value['check']) ? '<span class="right">'.$value['attrib'].'</span>': '<span class="wrong">'.$value['attrib'].'</span>';?></td>
        <td><?php echo ($value['check']) ? '<span class="right">正确</span>': '<span class="wrong">失败</span>';?></td>
    </tr>
   <?php endforeach;?>
</table>
</div>

<div class="action">
<a href="<?php echo spUrl("install","index"); ?>" class="btn btn_submit">上一步</a>
<?php if($final_check): ?>
<a href="<?php echo ($final_check) ?  spUrl("install","step3") : '#'; ?>" class="btn btn_submit">下一步</a>
<?php else:?>
<a href="#" class="btn">下一步</a>
<?php endif;?>
</div>
</div>
</body>
</html>
