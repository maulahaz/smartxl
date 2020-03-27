<?php

class Ourteams extends MX_Controller {
	function __construct(){
		parent ::__construct();
	}

	function index(){
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();
		
		redirect('ourteams/manage');
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

	function manage(){
		$this->load->module('site_security');
		// $this->site_security->_make_sure_logged_in();
		$this->site_security->_make_sure_is_admin();
		// $page_mode = "name_card";

		$this->load->module('halaman');
		
		$page_mode = "name_list";

		$limit = $this->get_limit();
		$offset = $this->get_offset();

		$pagination_data['target_url'] = base_url('ourteams/manage');
		$pagination_data['tot_rows'] = $this->count_where('usr_status',1);
		$pagination_data['offset_segment'] = 3;
		$pagination_data['limit'] = $limit;
		// echo $pagination_data['tot_rows'];die();
		$data['halamanku'] = $this->halaman->bs4_pagination($pagination_data);

		$mysql_query = "SELECT * from tbl_user WHERE usr_status=1 ORDER BY usr_Name ASC LIMIT $offset, $limit";
		$data['team_data'] = $this->_custom_query($mysql_query);		

		$data['page_title'] = "Ourteam - SmartXL";
		$data['page'] = $offset;
		$data['view_module'] = "ourteams";
		if($page_mode == "name_card"){
			$data['view_file'] = "manage2";
		}else{
			$data['view_file'] = "manage";
		}
		$data['local_js'] = "ourteams_js";
		// $this->load->view('template', $data);
		
		$this->load->module('templates');
		$this->templates->blank_top_menu($data);
	}

	function manage_2(){
		$this->load->module('site_security');
		// $this->site_security->_make_sure_logged_in();
		$this->site_security->_make_sure_is_admin();
		// $page_mode = "name_card";
		$page_mode = "name_list";

		$post = $this->input->post(null, true);
		if(isset($post['btnSearch'])){
			if($post['cboSearch'] == ""){
				$data['team_data'] = $this->data_by_search_gen($post['txtSearch']);
			}else{
				$data['team_data'] = $this->data_by_search($post['cboSearch'],$post['txtSearch']);
			}			
		}else{
			$mysql_query = "SELECT * from tbl_user WHERE usr_status=1 ORDER BY usr_Name ASC";
			$data['team_data'] = $this->_custom_query($mysql_query);		
		} 

		$data['view_module'] = "ourteams";
		if($page_mode == "name_card"){
			$data['view_file'] = "manage2";
		}else{
			$data['view_file'] = "manage";
		}
		
		$this->load->module('templates');
		$this->templates->blank_top_menu($data);
	}

	function manage_tbl_vw(){
		$this->load->module('site_security');
		$this->site_security->_make_sure_logged_in();

		$mysql_query = "SELECT * from tbl_user WHERE usr_status=1 ORDER BY usr_Name ASC";
		$data['team_data'] = $this->_custom_query($mysql_query);

		$data['view_module'] = "ourteams";
		$data['view_file'] = "manage";
		$this->load->module('templates');
		$this->templates->blank($data);
	}

	function search(){
		// $this->form_validation->set_rules('search_it','Search box','required');
		$search_by2 = $this->input->post('search_by', TRUE);
		$data['search_it'] = $this->input->post('search_it', TRUE);
		// print_r($search_by2);print_r($search_it);die;
		// if($this->form_validation->run() == FALSE){
			
		// 	echo validation_errors();	
		// 	die();
		// }else{
			if($search_by2 == ""){
				// echo "blank";die();
				$data['team_data'] = $this->data_by_search_gen($data['search_it']);

			} else{
				// echo "isi";die();
				$data['team_data'] = $this->data_by_search($search_by2,$data['search_it']);
			}
		// }
			$data['tot_data'] = $data['team_data']->num_rows();

		$data['view_module'] = "ourteams";
		$data['view_file'] = "manage2";
		$this->load->module('templates');
		$this->templates->blank($data);
	}

	function fetch_data_from_post(){
		$data['item_title'] = $this->input->post('item_title', TRUE);
		$data['item_price'] = $this->input->post('item_price', TRUE);
		$data['was_price'] = $this->input->post('was_price', TRUE);
		$data['item_desc'] = $this->input->post('item_desc', TRUE);
		return $data;
	}

	function fetch_data_from_db($update_id){
		$qry = $this->get_where($update_id);
		foreach ($qry->result() as $row) {
			$data['item_title'] = $row->item_title;
			$data['item_price'] = $row->item_price;
			$data['was_price'] = $row->was_price;
			$data['item_desc'] = $row->item_desc;
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

	function get($order_by){
		$this->load->model('ourteams_mdl');
		$query = $this->ourteams_mdl->get($order_by);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by){
		$this->load->model('ourteams_mdl');
		$query = $this->ourteams_mdl->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	function get_where($id){
		$this->load->model('ourteams_mdl');
		$query = $this->ourteams_mdl->get_where($id);
		return $query;
	}

	function get_where_custom($col, $value){
		$this->load->model('ourteams_mdl');
		$query = $this->ourteams_mdl->get_where_custom($col, $value);
		return $query;
	}

	function get_with_double_condition($col1, $value1, $col2, $value2){
		$this->load->model('ourteams_mdl');
		$query = $this->ourteams_mdl->get_with_double_condition($col1, $value1, $col2, $value2);
		return $query;
	}

	function data_by_search($search_by,$search_it){
		$this->load->model('ourteams_mdl');
		$query = $this->ourteams_mdl->data_by_search($search_by,$search_it);
		return $query;
	}

	function data_by_search_gen($search_it){
		$this->load->model('ourteams_mdl');
		$query = $this->ourteams_mdl->data_by_search_gen($search_it);
		return $query;
	}

	function test_search($arr_search_by){
		$arr_search_by = array('usr_ID', 'usr_Name', 'usr_Position', 'usr_Phone1');
		foreach ($arr_search_by as $src) {
			if($dt == $uom){
				echo '<option value="'.$dt.'" selected="selected">'.$dt.'</option>';
			} else{
				echo '<option value="'.$dt.'">'.$dt.'</option>';
			}
		}


		$this->load->model('ourteams_mdl');
		$query = $this->ourteams_mdl->test_search($arr_search_by);
		return $query;
	}	

	function _insert($data){
		$this->load->model('ourteams_mdl');
		$this->ourteams_mdl->_insert($data);
	}

	function _update($id, $data){
		$this->load->model('ourteams_mdl');
		$this->ourteams_mdl->_update($id, $data);
	}

	function _delete($id){
		$this->load->model('ourteams_mdl');
		$this->ourteams_mdl->_delete($id);
	}

	function count_where($column, $value){
		$this->load->model('ourteams_mdl');
		$count = $this->ourteams_mdl->count_where($column, $value);
		return $count;
	}

	function get_max(){
		$this->load->model('ourteams_mdl');
		$max_id = $this->ourteams_mdl->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query){
		$this->load->model('ourteams_mdl');
		$query = $this->ourteams_mdl->_custom_query($mysql_query);
		return $query;
	}
}