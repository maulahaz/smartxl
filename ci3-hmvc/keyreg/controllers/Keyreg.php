<?php

class Keyreg extends MX_Controller {
	function __construct(){
		parent ::__construct();
		//--This to get CALLBACK in Form_Validation working:
		$this->form_validation->CI =& $this;
	}

	function index(){
        redirect('keyreg/list');
	}
	
	/* CLIENT VIEW */
	function list()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();
		
		$this->load->model('Keyreg_mdl');
		// $data['loginID'] = $this->session->userdata('ses_UserID');
		// $data['loginID'] = $_SESSION['user_id'];
		$data['loginID'] = $this->site_security->_get_user_id();
		$data['usrLevel'] = $this->site_security->_get_user_level();

        $data['page_title'] = "Key Register List";
        // $data['qryKeyreg'] = $this->Keyreg_mdl->get('uid DESC');
        $data['optionsUserList'] = $this->fetch_UserList_as_options();
		$data['flashMsg'] = $this->session->flashdata('flashMsg');
		
		$data['view_module'] = "keyreg";
		$data['view_file'] = "v_list";
		$data['show_modal'] = "keyreg/frm_print";
		$data['js_file'] = "keyreg/js_keyreg";
		// $this->load->module('templates'); 
		// $this->templates->admin_2($data);
		echo Modules::run('templates/admin_2', $data);
	}

	function ajaxAction($action)
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();
		_isAjax();

		$this->load->module('mydatetime');
		$this->load->model('Keyreg_mdl');

		switch ($action) {
			case 'read':
				$qry = $this->Keyreg_mdl->get('uid DESC');
				$optUsers = $this->fetch_UserList_as_options();

				$result = array('data' => array());
				$sn = 0;
				foreach ($qry->result() as $key => $value){
					$sn = $sn + 1;
					
					$edit = base_url('keyreg/modify/').$value->uid;
					$delete = base_url('keyreg/delete/').$value->uid;
					$report = base_url('keyreg/report/').$value->uid;
					$buttons = '
						<a href="'.$edit.'" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
						<a href="'.$delete.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this data?\');"><i class="fa fa-trash-o"></i></a>
					';
					$buttons2 = '
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
					$result['data'][$key] = array(
						$sn,
						'<p>'.$value->Keyreg_type.'</p>',
						'<p class="text-left">'.$value->Reason.'</p>',
						// $value->Taken_dtm,
						convertDate($value->Taken_dtm, 'overtime'),
						$value->Taken_by,
						// $value->Return_dtm,
						convertDate($value->Return_dtm, 'overtime'),
						$value->Return_by,
						'<p class="text-left">'.$value->Notes.'</p>',
						$buttons
					); 
				}
				break;
			case 'update':
				echo 'update';
				break;
			case 'delete':
				echo 'delete';
				break;
			// default:
			// 	code to be executed if n is different from all labels;

		}
		echo json_encode($result);
	}

	function modify()
    {
        $this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();
		
		$this->load->model('Keyreg_mdl');
		// $data['loginID'] = $this->session->userdata('ses_UserID');
		// $data['loginID'] = $_SESSION['user_id'];
		
		$updateID = $this->uri->segment(3);
		// die($updateID);
		$btnSave = $this->input->post('btn_save',TRUE);

		if($btnSave == 'Save'){
			/// POST DATA:
			if(!empty($this->input->post('kr_type'))) {				
				$selectedKeyreg = implode(',', $this->input->post('kr_type',TRUE));
			}else{
				$selectedKeyreg = null;
			}
			$takenDatetime = $this->input->post('taken_date',TRUE)." ".$this->input->post('taken_time',TRUE);
			$returnDatetime = $this->input->post('return_date',TRUE)." ".$this->input->post('return_time',TRUE);

			/// VALIDASI
			$this->form_validation->set_rules('kr_type[]','Key Type','required');
			$this->form_validation->set_rules('taken_date','Taken Date','required');
			$this->form_validation->set_rules('taken_by','Taken by','required');
			$this->form_validation->set_rules('return_date','Return Date','required');
			$this->form_validation->set_rules('return_by','Return by','required');

			if($this->form_validation->run() == TRUE){
				$postedData['Keyreg_type'] = $selectedKeyreg;
				$postedData['Taken_dtm'] = date("Y-m-d H:i:s", strtotime($takenDatetime));
				$postedData['Taken_by'] = $this->input->post('taken_by', TRUE);
				$postedData['Reason'] = $this->input->post('reason', TRUE);
				$postedData['Return_dtm'] = date("Y-m-d H:i:s", strtotime($returnDatetime)); //$returnDatetime;
				$postedData['Return_by'] = $this->input->post('return_by', TRUE);
				$postedData['Notes'] = $this->input->post('notes', TRUE);
				// print_r($postedData);die();

				/// CREATE PROCESS:
				if(empty($updateID)){
					$this->Keyreg_mdl->insert($postedData);
					// $create = $this->Keyreg_mdl->insertTF($postedData);
					if($create){
						$flash_msg = "New data created";
						$value= '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
						$this->session->set_flashdata('flashMsg', $value);
					}else{
						$flash_msg = "New data created xxx";
						$value= '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
						$this->session->set_flashdata('flashMsg', $value);
					}

				/// UPDATE PROCESS:	
				}else{
					$this->Keyreg_mdl->update($updateID, $postedData);
					// $update = $this->Keyreg_mdl->update($updateID, $postedData);
					$flash_msg = "Data Edited";
					$value= '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
					$this->session->set_flashdata('flashMsg', $value);
				}

				redirect('keyreg/list');
			} 
			/// IF VALIDATION IS FALSE:
			else{
				$this->session->set_flashdata('flashMsg', validation_errors());
			}
		}

		if((!empty($updateID)) && ($btnSave != 'Submit')){
			$data = $this->fetchDataFromDB($updateID);
		}else{
			$data = $this->fetchDataFromPost();
		}

		if(empty($updateID)){
			$data['page_title'] = "Create Key Registration";
		}else{
			$data['page_title'] = "Update Key Registration";
		}

		$data['loginID'] = $this->site_security->_get_user_id();
        $data['updateID'] = $updateID;
        $data['userOptions'] = $this->getUserForOption();

		$data['flashMsg'] = $this->session->flashdata('flashMsg');
        $data['view_module'] = "keyreg";
		$data['view_file'] = "v_create";
		// $data['show_modal'] = "keyreg/frm_modify";
		$data['js_file'] = "keyreg/js_keyreg";
		echo Modules::run('templates/admin_2', $data);
	}

	function delete($updateID = null){
    	$this->load->module('site_security');
    	// $this->site_security->_make_sure_is_admin();	
    	$this->site_security->_make_sure_logged_in();

    	$this->load->model('Keyreg_mdl');

		if(is_numeric($updateID)){
			$this->Keyreg_mdl->delete($updateID);
			$flash_msg = "Data Successfully Deleted";
			$value= '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
			$this->session->set_flashdata('flashMsg', $value);
			redirect('keyreg/list');			
		}
    }	

	function test(){
		$post = $this->input->post();
		$postx =  $this->input->post('from_date', TRUE);
		// $timestamp = '2020-08-12 20:13:30';
		// $dt1x = '01-Jul-2020';
		// $dt2x = '30-Jul-2020';
		$postDt1 = $post['from_date'];
		// $postDt1 = $post->from_date;
		$dt1 = date("Y-m-d H:i:s", strtotime($postx));
		$dt2 = date("Y-m-d H:i:s", strtotime($postDt1));
		echo "<pre>";
		print_r ($dt1);
		print_r ($postDt1);
		print_r ($dt2);
		print_r ($post);
		print_r ($postx);
		echo "</pre>";
	}

	function print_keyreg()
	{
		/// PRINT PDF WITHOUT ANY LIBRARY

		$this->load->model('Keyreg_mdl');

		$post = $this->input->post();
		$from = $post['from_date']." 00:00:00";
		$until = $post['until_date']." 23:59:00";
		$frmDate = date("Y-m-d H:i:s", strtotime($from));
		$untilDate = date("Y-m-d H:i:s", strtotime($until));

		$data['title'] = "Print Key Register - SMARTXL By MHz";
		$data['pageTitle'] = "Key Register List";
		$data['fromDate'] = $post['from_date'];
		$data['untilDate'] = $post['until_date'];
		$mysqlQuery = "SELECT * FROM tbl_keyregs WHERE Taken_dtm BETWEEN '" . $frmDate . "' AND  '" . $untilDate . "' ORDER by uid DESC";
        $data['qry'] = $this->Keyreg_mdl->_custom_query($mysqlQuery);
        $this->load->view('keyreg/v_print_keyreg', $data, FALSE);
	}

	function createReport()
	{
		$this->load->library('Lib_tcpdf');
		$this->load->model('Keyreg_mdl');

        $data['title'] = "XLPE Key Register";
        $dt1 = '01-Jul-2020 00:00';//$this->input->post('from_date', TRUE)." "."00:00:00";
		$dt2 = '30-Aug-2020 23:59';//$this->input->post('until_date', TRUE)." "."23:59:00";
		$frmDate = date("Y-m-d H:i:s", strtotime($dt1));
		$untilDate = date("Y-m-d H:i:s", strtotime($dt2));
        $mysqlQuery = "SELECT * FROM tbl_keyregs WHERE Taken_dtm BETWEEN '" . $frmDate . "' AND  '" . $untilDate . "' ORDER by uid DESC";
        $data['qry'] = $this->Keyreg_mdl->_custom_query($mysqlQuery);
        // echo "<pre>";
        // print_r ($data['qry']->result());
        // echo "</pre>";die();
        // return view('keyreg/pdf_print', $data);
        $this->load->view('keyreg/rpt_keyreg', $data, FALSE);
	}

	function report()
	{
		// echo "report";
		// security:

		// add library:
		$this->load->library('Lib_tcpdf');
		$this->load->model('Keyreg_mdl');

		/// get data from POST:
		$post = $this->input->post();
		$dt1 = $this->input->post('from_date', TRUE)." "."00:00:00";
		$dt2 = $this->input->post('until_date', TRUE)." "."23:59:00";
		// $frmDate = date("Y-m-d", strtotime($this->input->post('from_date', TRUE)));
		$frmDate = date("Y-m-d H:i:s", strtotime($dt1));
		// $untilDate = date("Y-m-d", strtotime($this->input->post('until_date', TRUE)));
		$untilDate = date("Y-m-d H:i:s", strtotime($dt2));
		// $untilDate = date("Y-m-d H:i:s", strtotime($this->input->post('until_date', TRUE)." 23:59"));
		// print_r($post);
		// print_r($dt1);
		// print_r($untilDate);
		// print_r($frmDate);die();
		// $where = "`Taken_dtm` BETWEEN ".$frmDate." AND ".$untilDate;
		$mysqlQuery = "SELECT * FROM tbl_keyregs WHERE Taken_dtm BETWEEN '" . $frmDate . "' AND  '" . $untilDate . "' ORDER by uid DESC";
		// $where = array('Taken_dtm >' => $frmDate, 'Taken_dtm <' => $untilDate);
		// $qry = $this->Keyreg_mdl->getData($where,'uid DESC');
		$qry = $this->Keyreg_mdl->_custom_query($mysqlQuery);
		// print_r($this->db->last_query());
		// echo "<pre>";
		// print_r ($qry->result());
		// echo "</pre>";
		// print_r ($qry->num_rows());
		// die();

		if($qry->num_rows() > 0){
			// $validator['status'] = 'Success';
			// $validator['msg'] = 'Report executed';
			// $this->create_report();
			$pdf = new Lib_tcpdf('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetTitle('Key Register - SMARTXL By MHz');
			$pdf->SetHeaderMargin(30);
			// $pdf->SetTopMargin(10);
			$pdf->setFooterMargin(10);
			$pdf->SetAutoPageBreak(true);
			$pdf->SetAuthor('MHz');
			$pdf->SetDisplayMode('real', 'default');
			$pdf->AddPage();
			$sn = 1;
			// <td align="right">'.number_format($row['harga_produk'],0,",",",").'</td>
			$html='<h3>Key Register</h3>
	                <table>
	                    <tr bgcolor="#ffffff">
	                        <th>No</th>
	                        <th>Key Type</th>
	                        <th>Taken Date</th>
	                        <th>Taken By</th>
	                        <th>Reason</th>
	                        <th>Return By</th>
	                    </tr>';
	        foreach ($qry->result() as $row){
	            $html.='<tr bgcolor="#ffffff">
	                    <td align="center">'.$sn++.'</td>
	                    <td>'.$row->Keyreg_type.'</td>
	                    <td>'.$row->Taken_dtm.'</td>
	                    <td>'.$row->Taken_by.'</td>
	                    <td>'.$row->Reason.'</td>
	                    <td>'.$row->Return_by.'</td>
	                </tr>';
	        }
	        $html.='</table>';
	        $pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('Permisi.pdf', 'I');
			exit();
		}
		// } else{
		// 	$validator['status'] = 'Fail';
		// 	$validator['msg'] = 'Report No Data';
		// }

		// echo json_encode($validator);

	}

	function create_report()
	{
		// creating report:
		$pdf = new Lib_tcpdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('Key Register - SMARTXL By MHz');
		$pdf->SetHeaderMargin(30);
		// $pdf->SetTopMargin(10);
		$pdf->setFooterMargin(10);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('MHz');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage();
		$sn = 1;
		// <td align="right">'.number_format($row['harga_produk'],0,",",",").'</td>
		$html='<h3>Key Register</h3>
                <table cellspacing="1" bgcolor="#666666" cellpadding="2">
                    <tr bgcolor="#ffffff">
                        <th>No</th>
                        <th">Key Type</th>
                        <th">Taken Date</th>
                        <th">Taken By</th>
                        <th">Reason</th>
                        <th">Return By</th>
                    </tr>';
        foreach ($qry->result() as $row){
            $html.='<tr bgcolor="#ffffff">
                    <td align="center">'.$sn++.'</td>
                    <td>'.$row->Keyreg_type.'</td>
                    <td>'.$row->Taken_dtm.'</td>
                    <td>'.$row->Taken_by.'</td>
                    <td>'.$row->Reason.'</td>
                    <td>'.$row->Return_by.'</td>
                </tr>';
        }
        $html.='</table>';
        $pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('Permisi.pdf', 'I');
	}

	function fetchDataFromDB($updateID = null)
	{
		$this->load->model('Keyreg_mdl');

		if(empty($updateID)){
			redirect('site_security/not_allowed');
		}
		$qry = $this->Keyreg_mdl->getData(['uid' => $updateID], null);
		foreach ($qry->result() as $row) {
			$data['kr_type'] = $row->Keyreg_type;
			$data['reason'] = $row->Reason;
			$data['taken_date'] = convertDate(splitDateTime("date", $row->Taken_dtm), 'mydate');
			$data['taken_time'] = splitDateTime("time", $row->Taken_dtm);
			$data['taken_by'] = $row->Taken_by;
			$data['return_date'] = convertDate(splitDateTime("date", $row->Return_dtm), 'mydate');
			$data['return_time'] = splitDateTime("time", $row->Return_dtm);
			$data['return_by'] = $row->Return_by;
			$data['reason'] = $row->Reason;
			$data['notes'] = $row->Notes;
		}
		(!isset($data)) ? $data = "" : null;
		return $data;
	}

	function fetchDataFromPost(){
		$post = $this->input->post();

		$data['kr_type'] = '';
		$data['reason'] = '';
		$data['taken_date'] = '';
		$data['taken_time'] = '';
		$data['taken_by'] = '';
		$data['return_date'] = '';
		$data['return_time'] = '';
		$data['return_by'] = '';
		$data['reason'] = '';
		$data['notes'] = '';

		return $data;
	}
	
	function save($updateID = null)
	{
		// print_r($this->input->post());die();
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();
		
		$this->load->module('mydatetime');
		$this->load->model('Keyreg_mdl');
		// $data['loginID'] = $this->session->userdata('ses_UserID');
		// $data['loginID'] = $_SESSION['user_id'];
		// $data['loginID'] = $this->site_security->_get_user_id();
		
		$selectedKeyreg = implode(',', $this->input->post('kr_type',TRUE));
        $takenDatetime = $this->input->post('taken_date',TRUE)." ".$this->input->post('taken_time',TRUE);
        $returnDatetime = $this->input->post('return_date',TRUE)." ".$this->input->post('return_time',TRUE);
		
		$data['qryKeyreg'] = $this->Keyreg_mdl->get('uid DESC');
        // $this->form_validation->set_rules('kr_type','Key Type','required');
        $this->form_validation->set_rules('taken_date','Taken Date','required');
        $this->form_validation->set_rules('taken_by','Taken by','required');
		$this->form_validation->set_rules('return_date','Return Date','required');
		$this->form_validation->set_rules('return_by','Return by','required');
		
		if($this->form_validation->run() == TRUE){
			$postedData = [
				'Keyreg_type'   => $selectedKeyreg,
				'Taken_dtm'     => $takenDatetime,
				'Taken_by'      => $this->input->post('taken_by', TRUE),
				'Reason'        => $this->input->post('reason', TRUE),
				'Return_dtm'    => $returnDatetime,
				'Return_by'     => $this->input->post('return_by', TRUE),
				'Notes'         => $this->input->post('notes', TRUE)
			];

			if(!is_numeric($updateID)){
            	$this->Keyreg_mdl->insert($postedData);
	            $flash_msg = "New data created";
	            $value= '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
	            $this->session->set_flashdata('flashMsg', $value);
            }else{
            	$this->Keyreg_mdl->update($updateID, $postedData);
	            $flash_msg = "Data Edited";
	            $value= '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
	            $this->session->set_flashdata('flashMsg', $value);
            }
            
            redirect('keyreg/list');
		} else{
			$this->session->set_flashdata('flashMsg', validation_errors());
			redirect(base_url('keyreg/create'));
		}
		
	}

	// ADMIN VIEW : CAN MANAGE
    function manage(){
		/* -- */
    	$this->load->module('site_security');
        $this->site_security->_make_sure_logged_in();

        $this->load->model('Keyreg_mdl');

        $data['qryKeyreg'] = $this->Keyreg_mdl->get('uid DESC');
        $data['page_title'] = "Key Register";
        $data['optionsUserList'] = $this->fetch_UserList_as_options();
        $data['flash'] = $this->session->flashdata('item');

        $data['view_module'] = "keyreg";
        $data['view_file'] = "manage";
        $this->load->module('templates');
        $this->templates->blank_top_menu($data);
	}

    function create_1(){
    	// echo "<pre>";
    	// print_r ($_POST);
    	// echo "</pre>";
    	// die();
    	$this->load->module('site_security');
        $this->site_security->_make_sure_logged_in();

        $this->load->module('mydatetime');
        $this->load->model('Keyreg_mdl');

        $update_id = $this->input->post('inpUID',TRUE);
        // echo $update_id;die();

        $data['qryKeyreg'] = $this->Keyreg_mdl->get('uid DESC');
        $this->form_validation->set_rules('cbxEngkey', 'Engineer Key','callback_validateCheckbox');
        $this->form_validation->set_rules('inpReason','Reason','required');
        $this->form_validation->set_rules('inpTakenDate','Taken Date','required');
        $this->form_validation->set_rules('inpTakenBy','Taken By','required');
        // $this->form_validation->set_rules('inpReturnedDate','Returned Date','required');
        // $this->form_validation->set_rules('inpReturnedBy','Returned By','required');
        // $this->form_validation->set_rules('inpNotes','Notes/Remarks','required');

        if($this->form_validation->run() == TRUE){
        	$post_Engkey = $this->input->post('cbxEngkey', true);
        	$post_Moskey = $this->input->post('cbxMoskey', true);
        	$post_Othkey = $this->input->post('cbxOthkey', true);
            $postedData['Key_type1'] = ($post_Engkey ? $post_Engkey : 0 );
            $postedData['Key_type2'] = ($post_Moskey ? $post_Moskey : 0 );
            $postedData['Key_type3'] = ($post_Othkey ? $post_Othkey : 0 );
            $postedData['Reason'] = $this->input->post('inpReason', true);
            $_takenDate = $this->input->post('inpTakenDate', true);
            $postedData['Taken_dt'] = date('Y-m-d H:i:s',strtotime($_takenDate));
            $postedData['Taken_by'] = $this->input->post('inpTakenBy', true);

            $_returnedDate = $this->input->post('inpReturnedDate', true);
            if($_returnedDate != ""){
            	$postedData['Returned_dt'] = date('Y-m-d H:i:s',strtotime($_returnedDate));
            }
            
            $postedData['Returned_by'] = $this->input->post('inpReturnedBy', true);
            $postedData['Notes'] = $this->input->post('inpNotes', true);

            if(!is_numeric($update_id)){
            	$this->_insert($postedData);
	            $flash_msg = "New data created";
	            $value= '<div class="alert alert-success" style="margin-top:20px; font-weight: bold;font-size: 15px;" role="alert">'.$flash_msg.'</div>';
	            $this->session->set_flashdata('item', $value);
            }else{
            	$this->_update($update_id, $postedData);
	            $flash_msg = "Data Editted";
	            $value= '<div class="alert alert-success" style="margin-top:20px; font-weight: bold;font-size: 15px;" role="alert">'.$flash_msg.'</div>';
	            $this->session->set_flashdata('item', $value);
            }
            
            redirect('keyreg/manage','refresh');

        }

        $data['flash'] = $this->session->flashdata('item');
        $data['page_title'] = "Key Register";
        $data['optionsUserList'] = $this->fetch_UserList_as_options();
        $data['view_module'] = "keyreg";
        $data['view_file'] = "manage";
        $this->load->module('templates');
        $this->templates->blank_top_menu($data);
	}
	
	function getUserForOption()
    {
        $this->load->module('accounts');
		$qryUser = $this->accounts->getRecord(array('usr_Level' => '1', 'usr_Status' => '1'), 'uid DESC');

        foreach ($qryUser->result() as $row) {
            $options[''] = '--Select--';
            $options[$row->usr_ID] = $row->usr_ID." -- ".$row->usr_Name;
        }
        if(!isset($options)){
            $options = "";
        }

        return $options;
    }

    function fetch_UserList_as_options(){
	    //FOR DROPDOWN OPTION LISTS
	    $this->load->module('accounts');
	    $qryUser = $this->accounts->getRecord(array('usr_Level' => '1', 'usr_Status' => '1'), 'uid DESC');
	    foreach ($qryUser->result() as $row) {
            $options[''] = 'Please Select...';
            $options[$row->usr_ID] = $row->usr_Name;
	    }
	    if(!isset($options)){
            $options = "";
	    }
	    return $options;
	}

	function getData($forEvent = Null){
		$post_id = $this->input->post('uid', true);
		switch($forEvent){
		    case "forEdit":
		        echo json_encode(
		        	array(
							'status' => 'success',
							'data' => $this->get_where_custom('uid', $post_id)->row()
						)
				);
		        break;
		    case "Delete":
		        echo "Welcome to Tokyo, enjoy the sushi.";
		        break;
	    }
	}

	function fetch_data_from_post(){
		$data['item_data_1'] = $this->input->post('item_data_1', TRUE);
		$data['item_data_1'] = $this->input->post('item_data_1', TRUE);
		return $data;
	}

	function fetch_data_from_db($update_id){
		$qry = $this->get_where($update_id);
		foreach ($qry->result() as $row) {
			$data['item_data_1'] = $row->item_data_1;
			$data['item_data_1'] = $row->item_data_1;
		}
		if(!isset($data)){
			$data = "";
		}
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

	function validateCheckbox(){
		if($this->input->post('cbxEngkey') || $this->input->post('cbxMoskey') || $this->input->post('cbxOthkey')){
			return TRUE;
		}else{
			$this->form_validation->set_message('validateCheckbox', 'Please select at least one of Key type');
			return FALSE;
		}
	}
}
