<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		//执行重新排序
		$this->load->helper('publicedit');
		
		$this->data['rs_data']['id'] = '';
		$this->data['rs_data']['title'] = '';
		$this->data['rs_data']['siteUrl'] = '';
		$this->data['rs_data']['loginUrl'] = '';
		$this->data['rs_data']['user'] = '';
		$this->data['rs_data']['pass'] = '';
		$this->data['rs_data']['type_id'] = '';
		$this->data['rs_data']['onekey'] = '';
		$this->data['rs_data']['note'] = '';
		$this->data['rs_type'] = $this->Accounts_Model->get_types();
	}
	


	function index($type_id=0)
	{
		$this->load->library('Paging');
		
		//删除
		$del_id = $this->input->getnum('del_id');
		if( $del_id )
		{
			$this->db->where('id',$del_id);
			$this->db->delete('accounts');
		}
		
		//判断搜索
		$keysword = $this->input->get_or_post('keysword',TRUE);
		if($keysword!='')
		{
			$keylike_on[] = array( 'title'=> $keysword );
			$keylike_on[] = array( 'note'=> $keysword );
			$keylike_on[] = array( 'user'=> $keysword );
			$this->db->like_on($keylike_on);
		}

		//获取分类
		$type_id = $this->input->getnum('type_id');
		if( $type_id )
		{
			$this->db->where('type_id',$type_id);
		}
		
		$this->data['keysword'] = $keysword;
		$this->data['type_id'] = $type_id;

		$this->db->from('accounts');
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->data["accounts_list"] = $this->paging->show( $listsql ,15);

		//输出到视窗
		$this->load->view('accounts/manage',$this->data);
	
	}
	
	
	function go2url($id='')
	{
		if( is_num($id) )
		{
			//累计次数
			$this->db->set('visited','visited+1',false);
			$this->db->where('id',$id);
			$this->db->update('accounts');
			//跳转链接
			$this->db->select('loginUrl');
			$this->db->from('accounts');
			$this->db->where('id',$id);
			$rs = $this->db->get()->row();
			if(!empty($rs))
			{
				$loginUrl = $rs->loginUrl;
				if(!empty($loginUrl))
				{
					redirect($loginUrl, 'refresh');exit;
				}
			}
		}
	}

	
	function edit($id='')
	{
		$this->load->library('Kindeditor');
		
		/*表单配置*/
		$this->data['formTO']->url = 'index/save';
		$this->data['formTO']->backurl = '';
		
		if( is_num($id) )
		{
			//编辑
			$this->data['action_name'] = '编辑';
			$view = $this->Accounts_Model->view( $id );
			if(!empty($view))
			{
				$rs_data = $this->data['rs_data'];
				foreach( $rs_data as $item => $val )
				{
					$this->data['rs_data'][$item] = $view->$item;
				}	
			}
		}
		else
		{
			//添加
			$this->data['action_name'] = '添加';
		}
		//输出到视窗
		$this->load->view('accounts/edit',$this->data);
	}
	
	
	function save()
	{
		$rs_data = $this->data['rs_data'];
		foreach( $rs_data as $item => $val )
		{
			$this->data['rs_data'][$item] = $this->input->post($item);
		}
		
		$id = $this->data['rs_data']['id'];
		$title = $this->data['rs_data']['title'];
		$user = $this->data['rs_data']['user'];
		$pass = $this->data['rs_data']['pass'];
		if($title=='')
		{
			json_form_no('请先填写站点名称!');
		}
		elseif($user=='')
		{
			json_form_no('请先填登录帐号!');
		}
		elseif($pass=='')
		{
			json_form_no('请先填登录密码!');
		}

		if( is_num($id))
		{
			$this->db->where('id',$id );
			$this->db->update('accounts',$this->data['rs_data']);
			json_form_yes('更新成功!');
		}
		else
		{
			$this->db->insert('accounts',$this->data['rs_data']);
			json_form_yes('录入成功!');
		}
		
	}


	//分类页面
	function type()
	{
		//普通删除、数据处理
		$del_id = $this->input->getnum('del_id');
		if($del_id)
		{
			$this->Accounts_Model->del_type($del_id);
			//重新获取分类
			$this->data['rs_type'] = $this->Accounts_Model->get_types();
		}

		//(post)处理大类排序问题
		$go = $this->input->post('go');
		if($go=='yes')
		{
			$cmd = $this->input->post('cmd');
			$type_id = $this->input->postnum('type_id');
			
			if($cmd=='')
			{
				json_form_no('未知操作!');
			}
			elseif($type_id==false)
			{
				json_form_no('参数丢失,本次操作无效!');
			}
			
			$row = $this->Accounts_Model->get_type($type_id);
			if(!empty($row))
			{
				$keys = array(
					  'table' => 'accounts_type',
					  'key'  => 't_id',
					  'okey' => 't_order_id',
					  'id'   => $row->t_id,
					  'oid'  => $row->t_order_id,
					  'type' => $cmd
					  );
				List_Re_Order($keys);
				}	
		}
		
		
		
		//表单配置
		$this->data['formTO']->url = 'index/type';
		$this->data['formTO']->backurl = '';
		
		//输出界面效果
		$this->load->view('accounts/type_manage',$this->data);
	}
	
	function type_edit()
	{
		//接收Url参数
		$id = $this->input->getnum('id');
		
		//初始化数据
		$this->data['t_id'] = $id;
		$this->data['t_title'] = '';
		$this->data['t_loginbox'] = '';
		$this->data['t_order_id'] = 0;

		if($id==false)
		{
			$this->data['action_name'] = "添加";
		}
		else
		{
			$this->data['action_name'] = "编辑";
			$rs = $this->Accounts_Model->get_type($id);
			if(!empty($rs))
			{
				$this->data['t_title'] = $rs->t_title;
				$this->data['t_loginbox'] = $rs->t_loginbox;
				$this->data['t_order_id'] = $rs->t_order_id;
			}
		}
		
		//表单配置
		$this->data['formTO']->url = 'index/type_save';
		$this->data['formTO']->backurl = 'index/type';
		
		$this->load->view('accounts/type_edit',$this->data);
	}
	
	
	//保存分类
	function type_save()
	{
		//接收提交来的数据
		$id = $this->input->postnum('t_id');
		$t_title = noSql($this->input->post('t_title'));
		$t_loginbox = noSql($this->input->post('t_loginbox'));
		$t_order_id = $this->input->postnum('t_order_id');

		//验证数据
		if($t_title=='')
		{
			json_form_no('请填写标题!');
		}
		elseif($t_order_id==false)
		{
			json_form_no('请在排序处填写正整数!');
		}
		
		//写入数据
		$data['t_title'] = $t_title;
		$data['t_loginbox'] = $t_loginbox;
		$data['t_order_id'] = $t_order_id;
		
		if($id==false)
		{
			//添加
			$this->db->insert('accounts_type',$data);
			//重洗分类排序
			$this->re_order_type();
			json_form_yes('添加成功!');
		}
		else
		{
			//修改
			$this->db->where('t_id',$id);
			$this->db->update('accounts_type',$data);
			//重洗分类排序
			$this->re_order_type();
			json_form_yes('修改成功!');
		}	
	}

	//重洗分类排序
	function re_order_type()
	{
		$re_row = $this->Accounts_Model->get_types();
		if(!empty($re_row))
		{
			$re_num = $this->Accounts_Model->get_types_num();
			foreach($re_row as $re_rs)
			{
				$data['t_order_id'] = $re_num;
				$this->db->where('t_id',$re_rs->t_id);
				$this->db->update('accounts_type',$data);
				$re_num--;
			}
		}
	}


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */