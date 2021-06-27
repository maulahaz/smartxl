<?php

class Overtime extends MX_Controller {
	function __construct(){
		parent ::__construct();
		$this->form_validation->CI =& $this;
		$this->load->module('site_security');
		$this->load->module('mydatetime');
		$this->site_security->_make_sure_logged_in();
	}

	function index(){
		redirect('overtime/list');
	}	

	function list()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();
		
		$this->load->model('overtime_mdl');
		$data['loginID'] = $this->site_security->_get_user_id();

        $data['page_title'] = "Overtime List";
		$data['flashMsg'] = $this->session->flashdata('flashMsg');
		
		$data['view_module'] = "overtime";
		$data['view_file'] = "v_list";
		// $data['show_modal'] = "overtime/frm_print";
		$data['js_file'] = "overtime/js_overtime";
		echo Modules::run('templates/admin_2', $data);
	}

	function con(){
		$r = 'ewterwe';
		echo "<script>console.log('debug : $r');</script>";
	}

	function ajaxRead()
	{
	   $this->load->model("overtime_mdl");  
	   $this->load->module('mydatetime');

	   $list = $this->overtime_mdl->getDatatables(); 
	   // $r = $this->db->last_query(); echo "<script>console.log('debug : $r');</script>";die();
	   $data = array();  
	   $no = $_POST['start'];
	   foreach($list as $row)  
	   {  
	   		$otFrom = $this->mydatetime->get_nice_date($row->ot_date_from,'overtime');
	   		$otTo = $this->mydatetime->get_nice_date($row->ot_date_to,'overtime');
	   		$edit = base_url('overtime/modify/').$row->uid;
	   		$delete = base_url('overtime/delete/').$row->uid;
	   		$buttons = '
				<a class="btn btn-sm btn-warning" href="'.$edit.'"><i class="fa fa-edit"></i></a>
              	<a class="btn btn-sm btn-danger" href="'.$delete.'" onclick="return confirm(\'Are you sure you want to delete this data?\');"><i class="fa fa-trash-o"></i></a>
    		';
	   		$no++;
	        $sub_array = array();  

	        $sub_array[] = '<p style="text-align: center">'.$no.'</p>'; 
	        $sub_array[] = $otFrom;
	        $sub_array[] = $otTo;
	        $sub_array[] = $row->ot_category;  
	        $sub_array[] = '<p style="text-align: left">'.$row->ot_reason.'</p>'; 
	        $sub_array[] = $buttons;

	        $data[] = $sub_array;  
	   }  
	   $output = array(  
	        "draw"                    	=>     intval($_POST["draw"]),  
	        "recordsTotal"          	=>     $this->overtime_mdl->totalRows(),  
	        "recordsFiltered"     		=>     $this->overtime_mdl->countDatatables(),  
	        "data"                    	=>     $data,
	   );  
	   echo json_encode($output);
	} 

	function modify()
    {
        $this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();
		
		$this->load->model('Overtime_mdl');
		
		$updateID = $this->uri->segment(3);
		// die($updateID);
		$btnSubmit = $this->input->post('btn_submit',TRUE);

		if($btnSubmit == 'Save'){
			/// POST DATA:
			$post = $this->input->post();

			$otFrom = $this->input->post('ot_from_date',TRUE)." ".$this->input->post('ot_from_time',TRUE);
			$otUntil = $this->input->post('ot_until_date',TRUE)." ".$this->input->post('ot_until_time',TRUE);

			/// VALIDASI
			$this->form_validation->set_rules('ot_from_date','Date Overtime from','required');
			$this->form_validation->set_rules('ot_from_time','Time Overtime from','required');
			$this->form_validation->set_rules('ot_until_date','Date Overtime until','required');
			$this->form_validation->set_rules('ot_until_time','Time Overtime until','required');
			$this->form_validation->set_rules('category','Category','required');
			$this->form_validation->set_rules('reason','Reason','required');

			if($this->form_validation->run() == TRUE){
				$postedData['usr_ID'] = $this->site_security->_get_user_id();
				$postedData['ot_date_from'] = $this->mydatetime->my_timestamp_from_datetimepicker($otFrom);
				$postedData['ot_date_to'] = $this->mydatetime->my_timestamp_from_datetimepicker($otUntil);
				$postedData['ot_category'] = $this->input->post('category', TRUE);
				$postedData['ot_reason'] = $this->input->post('reason', TRUE);
				$postedData['Notes'] = $this->input->post('notes', TRUE);
				// print_r($postedData);die();

				/// CREATE PROCESS:
				if(empty($updateID)){
					$this->Overtime_mdl->insert($postedData);
					$msg= '<div class="alert alert-success" role="alert">New data created</div>';
					
					// $create = $this->Overtime_mdl->insertTF($postedData);
					// if($create){
					// 	$msg= '<div class="alert alert-success" role="alert">New data created</div>';
					// }else{
					// 	$msg= '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
					// }

					$this->session->set_flashdata('flashMsg', $msg);

				/// UPDATE PROCESS:	
				}else{
					$this->Overtime_mdl->update($updateID, $postedData);
					// $update = $this->Overtime_mdl->update($updateID, $postedData);
					$msg= '<div class="alert alert-success" role="alert">Data Edited</div>';
					$this->session->set_flashdata('flashMsg', $msg);
				}

				redirect('overtime/list');
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
			$data['page_title'] = "Create Overtime";
		}else{
			$data['page_title'] = "Update Overtime";
		}

		$data['loginID'] = $this->site_security->_get_user_id();
        $data['updateID'] = $updateID;

		$data['flashMsg'] = $this->session->flashdata('flashMsg');
        $data['view_module'] = "overtime";
		$data['view_file'] = "v_create";
		// $data['show_modal'] = "overtime/frm_modify";
		$data['js_file'] = "overtime/js_overtime";
		echo Modules::run('templates/admin_2', $data);
	}

	function fetchDataFromDB($updateID = null)
	{
		$this->load->model('Overtime_mdl');

		if(empty($updateID)){
			redirect('site_security/not_allowed');
		}
		$qry = $this->Overtime_mdl->getData(['uid' => $updateID], null);
		foreach ($qry->result() as $row) {
			$data['user_id'] = $row->usr_ID;
			$data['ot_from_date'] = $this->mydatetime->get_nice_date($row->ot_date_from, 'mydate');
			$data['ot_from_time'] = $this->mydatetime->get_nice_date($row->ot_date_from, 'mytime');
			$data['category'] = $row->ot_category;
			$data['ot_until_date'] = $this->mydatetime->get_nice_date($row->ot_date_to, 'mydate');
			$data['ot_until_time'] = $this->mydatetime->get_nice_date($row->ot_date_to, 'mytime');
			$data['reason'] = $row->ot_reason;
			$data['notes'] = $row->Notes;
		}
		(!isset($data)) ? $data = "" : null;
		return $data;
		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
	}

	function create(){
		$updateID = $this->uri->segment(3);

		if(isset($_SESSION['user_id'])){
			$login_id = $_SESSION['user_id'];
		}

		$this->load->module('mydatetime');

		$submit = $this->input->post('submit',TRUE);

		if($submit == "Cancel"){ redirect('overtime/read'); } 

		if($submit == "Submit"){
				// echo "value is ".$ot_date_from;die();
			// Validasi input
			// $this->form_validation->set_rules('ot_date_from','Overtime Date From','required|callback_date_valid');
			// $this->form_validation->set_rules('ot_date_to','Overtime Date To','required|callback_date_valid');
			$this->form_validation->set_rules('ot_date_from','Overtime Date From','required');
			$this->form_validation->set_rules('ot_date_to','Overtime Date To','required');
			$this->form_validation->set_rules('ot_category','Ovetime Category','required');
			$this->form_validation->set_rules('ot_reason','Ovetime Reason','required');
			// echo "string";die();
			if($this->form_validation->run() == TRUE){

				$data = $this->fetch_data_from_post();
				//Convert data 'Overtime To' (ot_date_to) ke Unix timestamp;
				$data['ot_date_to'] = $this->mydatetime->my_timestamp_from_datetimepicker($data['ot_date_to']);
				//Convert data 'Overtime From' (ot_date_from) ke Unix timestamp;
				$data['ot_date_from'] = $this->mydatetime->my_timestamp_from_datetimepicker($data['ot_date_from']);
				$data['usr_ID'] = $login_id;

				if(is_numeric($updateID)){
					//- update data
					$this->_update($updateID, $data);
					$flash_msg = "Update success";
					$value= '<div class="alert alert-success text-center" style="margin-top:20px; font-weight: bold;font-size: 15px;" role="alert">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('overtime/read');
					// redirect('overtime/create/'.$updateID);
				} else{
					//- New data
					$this->_insert($data);
					$updateID = $this->get_max();
					$flash_msg = "New data created";
					$value= '<div class="alert alert-success text-center" style="margin-top:20px; font-weight: bold;font-size: 15px;" role="alert">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value);
					redirect('overtime/read');
					// redirect('overtime/create/'.$updateID);
				}
			// } else{
			// 	$refer_url = $_SERVER['HTTP_REFERER'];
			// 	$error_msg = validation_errors("<div class='alert alert-warning'><strong>","</strong></div>");
			// 	$this->session->set_flashdata('item', $error_msg);

			// 	redirect($refer_url);
			// }
			}
		}

		if((is_numeric($updateID)) && ($submit != 'Submit')){
			$data = $this->fetch_data_from_db($updateID);
		}else{
			// $data = $this->fetch_data_blank();
			$data = $this->fetch_data_from_post();
		}

		if(!is_numeric($updateID)){
			$data['page_title'] = "New Overtime record";
		}else{
			$data['page_title'] = "Update data details";
		}

		
		if($data['ot_date_from'] != 0){
			$data['ot_date_from'] = $this->mydatetime->get_nice_date($data['ot_date_from'],'overtime');
		}
		if($data['ot_date_to'] != 0){
			$data['ot_date_to'] = $this->mydatetime->get_nice_date($data['ot_date_to'],'overtime');
		}
		

		$data['updateID'] = $updateID;
		$data['flash'] = $this->session->flashdata('item');

		$data['view_module'] = "overtime";
		$data['view_file'] = "create";
		echo Modules::run('templates/blank_top_menu', $data);
	}

	function delete($updateID = null)
	{
    	$this->load->module('site_security');
    	// $this->site_security->_make_sure_is_admin();	
    	$this->site_security->_make_sure_logged_in();

    	$this->load->model('Overtime_mdl');

		if(!empty($updateID)){
			$this->Overtime_mdl->delete($updateID);
			$msg= '<div class="alert alert-success" role="alert">Data Successfully Deleted</div>';
			$this->session->set_flashdata('flashMsg', $msg);
			redirect('overtime/list');			
		}
    }

	function printing(){
		$usr_ID = $_SESSION['user_id'];
		$bln = 8;//$this->input->post('txtBulan');
		$thn = 2019;//$this->input->post('txtTahun');

		$postedData = $this->_get_where(array(
								'usr_ID' => $usr_ID,
								'MONTH(FROM_UNIXTIME(ot_date_from))' => $bln,
								'YEAR(FROM_UNIXTIME(ot_date_from))' => $thn
								));

		foreach ($postedData->result() as $row) {
			$tgl[]=date('d', $row->ot_date_from);
		}
		// echo '<pre>'; print_r($tgl); echo '</pre>';die();

		$totDays = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
		// echo "There were {$totDays} days in ".$bln." - ".$thn;
		// die();

		for ($i=0; $i<=$totDays; $i++) { 
			echo $tgl[$i]."<br>";
			// echo "Tanggal-".$i." atau pake format ".sprintf('%1$02d', $i)."<br>";
			
			// foreach ($postedData->result() as $row) {
				// echo $row->ot_date_from." ok ".date("d", $row->ot_date_from)."<br>";
				//date("d", $tgl[$i]);
				// echo $tgl;
				// if($tgl[$i] == $i){
				// 	echo "string".$tgl[$i]."<br>";
				// }else{
				// 	echo $i."<br>";
				// }
			// };
		}

		$this->load->view('print_data');
	}

	function _filtering_by_month_year(){
		$where = ' 1=1';

		$bln_thn_unixtime = "SELECT * FROM tbl_overtime WHERE MONTH(FROM_UNIXTIME(ot_date_from))=8";

		$bulan = $this->input->post['txtBulan'];
		if(isset($bulan) && !empty($bulan)){
			$where.=" and EXTRACT(MONTH from dateIssued)='".$_POST['txtBulan']."'";
		}

		$tahun = $this->input->post['tahun'];
		if(isset($tahun) && !empty($tahun)){
			$where.=" and EXTRACT(YEAR from dateIssued)='".$_POST['txtTahun']."'";
		}

		$query ="select * from table_name $where";

	}

	function fetch_data_from_post(){
		$data['ot_date_from'] = $this->input->post('ot_date_from', TRUE);
		$data['ot_date_to'] = $this->input->post('ot_date_to', TRUE);
		$data['ot_category'] = $this->input->post('ot_category', TRUE);
		$data['ot_reason'] = $this->input->post('ot_reason', TRUE);
		return $data;
	}

	function fetch_data_from_db($updateID){
		$qry = $this->get_where($updateID);
		foreach ($qry->result() as $row) {
			$data['ot_date_from'] = $row->ot_date_from;
			$data['ot_date_to'] = $row->ot_date_to;
			$data['ot_category'] = $row->ot_category;
			$data['ot_reason'] = $row->ot_reason;
		}
		if(!isset($data)){
			$data = "";
		}
		return $data;
	}

	function cek(){
		$user_id = $this->session->userdata('x_usrLevel');die($user_id);
		$data['ot_record'] = $this->get('uid');
		$this->load->view('Overtime/reportku', $data, FALSE);
	}

	function printByMonth()
	{
		/// PRINT PDF WITHOUT ANY LIBRARY

		$this->load->model('Overtime_mdl');

		$post = $this->input->post();
		$otMonth = $post['ot_month'];
		$otYear = $post['ot_year'];

		$data['title'] = "Print Overtime - SMARTXL By MHz";
		$data['pageTitle'] = "Overtime List";
		$loginID = $this->site_security->_get_user_id();//'user_2';//

		$data['loginID'] = $loginID;
		$data['otMonth'] = $otMonth;
		$data['otYear'] = $otYear;			

		$mysqlQuery = "
				SELECT cal.Datenum as TglOT,
				IFNULL(from_unixtime(ot.ot_date_from, '%d-%b-%Y %H:%i'),'-') as ot_date_from,  
				IFNULL(from_unixtime(ot.ot_date_to, '%d-%b-%Y %H:%i'),'-') as ot_date_to,  
				ot.ot_category, ot.ot_reason 
				FROM (SELECT * 
						FROM tbl_overtime
						WHERE usr_ID='$loginID' 
						AND MONTH(from_unixtime(ot_date_from))=$otMonth
						AND YEAR(from_unixtime(ot_date_from))=$otYear
				) as ot
				RIGHT JOIN tbl_calendar as cal ON cal.Datenum = DAYOFMONTH(from_unixtime(ot.ot_date_from))
				WHERE cal.Datenum <= 31
				ORDER BY cal.Datenum ASC
				";

        $data['qry'] = $this->Overtime_mdl->_custom_query($mysqlQuery);
        // $qry = $this->db->last_query();die($qry);
        $this->load->view('overtime/v_print_bymonth', $data, FALSE);
	}

	function print()
	{
		/// PRINT PDF WITHOUT ANY LIBRARY

		$this->load->model('Overtime_mdl');

		$post = $this->input->post();
		$frmDate = $this->mydatetime->my_timestamp_from_datetimepicker($post['from_date']);
		$untilDate = $this->mydatetime->my_timestamp_from_datetimepicker($post['until_date']);
		$otMonth = $post['ot_month'];
		$otYear = $post['ot_year'];

		// $from = $post['from_date']." 00:00:00";
		// $until = $post['until_date']." 23:59:00";
		// $frmDate = date("Y-m-d H:i:s", strtotime($from));
		// $untilDate = date("Y-m-d H:i:s", strtotime($until));

		$data['title'] = "Print Overtime - SMARTXL By MHz";
		$data['pageTitle'] = "Overtime List";
		$loginID = $this->site_security->_get_user_id();//'user_2';//

		$data['loginID'] = $loginID;
		$data['fromDate'] = $post['from_date'];
		$data['untilDate'] = $post['until_date'];
		$data['otMonth'] = $post['ot_month'];
		$data['otYear'] = $post['ot_year'];
		$mysqlQuery1 = "
				SELECT * FROM tbl_overtime 
				WHERE (ot_date_from BETWEEN '" . $frmDate . "' AND  '" . $untilDate . "') 
				AND usr_ID = '" . $loginID . "'  
				ORDER by uid DESC
				";

		$mysqlQuery2 = "
				SELECT * 
				FROM tbl_overtime
				WHERE usr_ID='$loginID' 
				AND MONTH(from_unixtime(ot_date_from))=$otMonth
				AND YEAR(from_unixtime(ot_date_from))=$otYear
				";				

		$mysqlQuery = "
				SELECT cal.Datenum as TglOT,
				IFNULL(from_unixtime(ot.ot_date_from, '%d-%b-%Y %H:%i'),'-') as ot_date_from,  
				IFNULL(from_unixtime(ot.ot_date_to, '%d-%b-%Y %H:%i'),'-') as ot_date_to,  
				ot.ot_category, ot.ot_reason 
				FROM (SELECT * 
						FROM tbl_overtime
						WHERE usr_ID='$loginID' 
						AND MONTH(from_unixtime(ot_date_from))=$otMonth
						AND YEAR(from_unixtime(ot_date_from))=$otYear
				) as ot
				RIGHT JOIN tbl_calendar as cal ON cal.Datenum = DAYOFMONTH(from_unixtime(ot.ot_date_from))
				WHERE cal.Datenum <= 31
				ORDER BY cal.Datenum ASC
				";

        $data['qry'] = $this->Overtime_mdl->_custom_query($mysqlQuery);
        // $qry = $this->db->last_query();die($qry);
        $this->load->view('overtime/v_print', $data, FALSE);
	}


	function printByDate()
	{
		/// PRINT PDF WITHOUT ANY LIBRARY

		$this->load->model('Overtime_mdl');

		$post = $this->input->post();
		$frmDate = $this->mydatetime->my_timestamp_from_datetimepicker($post['from_date']);
		$untilDate = $this->mydatetime->my_timestamp_from_datetimepicker($post['until_date']);

		$data['title'] = "Print Overtime - SMARTXL By MHz";
		$data['pageTitle'] = "Overtime List";
		$loginID = $this->site_security->_get_user_id();//'user_2';//

		$data['loginID'] = $loginID;
		$data['fromDate'] = $post['from_date'];
		$data['untilDate'] = $post['until_date'];

		$mysqlQuery = "
				SELECT * FROM tbl_overtime 
				WHERE (ot_date_from BETWEEN '" . $frmDate . "' AND  '" . $untilDate . "') 
				AND usr_ID = '" . $loginID . "'  
				ORDER by uid DESC
				";

        $data['qry'] = $this->Overtime_mdl->_custom_query($mysqlQuery);
        // $qry = $this->db->last_query();die($qry);
        $this->load->view('overtime/v_print_bydate', $data, FALSE);
	}

	function mhz(){
		$this->load->library('pdf');

		// $usr_ID = $_SESSION['user_id'];
		$data['ot_record'] = $this->get('uid');
		// $data['page_title'] = 'Overtime List : '.$usr_ID;

		$this->pdf->setPaper('A4', 'portrait');
		$html_content =$this->load->view('overtime/reportku', $data, FALSE);
		// $this->pdf->load_view('overtime/reportku',$data);

		$this->pdf->loadHtml($html_content);
	   	$this->pdf->render();
	   	$this->pdf->stream("report.pdf", array("Attachment"=>0));
	}

	function export_pdf(){
		// $dompdf = new Dompdf();

		$usr_ID = $_SESSION['user_id'];
		$data['ot_record'] = $this->_get_where(array('usr_ID' => $usr_ID));

		$data['page_title'] = 'Overtime List';

		// $this->load->view('overtime/report', $data, true);

		// Load pdf library
        $this->load->library('Pdfdom');
        // $this->dompdf->loadHtml($html);
        $this->pdf->load_view('overtime/report',$data);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        // Output the generated PDF (1 = download and 0 = preview)
        $this->stream('Overtime.pdf', array("Attachment" => 0));

		// $dompdf->setPaper('A4', 'Landscape');
		// $dompdf->load_html($html);
		// $dompdf->render();
		// $dompdf->stream('Overtime List', array("Attachment" => 0));
	}

	function search_byDate($date1, $date2){
		$this->load->model('overtime_mdl');
		$query = $this->overtime_mdl->search_byDate($date1, $date2);
		return $query;
	}

	function get($order_by){
		$this->load->model('overtime_mdl');
		$query = $this->overtime_mdl->get($order_by);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by){
		$this->load->model('overtime_mdl');
		$query = $this->overtime_mdl->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	function _get_where($where){
		$this->load->model('overtime_mdl');
		$query = $this->overtime_mdl->_get_where($where);
		return $query;
	}	

	function get_where($id){
		$this->load->model('overtime_mdl');
		$query = $this->overtime_mdl->get_where($id);
		return $query;
	}

	function get_where_custom($col, $value){
		$this->load->model('overtime_mdl');
		$query = $this->overtime_mdl->get_where_custom($col, $value);
		return $query;
	}

	// $data = array('name' => $name, 'title' => $title, 'status' => $status);
	function get_where_multiple(array $data){
		$this->load->model('overtime_mdl');
		$query = $this->model_name->get_where_multiple($data);
		return $query;
	}	

	function get_with_double_condition($col1, $value1, $col2, $value2){
		$this->load->model('overtime_mdl');
		$query = $this->overtime_mdl->get_with_double_condition($col1, $value1, $col2, $value2);
		return $query;
	}

	function _insert($data){
		$this->load->model('overtime_mdl');
		$this->overtime_mdl->_insert($data);
	}

	function _update($id, $data){
		$this->load->model('overtime_mdl');
		$this->overtime_mdl->_update($id, $data);
	}

	function _delete($id){
		$this->load->model('overtime_mdl');
		$this->overtime_mdl->_delete($id);
	}

	function count_where($column, $value){
		$this->load->model('overtime_mdl');
		$count = $this->overtime_mdl->count_where($column, $value);
		return $count;
	}

	function get_max(){
		$this->load->model('overtime_mdl');
		$max_id = $this->overtime_mdl->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query){
		$this->load->model('overtime_mdl');
		$query = $this->overtime_mdl->_custom_query($mysql_query);
		return $query;
	}

	function date_valid($xdate,$xtime){
		$parts1 = explode("-", $xdate);
		$parts2 = explode(":", $xtime);
	    if (count($parts1) == 3) {      
	      if (checkdate($parts[1], $parts[0], $parts[2]))
	      {
	        return TRUE;
	      }
	    }
	    $this->form_validation->set_message('date_valid', 'The Date field must be dd-MMM-yyyy HH:mm');
	    return false;
	}
}
