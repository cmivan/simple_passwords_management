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

<div class="well" style="width:400px; margin:auto; margin-top:40px;">
<form class="validform" method="post">
<label>类别名称：</label>
<input type="text" class="span3" name="t_title" id="t_title" placeholder="类别名称…" value="<?php echo $t_title?>"/>
<br><br>
<label>类别序号：</label>
<input type="text" name="t_order_id" id="t_order_id"  value="<?php echo $t_order_id?>"/>
<br>
注：排序数字越大越靠前
<br><br>
<label>登录代码：</label>
<textarea name="t_loginbox" cols="40" id="t_loginbox" style="width:90%;" placeholder="如果该分类的登录方式一样，可以统一在这里设置登录代码…"><?php echo $t_loginbox?></textarea>
<br><br>

<input type="button" class="btn" value="返回" id="edit_back"/>
<input type="submit" class="btn btn-success" id="save_button" value="提交"/>
<input type="hidden" name="t_id" id="t_id"  value="<?php echo $t_id?>"/>

</form>
</div>
</body>
</html>