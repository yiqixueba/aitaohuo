<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="<?php echo base_url('themes/admin/css/bootstrap.min.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('themes/admin/css/admin.css'); ?>" type="text/css" rel="stylesheet" />
<script>
var base_url = '<?php echo base_url();?>';
</script>
<script src="http://lib.sinaapp.com/js/jquery/1.7/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/onightjar.min.js" type="text/javascript"></script>
<title>后台登录界面</title>
</head>

<body id="actions">
<div class="tablebox_header">   
</div>
<div class="tablebox">
	<div id="ajax_fetch_message">
		
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var actions = {
			checkUpdateClick: function(e){
				checkUpdate();
	        },
			updateClick: function(e){
				update();
		     },
			updateDbClick: function(e){
				updateDb();
			}
		};
		$('#actions').actionController({
			controller: actions,
			events: 'click'
		});

		var update_server_status;

		function updateDb() {
			var purl = '<?php echo spUrl('sqlupdate','index');?>';
			$('#ajax_fetch_message').html('正在更新数据库...');
			$.ajax({
				type: "post",
				url: purl,
				dataType: 'json',
				data: {'remote_version':update_server_status.remote_version}
			}).error(function() {
				alert('出错了！');
			}).success(function(result) {
				if(result.success === !0){
					$('#ajax_fetch_message').html('数据库更新完毕！');
				}else{
					$('#ajax_fetch_message').html('数据库更新完失败！');
				}
			});
		}

		function update() {
			var purl = '<?php echo spUrl('update','index');?>';
			$('#ajax_fetch_message').html('正在从官网下载可用更新...');
			$.ajax({
				type: "post",
				url: purl,
				dataType: 'json',
				data: {'ftp_address':update_server_status.ftp_address,'ftp_port':update_server_status.ftp_port,'ftp_user':update_server_status.ftp_user,
						'ftp_passwd':update_server_status.ftp_passwd,'remote_dir':update_server_status.remote_dir,'remote_version':update_server_status.remote_version}
			}).error(function() {
				alert('出错了！');
			}).success(function(result) {
				if(result.success === !0){
					$('#ajax_fetch_message').html('文件更新完毕<br/><button type="submit" data-action="updateDb" class="btn">点击更新数据库。</button>');
				}else{
					var error = '';
					for(var i=0;i<result.data.length;i++){
						error += result.data[i]+'</br>';
					}
					$('#ajax_fetch_message').html(error);
				}
			});
		}

		
		function checkUpdate() {
			var purl = 'http://localhost/nightjar_lite/updateserver';
			$('#ajax_fetch_message').html('正在检查是否有可用更新...');
			$.ajax({
				type: "post",
				url: purl,
				dataType: 'json',
				data: {'client_version':'<?php echo $version;?>'}
			}).error(function() {
				alert('www');
			}).success(function(result) {
				if(result.success === !0){
					update_server_status = result.data;
					$('#ajax_fetch_message').html('<button type="submit" data-action="update" class="btn">有新的更新，点击升级。</button>');
				}else{
					$('#ajax_fetch_message').html('暂时没有可用更新！');
				}
			});
		}
		checkUpdate();

});
</script>
</body>
</html>