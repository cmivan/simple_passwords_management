<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title><?php echo $seo['title']?></title>
<meta name="keywords" content="<?php echo $seo['keywords']?>" />
<meta name="description" content="<?php echo $seo['description']?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="cm.ivan@163.com"/>
<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" />

<script type="text/javascript">var base_url='<?php echo base_url()?>';var img_url ='<?php echo $img_url?>';var js_url='<?php echo $js_url?>';</script>
<script type="text/javascript" src="<?php echo $jq_url;?>"></script>
<script type="text/javascript" src="<?php echo $js_url;?>jquery_table_over.js"></script>
<?php $this->load->view('public/validform'); ?>

<link rel="stylesheet" href="<?php echo $css_url;?>../bootstrap/css/bootstrap.css" />