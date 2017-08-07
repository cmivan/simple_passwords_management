<?php
if(empty($keysword)){ $keysword=''; }
if(empty($table_title)){ $table_title=''; }
//if(empty($page)){ $page='null'; }
$page='null';
if(empty($p_id)){ $p_id='null'; }
if(empty($c_id)){ $c_id='null'; }
if(empty($a_id)){ $a_id='null'; }
//<?php echo reUrl('page=null')
?>
<form name="search" method="get" class="form-search" action="">
<input name="keysword" type="text" id="keysword" value="<?php echo $keysword?>" class="input-medium search-query" placeholder="搜索帐号…" />
<input type="submit" name="Submit" value="&nbsp;<?php echo $table_title;?>搜索&nbsp;" class="btn"/>&nbsp;&nbsp;
<input type="hidden" name="page" value="<?php echo $page?>"/>
<input type="hidden" name="p_id" value="<?php echo $p_id?>"/>
<input type="hidden" name="c_id" value="<?php echo $c_id?>"/>
<input type="hidden" name="a_id" value="<?php echo $a_id?>"/>
</form>