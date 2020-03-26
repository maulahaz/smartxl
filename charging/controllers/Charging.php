<?php

class Charging extends MX_Controller {
	function __construct(){
		parent ::__construct();
	}

	function index(){
		redirect('charging/manage');
		
	}

	function manage(){
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$this->load->module('halaman');

		$data['header'] = "Additive Charging Records";

		// $limit = $this->get_limit(); //per page
		$limit = 5;
		$offset = $this->get_offset();

		// Pagination_data must contain:
		// $target_url, $tot_rows, $offset_segment, $limit
		$pagination_data['target_url'] = base_url() . "charging/manage/";
		$pagination_data['tot_rows'] = $this->count_all();
		$pagination_data['offset_segment'] = 3;
		$pagination_data['limit'] = $limit;

		// $data['halamanku'] = $this->halaman->_bikin_halaman('public_bootstrap');
		// $data['halamanku'] = $this->halaman->my_pagination($pagination_data);
		$data['halamanku'] = make_pagination($pagination_data);
		// $data['data_det'] = $this->get('uid DESC'); 
		$data['data_det'] = $this->get_with_limit($limit, $offset, 'uid DESC');
		$data['page'] = $offset;
		$data['view_module'] = "charging";
		$data['view_file'] = "manage";
		echo Modules::run('templates/blank_top_menu', $data);
	}

	function add(){
		$this->load->module('site_security');
		// $this->site_security->_make_sure_logged_in();

		$data['header'] = "Add New Data";

		$data['view_module'] = "charging";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->blank_top_menu($data);
		// $this->templates->blank($data);
	}

	function create(){
		// echo "string";die();
		$this->load->library('session');
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();
		// $this->site_security->_make_sure_is_admin();

		$this->load->module('mydatetime'); 

		$update_id = $this->uri->segment(3);
		// echo "update id ".$update_id;die();
		$submit = $this->input->post('submit', TRUE);

		if($submit == "Submit"){
			// proces the form.
			//- Validation input first
			// $this->load->library('form_validation');-- Already loaded in Autoload
			$this->form_validation->set_rules('charging_dt','Charge Date','required');
			$this->form_validation->set_rules('material','Material','required');
			$this->form_validation->set_rules('qty','Quantity','required|numeric');
			$this->form_validation->set_rules('uom','Unit of Material','required');
			$this->form_validation->set_rules('lotnum','Material lotnum','required');
			$this->form_validation->set_rules('charge_to','Material Charged to','required');
			$this->form_validation->set_rules('charge_by','Charged By','required');
			// $this->form_validation->set_error_delimiters('<div class="error" style="color: blue; font-weight: bold;font-size: 15px;">','</div>');

			if($this->form_validation->run() == TRUE){
				//- get the vaiables.
				$data = $this->fetch_data_from_post();

				// Data di post dari DATEPICKER trus di rubah ke bentuk MYSQL date format
				$data['charging_dt'] = $this->mydatetime->my_timestamp_from_datepicker($data['charging_dt']);
				// echo $data['charging_dt'];
				// die();


				if(is_numeric($update_id)){
					//- update data
					$this->_update($update_id, $data);
					$flash_msg = "Update success";
					$value= '<div class="alert alert-success text-center" style="margin-top:20px; font-weight: bold;font-size: 15px;" role="alert">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('charging/create/'.$update_id);
				}else{
					//- insert data
					$this->_insert($data);
					$update_id = $this->get_max();		
					$flash_msg = "New data created";
					// $value= '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
					$value= '<div class="alert alert-success text-center" style="margin-top:20px; font-weight: bold;font-size: 15px;" role="alert">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('charging/create/'.$update_id);
				}
			}
			
		}

		if($submit == "Cancel"){
			redirect('charging/manage');
		}

		if((is_numeric($update_id)) && ($submit != 'Submit')){
			$data = $this->fetch_data_from_db($update_id);
		}else{
			$data = $this->fetch_data_from_post();
		}

		if(!is_numeric($update_id)){
			$data['headline'] = "Add new data";
		}else{
			$data['headline'] = "Update data details";
		}

		if($data['charging_dt'] != 0){
			$data['charging_dt'] = $this->mydatetime->get_nice_date_str($data['charging_dt'],'mydate');
		}	


		// if($data['charging_dt'] > 0){
		// 	$data['charging_dt'] = $this->mydatetime->get_nice_date($data['charging_dt'],'datepicker_us');
		// 	// print_r($data['charging_dt']);die();
		// } 

		//*Data untuk cbobox Employee
		$this->load->module('accounts'); 
		$mysql_query = "SELECT usr_ID FROM `tbl_user` WHERE usr_Status =1";
		$data['employee'] = $this->accounts->_custom_query($mysql_query);

		$data['update_id'] = $update_id;
		$data['flash'] = $this->session->flashdata('item');

		$data['view_module'] = "charging";
		$data['view_file'] = "create";
		$this->load->module('templates');

		$this->templates->blank_top_menu($data);
		// $this->templates->blank($data);
	}	

