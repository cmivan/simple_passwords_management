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

<div class="panel panel-info" style="width:320px; margin:auto; margin-top:40px;">
  <div class="panel-heading">
		<div class="panel panel-default">
		  <div class="panel-body">

				<form class="validform form-horizontal" id="loginform" method="post">
				  <div class="form-group">
				    <label class="col-sm-3 control-label">User</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" name="username" placeholder="请先填写登录帐号…" datatype="*" nullmsg="请填写帐号!" value="cm"/>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label">Password</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="password" name="password" placeholder="password…" datatype="*" nullmsg="请填写密码!" value=""/>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-9">
				      <button type="submit" class="btn btn-sm btn-primary">Sign in</button>
				      <a href="<?php echo site_url('index/reg');?>" class="btn">注册</a>
				    </div>
				  </div>
				</form>


		  </div>
		</div>
  </div>
</div>

</body>
</html>