<?php

class Cdo extends MX_Controller {
	function __construct(){
		parent ::__construct();
		$this->load->model(['Cdo_mdl']);
		$this->load->module(['site_security','mydatetime']);
	}

	function index()
	{
		redirect('cdo/list');
		
	}

	function list()
	{
		// $this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$data['loginID'] = $this->site_security->_get_user_id();

		$data['page_title'] = "CDOs List xx";

		$data['flashMsg'] = $this->session->flashdata('flashMsg');
		$data['view_module'] = "cdo";
		$data['view_file'] = "v_list";
		// $data['show_modal'] = "cdo/frm_modify";
		$data['js_file'] = "cdo/js_cdo";
		echo Modules::run('templates/admin_2', $data);
	}

	function ajaxRead()
	{
		$this->load->module('mydatetime'); 

		$where = ['Usr_id' => $this->site_security->_get_user_id()];
		$list = $this->Cdo_mdl->getDatatables($where);
		// $list = $this->Cdo_mdl->getDatatables();
	    $data = array();
		$no = $_POST['start'];

		foreach ($list as $row) {
			$no++;
			$html = array();

			///LINKS
            $edit = base_url()."cdo/modify/".$row->uid;     
            $delete = base_url()."cdo/delete/".$row->uid;
            $report = base_url()."cdo/report/".$row->uid;

            $buttons = '
            	<a class="btn btn-sm btn-warning" href="'.$edit.'"><i class="fa fa-edit"></i></a>
              	<a class="btn btn-sm btn-danger" href="'.$delete.'" onclick="return confirm(\'Are you sure you want to delete this data?\');"><i class="fa fa-trash-o"></i></a>
            ';
			$buttonsXX = '
				<div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      Options
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="'.$edit.'"><i class="fa fa-edit"></i> Edit</a>
                      <a class="dropdown-item" href="'.$delete.'"><span class="fa fa-trash-o"></span> Delete</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="'.$report.'"><span class="fa fa-print"></span> Print</a>
                    </div>
                  </div>
                </td>
    		';
	    	$html[] = $no;
	    	$html[] = $row->Type;
	    	$html[] = $this->mydatetime->get_nice_date($row->Datetime_frm,'overtime');
	    	$html[] = $this->mydatetime->get_nice_date($row->Datetime_to,'overtime');
	    	$html[] = '<p style="text-align: left">'.$row->Reason.'</p>';
	    	$html[] = '<p style="text-align: left">'.$row->Note.'</p>';
	    	$html[] = $buttons;

	    	/// Penambahan tombol edit dan hapus:
	    	$html[] = $buttons;

	      	$data[] = $html;
	    }

		$output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->Cdo_mdl->totalRows(),
          "recordsFiltered" => $this->Cdo_mdl->countDatatables(),
          "data" => $data
        );

