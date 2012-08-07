$(document).ready(function($) {
	$('#install_step3').validate({
		rules: {
			db_host: { required: true},
			db_port: { required: true},
			db_login: { required: true},
			db_password: { required: true},
			db_database: { required: true},
			admin_email: { required: true, email: true},
			admin_nickname: { required: true},
			admin_password: { required: true, rangelength: [6, 15] },
			admin_password2: { required: true, rangelength: [6, 15],equalTo: "#admin_password" }
		},
		messages: {
			db_host: { required: "请输入主机"},
			db_port: { required: "请输入端口"},
			db_login: { required: "请输入账号"},
			db_password: { required: "请输入密码"},
			db_database: { required: "请输入数据库名称"},
			admin_email: { required: "请输入有效的邮箱地址", email: "请输入有效的邮箱地址"},
			admin_nickname: { required: "请输入管理员昵称"},
			admin_password: { required: "请输入密码", rangelength: "密码长度为6-15位"},
			admin_password2: { required: "请输入密码", rangelength: "密码长度为6-15位",equalTo: "两次输入的密码不一致" }
		}
 	}); //用户绑定表单结束
});