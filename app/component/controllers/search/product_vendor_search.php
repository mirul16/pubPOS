<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_vendor_search extends CI_Controller {
	
	function __construct() {
        parent::__construct();
    }
	
	function index() {
		$sesi = $this->session->userdata('iSysLog');
		
		if(empty($sesi)) {
			header('location:'.site_url().'/login');
		} else {
			$id["type"] = "V";
			$d['data'] = $this->m_search->getWhere('master_account',$id);
			$this->template->set('title','Vendor List');
			$this->template->load('template_search','search/product_vendor_search',$d);
		}
	}
}