	function fetch_data_from_post(){
		$data['charging_dt'] = $this->input->post('charging_dt', TRUE);
		$data['material'] = $this->input->post('material', TRUE);
		$data['qty'] = $this->input->post('qty', TRUE);
		$data['uom'] = $this->input->post('uom', TRUE);
		$data['lotnum'] = $this->input->post('lotnum', TRUE);
		$data['charge_to'] = $this->input->post('charge_to', TRUE);
		$data['level_b4'] = $this->input->post('level_b4', TRUE);
		$data['charge_by'] = $this->input->post('charge_by', TRUE);
		$data['notes'] = $this->input->post('notes', TRUE);
		return $data;
	}

	function fetch_data_from_db($update_id){
		$qry = $this->get_where($update_id);
		foreach ($qry->result() as $row) {
			$data['charging_dt'] = $row->charge_date;
			$data['material'] = $row->material;
			$data['qty'] = $row->qty;
			$data['uom'] = $row->uom;
			$data['lotnum'] = $row->lotnum;
			$data['charge_to'] = $row->charge_to;
			$data['level_b4'] = $row->level_b4;
			$data['charge_by'] = $row->charge_by;
			$data['notes'] = $row->notes;
		}
		if(!isset($data)){
			$data = "";
		}
		return $data;
	}

	function delconf($update_id){
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}

		$this->load->library('session');

		$data['headline'] = "Delete Confirmation";
        $data['update_id'] = $update_id;
		$data['flash'] = $this->session->flashdata('item');

		$data['view_module'] = "charging";
		$data['view_file'] = "delconf";
		$this->load->module('templates');
		$this->templates->blank($data); 
	}

	function delete_item($update_id){
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();
		
		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}

		$this->load->library('session');

		$submit = $this->input->post('submit', TRUE);
		if($submit == 'Cancel'){
			// redirect('charging/create/'.$update_id);
			redirect('charging/manage');
		}elseif ($submit == 'Delete') {
			$data = $this->fetch_data_from_db($update_id);
			$this->_delete($update_id);

			$flash_msg = "Data successfully deleted";
			$value= '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
			$this->session->set_flashdata('item', $value);

			redirect('charging/manage');
		}
	}	

	function show(){
		$update_id = $this->uri->segment(3);

		if(!is_numeric($update_id)){
			$data['headline'] = "Add new item";
		}else{
			$data['headline'] = "Update item";
		}
		
		$data['view_module'] = "store_items";
		$data['view_file'] = "create";
		echo Modules::run('templates/admin', $data);
	}

	function get_target_pagination_base_url(){
		$first_bit = $this->uri->segment(1);
		$second_bit = $this->uri->segment(2);
		$third_bit = $this->uri->segment(3);
		$target_base_url = base_url().$first_bit."/".$second_bit."/".$third_bit; 
		return $target_base_url;
	}

	function get_limit(){
		$limit = 10;
		return $limit;
	}

	function get_offset(){
		$offset = $this->uri->segment(3);
		if(!is_numeric($offset)){
			$offset = 0;
		}
		return $offset;
	}

	function get($order_by){
		$this->load->model('charging_mdl');
		$query = $this->charging_mdl->get($order_by);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by){
		$this->load->model('charging_mdl');
		$query = $this->charging_mdl->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	function get_where($id){
		$this->load->model('charging_mdl');
		$query = $this->charging_mdl->get_where($id);
		return $query;
	}

	function get_where_custom($col, $value){
		$this->load->model('charging_mdl');
		$query = $this->charging_mdl->get_where_custom($col, $value);
		return $query;
	}

	function get_with_double_condition($col1, $value1, $col2, $value2){
		$this->load->model('charging_mdl');
		$query = $this->charging_mdl->get_with_double_condition($col1, $value1, $col2, $value2);
		return $query;
	}

	function _insert($data){
		$this->load->model('charging_mdl');
		$this->charging_mdl->_insert($data);
	}

	function _update($id, $data){
		$this->load->model('charging_mdl');
		$this->charging_mdl->_update($id, $data);
	}

	function _delete($id){
		$this->load->model('charging_mdl');
		$this->charging_mdl->_delete($id);
	}

	function count_all(){
		$this->load->model('charging_mdl');
		$count = $this->charging_mdl->count_all();
		return $count;
	}

	function count_where($column, $value){
		$this->load->model('charging_mdl');
		$count = $this->charging_mdl->count_where($column, $value);
		return $count;
	}

	function get_max(){
		$this->load->model('charging_mdl');
		$max_id = $this->charging_mdl->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query){
		$this->load->model('charging_mdl');
		$query = $this->charging_mdl->_custom_query($mysql_query);
		return $query;
	}

	function emp_get_table(){
		$table = "tbl_user";
		return $table;
	}

	function emp_get_them(){
		$this->load->module('webpages');
		$query = $this->webpages->get_where_custom('page_url', $first_bit);
		$num_rows = $query->num_rows();
		echo $num_rows;

        $mysql = 'SELECT description FROM location';
        $query = $this->get_where_custom($col, $value);

        foreach ($query->result() as $row)
        {
            echo $row->description;
        }

        //echo 'Total Results: ' . $query->num_rows();
    }	
}