<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugmasters extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect('tugmasters/manage');
	}

	function manage()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$data['loginID'] = $this->site_security->_get_user_id();

		$data['headline'] = "Manage Tugmasters";

		$data['flashMsg'] = $this->session->flashdata('flashMsg');
		$data['view_module'] = "tugmasters";
		$data['view_file'] = "v_manage";
		// $data['show_modal'] = "tugmasters/frm_modify";
		$data['js_file'] = "tugmasters/js_tugmasters";
		echo Modules::run('templates/admin_2', $data);
	}

	function create()
	{
		$this->load->module('site_security');
		$this->load->model('Tugmasters_mdl');
		$this->site_security->_make_sure_logged_in();

		// $post = $this->input->post();var_dump($post);die();

		$submit = $this->input->post('btn_submit',TRUE);

		// if($submit == "Cancel"){ redirect('tugmasters/manage'); } 

		if($submit == "Save"){
			$this->_validation();

			if($this->form_validation->run() == TRUE){
				$reqDate = $this->input->post('req_date',TRUE)." ".$this->input->post('req_time',TRUE);
				$packDate = $this->input->post('req_date',TRUE);
				$packShift = $this->input->post('shift',TRUE);

				$reqID = $this->_getRequestID($packDate, $packShift);

				// INSERT DATA MASTER:
				$postedDataMaster = array(
					'Req_id'			=> $reqID,
					'Request_dtm'	=> convertDate($reqDate, 'mysql'),
					'Team'			=> $this->input->post('team',TRUE),
					'Shift'			=> $this->_getShiftTime($packShift),
					// 'Status'		=> $this->input->post('status',TRUE),
					'Request_by'	=> $this->input->post('req_by',TRUE),
					'Operator'		=> $this->input->post('operator',TRUE),
					'Notes'		=> $this->input->post('notes',TRUE),
				);
				$this->db->insert('tbl_tugmasters', $postedDataMaster);

				// INSERT DATA DETAIL:
				$postedDataDetail = array(
					'Req_id'	=> $reqID,
					'Bay_no'		=> $this->input->post('txtBayNum',TRUE),
					'Container_no'	=> $this->input->post('txtContrNum',TRUE),
					'Material'		=> $this->input->post('txtMaterial',TRUE),
					'Batch'			=> $this->input->post('txtBatch',TRUE),
					'Qty'			=> $this->input->post('txtQty',TRUE),
					'Unit'			=> $this->input->post('txtUnit',TRUE),
					'Destination'	=> $this->input->post('txtDestination',TRUE),
					'Replace_with'	=> $this->input->post('txtReplaceWith',TRUE),
					'Notes'			=> $this->input->post('txtNotes',TRUE),
				);
				$this->_save_data_detail($postedDataDetail);

				// MSG:
				$msg= '<div class="alert alert-success text-center" style="margin-top:20px; font-weight: bold;font-size: 15px;" role="alert">New data created</div>';
				// $value= '<p style="color: red;">'.$flash_msg.'</p>';
				$this->session->set_flashdata('flashMsg', $msg);
				redirect('tugmasters/manage');

			}
			/// IF VALIDATION IS FALSE:
			else{
				$this->session->set_flashdata('flashMsg', validation_errors());
			}
		}

		$data['loginID'] = $this->site_security->_get_user_id();

		$data['headline'] = "Create Tugmasters Request";

		$data['flashMsg'] = $this->session->flashdata('flashMsg');
		$data['view_module'] = "tugmasters";
		$data['view_file'] = "v_create";
		$data['dtSupervisor'] = $this->_getSupervisor();
		$data['js_file'] = "tugmasters/js_tugmasters";
		echo Modules::run('templates/admin_2', $data);
		// $this->load->view('templates/gentelella/v_admin', $data);
	}

	function _validation()
	{
		//Master Data Validation:
		$this->form_validation->set_rules('req_date','Request Date','required');
		$this->form_validation->set_rules('req_time','Request Time','required');
		$this->form_validation->set_rules('req_by','Request by','required');
		$this->form_validation->set_rules('team','Shift Group','required');
		$this->form_validation->set_rules('shift','Shift time','required');
		$this->form_validation->set_rules('operator','Contact person','required');

		//Detail Data Validation:
		$this->form_validation->set_rules('txtBayNum[]','Loading Bay Number','required');
		$this->form_validation->set_rules('txtContrNum[]','Container Number','required|min_length[11]|max_length[11]');
		$this->form_validation->set_rules('txtMaterial[]','Material','required');
		$this->form_validation->set_rules('txtBatch[]','Batch Number','required|numeric|min_length[8]|max_length[8]');
		$this->form_validation->set_rules('txtQty[]','Quantity','required|numeric');
		$this->form_validation->set_rules('txtUnit[]','Unit of Material','required');
		$this->form_validation->set_rules('txtDestination[]','Destination','required');
		$this->form_validation->set_rules('txtReplaceWith[]','Container Replace with','required');

		$this->form_validation->set_error_delimiters('<div style="color: red;">', '</div>');
	}

	function ajaxRead()
	{
		$this->load->module('mydatetime'); 
		$this->load->model('Tugmasters_mdl');

		$list = $this->Tugmasters_mdl->getDatatables();
	  $data = array();
		$no = $_POST['start'];

		foreach ($list as $row) {

			///LINKS
			$shift = substr($row->Shift, 0, 3);
			$detail = base_url()."tugmasters/viewDetail/".$row->Req_id;
            $edit = base_url()."tugmasters/modify/".$row->Req_id;     
            $delete = base_url()."tugmasters/delete/".$row->Req_id;

			$buttons = '
				<div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      Options
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="'.$detail.'"><i class="fa fa-eye"></i> Detail</a>
                      <a class="dropdown-item" href="'.$edit.'"><i class="fa fa-edit"></i> Edit</a>
                      <a class="dropdown-item" href="'.$delete.'" onclick="return confirm(\'Are you sure you want to delete this data?\');"><span class="fa fa-trash-o"></span> Delete</a>
                      <div class="dropdown-divider"></div>
                    </div>
                  </div>
                </td>
    		';
    		$no++;
			$html = array();
	    	$html[] = $row->Req_id;
	    	$html[] = $row->Request_dtm;
	    	$html[] = '<p style="text-align: left">'.$row->Request_by.' ('.$row->Team.'/'.$shift.')'.'</p>';
	    	$html[] = $row->Bay_no;
	    	$html[] = '<p style="text-align: left">'.$row->Container_no.'</p>';
	    	$html[] = '<p style="text-align: left">'.$row->Material.' '.$row->Batch.'</p>';
	    	$html[] = $row->Qty.' '.$row->Unit;
	    	$html[] = '<p style="text-align: left">'.$row->Destination.'</p>';
	    	$html[] = '<p style="text-align: left">'.$row->Replace_with.'</p>';
	    	$html[] = $buttons;

	      	$data[] = $html;
	    }

		$output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->Tugmasters_mdl->totalRows(),
          "recordsFiltered" => $this->Tugmasters_mdl->countDatatables(),
          "data" => $data
        );

	    echo json_encode($output);
	}

	function print($requestID)
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$this->load->model(array('Tugmasters_mdl', 'Commons_mdl'));

		$sqlTugmaster = '
    		SELECT *, tm.Req_id as ID
    		FROM tbl_tugmasters tm
    		JOIN tbl_account ac ON ac.Usr_id = tm.Request_by  
    		WHERE tm.Req_id = '.$requestID.'
		';
    	$data['dtaTugmaster'] = $this->Tugmasters_mdl->_customQuery($sqlTugmaster)->row();

    	$sqlDataItems = '
			SELECT *
			FROM tbl_tugmasters_det as td
			LEFT JOIN tbl_tugmasters as tm ON tm.Req_id = td.Req_id
			WHERE td.Req_id = '.$requestID.'
    	';

    	$data['dtItems'] = $this->Commons_mdl->customQuery($sqlDataItems);
    	$data['title'] = "Tugmasters Request";

    	$this->load->view('v_print2', $data);
	}

	function viewDetail($requestID)
    {
    	$this->load->module('site_security');
    	$this->load->model('Tugmasters_mdl');
    	$this->load->model('Commons_mdl');

    	$sqlTugmaster = '
    		SELECT *, tm.Req_id as ID
    		FROM tbl_tugmasters tm
    		JOIN tbl_account ac ON ac.Usr_id = tm.Request_by  
    		WHERE tm.Req_id = '.$requestID.'
		';
    	$data['dtaTugmaster'] = $this->Tugmasters_mdl->_customQuery($sqlTugmaster)->row();
    	// $x = $this->db->last_query();
    	// echo "<pre>";
    	// print_r ($data['dtaTugmaster']);
    	// echo "</pre>";die();

    	$sqlDataItems = '
			SELECT *
			FROM tbl_tugmasters_det as td
			LEFT JOIN tbl_tugmasters as tm ON tm.Req_id = td.Req_id
			WHERE td.Req_id = '.$requestID.'
    	';

    	$data['dtItems'] = $this->Commons_mdl->customQuery($sqlDataItems);

   //  	$mysql = "
			// SELECT
			// td.*,tm.*,
			// td.uid as detail_id
			// FROM
			// tbl_tugmasters_det as td
			// LEFT JOIN tbl_tugmasters as tm ON tm.uid = td.Request_no
			// WHERE
			// tm.uid = '$requestID'
   //  	";
   //  	$data['dtaTugmasterDet'] = $this->Tugmasters_mdl->_customQuery($mysql);
    	// $qry = $data['qryContrDetail'];
    	// echo "<script>console.log(".$qry.")</script>";//die();
  		// $sqlx = $this->db->last_query();
		// echo $sqlx;die();

    	$data['loginID'] = $this->site_security->_get_user_id();
    	$data['requestID'] = $requestID;//$this->uri->segment(3);
    	$data['headline'] = "Tugmasters Detail View";

		$data['flashMsg'] = $this->session->flashdata('flashMsg');
		$data['view_module'] = "tugmasters";
		$data['view_file'] = "v_detail";
		// $data['show_modal'] = "tugmasters/frm_modify";
		$data['js_file'] = "tugmasters/js_tugmasters";
		echo Modules::run('templates/admin_2', $data);
    }

    function ajaxActDetail($action = null)
    {
    	// MODULES, LIBs, MODELS:
    	$this->load->module('site_security'); 
    	$this->load->module('mydatetime'); 
		$this->load->model('Tugmasters_mdl');

    	// VARIABLES:
    	$reqNo = $this->input->post('requestID');

    	if($action == 'read'){
    		// die();
    		// echo "Read";
    		$mysql = '
				SELECT
				*, td.uid as itemID
				FROM
				tbl_tugmasters_det as td
				LEFT JOIN tbl_tugmasters as tm ON tm.uid = td.Request_no
				WHERE
				td.Request_no = '.$reqNo.'
	    	';

	    	$dataTable = $this->Tugmasters_mdl->_customQuery($mysql);
	    	// $r = $this->db->last_query();die($r);
	    	if($dataTable->num_rows() <= 0){
	    		$output['isSuccess'] = false;
	    		$output['msg'] = 'Data empty';
	    		$output['data'] = [];
	    	}
	    	else{
	    		foreach ($dataTable->result() as $key => $value) {
	    			// $sn = $sn + 1;
		            $itemID = $value->itemID;
		    		//Utk Button:
		    		$buttons = '
						<a onclick="edit(parseInt('.$itemID.'))" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i>
						</a>					
						<a href="'.base_url().'tugmasters/detail/delete/'.$itemID.'" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i>
						</a>
		    		';
		    		$output['isSuccess'] = true;
		    		$output['msg'] = 'Datatable generated'.$reqNo;
		    		$output['data'][$key] = array(
		                $value->Bay_no,
		                $value->Container_no,
		    			$value->Material.' '.$value->Batch,
		    			$value->Qty.' '.$value->Unit,
		    			$value->Destination,
		    			$value->Replace_with,
		    			$value->Notes,
		    			$buttons
		    		);
	    		}
	    	}
    	}

    	elseif ($action == 'create') {
    		echo "Create";
    	}

    	elseif ($action == 'edit') {
    		echo "Create";
    	}

    	elseif ($action == 'update') {
    		echo "Create";
    	}

    	echo json_encode($output);
		}
		
		function _getRequestID($reqDate, $shiftTime)
    {
			// FORMAT Request ID is yymmddSXX (200923101,200923102,200923203,..) = 9 digits
			// S => Shift morning = 1
			// S => Shift night = 2
			// CONTOH:
			// $reqDate = "2020-09-23 21:08:55";
			// $shiftTime = 1;
			// Y-m-d = 2020-10-12
			// y-m-d = 20-10-12

    	$date = date('ymd', strtotime($reqDate));

			$shift = $this->_getShiftTime($shiftTime);// Morning or Night

			// GET Max num from DB for certain Date,Mont,Year and Shift-time
			$sql='
				SELECT sn
				FROM tbl_tugmasters
				WHERE DATE_FORMAT(Request_dtm, "%y%m%d") = '.$date.' AND Shift = "'.$shift.'"
			';
			$this->load->model('Tugmasters_mdl');
			$totRows = $this->Tugmasters_mdl->_customQuery($sql)->num_rows();
			if($totRows > 0){
				$nextRow = $totRows + 1;
			}else{
				$nextRow = 1;
			}

			$sn = str_pad($nextRow, 2, 0, STR_PAD_LEFT);
			$reqID = $date.$shiftTime.$sn;
			
			// echo $reqID;
			return $reqID;
    }

    function x_getSupervisor()
    {
    	$this->load->model('Commons_mdl');
		$data = $this->Commons_mdl->getData('tbl_account', ['Position' => 'Shift Controller'], 'uid ASC');
		// print_r($data->result());
		return $data;
		}
		
		function _getSupervisor()
    {
			$this->load->model('Tugmasters_mdl');
			$sql = 'SELECT * FROM tbl_account WHERE Position = "Shift Controller"';
			$data = $this->Tugmasters_mdl->_customQuery($sql);
			// print_r($data->result());
			return $data;
    }

    function _getShiftTime($shiftCode)
    {
    	if($shiftCode == 1){
			$shiftTime = 'Morning';
		}elseif($shiftCode == 2){
			$shiftTime = 'Night';
		}

		return $shiftTime;
    }

    function _save_data_detail($dataArray)
	{
		$this->load->model('Tugmasters_mdl');
		// $postedDataDetail = array(
		// 	'Request_no'	=> $reqID,
		// 	'Bay_no'		=> $this->input->post('txtBayNum',TRUE),
		// 	'Container_no'	=> $this->input->post('txtContrNum',TRUE),
		// 	'Material'		=> $this->input->post('txtMaterial',TRUE),
		// 	'Batch'			=> $this->input->post('txtBatch',TRUE),
		// 	'Qty'			=> $this->input->post('txtQty',TRUE),
		// 	'Unit'			=> $this->input->post('txtUnit',TRUE),
		// 	'Destination'	=> $this->input->post('txtDestination',TRUE),
		// 	'Replace_with'	=> $this->input->post('txtReplaceWith',TRUE),
		// 	'Notes'			=> $this->input->post('txtNotes',TRUE),
		// );
		extract($dataArray);
		$totData = count($Bay_no);//var_dump($totData);die();

		for ($i=0; $i < $totData; $i++) { 
			$eachData = array(
				'Req_id' => $Req_id,
				'Bay_no' => $Bay_no[$i],
				'Container_no' => $Container_no[$i],
				'Material' => $Material[$i],
				'Batch' => $Batch[$i],
				'Qty' => $Qty[$i],
				'Unit' => $Unit[$i],
				'Destination' => $Destination[$i],
				'Replace_with' => $Replace_with[$i],
				'Notes' => $Notes[$i]
			);

			// $this->Tugmasters_mdl->insert($eachData);
			$this->db->insert('tbl_tugmasters_det', $eachData);
		}
	}

}
