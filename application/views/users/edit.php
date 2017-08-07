<?php
//-=================================================-
//-====  |       伊凡php建站系统 v1.0           | ====-
//-====  |       Author : cm.ivan             | ====-
//-====  |       QQ     : 394716221           | ====-
//-====  |       Time   : 2011-04-02 11:00    | ====-
//-====  |       For    : 齐翔广告             | ====-
//-=================================================-
?>
<?php $this->load->view('public/validform'); ?>
<form class="validform" method="post">
<TABLE border="0" align="center" cellpadding="0" cellspacing="10" class="forum1"><tr><td>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="forum2">

<tr class="forumRow">
<td align="right">类别：</td><td>
<select name="type_id" id="type_id">
<?php
if(!empty($rs_type)){
	foreach($rs_type as $rs){
?>
<option value="<?php echo $rs->t_id?>" <?php if($rs_data['type_id']==$rs->t_id){echo "selected";}?> > <?php echo $rs->t_title?></option>
<?php }}?>
</select>
</td></tr>   
<tr class="forumRow">
<td width="80" align="right">站点名称：</td>
<td><label><input name="title" type="text" id="title" size="50" value="<?php echo $rs_data['title'];?>" /></label></td></tr>

  
<tr class="forumRow">
<td width="80" align="right">网址：</td>
<td><label><input name="siteUrl" type="text" id="siteUrl" size="50" value="<?php echo $rs_data['siteUrl'];?>" /></label></td></tr>

<tr class="forumRow">
<td width="80" align="right">帐号：</td>
<td><label><input name="user" type="text" id="user" size="50" value="<?php echo $rs_data['user'];?>" /></label></td></tr>

<tr class="forumRow">
<td width="80" align="right">密码：</td>
<td><label><input name="pass" type="text" id="pass" size="50" value="<?php echo $rs_data['pass'];?>" /></label></td></tr>
  
<tr class="forumRow">
<td width="80" align="right">登录地址：</td>
<td><label><input name="loginUrl" type="text" id="loginUrl" size="50" value="<?php echo $rs_data['loginUrl'];?>" /></label></td></tr>
  
<tr class="forumRow">
<td align="right" valign="top">一键登录：</td>
<td><textarea name="onekey" rows="5" id="onekey" style="width:350px;"><?php echo $rs_data['onekey'];?></textarea></td></tr>
     
<tr class="forumRow">
<td align="right" valign="top">备注：</td><td>
<textarea name="note" cols="50" rows="5" id="note" style="width:350px;"><?php echo $rs_data['note'];?></textarea>
<?php /*?>编辑器<?php */?>
<?php //=$this->kindeditor->system_js('note',$rs_data['note'],'88%','400px');?>
</td></tr>

<tr class="forumRaw">
<td height="30" align="center">&nbsp;</td>
<td class="edit_box_save_but" style="text-align:left">
<input type="submit" name="button" id="save_button" value="提交数据" class="btn btn-success" />
<input type="hidden" name="id" id="id" value="<?php echo $rs_data['id'];?>" /></td>
</tr></table>
</td></tr></table>
</form>