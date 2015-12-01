<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fdefault extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$sesi = $this->session->userdata('iSysLog');
		
		if(empty($sesi)) {
			$this->load->view('login');
		} else {
			$this->template->set('title','Dashboard');
			$this->template->load('template_content','fdefault');
		}
	}
}

/* End of file fdefault.php */
/* Location: ./application/controllers/fdefault.php */