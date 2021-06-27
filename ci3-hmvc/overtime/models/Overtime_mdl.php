<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overtime_mdl extends CI_Model{
	
	/// TABLE NAME:
	var $tableName = 'tbl_overtime';
	/// for datatable orderable:
	var $columnOrder = array(null, "ot_date_from", "ot_date_to", "ot_category","ot_reason",null); 
	/// for datatable searchable:
    var $columnSearch = array("ot_date_from", "ot_date_to", "ot_category","ot_reason");
    /// default order type:
    var $order = array('uid' => 'desc'); 

    ///SOURCE: mbahcoding.com, 
    //mix with Weblesson:
    //https://www.webslesson.info/2017/06/date-range-search-in-datatables-using-php-ajax.html

	function __construct(){
		parent ::__construct(); 
	  	// $this->order_column = array(null, "From", "To", null, null,null);
	  	$this->load->module('mydatetime');
	}

	private function _getDatatablesQuery()
    {
    	$table = $this->tableName;

    	/// CUSTOM FILTER HERE:
    	if(is_numeric($this->input->post('start_date'))  && is_numeric($this->input->post('end_date')))
		{
		 	// $this->db->where('ot_date_from >=', my_timestamp_from_datetimepicker($_POST["start_date"]));
		 	// $this->db->where('ot_date_from <=', my_timestamp_from_datetimepicker($_POST["end_date"]));
		 	$this->db->where('ot_date_from >=', $this->input->post('start_date'));
		 	$this->db->where('ot_date_from <=', $this->input->post('end_date'));
		}

		/// BASED ON Loggedin ID:
		$this->db->where('usr_ID', $this->session->userdata('user_id'));

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

    function getDatatables()
    {
        $this->_getDatatablesQuery();
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

	function get($order_by){
		$table = $this->tableName;
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by){
		$table = $this->tableName;
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}

	function search_byDate($date1, $date2){
		$table = $this->tableName;
		$this->db->where("ot_date_from >=", $date1);
		$this->db->where("ot_date_to <=", $date2);
		$this->db->order_by('ot_date_from', 'desc');
	 //    $this->db->where("DATE_FORMAT(date, '%d-%m-%Y') >= ","DATE_FORMAT('$date1', '%d-%m-%Y')");
		// $this->db->where("DATE_FORMAT(date, '%d-%m-%Y') <  ","DATE_FORMAT('$date2', '%d-%m-%Y') + INTERVAL 1 DAY");
	    $query = $this->db->get($table);
		return $query;
	}

	function _get_where($where){
		$table = $this->tableName;
		$this->db->where($where);
		$query = $this->db->get($table);
		return $query;
	}	

	function get_where($id){
		$table = $this->tableName;
		$this->db->where('uid', $id);
		$query = $this->db->get($table);
		return $query;
	}

	function get_where_custom($col, $value){
		$table = $this->tableName;
		$this->db->where($col, $value);
		$query = $this->db->get($table);
		return $query;
	}

	// $data = array('name' => $name, 'title' => $title, 'status' => $status);
	// $this->db->or_where($data); or
	// $this->db->where($data);
	function get_where_multiple(array $data){
		$table = $this->tableName;
		$this->db->where($data);
		$query = $this->db->get($table);
		return $query;
	}


	function get_with_double_condition($col1, $value1, $col2, $value2){
		$table = $this->tableName;
		$this->db->where($col1, $value1);
		$this->db->or_where($col2, $value2);
		$query = $this->db->get($table);
		return $query;
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

	function count_where($column, $value){
		$table = $this->tableName;
		$this->db->where($column, $value);
		$query = $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function count_all(){
		$table = $this->tableName;
		$query = $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;	
	}

	function get_max(){
		$table = $this->tableName;
		$this->db->select_max('uid');
		$query = $this->db->get($table);
		$row = $query->row();
		$id = $row->uid;
		return $id;
	}

	function _custom_query($mysql_query){
		$query = $this->db->query($mysql_query);
		return $query;
	}

}
