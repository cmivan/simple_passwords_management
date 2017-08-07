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
   <!--绑定表单-注册-->
   $("#regform").validform({
	  tiptype:1,ajaxurl:'<?php echo site_url('action/do_reg');?>',
	  callback:function(data){
		  if(data.cmd=="y"){
			  setTimeout(function(){ $.Hidemsg(); window.location.href='<?php echo site_url('index');?>'; },2000);
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

<form class="validform" id="regform" method="post">

<label>登录帐号：</label>
<input name="username" type="text" placeholder="你想用什么帐号登录呢？" datatype="*" nullmsg="请填写帐号!"/>

<br><br><label>登录密码：</label>
<input name="password" type="password" datatype="*" nullmsg="请填写密码!" placeholder="要设密码哦！"/>

<br><br>
<label>昵称：</label>
<input name="nicename" type="text" datatype="*" nullmsg="请填写昵称!"/>

<?php /*?><br><br>
<label>邮箱：</label>
<input name="email" type="text" class="generic-box" id="email" datatype="e" errormsg="请填写密码!" nullmsg="请填写密码!"/>

<br><br>
<label>手机</label>
<input name="mobile" type="text" class="generic-box" id="mobile" datatype="m" errormsg="请填写密码!" nullmsg="请填写密码"/>

<br><br>
<label>电话</label>
<input name="tel" type="text" class="generic-box" id="tel" datatype="*" nullmsg="请填写密码"/>
<?php */?>

<br><br>
<a href="<?php echo site_url('index');?>" class="btn">返回登录</a>
<input type="submit" class="btn btn-success" value="提交注册信息" />
   
</form>

</div>
</body>
</html>