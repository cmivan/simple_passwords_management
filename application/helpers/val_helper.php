<?php

/**
 * Utf-8、gb2312都支持的汉字截取函数
 *
 * @access: public
 * @author: mk.zgc
 * @use   : cut_str(字符串, 截取长度, 开始长度, 编码); 编码默认为 utf-8 开始长度默认为 0 
 * @param : string，$str，原字符串
 * @param : int，$len ，截取的长度
 * @return: string
 * @eq    : echo cut_str("abcd需要截取的字符串", 8, 0, 'gb2312'); 
 */
function cutstr($string, $sublen, $start = 0, $code = 'UTF-8')
{ 
   if($code == 'UTF-8') 
   { 
       $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
       preg_match_all($pa, $string, $t_string); 
       if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)).".."; 
	   if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)); 
       return join('', array_slice($t_string[0], $start, $sublen)); 
   } 
   else 
   { 
       $start = $start*2; 
       $sublen = $sublen*2; 
       $strlen = strlen($string); 
       $tmpstr = ''; 

       for($i=0; $i<$strlen; $i++) 
       { 
           if($i>=$start && $i<($start+$sublen)) 
           { 
               if(ord(substr($string, $i, 1))>129) 
               { 
                   $tmpstr.= substr($string, $i, 2); 
               } 
               else 
               { 
                   $tmpstr.= substr($string, $i, 1); 
               } 
           } 
           if(ord(substr($string, $i, 1))>129) $i++; 
       } 
      if(strlen($tmpstr)<$strlen ) $tmpstr.= "..."; 
	  //if(strlen($tmpstr)<$strlen ) $tmpstr.= ""; 
      return $tmpstr; 
   } 
} 



#辅助函数，用于下拉框
function selectboxitem($str1,$str2)
{
  $strs=split(",",$str1);
  foreach($strs as $s)
  {
     if(!empty($str2)&&$s==$str2)
     {
	    echo '<option value="'.$s.'" selected>'.$s.'</option>';
     }
     else
     {
	    echo '<option value="'.$s.'">'.$s.'</option>';	
     }
  }
}



/**
 * 过滤html标签
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$str，要过滤html的字符
 * @return: string 
 */
function noHtml($str,$br=0)
{
   if($br==0)
   {
	   $str = str_replace(chr(10),'[br]',$str);
	   //$str = noSql($str);
	   $str = str_replace('<br>','[br]',$str);
	   $str = str_replace('<bR>','[br]',$str);
	   $str = str_replace('<Br>','[br]',$str);
	   $str = str_replace('<BR>','[br]',$str);
	/*
	   $str = htmlspecialchars_decode($str); 
	   $str = preg_replace( "@<script(.*?)</script>@is","",$str); 
	   $str = preg_replace( "@<iframe(.*?)</iframe>@is","",$str); 
	   $str = preg_replace( "@<style(.*?)</style>@is","",$str); 
	   $str = preg_replace( "@<(.*?)>@is", "",$str);
	*/
	   $str = htmlspecialchars($str,ENT_QUOTES); 
	   $str = str_replace('[br]','<br/>',$str);
   }
   else
   {
	   $str = htmlspecialchars($str,ENT_QUOTES); 
   }
   return $str;
}


/**
 * 过滤html标签2
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$str，要过滤html的字符
 * @return: string 
 */
function toText($str)
{
   $str = strtolower($str);
   $str = str_replace('&nbsp;',' ',$str);
   $str = preg_replace( "@<script(.*?)</script>@is","",$str); 
   $str = preg_replace( "@<iframe(.*?)</iframe>@is","",$str); 
   $str = preg_replace( "@<style(.*?)</style>@is","",$str); 
   $str = preg_replace( "@<(.*?)>@is", "",$str);
   return $str;
}



/**
 * 过滤sql标签
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$str，要过滤sql的字符
 * @return: string 
 */
function noSql($str)
{
   $str = addslashes($str);
   $str = str_replace("'","‘",$str);
   //$str = str_replace("\"","\",$str);
   //$str = str_replace("#","#",$str);
   //$str = str_replace("$","",$str);
   //$str = str_replace("_","\_",$str);
   //$str = str_replace("-","",$str);
   $str = str_replace(";","；",$str);
   //$str = str_replace("%","",$str);
   return $str;
}




/**
 * 重组数组,防止非法注入
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$val，要要重组的字符
 * @return: string 
 */
function getarray($val)
{
	$data = NULL;
	if(!empty($val) && $val != ''&&$val != 'no')
	{
		$arr = split('_',$val);
		foreach($arr as $item)
		{
			if(is_num($item))
			{
				$data[] = (int)$item;
			}
		}
	}
	return $data;
}




/**
 * 过滤如果为empty则输出空字符(主要用于添加编辑页面共享)
 * 暂未应用 2011-7-9
 * @access: public
 * @author: mk.zgc
 * @param: string,$str，string,$key
 * @return: string 
 */
function noempty($rs="",$key)
{
	if(!empty($rs))
	{
		return $rs->$key;
	}
	return '';
}





/**
 * 重写返回Query，
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$url，要重写的url参数
 * @return: string 
 */
function reQuery($query='')
{
	if( !empty($query) )
	{
		parse_str($query,$arr); 
		return $arr;
	}
	return array();
}
/**
 * 重写返回url，
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$url，要重写的url参数
 * @return: string 
 */
