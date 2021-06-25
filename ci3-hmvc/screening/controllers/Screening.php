<?php

class Screening extends MX_Controller {
	function __construct(){
		parent ::__construct();	
		// $this->load->helper('security');
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

	function index() {  
	
		$data['page_title'] = "Screening";

		$data['view_module'] = "screening";
		$data['view_file'] = "manage";
		echo Modules::run('templates/admin', $data);
    }

    function manage(){
    	//Using Datatable
    	$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$this->load->module('mydatetime');
		$this->load->model('Screening_mdl');

		$qryDept = "SELECT * FROM tbl_aux_dept";
		$data['optDepartment'] = $this->Screening_mdl->_custom_query($qryDept);
		$data['count_screening_sched'] = $this->Screening_mdl->count_screening_sched();

		//viewing section:
		$data['page_title'] = "Screening Schedule";
		$data['view_module'] = "Screening";
		$data['view_file'] = "v_list_dt";
		// js for this page only
        $data['js_file'] = "js_screening";
    	$this->load->module('templates');
		$this->templates->blank_top_menu($data);
    }
    function fetch_datatable(){
    	$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$this->load->module('mydatetime');
		$this->load->model('Screening_mdl','mymodal');

		$result = array('data' => array());
		$sn = 0;
    	$data_table = $this->mymodal->getAll('uid DESC');
    	// echo "<pre>";
    	// print_r ($data_table);
    	// echo "</pre>";die();
    	foreach ($data_table->result() as $key => $value) {
    		$sn = $sn + 1;
    		//Utk Button:
    		$buttons = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-inline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Action
					</button>
					<div class="dropdown-menu">
						<a href="javascript:;" class="dropdown-item" onclick="edit('.$value->uid.')">Edit</a>
						<a href="javascript:;" class="dropdown-item" onclick="del('.$value->uid.')">Delete</a>
					</div>
				</div>
    		';
    		$result['data'][$key] = array(
    			$sn,
    			$value->Emp_id,
    			$value->Name,
    			$value->Phone,
    			$value->Emirate_id,
    			$this->mydatetime->get_nice_date($value->Screen_dt,'mydate'),
    			$value->Note,
    			$buttons
    		); 

    	}

    	echo json_encode($result);
    }

    function list(){
    	$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$this->load->module('mydatetime');
		$this->load->model('Screening_mdl');

		$qryDept = "SELECT * FROM tbl_aux_dept";
		$data['optDepartment'] = $this->Screening_mdl->_custom_query($qryDept);
		$data['count_screening_sched'] = $this->Screening_mdl->count_screening_sched();

		///Pagination:
		$limit = 7;
		$offset = $this->get_offset();
		// echo "<script>alert(".$offset.")</script>";
		$data['offset'] = $offset;
		//AllData for Page Pagination:
		$numRows = $this->Screening_mdl->count_all();
		$data['qryScreen'] = $this->Screening_mdl->get_with_limit($limit, $offset, 'uid DESC');

		$pagination_data['target_url'] = base_url('screening/list');
		$pagination_data['total_rows'] = $numRows;
		$pagination_data['offset_segment'] = 3;
		$pagination_data['limit'] = $limit;
		$data['halamanku'] = make_pagination($pagination_data);

		//viewing section:
		$data['page_title'] = "Screening Schedule";
		$data['view_module'] = "Screening";
		$data['view_file'] = "v_list";
		// js for this page only
        $data['js_file'] = "js_screening";
    	$this->load->module('templates');
		$this->templates->blank_top_menu($data);
    }

    function get_offset(){
		$offset = $this->uri->segment(3);
		if(!is_numeric($offset)){
			$offset = 0;
		}
		return $offset;
	}

    function ajax_edit($uid){
    	$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

    	$this->load->model('Screening_mdl');

		$data = $this->Screening_mdl->get_where($uid)->row();
		echo json_encode($data);
	}

	function ajax_delete($uid){
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$this->load->model('Screening_mdl');

		$execution = $this->Screening_mdl->_deleteTF($uid);
		if($execution == true){
			$ajax_validator['isSuccess'] = true;
			$ajax_validator['pesan'] = 'Data Successfully Deleted';
		}
		echo json_encode($ajax_validator);
	}

    function ajax_action_ext($action){
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$this->load->model('Screening_mdl');

		// $login_id = _get_user_id();

		$ajax_validator = array('isSuccess' => false, 'pesan' => array());	

		$this->form_validation->set_rules('inpName','Name','required|min_length[5]');
		$this->form_validation->set_rules('inpPhone','Phone','required');
		$this->form_validation->set_rules('inpEmirateID','Emirate ID','required');
		$this->form_validation->set_rules('optScrDate','Screening Date','required|callback_check_quota_date');

		$this->form_validation->set_error_delimiters('<div class="alert alert-warning text-danger" role="alert">','</div>');

		$xDate = $this->input->post('optScrDate', true);
		$postedData['Emp_id'] = $this->input->post('inpEmpID', true);
		$postedData['Name'] = $this->input->post('inpName', true);
		$postedData['Phone'] = $this->input->post('inpPhone', true);
		$postedData['Emirate_id'] = $this->input->post('inpEmirateID', true);
		$postedData['Screen_dt'] = $xDate;
		$postedData['Dept'] = $this->input->post('optDept', true);
		// $postedData['Note'] = $this->input->post('inpNote', true);
		$uid = $this->input->post('inpUID', true);

		if($action == 'create'){
			$this->form_validation->set_rules('inpEmpID','Employee ID','required|callback_check_emp_id');

			if($this->form_validation->run() == TRUE){
				$execution = $this->Screening_mdl->_insertTF($postedData);
				if($execution == true){
					$ajax_validator['isSuccess'] = true;
					$ajax_validator['pesan'] = 'New Data Successfully Saved';
				}else{
					$ajax_validator['isSuccess'] = false;
					$ajax_validator['pesan'] = 'Error while uploading new data';
				}
			}else{
				$ajax_validator['isSuccess'] = false;
				$err = $this->form_validation->error_array();
				// foreach ($_POST as $key => $value) {
				foreach ($err as $key => $value) {
					$ajax_validator['pesan'][$key] = form_error($key);
				}
			}
				
		}elseif ($action == 'update'){

			if($this->form_validation->run() == TRUE){
				$execution = $this->Screening_mdl->_updateTF($uid, $postedData);
				if($execution == true){
					$ajax_validator['isSuccess'] = true;
					$ajax_validator['pesan'] = 'Data Successfully Updated';
				}else{
					$ajax_validator['isSuccess'] = false;
					$ajax_validator['pesan'] = 'Error while updating new data';
				}
			}else{
				$ajax_validator['isSuccess'] = false;
				$err = $this->form_validation->error_array();
				// foreach ($_POST as $key => $value) {
				foreach ($err as $key => $value) {
					$ajax_validator['pesan'][$key] = form_error($key);
				}
			}
		}	

		echo json_encode($ajax_validator);
	}

	function ajax_action($action){
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$this->load->model('Screening_mdl');

		// $login_id = _get_user_id();		

		$xDate = $this->input->post('optScrDate', true);
		$postedData['Emp_id'] = $this->input->post('inpEmpID', true);
		$postedData['Name'] = $this->input->post('inpName', true);
		$postedData['Phone'] = $this->input->post('inpPhone', true);
		$postedData['Emirate_id'] = $this->input->post('inpEmirateID', true);
		$postedData['Screen_dt'] = $xDate;
		$postedData['Dept'] = $this->input->post('optDept', true);
		// $postedData['Note'] = $this->input->post('inpNote', true);
		$uid = $this->input->post('inpUID', true);

		if($action == 'create'){

			$execution = $this->Screening_mdl->_insertTF($postedData);

			if($execution == true){
				$ajax_validator['isSuccess'] = true;
				$ajax_validator['pesan'] = 'New Data Successfully Saved';
			}else{
				$ajax_validator['isSuccess'] = false;
				$ajax_validator['pesan'] = 'Error while uploading new data';
			}
		} elseif ($action == 'update'){
			$execution = $this->Screening_mdl->_updateTF($uid, $postedData);

			if($execution){
				$ajax_validator['isSuccess'] = true;
				$ajax_validator['pesan'] = 'Data Successfully Updated';
			}else{
				$ajax_validator['isSuccess'] = false;
				$ajax_validator['pesan'] = 'Error while updating data';
			}
		}

		echo json_encode($ajax_validator);
	}

	function check_emp_id($emp_id){
		// die($emp_id);
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$this->load->model('Screening_mdl');

        $query = $this->Screening_mdl->get_where_custom(['Emp_id' => $emp_id], null);
        $num_rows = $query->num_rows();

        if ($num_rows > 0) {
            $this->form_validation->set_message('check_emp_id', 'The Employee ID already exist.');
            return FALSE;
        } else {
            return TRUE;

        }
	}

	function check_quota_date($date){
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$this->load->model('Screening_mdl');

        $query = $this->Screening_mdl->get_where_custom(['Screen_dt' => $date], null);
        $num_rows = $query->num_rows();

        if ($num_rows < 6) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_quota_date', 'The Selected Date is over quota. Please select other date.');
            return FALSE;
        }
	}
}
