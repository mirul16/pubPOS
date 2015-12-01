<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		ini_set("max_execution_time",300);
		error_reporting(0);
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
		$data["category"] = $this->m_master->getAllData("master_category");
		$data["unit"] = $this->m_master->getAllData("master_unit");
		$this->template->set('title','Product');
		$this->template->load('template_content','master/product',$data);
	}
	
	function jsonProduct() {
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
		$count = $this->db->count_all_results("master_product");

		if($count > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}

		if ($page > $total_pages)$page=$total_pages;
		
		$data = $this->m_master->getDataJoin1("master_product P",
			"master_category C",
			"P.category_id","C.category_id",
			$where,$sidx,$sord,$start,$limit
		)->result();
		
		$i=0;
		foreach($data as $line) {
			$edit="<a href='#' class='editProduct' 
						productid='".$line->product_id."' 
						productname='".$line->product_name."' 
						productcat='".$line->category_id."'  
						productbrand='".$line->product_brand."' 
						productvendor='".$line->vendor_id."' 
						productstat='".$line->product_status."'
					><span class='ui-icon ui-icon-pencil'></span></a>";
			$responce->rows[$i]['id'] = $line->product_id;
			$responce->rows[$i]['cell'] = array(
				$edit,
				$line->product_id,
				$line->product_name,
				$line->category_name,
				$line->product_brand,
				$line->product_status
			);
			$i++;
		}
		
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		
		echo json_encode($responce);
	}
	
	function crudProduct() {
		$data['product_name'] = strtoupper($this->input->post('productname'));
		$data['category_id'] = strtoupper($this->input->post('productcat'));
		$data['product_brand'] = strtoupper($this->input->post('productbrand'));
		$data['product_status'] = strtoupper($this->input->post('productstat'));
		
		$oper=$this->input->post('oper');
		switch ($oper) {
	        case 'add':
				$data['product_id'] = $this->m_master->ProductID();
				$this->m_master->insertData('master_product',$data);
				break;
	        case 'edit':
				$d['product_id'] = $this->input->post('productid');
				$this->m_master->updateData('master_product',$d,$data);
	            break;
	        case 'del':
				$d['product_id'] = $this->input->post('id');
				$this->m_master->deleteData('master_product',$d);
	        break;
		}
	}
	
	function jsonProductD() {
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
		$count = $this->db->count_all_results("master_product_detail");

		if($count > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}

		if ($page > $total_pages)$page=$total_pages;
		
		$whereid = " WHERE product_id='".$this->uri->segment(4)."'";
		$data = $this->m_master->getProductD("master_product_detail Pd",
			"master_unit U","master_account A","master_currency C",
			"Pd.unit_id","U.unit_id","Pd.vendor_id","A.account_id","Pd.currency_id","C.currency_id",
			$where,$whereid,$sidx,$sord,$start,$limit
		)->result();
		
		$i=0;
		foreach($data as $line) {
			$edit="<a href='#' class='editProductD' 
						productdsku='".$line->sku."' 
						productdid='".$line->product_id."' 
						productdbcode='".$line->barcode."' 
						productdvar='".$line->product_detail_name."' 
						productdfla='".$line->typep."' 
						productdstock='".$line->unit_stock."' 
						productdunit='".$line->unit_id."' 
						productdqstock='".$line->unit_qty."' 
						productcurrnm='".$line->symbol."' 
						productcurr='".$line->currency_id."' 
						productdbuy='".$line->price_buy."' 
						productdwhole='".$line->price_wholesale."' 
						productdretail='".$line->price_retail."' 
						productdorder='".$line->unit_order."' 
						productdrorder='".$line->unit_reorder."' 
						productvendornm='".$line->account_name."' 
						productvendor='".$line->vendor_id."' 
					><span class='ui-icon ui-icon-pencil'></span></a>";
			$responce->rows[$i]['id'] = $line->sku;
			$responce->rows[$i]['cell'] = array(
				$edit,
				$line->sku,
				$line->barcode,
				$line->product_detail_name,
				$line->typep,
				$line->unit_stock,
				$line->unit_name,
				$line->unit_qty,
				$line->symbol,
				$line->price_buy,
				$line->price_wholesale,
				$line->price_retail,
				$line->unit_order,
				$line->unit_reorder,
				$line->account_name
			);
			$i++;
		}
		
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		
		echo json_encode($responce);
	}
	
	function crudProductD() {
		$data['product_id'] = strtoupper($this->input->post('productdid'));
		$data['barcode'] = strtoupper($this->input->post('productdbcode'));
		$data['product_detail_name'] = strtoupper($this->input->post('productdvar'));
		$data['typep'] = strtoupper($this->input->post('productdfla'));
		$data['unit_stock'] = $this->input->post('productdstock');
		$data['unit_id'] = $this->input->post('productdunit');
		$data['unit_qty'] = $this->input->post('productdqstock');
		$data['currency_id'] = strtoupper($this->input->post('productcurr'));
		$data['price_buy'] = $this->input->post('productdbuy');
		$data['price_wholesale'] = $this->input->post('productdwhole');
		$data['price_retail'] = $this->input->post('productdretail');
		$data['unit_order'] = $this->input->post('productdorder');
		$data['unit_reorder'] = $this->input->post('productdrorder');
		$data['vendor_id'] = strtoupper($this->input->post('productvendor'));
		
		$oper=$this->input->post('oper');
		switch ($oper) {
	        case 'add':
				$data['sku'] = strtoupper($this->input->post('productdsku'));
				$this->m_master->insertData('master_product_detail',$data);
				break;
	        case 'edit':
				$d['sku'] = strtoupper($this->input->post('productdsku'));
				$this->m_master->updateData('master_product_detail',$d,$data);
	            break;
	        case 'del':
				$d['sku'] = $this->input->post('id');
				$this->m_master->deleteData('master_product_detail',$d);
	        break;
		}
	}
}