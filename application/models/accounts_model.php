<?php
class Accounts_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
    /*返回sql*/
	function get_sql($typeid=0,$uid=0)
	{
		$this->db->select('accounts.id,accounts.title,accounts.type_id,accounts.time,accounts_type.t_id,accounts_type.t_title,accounts_type.t_order_id');
		$this->db->from('accounts');
		$this->db->join('accounts_type','accounts.type_id = accounts_type.t_id','left');
		$this->db->where('accounts.uid',$uid);
		$this->db->order_by('accounts.id','desc');
		if(get_num($typeid))
		{
			$this->db->where('accounts.type_id', $typeid);
		}
		//返回SQL
		$sql = $this->db->_compile_select();
		$this->db->_reset_select();
		return $sql;
	}
	
	/*返回分类*/
	function get_types($uid=0)
	{
	    $this->db->select('t_id,t_title,t_loginbox,t_order_id');
    	$this->db->from('accounts_type');
		$this->db->where('uid',$uid);
    	$this->db->order_by('t_order_id','desc');
    	$this->db->order_by('t_id','desc');
    	return $this->db->get()->result();
	}
	
	/*返回分类数目*/
	function get_types_num($uid=0)
	{
		$this->db->where('uid',$uid);
    	return $this->db->count_all_results('accounts_type');
	}

	/*返回分类*/
	function get_type($id,$uid=0)
	{
	    $this->db->select('t_id,t_title,t_loginbox,t_order_id');
    	$this->db->from('accounts_type');
    	$this->db->where('t_id',$id);
		$this->db->where('uid',$uid);
    	return $this->db->get()->row();
	}
	
	/*点击+1*/
	function hit($id=0,$uid=0)
	{
    	$this->db->set('visited', 'visited+1', FALSE);
    	$this->db->where('id', $id);
		$this->db->where('uid',$uid);
    	return $this->db->update('accounts');
	}
	
	/*返回文章内容详情*/
	function view($id=0,$uid=0)
	{
	    $this->db->select('accounts.*,accounts_type.t_id,accounts_type.t_title');
    	$this->db->from('accounts');
    	$this->db->join('accounts_type','accounts.type_id = accounts_type.t_id','left');
    	$this->db->where('accounts.id',$id);
		$this->db->where('accounts.uid',$uid);
    	$this->db->limit(1);
    	return $this->db->get()->row();
	}
	
	
	//删除文章内容
	function del($id,$uid=0)
	{
    	$this->db->where('id', $id);
		$this->db->where('uid',$uid);
    	return $this->db->delete('accounts'); 
	}
	
	/*删除分类*/
	function del_type($id,$uid=0)
	{
    	$this->db->where('t_id', $id);
		$this->db->where('uid',$uid);
    	return $this->db->delete('accounts_type'); 
	}

}
?>