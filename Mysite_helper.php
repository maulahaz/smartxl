<?php

function make_pagination($pagination_data){
    // Note : to make this function work, it should have pagination_data like:
    // $target_url, $tot_rows, $offset_segment, $limit

    $target_url = $pagination_data['target_url'];
    $tot_rows = $pagination_data['tot_rows'];
    $offset_segment = $pagination_data['offset_segment'];
    $limit = $pagination_data['limit'];
    // echo $target_url;die();

    $this->load->library('pagination');

    $config['base_url'] = $target_url;
    $config['total_rows'] = $tot_rows;		

    $config['uri_segment'] = $offset_segment;

    $config['per_page'] = $limit;
    // $config['num_links'] = 10;
    $config['num_links'] = floor($config['total_rows'] / $config['per_page'] );

    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
    $config['full_tag_close']   = '</ul></nav></div>';

    $config['attributes'] = ['class' => 'page-link'];
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);

    $mhz_pagination =  $this->pagination->create_links();
    return $mhz_pagination;
}

?>