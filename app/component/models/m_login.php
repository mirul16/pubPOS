<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_login extends CI_Model {
	
	function __construct() {
        parent::__construct();
    }
	
	function getLoginData($usr,$pass) {
		$u = mysql_real_escape_string($usr);
		$p = mysql_real_escape_string($pass);
		return $this->db->get_where('users', array('username'=>$u,'password'=>md5($p)));
	}
}