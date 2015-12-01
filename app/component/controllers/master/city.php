<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City extends CI_Controller {
	
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
		$data["country"] = $this->m_master->getAllData("master_country");
		$this->template->set('title','City');
		$this->template->load('template_content','master/city',$data);
	}
	
	function jsonCity() {
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
		$count = $this->db->count_all_results("master_city");

		if($count > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}

		if ($page > $total_pages)$page=$total_pages;
		
		$data = $this->m_master->getDataJoin1("master_city Ci",
			"master_country Co",
			"Ci.country_id","Co.country_id",
			$where,$sidx,$sord,$start,$limit
		)->result();
		
		$i=0;
		foreach($data as $line) {
			$edit="<a href='#' class='editCity' 
						cityid='".$line->city_id."' 
						cityname='".$line->city_name."'
						citycode='".$line->city_code."'
						citycountry='".$line->country_id."' 
					><span class='ui-icon ui-icon-pencil'></span></a>";
			$responce->rows[$i]['id'] = $line->city_id;
			$responce->rows[$i]['cell'] = array(
				$edit,
				$line->city_id,
				$line->city_name,
				$line->city_code,
				$line->country_name
			);
			$i++;
		}
		
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		
		echo json_encode($responce);
	}
	
	function crudCity() {
		$data['city_name'] = strtoupper($this->input->post('cityname'));
		$data['city_code'] = strtoupper($this->input->post('citycode'));
		$data['country_id'] = $this->input->post('citycountry');
		
		$oper=$this->input->post('oper');
		switch ($oper) {
	        case 'add':			
				$data['city_id'] = $this->m_master->CityID();
				$this->m_master->insertData('master_city',$data);
				break;
	        case 'edit':		
				$d['city_id'] = $this->input->post('cityid');
				$this->m_master->updateData('master_city',$d,$data);
	            break;
	        case 'del':
				$d['city_id'] = $this->input->post('id');
				$this->m_master->deleteData('master_city',$d);
	        break;
		}
	}
}