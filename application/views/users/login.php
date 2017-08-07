<?php
//-=================================================-
//-====  |       伊凡php建站系统 v1.0           | ====-
//-====  |       Author : cm.ivan             | ====-
//-====  |       QQ     : 394716221           | ====-
//-====  |       Time   : 2011-04-02 11:00    | ====-
//-====  |       For    : 齐翔广告             | ====-
//-=================================================-
?>
<?php $this->load->view('public/header'); ?>
<script type="text/javascript" src="<?php echo $js_url;?>validform/js/validform.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $js_url;?>validform/css/css.css" />
<script type="text/javascript">
$(function(){
   <!--绑定表单-登录-->
   $("#loginform").validform({
	  tiptype:1,ajaxurl:'<?php echo site_url('action/do_login');?>',
	  callback:function(data){
		  if(data.cmd=="y"){
			  setTimeout(function(){ $.Hidemsg(); window.location.reload(); },2000);
		  }else if(data.cmd=="n"){
			  setTimeout(function(){ $.Hidemsg(); },2000);
		  }
	  }
   });
});
</script>
</head>
<body>

<div class="well" style="width:220px; margin:auto; margin-top:40px;">
<form class="validform" id="loginform" method="post">
<label>登录帐号：</label>
<input type="text" name="username" placeholder="请先填写登录帐号…" datatype="*" nullmsg="请填写帐号!" value="cm"/>
<br><br>
<label>登录密码：</label>
<input type="password" name="password" datatype="*" nullmsg="请填写密码!"/>
<br><br>
<a href="<?php echo site_url('index/reg');?>" class="btn">注册</a>
<input type="submit" class="btn btn-success" value="登录"/>
</form>
</div>
</body>
</html>