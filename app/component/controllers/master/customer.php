<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function __construct() {
        parent::__construct();
    }
	
	function index() {
		$sesi = $this->session->userdata('iSysLog');
		
		if(empty($sesi)) {
			header('location:'.site_url().'/login');
		} else {
			$this->grid();
		}
	}
	
	function grid() {
		$data["city"] = $this->m_master->getAllData("master_city");
		$this->template->set('title','Customer');
		$this->template->load('template_content','master/customer',$data);
	}
	
	function jsonCust() {
		$page = isset($_POST['page'])?$_POST['page']:1;
		$limit = isset($_POST['rows'])?$_POST['rows']:10;
		$sidx = isset($_POST['sidx'])?$_POST['sidx']:'';
		$sord = isset($_POST['sord'])?$_POST['sord']:'';

		$start = $limit*$page-$limit;
		($start<0)?0:$start;

		$where = "";
		$searchField = isset($_POST['searchField'])?$_POST['searchField']:false;
		$searchOper = isset($_POST['searchOper'])?$_POST['searchOper']:false;
		$searchString = isset($_POST['searchString'])?$_POST['searchString']:false;

		if ($_POST['_search']=='true') {
			$ops = array(
				'eq'=>'=',
				'ne'=>'<>',
				'lt'=>'<',
				'le'=>'<=',
				'gt'=>'>',
				'ge'=>'>=',
				'bw'=>'LIKE',
				'bn'=>'NOT LIKE',
				'in'=>'LIKE',
				'ni'=>'NOT LIKE',
				'ew'=>'LIKE',
				'en'=>'NOT LIKE',
				'cn'=>'LIKE',
				'nc'=>'NOT LIKE'
			);

			foreach ($ops as $key=>$value){
				if ($searchOper==$key) {
					$ops = $value;
				}
			}
		
			if($searchOper=='eq' ) $searchString = $searchString;
			if($searchOper=='bw'||$searchOper=='bn') $searchString .= '%';
			if($searchOper=='ew'||$searchOper=='en') $searchString = '%'.$searchString;
			if($searchOper=='cn'||$searchOper=='nc'||$searchOper=='in'||$searchOper=='ni') $searchString = '%'.$searchString.'%';

			$where = "$searchField $ops '$searchString'";
		}

		if(!$sidx) $sidx =1;
		$count = $this->db->count_all_results("master_account");

		if($count > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}

		if ($page > $total_pages)$page=$total_pages;
		
		$whereid = " WHERE type='C'";
		$data = $this->m_master->getDataJoin2("master_account Ac",
			"master_city Ci",
			"Ac.city_id","Ci.city_id",
			$where,$whereid,$sidx,$sord,$start,$limit
		)->result();
		
		$i=0;
		foreach($data as $line) {
			$edit="<a href='#' class='editCust' 
						custid='".$line->account_id."' 
						custname='".$line->account_name."' 
						custaddr='".$line->address."' 
						custcity='".$line->city_id."' 
						custcitynm='".$line->city_name."' 
						custpic='".$line->pic."' 
						custmail='".$line->email."' 
						custph='".$line->phone."' 
						custfax='".$line->fax."' 
						custnote='".$line->notes."'
					><span class='ui-icon ui-icon-pencil'></span></a>";
			$responce->rows[$i]['id'] = $line->account_id;
			$responce->rows[$i]['cell'] = array(
				$edit,
				$line->account_id,
				$line->account_name,
				$line->address,
				$line->city_name,
				$line->pic,
				$line->email,
				$line->phone,
				$line->fax,
				$line->notes
			);
			$i++;
		}
		
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		
		echo json_encode($responce);
	}
	
	function crudCust() {
		$data['account_name'] = strtoupper($this->input->post('custname'));
		$data['address'] = strtoupper($this->input->post('custaddr'));
		$data['city_id'] = $this->input->post('custcity');
		$data['pic'] = strtoupper($this->input->post('custpic'));
		$data['email'] = $this->input->post('custmail');
		$data['phone'] = $this->input->post('custph');
		$data['fax'] = $this->input->post('custfax');
		$data['notes'] = strtoupper($this->input->post('custnote'));
		
		$oper=$this->input->post('oper');
		switch ($oper) {
	        case 'add':			
				$data['account_id'] = $this->m_master->customerID();
				$data['type'] = "C";
				$this->m_master->insertData('master_account',$data);
				break;
	        case 'edit':		
				$d['account_id'] = $this->input->post('custid');
				$this->m_master->updateData('master_account',$d,$data);
	            break;
	        case 'del':
				$d['account_id'] = $this->input->post('id');
				$this->m_master->deleteData('master_account',$d);
	        break;
		}
	}
}