function reUrl($url='',$T=0)
{
	//获取基本Url参数
	$Ourl = strtolower($_SERVER["QUERY_STRING"]);
	$Ourl_arr = reQuery( $Ourl );

	$Nurl_arr = reQuery( $url );
	
	//返回url参数
	foreach($Nurl_arr as $item => $val)
	{
		if($val=='null')
		{
			if($item=='page')
			{
				$Ourl_arr['v'] = '1.0';
			}
			unset($Ourl_arr[$item]);
		}
		else
		{
			$Ourl_arr[$item] = $val;
		}
	}
	$back_urls = http_build_query($Ourl_arr);
	if(!empty($back_urls))
	{
		$back_urls = '?'.$back_urls;
	}
	if($T==1)
	{
		$CI = &get_instance();
		$back_urls = site_url($CI->uri->uri_string()) . $back_urls;
	}
	return $back_urls;
}


/**
 * 重写返回url，
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$url，要重写的url参数
 * @return: string 
 */
function reUrls($key='')
{
	//获取基本Url参数
	$CI = &get_instance();
	$ukey = $CI->uri->uri_string();
	return site_url($ukey.'/'.$key);
}



//获取网站域名
function siteurl()
{
	$pageURL = 'http://';
	if($_SERVER["SERVER_PORT"] != "80")
	{
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
	} 
	else
	{
		$pageURL .= $_SERVER["SERVER_NAME"];
	}
	return $pageURL;
}



//生成案例评价链接
function case_link($id)
{
	return 'http://'.$_SERVER["HTTP_HOST"].site_url('ver/c/'.$id).'?key='.case_hash($id);
}

//生成验证密文
function case_hash($id)
{
	$key = 'x'.$id;
	$key = base64_encode($key);
	$key = base64_encode($key.'tg');
	return $key;
}

//生成email验证链接
function email_link($uid,$email)
{
	$t = date('his',time());
	return 'http://'.$_SERVER["HTTP_HOST"].site_url('ver/e').'?uid='.$uid.'&key='.key_hash($uid,$email,$t).'&t='.$t;
}

//验证密文
function key_hash($uid=0,$str=0,$t=0)
{
	$CI = &get_instance();
	$CI->load->helper('security');
	$key = '#4'.$uid.'k*'.$str.'2@'.$t;
	$key = base64_encode(do_hash($key));
	$key = do_hash($key);
	return $key;
}


/**
 * 将指定数组进行加密处理
 * 
 * @access: public
 * @author: mk.zgc
 * @param: array,$arr  加密数组
 * @return: string  
 */
function arr2md5($arr)
{
	$dd = '';
	if(!empty($arr))
	{
		foreach($arr as $val)
		{
			$dd.= $val;
		}
	}
	return md5($dd);
}



/**
 * 将指定字符颜色高亮显示
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$str  被替换的字符串
 * @param: string,$str2 自定高亮显示的字符串
 * @return: string  
 */
function keycolor($str,$key,$T='red')
{
	return str_replace($key,"<span class='".$T."'>".$key."</span>",$str);
}


/**
 * 将指定字符颜色高亮显示
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$str  被替换的字符串
 * @return: string  
 */
function colorT($str,$T='chenghong')
{
	return "<span style='".$T."'>".$str."</span>";
}
 
 
 


/**
 * 匹配，只返回数字部分
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$val  原字符
 * @return: int  
 * @err return: $back
 */
function get_num($val=0,$back=false)
{
	if(empty($val)&&$back=='404')
	{
		show_404('/index' ,'log_error');exit;
	}
	elseif(empty($val))
	{
		return $back;	
	}
	
	preg_match_all("/\d+/",$val,$varr);
	if(!empty($varr[0][0])&&$varr[0][0]!=''&&($varr[0][0]==0||is_numeric($varr[0][0])))
	{
		return (int)$varr[0][0]; //强调返回数值
	}
	elseif($back=='404')
	{
		show_404('/index' ,'log_error');exit;
	}
	else
	{
		return $back;
	}
}
 


/**
 * 判断是否为数字
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$val
 * @return: bool
 */
function is_num($val=0)
{
	if(!empty($val) && $val!='' && is_numeric($val))
	{
		return true;
	}
	return false;
}





/**
 * 返回图片,如果图片为空，则返回默认图
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$val  原字符
 * @return: string  
 */
//判断是否已经验证
function yz_check($yz,$tip="绑定")
{
	$CI = & get_instance();
	$img_url = $CI->config->item("img_url");
	if($yz==1)
	{
		return '<img title="已'.$tip.'" src="'.$img_url.'ico/tick_shield.png" width="16" height="16" /><br />已'.$tip;
	}
	else
	{
		return '<img title="请'.$tip.'" src="'.$img_url.'ico/ktip.gif" width="16" height="16" /><br />未'.$tip;
	}
}







/**
 * 生成随机编号,用于订单号
 *
 * @access: public
 * @author: mk.zgc
 * @param: int,$uid  传入数字,一般为用户的id
 * @param: int,$t  0或1用于生成不同形式的值
 * @return: string
 */
function order_no($uid,$t=0)
{
	if(is_numeric($uid))
	{
		if($t==0)
		{
	      $date = date("YmdHis");
	      //return $date."-"."TG".$uid."-".rand(1000,9999);
		  return $date.$uid.rand(1000,9999);
		}
		else
		{
	      $date = date("ymdHis");
	      //return $date.".TG".$uid;
		  return $date.$uid;
		}
	}
}


/*返回验证码*/
function rnd_no()
{
	return rand(1000,9999);
}



/*转换成json形式*/
function txt2json($key='')
{
	if(!empty($key))
	{
		$key = str_replace("/","\/",$key);
		$key = str_replace('"','\"',$key);
	}
	return $key;
}

/*转换成json形式*/
function txt2arr($str='')
{
	$key = '';
	if(!empty($str))
	{
		$key = split(chr(10),$str);
	}
	return $key;
}



?>