<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_search extends CI_Model {
	
	function __construct() {
        parent::__construct();
    }
	
	function getAllData($table) {
		return $this->db->get($table);
	}
	
	function getWhere($table,$id) {
		$this->db->where($id);
		return $this->db->get($table);
	}
	
	function getJoin($table,$join,$alias) {
		$this->db->from($table);
		$this->db->join($join,$table.$alias."=".$join.$alias);
		return $this->db->get();
	}
	
	function getDataJoin($table,$join1,$join2,$joinData1,$joinData2,$joinData3,$joinData4,$where) {
		return $this->db->query("SELECT * FROM ".$table.
			" INNER JOIN ".$join1.
			" ON ".$joinData1."=".$joinData2.
			" INNER JOIN ".$join2.
			" ON ".$joinData3."=".$joinData4.$where
		);
	}
}