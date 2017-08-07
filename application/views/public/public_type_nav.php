<?php if(!empty($rs_type)){?>
<ul class="nav nav-tabs nav-xs">
  	<li role="presentation"><a href="?" class="btn-success"><i class="icon-th-large icon-white"></i> 全部</a></li>
	<?php foreach($rs_type as $rs){?>
	<?php if($rs->t_id==$type_id){?>
		<li role="presentation" class="active">
			<a href="<?php echo reUrl('page=null&type_id='.$rs->t_id)?>"><?php echo $rs->t_title?></a>
		</li>
	<?php }else{?>
		<li role="presentation">
			<a href="<?php echo reUrl('page=null&type_id='.$rs->t_id)?>"><?php echo $rs->t_title?></a>
		</li>
	<?php }}?>
</ul>
<?php }?>