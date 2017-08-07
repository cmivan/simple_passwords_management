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
<script language="javascript">
$(function(){
	$('.order_btu').click(function(){
		var cmd = $(this).attr('cmd');
		var type_id = $(this).attr('type_id');
		$('#cmd').val(cmd);
		$('#type_id').val(type_id);
		$(this).parents().find('.validform').submit();
		return false;
      });
  });
</script>
</head>
<body>

<div class="well" style="width:500px; margin:auto; margin-top:40px;">
<form class="validform" method="post">
<input type="hidden" name="cmd" id="cmd" />
<input type="hidden" name="type_id" id="type_id" />
<input type="hidden" name="go" id="go" value="yes" />
<table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
<thead>
<tr class="forumRaw edit_item_frist">
<td>
  <a class="btn btn-mini" href="<?php echo site_url('accounts')?>">返回帐号管理</a>
  <a class="btn btn-mini btn-primary" href="<?php echo site_url('accounts/type_edit')?>"><span class="icon-plus-sign icon-white"></span> 添加<span class="red">帐号</span>类别</a></td>
<td width="60" align="center"><strong>批登录</strong></td>
<td width="40" align="center"><strong>排序</strong></td>
<td width="100" align="center" class="edit_box_edit_td"><strong>操作</strong></td></tr>
</thead>
<?php
if(!empty($rs_type)){
	foreach($rs_type as $rs){
?>
<tr><td>
<a href="<?php echo site_url('index/type_edit')?><?php echo reUrl('id='.$rs->t_id)?>" class="btn btn-mini btn-success">
<span class="icon-cog icon-white"></span>
<?php echo $rs->t_title?><span>(<?php echo $rs->t_id?>)</span>
</a>


</td>
  <td align="center">
<?php if(!empty($rs->t_loginbox)){?>
<a href="" class="btn btn-mini btn-danger"><span class="icon-ok-sign icon-white"></span></a>
<?php }?>

  </td>
  <td width="40" align="center">
<a href="javascript:void(0);" class="order_btu" cmd="up" type_id="<?php echo $rs->t_id?>">
<img src="<?php echo site_url_fix('public/images/ico/up_ico','gif');?>" border="0" /></a>
<a href="javascript:void(0);" class="order_btu" cmd="down" type_id="<?php echo $rs->t_id?>">
<img src="<?php echo site_url_fix('public/images/ico/down_ico','gif');?>" border="0" /></a>
</td>
<td align="center">
<input type="button" class="btn btn-mini delete" url='<?php echo reUrl('del_id='.$rs->t_id)?>' title='<?php echo $rs->t_title;?>' value="删除" />
<input type="button" class="btn btn-mini btn-info update" url='<?php echo site_url('accounts/type_edit')?><?php echo reUrl('id='.$rs->t_id)?>' value="修改"/>
</td>
</tr>
<?php }}?>

</table>
</form>
</div>

</body>
</html>