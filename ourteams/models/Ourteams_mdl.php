<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ourteams_mdl extends CI_Model{
	function __construct(){
		parent ::__construct();
	}

	function get_table(){
		$table = "tbl_user";
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
		$this->db->where('id', $id);
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

	function search_by_categ($search_by, $search_text, $limit = null, $offset = null){
		$table = $this->get_table();
		$this->db->where('usr_Status', 1);
		$this->db->like($search_by, $search_text);
		$this->db->limit($limit, $offset);
		$this->db->order_by('usr_ID ASC');		
		$query = $this->db->get($table);
		return $query;
	}

	function search_by_text($search_text, $limit = null, $offset = null){
		$table = $this->get_table();
		
		$this->db->like('usr_ID', $search_text);
		$this->db->or_like('usr_Name', $search_text);
		$this->db->or_like('usr_Email', $search_text);
		$this->db->or_like('usr_Position', $search_text);
		$this->db->or_like('usr_Phone1', $search_text);
		$this->db->limit($limit, $offset);
		$this->db->order_by('usr_ID ASC');
		// $this->db->where("usr_Status = 1 AND 
  //       (usr_ID LIKE '%$search_text%' OR usr_Name LIKE '%$search_text%' 
  //       OR usr_Position LIKE '%$search_text%' OR usr_Phone1 LIKE '%$search_text%')");	
  //       $this->db->order_by('uid ASC');		
		$query = $this->db->get($table);
		// print_r($query);die();
		return $query;

	}

	function _insert($data){
		$table = $this->get_table();
		$this->db->insert($table, $data);
	}

	function _update($id, $data){
		$table = $this->get_table();
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}

	function _delete($id){
		$table = $this->get_table();
		$this->db->where('id', $id);
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
		$this->db->select_max('id');
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
