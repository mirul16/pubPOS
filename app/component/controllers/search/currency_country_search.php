<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency_country_search extends CI_Controller {
	
	function __construct() {
        parent::__construct();
    }
	
	function index() {
		$sesi = $this->session->userdata('iSysLog');
		
		if(empty($sesi)) {
			header('location:'.site_url().'/login');
		} else {
			$d['data'] = $this->m_search->getAllData('master_country');
			$this->template->set('title','Country List');
			$this->template->load('template_search','search/currency_country_search',$d);
		}
	}
}