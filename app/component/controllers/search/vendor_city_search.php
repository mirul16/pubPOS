<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_city_search extends CI_Controller {
	
	function __construct() {
        parent::__construct();
    }
	
	function index() {
		$sesi = $this->session->userdata('iSysLog');
		
		if(empty($sesi)) {
			header('location:'.site_url().'/login');
		} else {
			$d['data'] = $this->m_search->getAllData('master_city');
			$this->template->set('title','City List');
			$this->template->load('template_search','search/vendor_city_search',$d);
		}
	}
}