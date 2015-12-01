<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_currency_search extends CI_Controller {
	
	function __construct() {
        parent::__construct();
    }
	
	function index() {
		$sesi = $this->session->userdata('iSysLog');
		
		if(empty($sesi)) {
			header('location:'.site_url().'/login');
		} else {
			$d['data'] = $this->m_search->getAllData('master_currency');
			$this->template->set('title','Currency List');
			$this->template->load('template_search','search/product_currency_search',$d);
		}
	}
}