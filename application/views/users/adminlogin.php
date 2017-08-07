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
</head>
<body>

<div class="well" style="width:220px; margin:auto; margin-top:40px;">
<form class="validform" method="post">
<label>帐号：</label>
<input type="text" name="username" placeholder="小样，先填写好帐号…"/>
<br><br>
<label>密码：</label>
<input type="password" name="password" />
<br><br>
<input type="submit" class="btn btn-success" value="管理员登录"/>

</form>
</div>
</body>
</html>