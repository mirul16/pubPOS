<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency extends CI_Controller {
	
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
		$this->template->set('title','Currency');
		$this->template->load('template_content','master/currency',$data);
	}
	
	function jsonCurrency() {
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
		$count = $this->db->count_all_results("master_currency");

		if($count > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}

		if ($page > $total_pages)$page=$total_pages;
		
		$data = $this->m_master->getDataJoin1("master_currency Cu",
			"master_country Co",
			"Co.country_id","Cu.country_id",
			$where,$sidx,$sord,$start,$limit
		)->result();
		
		$i=0;
		foreach($data as $line) {
			$edit="<a href='#' class='editCurrency' 
						currencyid='".$line->currency_id."' 
						currencycode='".$line->currency_code."'
						currencycountry='".$line->country_id."' 
						currencycountrynm='".$line->country_name."' 
						currencyrate='".$line->rate."' 
						currencysymbol='".$line->symbol."' 
					><span class='ui-icon ui-icon-pencil'></span></a>";
			$responce->rows[$i]['id'] = $line->currency_id;
			$responce->rows[$i]['cell'] = array(
				$edit,
				$line->currency_id,
				$line->currency_code,
				$line->country_name,
				$line->rate,
				$line->symbol
			);
			$i++;
		}
		
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		
		echo json_encode($responce);
	}
	
	function crudCurrency() {
		$data['currency_code'] = strtoupper($this->input->post('currencycode'));
		$data['country_id'] = $this->input->post('currencycountry');
		$data['rate'] = $this->input->post('currencyrate');
		$data['symbol'] = $this->input->post('currencysymbol');
		
		$oper=$this->input->post('oper');
		switch ($oper) {
	        case 'add':			
				$data['currency_id'] = $this->m_master->CurrencyID();
				$this->m_master->insertData('master_currency',$data);
				break;
	        case 'edit':		
				$d['currency_id'] = $this->input->post('currencyid');
				$this->m_master->updateData('master_currency',$d,$data);
	            break;
	        case 'del':
				$d['currency_id'] = $this->input->post('id');
				$this->m_master->deleteData('master_currency',$d);
	        break;
		}
	}
}