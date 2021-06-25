<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cdo_mdl extends CI_Model{

	/// TABLE NAME:
	var $tableName = 'tbl_cdo';
	/// for datatable orderable:
	var $columnOrder = [null,'Type','Datetime_frm','Datetime_to','Reason','Note']; 
	/// for datatable searchable:
    var $columnSearch = ['Type','Datetime_frm','Datetime_to','Reason','Note']; 
    /// default order type:
	var $order = array('uid' => 'desc');
	
	function __construct(){
		parent ::__construct();
	}

	private function _getDatatablesQuery($where = null)
    {
    	$table = $this->tableName;
    	($where) ? $this->db->where($where) : null;
        $this->db->from($table);
 
        $i = 0;
     
        foreach ($this->columnSearch as $item)
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->columnSearch) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->columnOrder[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function getDatatables($where = null)
    {
        $this->_getDatatablesQuery($where);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function countDatatables()
	{
		$this->_getDatatablesQuery();
		$query = $this->db->get();
		return $query->num_rows();
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

	function insert($data){
		$table = $this->tableName;
		$this->db->insert($table, $data);
	}

	function update($id, $data){
		$table = $this->tableName;
		$this->db->where('uid', $id);
		$this->db->update($table, $data);
	}

	function delete($id){
		$table = $this->tableName;
		$this->db->where('uid', $id);
		$this->db->delete($table);
	}

	function get_table(){
		$table = "tbl_cdo";
		return $table;
	}

	function getRecord($whereArray = Null, $order_by){
		$table = $this->get_table();
		if(!empty($whereArray)){
			$this->db->where($whereArray);
		}
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
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

	function get_where_custom($col, $value, $sortBy){
		$table = $this->get_table();
		$this->db->where($col, $value);
		$this->db->order_by($sortBy);
		$query = $this->db->get($table);
		return $query;
	}

	// $where = array('name' => $name, 'title' => $title, 'status' => $status);
	function _get_where_multi($where){
		$table = $this->get_table();
		$this->db->where($where);
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

	function _insert($data){
		$table = $this->get_table();
		$this->db->insert($table, $data);
	}

	function _update($id, $data){
		$table = $this->get_table();
		$this->db->where('uid', $id);
		$this->db->update($table, $data);
	}

	function _delete($id){
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

	function get_max($field_name){
		$table = $this->get_table();
		$this->db->select_max($field_name);
		$query = $this->db->get($table);
		$row = $query->row();
		$dt_field_name = $row->$field_name;
		return $dt_field_name;
	}

	function _custom_query($mysql_query){
		$query = $this->db->query($mysql_query);
		return $query;
	}

	function procedure_fill_calendar($start, $end){
		$stored_procedure = "CALL fill_calendar(?,?)";
		$query = $this->db->query($stored_procedure, array("str_date" => $start, "end_date" => $end));
		return $query;
	}

	function get_results_like($field, $search, $order_by){
		$table = $this->get_table();
		$this->db->like($field, $search);
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}	

	function my_func($time, $your_date) {
		if ($time == 'today') {
		    $timeSQL = ' Date($your_date)= CURDATE()';
		}
		if ($time == 'week') {
		    $timeSQL = ' YEARWEEK($your_date)= YEARWEEK(CURDATE())';
		}
		if ($time == 'month') {
		    $timeSQL = ' Year($your_date)=Year(CURDATE()) AND Month(`your_date`)= Month(CURDATE())';
		}

		$Sql = "SELECT * FROM  your_table WHERE ".$timeSQL;
		return $Result = $this->db->query($Sql)->result_array();
	}

}
