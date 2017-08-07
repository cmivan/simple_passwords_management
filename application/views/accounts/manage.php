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
<a class="btn login_out" href="javascript:void(0);" url="<?php echo site_url('action/login_out')?>"><span class="icon-off"></span> 退出</a>
<a class="btn btn-primary" href="<?php echo reUrls('type')?>"><span class="icon-cog icon-white"></span> 分类管理</a>
<a class="btn btn-primary edit_btu" href="javascript:void(0);" url="<?php echo reUrls('edit')?>"><span class="icon-plus-sign icon-white"></span> 添加帐号</a>
<a class="btn btn-primary" href="<?php echo reUrls('lists')?>"><span class="icon-plus-sign icon-white"></span> 帐号分类</a>
</td>
<td align="right">
  <?php $this->load->view('public/public_search'); ?>
</td></tr></table>
<?php $this->load->view('public/public_type_nav'); ?>


<table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
<thead>
<tr class="edit_item_frist">
<td width="40" align="center"><strong>编号</strong></td>
<td width="40" align="center"><strong>热度</strong></td>
<td align="center"><strong>&nbsp;站点名称</strong></td>
<td width="70" align="center"><strong>一键登录</strong></td>
<td width="180" align="center"><strong>帐号</strong></td>
<td width="180" align="center"><strong>密码</strong></td>
<td width="130" align="center" class="edit_box_edit_td"><strong>录入时间</strong></td>
<td width="130" align="center" class="edit_box_edit_td"><strong>操作</strong></td>
</tr>
</thead>
	  
	  
<?php
if(!empty($accounts_list)){
	$delnum = 0;
	foreach($accounts_list as $rs){
		$delnum++;
		$siteUrl = $rs->siteUrl;
		$loginUrl = $rs->loginUrl;
?> 
<tr>
<td align="center"><?php echo $rs->id;?></td>
<td align="center"><?php echo $rs->visited;?></td>
<td>&nbsp;
  <?php if( $siteUrl !='' ){?>
  <a class="btn btn-mini btn-success" href="<?php echo reUrls('go2url/'.$rs->id);?>" target="_blank" title="<?php echo $rs->title;?>"><?php echo keycolor(cutstr($rs->title,26),$keysword);?></a>
  <?php }else{?>
  <span class="btn btn-mini disabled"><?php echo keycolor(cutstr($rs->title,26),$keysword);?></span>
  <?php }?>
</td>
<td align="center"><?php echo oneKey($rs->user,$rs->pass,$rs->loginUrl,$rs->onekey)?></td>
<td align="center"><?php echo $rs->user;?></td>
<td align="center"><?php echo $rs->pass;?></td>
<td align="center" title="<?php echo $rs->time;?>"><?php echo dateHi($rs->time);?></td>
<td align="center">
<a href="javascript:void(0);" class="btn btn-mini delete" url='<?php echo reUrl('del_id='.$rs->id)?>' title='<?php echo cutstr($rs->title,26);?>' ><span class="icon-remove"></span> 删除</a>
<a href="javascript:void(0);" class="btn btn-mini btn-info edit_btu" url="<?php echo reUrls('edit/'.$rs->id)?>"><span class="icon-edit icon-white"></span> 修改</a>
</td></tr>
<?php }?>
<tr><td colspan="9"><?php $this->paging->links(); ?></TD></tr>
<?php }else{?>
<tr><td height="50" colspan="9" align="center">暂无相应内容!</td></tr>
<?php }?>
</table>

</div>

</body>
</html>