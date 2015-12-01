<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$sesi = $this->session->userdata('iSysLog');
		
		if(empty($sesi)) {
			$this->load->view('login');
		} else {
			header('location:'.site_url().'/fdefault');
		}
	}
	
	function clog() {
		$this->form_validation->set_rules('username','Username','required|xss_clean|prep_for_form|encode_php_tags');
		$this->form_validation->set_rules('password','','required|xss_clean|prep_for_form|encode_php_tags');
		$this->form_validation->set_error_delimiters('<div class="alert alert-dismissable alert-warning">
														<a href="#" class="close" data-dismiss="alert">&times;</a>
														<center>','</center>
													  </div>');
		
		if($this->form_validation->run() == false) {
			$this->index();
		} else {
			$u = $this->input->post('username');
			$p = $this->input->post('password');

			$query = $this->m_login->getLoginData($u,$p);
			
			if(count($query->result()) > 0) {
				foreach($query->result() as $row) {
					$this->load->library('random_string');
					$rString = $this->random_string->random_str();
						
					$data['iSysLog'] = $rString;
					$data['iSysUser'] = $row->username;
					$data['iSysNm'] = $row->name;
					$this->session->set_userdata($data);
				}
				header('location:'.site_url().'/fdefault');
			} else {
				$this->session->set_flashdata('wlogin','<div class="alert alert-dismissable alert-warning">'.
												     	'<a href="#" class="close" data-dismiss="alert">&times;</a><center>Username or Password is wrong</center>'. 
													   '</div>');
				header('location:'.site_url().'/login');
			}
		}
	}
	
	function logout() {
		$sesi = $this->session->userdata('iSysLog');
		
		if(empty($sesi)) {
			$this->index();
		} else {
			$ses_param = array('iSysLog'=>'','iSysUser'=>'','iSysNm'=>'');
			$this->session->unset_userdata($ses_param);
			$this->index();
		}
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */