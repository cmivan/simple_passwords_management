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

<link rel="stylesheet" href="<?php echo $js_url;?>thickbox/thickbox.css" />
<script type="text/javascript" src="<?php echo $js_url;?>thickbox/thickbox.js"></script>

<script language="javascript" type="text/javascript"> 
$(function(){
  $(".edit_btu").click(function(){
	   var url=$(this).attr("url");
	   tb_show('更新帐号信息', url + '?height=509&width=460',false);
	  });
});</script>
</head>
<body>
<div class="well">

<table width="100%" border="0" align=center cellpadding="0" cellspacing="0" class="well">
<tr>
<td>
<a class="btn btn-xs login_out" href="javascript:void(0);" url="<?php echo site_url('action/login_out')?>"><span class="icon-off"></span> 退出</a>
<a class="btn btn-xs btn-primary" href="<?php echo site_url('accounts')?>">返回帐号管理</a>
</td>
<td align="right" style="padding:7px;" class="col-lg-2">
  <?php $this->load->view('public/public_search'); ?>
</td></tr></table>


<table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
<thead>
<tr class="edit_item_frist">
<td width="40" align="center"><strong>编号</strong></td>
<td width="260"><strong>&nbsp;站点名称</strong></td>
<td width="180"><strong>帐号</strong></td>
<td width="180"><strong>密码</strong></td>
<td width="130" class="edit_box_edit_td"><strong>访问地址</strong></td>
</tr>
</thead>

<?php
if(!empty($accounts_list)){
	foreach($accounts_list as $item){
?> 
<thead>
<tr class="edit_item_frist">
<td colspan="5" align="left"><strong>&nbsp;&nbsp;+ <?php echo $item['title'];?></strong></td>
</tr>
</thead>
	  
	  
<?php
$accounts = $item['accounts'];
if(!empty($accounts)){
	$delnum = 0;
	foreach($accounts as $rs){
		$delnum++;
		$siteUrl = $rs->siteUrl;
		$loginUrl = $rs->loginUrl;
?> 
<tr>
<td width="40" align="center"><?php echo $rs->id;?></td>
<td>
  <?php if( $siteUrl !='' ){?>
  <a href="<?php echo reUrls('go2url/'.$rs->id);?>" target="_blank" title="<?php echo $rs->title;?>"><?php echo $rs->title;?></a>
  <?php }else{?>
  <span class="btn btn-mini disabled"><?php echo $rs->title;?></span>
  <?php }?>
</td>
<td width="180" align="left"><?php echo $rs->user;?></td>
<td width="180" align="left"><?php echo $rs->pass;?></td>
<td width="130" align="left" title="<?php echo $rs->time;?>"><?php echo $rs->siteUrl;?></td>
</tr>
<?php }}?>

<?php
	}}
?>
</table>


</div>

</body>
</html>