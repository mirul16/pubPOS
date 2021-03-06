<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends CI_Controller {
	
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
		$this->template->set('title','Country');
		$this->template->load('template_content','master/country');
	}
	
	function jsonCountry() {
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
		$count = $this->db->count_all_results("master_country");

		if($count > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}

		if ($page > $total_pages)$page=$total_pages;
		
		$data = $this->m_master->getData("master_country",$where,$sidx,$sord,$start,$limit)->result();
		
		$i=0;
		foreach($data as $line) {
			$edit="<a href='#' class='editCountry' 
						countryid='".$line->country_id."' 
						countryname='".$line->country_name."' 
					><span class='ui-icon ui-icon-pencil'></span></a>";
			$responce->rows[$i]['id'] = $line->country_id;
			$responce->rows[$i]['cell'] = array(
				$edit,
				$line->country_id,
				$line->country_name
			);
			$i++;
		}
		
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		
		echo json_encode($responce);
	}
	
	function crudCountry() {
		$data['country_name'] = strtoupper($this->input->post('countryname'));
		
		$oper=$this->input->post('oper');
		switch ($oper) {
	        case 'add':			
				$data['country_id'] = $this->m_master->CountryID();
				$this->m_master->insertData('master_country',$data);
				break;
	        case 'edit':		
				$d['country_id'] = $this->input->post('countryid');
				$this->m_master->updateData('master_country',$d,$data);
	            break;
	        case 'del':
				$d['country_id'] = $this->input->post('id');
				$this->m_master->deleteData('master_country',$d);
	        break;
		}
	}
}