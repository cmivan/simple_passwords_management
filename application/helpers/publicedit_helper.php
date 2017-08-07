<?php

#创建一键登录信息
function oneKey($user='',$pass='',$loginUrl='',$onekey='')
{
	if( $user !='' &&  $pass !='' && $onekey !='' )
	{
		$loginBOX = '<form action="'.$loginUrl.'" method="post" target="_blank">';
		$loginBOX.= $onekey;
		$loginBOX = str_replace('{user}',$user,$loginBOX);
		$loginBOX = str_replace('{pass}',$pass,$loginBOX);
		$loginBOX.= '<input type="submit" class="btn btn-xs btn-danger" value=" 登录 " />';
		$loginBOX.= '</form>';
		return $loginBOX;
	}
	return '-';
}



#重新排序
function List_Re_Order($keys)
{
//    $keys = array(
//		  'table' => 'place_area',
//		  'key'  => 'a_id',
//		  'okey' => 'order_id',
//		  'where' => array('c_id'=>$c_id),
//		  'id'   => $at_a_id,
//		  'oid'  => $at_order_id,
//		  'type' => $cmd,
//		  'order_type' => 'ASC'
//		  );
	
	$CI = &get_instance();
	
	if (is_array($keys) == false)
	{
		json_form_no('服务器繁忙!');
	}
	
	$table = $keys['table'];
	$key   = $keys['key'];
	$okey  = $keys['okey'];
	$id    = $keys['id'];
	$oid   = $keys['oid'];
	$type  = $keys['type'];
	
	$where = NULL;
	$order_type = NULL;
	if(!empty($keys['where']))
	{
		$where = $keys['where'];
	}
	if(!empty($keys['order_type']))
	{
		$order_type = $keys['order_type'];
	}

	
	if(is_null($table) || is_null($key) || is_null($okey) || is_null($id) || is_null($oid))
	{
		json_form_no('服务器繁忙!');
	}

	if(is_array($where))
	{
		$CI->db->where($where);
	}
	//处理排序方式
	if( is_null($order_type) )
	{
		$order_type = 0;
	}
	
	
	//执行重新排序
	if($type=="up")
	{
		$CI->db->from($table);
		if($order_type===0)
		{
			$CI->db->where($okey.' >', $oid);
			$CI->db->order_by($okey, 'asc');
		}
		else
		{
			$CI->db->where($okey.' <', $oid);
			$CI->db->order_by($okey, 'desc');
		}
		$row_up = $CI->db->get()->row();
		if(!empty($row_up))
		{
			$up_id = $row_up->$key;
			$up_order_id = $row_up->$okey;

			$CI->db->set($okey,$oid);
			$CI->db->where($key,$up_id);
			$CI->db->update($table);
			//--------------------------------
			$CI->db->set($okey,$up_order_id);
			$CI->db->where($key,$id);
			$CI->db->update($table);
			
			json_form_yes('更新成功!');
		}
		json_form_no('排序已到上限!');
	}
	elseif($type=="down")
	{
		$CI->db->from($table);
		if($order_type===0)
		{
			$CI->db->where($okey.' <', $oid);
			$CI->db->order_by($okey, 'desc');
		}
		else
		{
			$CI->db->where($okey.' >', $oid);
			$CI->db->order_by($okey, 'asc');
		}
		$row_down = $CI->db->get()->row();
		if(!empty($row_down))
		{
			$down_id = $row_down->$key;
			$down_order_id = $row_down->$okey;
			
			$CI->db->set($okey,$oid);
			$CI->db->where($key,$down_id);
			$CI->db->update($table);
			//--------------------------------
			$CI->db->set($okey,$down_order_id);
			$CI->db->where($key,$id);
			$CI->db->update($table);

			json_form_yes('更新成功!');
		}
		json_form_no('排序已到下限!');
	}
} 

?>