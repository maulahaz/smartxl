<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keyreg_mdl extends CI_Model{

	/// TABLE NAME:
	var $tableName = 'tbl_keyregs';
	
	function __construct(){
		parent ::__construct();
	}

	function getData($where = null, $orderBy = null){
		$table = $this->tableName;
		($where) ? $this->db->where($where) : null;
		($orderBy) ? $this->db->order_by($orderBy) : null;
		$query = $this->db->get($table);
		return $query;
	}

	function getLimitedData($where = null, $limit = null, $offset = null, $orderBy = null){
		$table = $this->tableName;
		($where) ? $this->db->where($where) : null;
		$this->db->limit($limit, $offset);
		($orderBy) ? $this->db->order_by($orderBy) : null;
		$query = $this->db->get($table);
		return $query;
	}	

	function totalRows($where = null)
	{
		$table = $this->tableName;
		if($where){
			$this->db->where($where);
		}
		return $this->db->count_all_results($table);	
	}

	function get_table(){
		$table = "tbl_keyregs";
		return $table;
	}

	function get($order_by){
		$table = $this->get_table();
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

	function get_where($id){
		$table = $this->get_table();
		$this->db->where('uid', $id);
		$query = $this->db->get($table);
		return $query;
	}

	function get_where_custom($col, $value){
		$table = $this->get_table();
		$this->db->where($col, $value);
		$query = $this->db->get($table);
		return $query;
	}

	function get_with_double_condition($col1, $value1, $col2, $value2){
		$table = $this->get_table();
		$this->db->where($col1, $value1);
		$this->db->or_where($col2, $value2);
		$query = $this->db->get($table);
		return $query;
	}

	function insert($data){
		$table = $this->get_table();
		$this->db->insert($table, $data);
	}

	function insertTF($data){
		$table = $this->get_table();
		$insert = $this->db->insert($table, $data);
		return $insert ? true : false;
	}

	function update($id, $data){
		$table = $this->get_table();
		$this->db->where('uid', $id);
		$this->db->update($table, $data);
	}

	function delete($id){
		$table = $this->get_table();
		$this->db->where('uid', $id);
		$this->db->delete($table);
	}

	function count_where($column, $value){
		$table = $this->get_table();
		$this->db->where($column, $value);
		$query = $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function count_all(){
		$table = $this->get_table();
		$query = $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;	
	}

	function get_max(){
		$table = $this->get_table();
		$this->db->select_max('uid');
		$query = $this->db->get($table);
		$row = $query->row();
		$id = $row->id;
		return $id;
	}

	function _custom_query($mysql_query){
		$query = $this->db->query($mysql_query);
		return $query;
	}

}
