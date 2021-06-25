<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugmasters_mdl extends CI_Model{
	
	/// TABLE NAME:
	var $tableName = 'tbl_tugmasters';

	function __construct()
	{
		parent ::__construct(); 
	}

	function _getDatatablesQuery()
    {
    	$columnOrder = array('tm.sn', 'tm.Request_dtm', 'tm.Request_by', 'td.Bay_no', 'td.Container_no',NULL); 
	    $columnSearch = array('tm.sn', 'tm.Request_dtm', 'tm.Request_by', 'td.Bay_no', 'td.Container_no');
	    $order = array('tm.sn' => 'desc'); 

    	$this->db->select('*');
        $this->db->from('tbl_tugmasters as tm');
        $this->db->join('tbl_tugmasters_det td', 'td.Req_id = tm.Req_id','left');
        $this->db->order_by('tm.sn', 'desc');
 
        $i = 0;
     
        foreach ($columnSearch as $item)
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
 
                if(count($columnSearch) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing

        {
            $this->db->order_by($columnOrder[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
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

	function insert($data)
	{
		$table = $this->tableName;
		$this->db->insert($table, $data);
	}

	function update($id, $data)
	{
		$table = $this->tableName;
		$this->db->where('uid', $id);
		$this->db->update($table, $data);
	}

	function delete($id)
	{
		$table = $this->tableName;
		$this->db->where('uid', $id);
		$this->db->delete($table);
	}

	function count_where($column, $value)
	{
		$table = $this->tableName;
		$this->db->where($column, $value);
		$query = $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function countData()
	{
		$table = $this->tableName;
		$query = $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;	
	}

	function getMax($fieldName)
	{
		$table = $this->tableName;
		$this->db->select_max($fieldName);
		$query = $this->db->get($table);
		$row = $query->row();
		$dt_fieldName = $row->$fieldName;
		return $dt_fieldName;
	}

	function _customQuery($mysqlQuery)
	{
		$query = $this->db->query($mysqlQuery);
		return $query;
	}
}