	    echo json_encode($output);
	}

	function modify()
    {
        // $this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();
		
		// $this->load->model('Cdo_mdl');
		
		$updateID = $this->uri->segment(3);
		$loginID = $this->site_security->_get_user_id();
		$btnSubmit = $this->input->post('btn_submit',TRUE);

		if($btnSubmit == 'Save'){
			/// POST DATA:
			$post = $this->input->post();

			$dateFrom = $this->input->post('from_date',TRUE)." ".$this->input->post('from_time',TRUE);
			$dateTo = $this->input->post('to_date',TRUE)." ".$this->input->post('to_time',TRUE);

			/// VALIDASI
			$this->form_validation->set_rules('cdo_type','CDO Type','required');
			$this->form_validation->set_rules('from_date','Date from','required');
			$this->form_validation->set_rules('from_time','Time from','required');
			$this->form_validation->set_rules('to_date','Date to','required');
			$this->form_validation->set_rules('to_time','Time to','required');
			$this->form_validation->set_rules('reason','Reason','required');

			if($this->form_validation->run() == TRUE){
				$postedData['Usr_id'] = $loginID;
				$postedData['Type'] = $this->input->post('cdo_type', TRUE);
				$postedData['Datetime_frm'] = $this->mydatetime->my_timestamp_from_datetimepicker($dateFrom);
				$postedData['Datetime_to'] = $this->mydatetime->my_timestamp_from_datetimepicker($dateTo);
				$postedData['Reason'] = $this->input->post('reason', TRUE);
				$postedData['Note'] = $this->input->post('notes', TRUE);
				// print_r($postedData);die();

				/// CREATE PROCESS:
				if(empty($updateID)){
					$this->Cdo_mdl->insert($postedData);
					$msg= '<div class="alert alert-success" role="alert">New data created</div>';

				/// UPDATE PROCESS:	
				}else{
					$this->Cdo_mdl->update($updateID, $postedData);
					// $update = $this->Cdo_mdl->update($updateID, $postedData);
					$msg= '<div class="alert alert-success" role="alert">Data Edited</div>';
				}

				$this->session->set_flashdata('flashMsg', $msg);
				redirect('cdo/list');
			} 
			/// IF VALIDATION IS FALSE:
			else{
				$this->session->set_flashdata('flashMsg', validation_errors());
			}
		}

		if((!empty($updateID)) && ($btnSubmit != 'Save')){
			$data = $this->fetchDataFromDB($updateID);
		}

		if(empty($updateID)){
			$data['page_title'] = "Create CDO";
		}else{
			$data['page_title'] = "Update CDO";
		}

		$data['loginID'] = $loginID;
        $data['updateID'] = $updateID;

		$data['flashMsg'] = $this->session->flashdata('flashMsg');
        $data['view_module'] = "cdo";
		$data['view_file'] = "v_modify";
		// $data['show_modal'] = "cdo/frm_modify";
		$data['js_file'] = "cdo/js_cdo";
		echo Modules::run('templates/admin_2', $data);
	}

	function delete($updateID = null)
	{
    	// $this->site_security->_make_sure_is_admin();	
    	$this->site_security->_make_sure_logged_in();

		if(!empty($updateID)){
			$this->Cdo_mdl->delete($updateID);
			$msg= '<div class="alert alert-success" role="alert">Data Successfully Deleted</div>';
			$this->session->set_flashdata('flashMsg', $msg);
			redirect('cdo/list');			
		}
    }

	function fetchDataFromDB($updateID)
	{
		if(empty($updateID)){
			redirect('site_security/not_allowed');
		}
		$qry = $this->Cdo_mdl->get_where($updateID);
		foreach ($qry->result() as $row) {
			$data['cdo_type'] = $row->Type;
			$data['from_date'] = $this->mydatetime->get_nice_date($row->Datetime_frm, 'mydate');
			$data['from_time'] = $this->mydatetime->get_nice_date($row->Datetime_frm, 'mytime');
			$data['to_date'] = $this->mydatetime->get_nice_date($row->Datetime_to,'mydate');
			$data['to_time'] = $this->mydatetime->get_nice_date($row->Datetime_to,'mytime');
			$data['reason'] = $row->Reason;
			$data['notes'] = $row->Note;
		}
		if(!isset($data)){
			$data = "";
		}
		return $data;
	}

	function manage(){
		$this->load->module('site_security');
		// $this->site_security->_make_sure_is_admin();
		$this->site_security->_make_sure_logged_in();

		$this->load->module('mydatetime');

		$loggin_id = $this->site_security->_get_user_id();

		$submit = $this->input->post('submit', TRUE);
		// echo "<script> alert('".$submit."')</script>";
		if($submit == "Search"){
			$txtDatetimeFrm = $this->mydatetime->my_timestamp_from_datetimepicker($this->input->post('txtDatetimeFrm', TRUE));
			$txtDatetimeTo = $this->mydatetime->my_timestamp_from_datetimepicker($this->input->post('txtDatetimeTo', TRUE));
			$data['qryCDO'] = $this->getRecord(array('Usr_id' => $loggin_id, 'Datetime_frm >=' => $txtDatetimeFrm, 'Datetime_to <=' => $txtDatetimeTo ), 'uid DESC');
		}
		elseif($submit == "Refresh"){
			$data['qryCDO'] = $this->getRecord(array('Usr_id' => $loggin_id), 'uid DESC');
		}else{
			$data['qryCDO'] = $this->getRecord(array('Usr_id' => $loggin_id), 'uid DESC');
		}

		$data['flash'] = $this->session->flashdata('item');
		$data['page_title'] = 'Manage CDO';
		$data['view_module'] = "cdo";
		$data['view_file'] = "manage";
		$this->load->module('templates');
		$this->templates->blank_top_menu($data);
	}

	function create(){
		$this->load->module('site_security');
		// $this->site_security->_make_sure_is_admin(); 
		$this->site_security->_make_sure_logged_in();

		$this->load->module('mydatetime');

		$update_id = $this->uri->segment(3);

		$loggin_id = $this->site_security->_get_user_id();

		$submit = $this->input->post('submit', TRUE);

		if($submit == "Cancel"){ redirect('cdo/manage'); }

		if($submit == "Submit"){
			// echo "<pre>";
			// print_r ($_POST);
			// echo "</pre>";die();
			// $this->form_validation->set_rules('txtUsrID','User ID','required');
			$this->form_validation->set_rules('txtType','CDO Type','required');
			$this->form_validation->set_rules('txtDatetimeFrm','Date & Time From','required');
			$this->form_validation->set_rules('txtDatetimeTo','Date & Time To','required');
			$this->form_validation->set_rules('txtReason','Reason','required');
			$this->form_validation->set_rules('txtNote','Note','required');

			if($this->form_validation->run() == TRUE){
				//--if Update_id NOT blank mean EDIT ACTION:
				if(is_numeric($update_id)){
					$updateData['Usr_id'] = $loggin_id; 
					$updateData['Type'] = $this->input->post('txtType', true); 
					$updateData['Datetime_frm'] = $this->mydatetime->my_timestamp_from_datetimepicker($this->input->post('txtDatetimeFrm', true)); 
					$updateData['Datetime_to'] = $this->mydatetime->my_timestamp_from_datetimepicker($this->input->post('txtDatetimeTo', true)); 
					$updateData['Reason'] = $this->input->post('txtReason', true); 
					$updateData['Note'] = $this->input->post('txtNote', true); 
					$this->_update($update_id, $updateData);
					$flash_msg = "Update success";
					$value= '<div class="alert alert-success text-center" role="alert">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('cdo/manage');
				}
				//--if Update_id = blank mean CREATE ACTION: 
				else{
					$createData['Usr_id'] = $loggin_id; 
					$createData['Type'] = $this->input->post('txtType', true); 
					$createData['Datetime_frm'] = $this->mydatetime->my_timestamp_from_datetimepicker($this->input->post('txtDatetimeFrm', true)); 
					$createData['Datetime_to'] = $this->mydatetime->my_timestamp_from_datetimepicker($this->input->post('txtDatetimeTo', true)); 
					$createData['Reason'] = $this->input->post('txtReason', true); 
					$createData['Note'] = $this->input->post('txtNote', true); 
					$this->_insert($createData);		
					$flash_msg = "New data created";
					$value = '<div class="alert alert-success text-center" role="alert">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('cdo/manage');
				}
			}
			//--If Form_validation is FALSE, then :

		}

		if((is_numeric($update_id)) && ($submit != 'Submit')){
			$data = $this->fetch_data_from_db($update_id);
		}

		$data['flash'] = $this->session->flashdata('item');

		if(!is_numeric($update_id)){
			$data['page_title'] = "Add new CDO";
		}else{
			$data['page_title'] = "Update CDO";
		}
		$data['update_id'] = $update_id;
		$data['view_module'] = "cdo";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->blank_top_menu($data);
	}

	function deleteOLD($update_id){
		$this->load->module('site_security');
		// $this->site_security->_make_sure_is_admin(); 
		$this->site_security->_make_sure_logged_in();

		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}

		$this->_delete($update_id);

		$flash_msg = "Item successfully deleted";
		$value= '<div class="alert alert-success text-center" style="margin-top:20px; font-weight: bold;font-size: 15px;" role="alert">'.$flash_msg.'</div>';
		$this->session->set_flashdata('item', $value);

		redirect('cdo/manage');
	}	

	function fetch_data_from_db($update_id){
		$this->load->module('mydatetime');

		if(!is_numeric($update_id)){
			redirect('site_security/not_allowed');
		}
		$qry = $this->get_where($update_id);
		foreach ($qry->result() as $row) {
			$data['txtType'] = $row->Type;
			$data['txtDatetimeFrm'] = $this->mydatetime->get_nice_date($row->Datetime_frm, 'cdo');
			$data['txtDatetimeTo'] = $this->mydatetime->get_nice_date($row->Datetime_to,'cdo');
			$data['txtReason'] = $row->Reason;
			$data['txtNote'] = $row->Note;
		}
		if(!isset($data)){
			$data = "";
		}
		return $data;
	}

	function checkPostedData(){
		if($submitted){
			foreach ($_POST as $key => $value) {
				echo "Key of $key has value of $value.<br>";
				echo "OR";
				echo "Key of ".$key." has value of ".$value."<br>";
				echo "OR";
				echo "<pre>";
				print_r ($_POST);
				echo "</pre>";
			}
		}
	}

	function fetch_data_as_options(){
		//FOR DROPDOWN OPTION LISTS
		$this->load->module('Account');
		$qryUser = $this->Account->getRecord(array('Level' => 'Operator'), 'uid DESC');
		foreach ($qryUser->result as $row) {
			$options[$row->uid] = $row->Username;
		}
		if(!isset($options)){
			$options = "";
		}

		return $options;
	}

	function make_pdf(){
		$this->load->library('Lib_tcpdf');
		$usr_ID = $_SESSION['user_id'];
		$month = $this->input->post('inpMonth', true);
		$year = $this->input->post('inpYear', true);
		$sql_query = "
					SELECT
					DATE_FORMAT(cald.Datefield,'%Y-%m-%d') AS Tgl,
					FROM_UNIXTIME(cdo.Datetime_frm,'%Y-%m-%d') AS CDO,
					cdo.Type,
					cdo.Reason,
					cdo.Datetime_frm,
					cdo.Datetime_to,
					cdo.Note
					FROM 
					tbl_calendar as cald LEFT JOIN (SELECT * FROM tbl_cdo WHERE Usr_id= '$usr_ID') as cdo
					ON 
					cald.Datefield = cdo.Datefield
					WHERE 
					MONTH(cald.Datefield) = $month AND YEAR(cald.Datefield) = $year
					GROUP BY 
					cald.Datefield
				";
		
		$this->load->model('Cdo_mdl');
		$data['qryCDO'] = $this->Cdo_mdl->_custom_query($sql_query);
		// echo "<pre>";
		// print_r ($data['qryCDO']);
		// echo "</pre>";
		$this->load->view('report_pdf', $data);
	 }

	function get_report_permonth(){
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$loggin_id = $this->site_security->_get_user_id();
		$month = $this->input->post('optMonth', true);
		$year = $this->input->post('optYear', true);
		$submit = $this->input->post('btnSubmit_CDO',TRUE);

		//--SUBMITING Report CDO 
		if(!empty($month) && $submit == "Submit"){
			$this->form_validation->set_rules('optMonth','Month','required');

			if($this->form_validation->run() == TRUE){
				$sql_query = "
					SELECT
					DATE_FORMAT(cald.Datefield,'%Y-%m-%d') AS Tgl,
					FROM_UNIXTIME(cdo.Datetime_frm,'%Y-%m-%d') AS CDO,
					cdo.Type,
					cdo.Reason,
					cdo.Datetime_frm,
					cdo.Datetime_to,
					cdo.Note
					FROM 
					tbl_calendar as cald LEFT JOIN (SELECT * FROM tbl_cdo WHERE Usr_id= '$loggin_id') as cdo
					ON 
					cald.Datefield = cdo.Datefield
					WHERE 
					MONTH(cald.Datefield) = $month AND YEAR(cald.Datefield) = $year
					GROUP BY 
					cald.Datefield
				";		
				// echo "<pre>";
				// print_r ($sql_query);
				// echo "</pre>";die();

				$this->load->model('Cdo_mdl');
				$data['qryCDO'] = $this->Cdo_mdl->_custom_query($sql_query);

				// echo "<pre>";
				// print_r ($data['qryCDO']->result());
				// echo "</pre>";
				// die();

				// $flash_msg = "Report Generated";
				// $value= '<div class="alert alert-success text-center" role="alert">'.$flash_msg.'</div>';
				// $this->session->set_flashdata('item', $value);
				$data['month'] = $month;
				$data['year'] = $year;
				$data['flash'] = $this->session->flashdata('item');
				$data['page_title'] = 'CDO Monthly Report';
				$data['view_module'] = "cdo";
				$data['view_file'] = "report";
				// $data['local_js'] = "cdo_report_js";
				$this->load->module('templates');
				$this->templates->blank_top_menu($data);	
			} 
			// else{
			// 	$flash_msg = "Report Generated";
			// 	$value= '<div class="alert alert-success text-center" role="alert">'.$flash_msg.'</div>';
			// 	$data['flash'] = $this->session->flashdata('item');
			// 	redirect('etask/report','refresh');
			// }
		}

	}

	function call_stored_procedure_fill_calendar(){
		// echo "string";die();
		$start = "2019-10-01";
		$end = "2019-12-31";
		$this->procedure_fill_calendar($start, $end);
		// $my_stored_procedure = "CALL fill_calendar(?,?)";
		// $this->_custom_query($my_stored_procedure, array("str_date" => $star, "end_date" => $end));
		echo "finished";die();
	}

	function procedure_fill_calendar($start, $end){
		$this->load->model('Cdo_mdl');
		$query = $this->Cdo_mdl->procedure_fill_calendar($start, $end);
		return $query;
	}	

	function fetch_data_from_post(){
		$data['item_title'] = $this->input->post('item_title', TRUE);
		$data['item_price'] = $this->input->post('item_price', TRUE);
		$data['was_price'] = $this->input->post('was_price', TRUE);
		$data['item_desc'] = $this->input->post('item_desc', TRUE);
		return $data;
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

	function getRecord($whereArray = Null, $order_by){
		$this->load->model('Cdo_mdl');
		$query = $this->Cdo_mdl->getRecord($whereArray, $order_by);
		return $query;
	}	

	function get($order_by){
		$this->load->model('Cdo_mdl');
		$query = $this->Cdo_mdl->get($order_by);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by){
		$this->load->model('Cdo_mdl');
		$query = $this->Cdo_mdl->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	function get_where($id){
		$this->load->model('Cdo_mdl');
		$query = $this->Cdo_mdl->get_where($id);
		return $query;
	}

	function get_where_custom($col, $value, $sortBy){
		$this->load->model('Cdo_mdl');
		$query = $this->blogs_mdl->get_where_custom($col, $value, $sortBy);
		return $query;
	}

	// $where = array('name' => $name, 'title' => $title, 'status' => $status);
	function _get_where_multi($where){
		$this->load->model('cdo_mdl');
		$query = $this->cdo_mdl->_get_where_multi($where);
		return $query;
	}

	function get_with_double_condition($col1, $value1, $col2, $value2){
		$this->load->model('Cdo_mdl');
		$query = $this->Cdo_mdl->get_with_double_condition($col1, $value1, $col2, $value2);
		return $query;
	}

	function _insert($data){
		$this->load->model('Cdo_mdl');
		$this->Cdo_mdl->_insert($data);
	}

	function _update($id, $data){
		$this->load->model('Cdo_mdl');
		$this->Cdo_mdl->_update($id, $data);
	}

	function _delete($id){
		$this->load->model('Cdo_mdl');
		$this->Cdo_mdl->_delete($id);
	}

	function count_where($column, $value){
		$this->load->model('Cdo_mdl');
		$count = $this->Cdo_mdl->count_where($column, $value);
		return $count;
	}

	function get_max($field_name){
		$this->load->model('Cdo_mdl');
		$max_data = $this->Cdo_mdl->get_max($field_name);
		return $max_data;
	}

	function _custom_query($mysql_query){
		$this->load->model('Cdo_mdl');
		$query = $this->Cdo_mdl->_custom_query($mysql_query);
		return $query;
	}	

	function get_results_like($field, $search, $order_by){
		$this->load->model('Cdo_mdl');
		$query = $this->Cdo_mdl->get_results_like($field, $search, $order_by);
		return $query;
	}

	function makeTableDB_withDBForge($tblName =null){
		$this->load->dbforge();
        $posts_fields=array(
            'uid' => array('type' =>'INT', 'constraint' =>11,'unsigned' =>TRUE, 'auto_increment' =>TRUE ),
            'Usr_id' => array('type' =>'VARCHAR','constraint' => 20),
            'Type' => array('type' =>'VARCHAR','constraint' => 30),
            'Datetime_frm' => array('type' =>'INT', 'constraint' =>11,'unsigned' =>TRUE),
            'Datetime_to' => array('type' =>'INT', 'constraint' =>11,'unsigned' =>TRUE),
            'Reason' => array('type' =>'VARCHAR','constraint' => 255),
            'Note' => array('type' =>'text'));

        $this->dbforge->add_key('uid', TRUE);
        $this->dbforge->add_field($posts_fields);
        $attributes = array('ENGINE' =>'InnoDB');
        if($this->dbforge->create_table($tblName, TRUE, $attributes)){
        	echo "Table created";
        }else{
        	echo "Table not created";
        }
    }	
}
