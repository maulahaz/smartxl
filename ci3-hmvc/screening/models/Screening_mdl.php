<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Screening_mdl extends CI_Model{
	function __construct(){
		parent ::__construct();
	}

	function get_table(){
		$table = "tbl_screening";
		return $table;
	}

	function getAll($order_by = null){
		$table = $this->get_table();
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}

	function get_where($id){
		$table = $this->get_table();
		$this->db->where('uid', $id);
		$query = $this->db->get($table);
		return $query;
	}

	function get_where_custom($whereArray = Null, $order_by = Null){
		$table = $this->get_table();
		if(!empty($whereArray)){
			$this->db->where($whereArray);
		}
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by){
		$table = $this->get_table();
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}

	function count_all(){
		$table = $this->get_table();
		$query = $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;	
	}

	function _insert($data){
		$table = $this->get_table();
		$this->db->insert($table, $data);
	}

	function _insertTF($data){
		$table = $this->get_table();
		$sql = $this->db->insert($table, $data);
		if($sql == true){
			return true;
		}else{
			return false;
		}
	}

	function _update($id, $data){
		$table = $this->get_table();
		$this->db->where('uid', $id);
		$this->db->update($table, $data);
	}
 
	function _updateTF($id, $data){
		$table = $this->get_table();
		$this->db->where('uid', $id);
		$sql = $this->db->update($table, $data);
		if($sql == true){
			return true;
		}else{
			return false;
		}
	}

	function _delete($id){
		$table = $this->get_table();
		$this->db->where('uid', $id);
		$this->db->delete($table);
	}

	function _deleteTF($id){
		$table = $this->get_table();
		$this->db->where('uid', $id);
		$sql = $this->db->delete($table);
		if($sql == true){
			return true;
		}else{
			return false;
		}
	}	

	function _custom_query($mysql_query){
		$query = $this->db->query($mysql_query);
		return $query;
	}

	//Special:
	function count_screening_sched(){
		$this->db->select('
			scr_dt.Screen_dt as ScreeningDate,
			COUNT(scr_ls.Screen_dt) AS Registered
		');	
		$this->db->from('tbl_aux_screening scr_dt');
		$this->db->join('tbl_screening scr_ls', 'scr_ls.Screen_dt = scr_dt.Screen_dt', 'left');
		$this->db->group_by('scr_dt.Screen_dt');
		// $this->db->having('Sched  >', 5);
		$query = $this->db->get();
		return $query;
	}
}
