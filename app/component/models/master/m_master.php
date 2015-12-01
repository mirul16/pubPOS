<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_master extends CI_Model {
	
	function __construct() {
        parent::__construct();
    }
	
	function getAllData($table) {
		return $this->db->get($table);
	}
	
	function getData($table,$where,$sidx,$sord,$start,$limit) {
		if($where!=NULL){
			$where = " WHERE ".$where;
		};
	
		return $this->db->query("SELECT * FROM ".$table.$where." ORDER BY ".$sidx." ".$sord." LIMIT ".$start.",".$limit);
	}
	
	function getDataWhere($table,$where,$whereid,$sidx,$sord,$start,$limit) {
		if($where!=NULL){
			$where = " AND ".$where;
		};
	
		return $this->db->query("SELECT * FROM ".$table.$whereid.$where." ORDER BY ".$sidx." ".$sord." LIMIT ".$start.",".$limit);
	}
	
	function getDataJoin1($table,$join,$joinData1,$joinData2,$where,$sidx,$sord,$start,$limit) {
		if($where!=NULL){
			$where = " WHERE ".$where;
		};
	
		return $this->db->query("SELECT * FROM ".$table.
			" INNER JOIN ".$join.
			" ON ".$joinData1."=".$joinData2.$where.
			" ORDER BY ".$sidx." ".$sord.
			" LIMIT ".$start.",".$limit
		);
	}
	
	function getDataJoin2($table,$join,$joinData1,$joinData2,$where,$whereid,$sidx,$sord,$start,$limit) {
		if($where!=NULL){
			$where = " AND ".$where;
		};
	
		return $this->db->query("SELECT * FROM ".$table.
			" INNER JOIN ".$join.
			" ON ".$joinData1."=".$joinData2.$whereid.$where.
			" ORDER BY ".$sidx." ".$sord.
			" LIMIT ".$start.",".$limit
		);
	}
	
	function getDataJoin3($table,
		$join1,$join2,$join3,$join4,
		$joinData1,$joinData2,$joinData3,$joinData4,$joinData5,$joinData6,$joinData7,$joinData8,
		$where,$sidx,$sord,$start,$limit) {
		
		if($where!=NULL){
			$where = " AND ".$where;
		};
	
		return $this->db->query("SELECT Fin.item_fin_id,Fin.item_fin_name,Fin.item_id,I.item_name,Fin.parent_id,F.item_fin_name AS ifiname,
			Fin.fintype,Ft.item_fintype_name,Fin.currency_id,Cu.currency_code".
			
			" FROM ".$table.
			" INNER JOIN ".$join1.
			" ON ".$joinData1."=".$joinData2.
			" LEFT JOIN ".$join2.
			" ON ".$joinData3."=".$joinData4.
			" INNER JOIN ".$join3.
			" ON ".$joinData5."=".$joinData6.
			" LEFT JOIN ".$join4.
			" ON ".$joinData7."=".$joinData8.$where.
			" ORDER BY ".$sidx." ".$sord.
			" LIMIT ".$start.",".$limit
		);
	}
	
	function getLevel($parentid){
		$query = "SELECT * FROM master_item_fin WHERE item_fin_id='".$parentid."'";
		
		$data = $this->manualQuery($query);
		if($data->num_rows()>0) {
			foreach($data->result() as $t) {
				$result = $t->level;
			}
		} else {
			$result = 0;
		}
		return $result;
	}
	
	function getProductD($table,
		$join1,$join2,$join3,
		$joinData1,$joinData2,$joinData3,$joinData4,$joinData5,$joinData6,
		$where,$whereid,$sidx,$sord,$start,$limit) {
		
		if($where!=NULL){
			$where = " AND ".$where;
		};
	
		return $this->db->query("SELECT * FROM ".$table.
			" LEFT JOIN ".$join1.
			" ON ".$joinData1."=".$joinData2.
			" LEFT JOIN ".$join2.
			" ON ".$joinData3."=".$joinData4.
			" LEFT JOIN ".$join3.
			" ON ".$joinData5."=".$joinData6.$whereid.$where.
			" ORDER BY ".$sidx." ".$sord.
			" LIMIT ".$start.",".$limit
		);
	}
	
	function manualQuery($sql) {
		return $this->db->query($sql);
	}
	
	function insertData($table,$data) {
		return $this->db->insert($table,$data);
	}
	
	function updateData($table,$id,$data) {
		$this->db->set($data);
		$this->db->where($id);
		return $this->db->update($table);
	}
	
	function deleteData($table,$id) {
		$this->db->where($id);
		$this->db->delete($table); 
	}
	
	function customerID(){
		$var = "CUS";
		$query = "SELECT max(account_id) AS last FROM master_account WHERE type='C'";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi,3,4);
		$nextNoUrut = $lastNoUrut+1;
		$nextNoTransaksi = $var.sprintf('%04s',$nextNoUrut);
		
		return $nextNoTransaksi;
	}
	
	function vendorID(){
		$var = "VEN";
		$query = "SELECT max(account_id) AS last FROM master_account WHERE type='V'";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi,3,4);
		$nextNoUrut = $lastNoUrut+1;
		$nextNoTransaksi = $var.sprintf('%04s',$nextNoUrut);
		
		return $nextNoTransaksi;
	}
	
	function CityID(){
		$var = "A";
		$query = "SELECT max(city_id) AS last FROM master_city";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi,1,3);
		$nextNoUrut = $lastNoUrut+1;
		$nextNoTransaksi = $var.sprintf('%03s',$nextNoUrut);
		
		return $nextNoTransaksi;
	}
	
	function CurrencyID(){
		$var = "B";
		$query = "SELECT max(currency_id) AS last FROM master_currency";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi,1,2);
		$nextNoUrut = $lastNoUrut+1;
		$nextNoTransaksi = $var.sprintf('%02s',$nextNoUrut);
		
		return $nextNoTransaksi;
	}
	
	function ProductID(){
		$var = "P";
		$query = "SELECT max(product_id) AS last FROM master_product";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi,1,5);
		$nextNoUrut = $lastNoUrut+1;
		$nextNoTransaksi = $var.sprintf('%05s',$nextNoUrut);
		
		return $nextNoTransaksi;
	}
	
	function CountryID(){
		$var = "C";
		$query = "SELECT max(country_id) AS last FROM master_country";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi,1,3);
		$nextNoUrut = $lastNoUrut+1;
		$nextNoTransaksi = $var.sprintf('%03s',$nextNoUrut);
		
		return $nextNoTransaksi;
	}
	
	function StatID(){
		$var = "S";
		$query = "SELECT max(status_id) AS last FROM master_status";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi,1,2);
		$nextNoUrut = $lastNoUrut+1;
		$nextNoTransaksi = $var.sprintf('%02s',$nextNoUrut);
		
		return $nextNoTransaksi;
	}
	
	function UnitID(){
		$var = "U";
		$query = "SELECT max(unit_id) AS last FROM master_unit";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi,1,2);
		$nextNoUrut = $lastNoUrut+1;
		$nextNoTransaksi = $var.sprintf('%02s',$nextNoUrut);
		
		return $nextNoTransaksi;
	}
	
	function CategoryID(){
		$var = "D";
		$query = "SELECT max(category_id) AS last FROM master_category";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi,1,3);
		$nextNoUrut = $lastNoUrut+1;
		$nextNoTransaksi = $var.sprintf('%03s',$nextNoUrut);
		
		return $nextNoTransaksi;
	}
}