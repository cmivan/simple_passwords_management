<?php if(!empty($rs_type)){?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="well">
<TR>
<td valign="top">
<a href="?" class="btn btn-mini btn-success"><i class="icon-th-large icon-white"></i> 全部</a>
<?php foreach($rs_type as $rs){?>
<?php if($rs->t_id==$type_id){?>
<a href="<?php echo reUrl('page=null&type_id='.$rs->t_id)?>" class="btn btn-mini btn-danger"><?php echo $rs->t_title?></a>
<?php }else{?>
<a href="<?php echo reUrl('page=null&type_id='.$rs->t_id)?>" class="btn btn-mini"><?php echo $rs->t_title?></a>
<?php }}?>
</td></tr></table>
<?php }?>