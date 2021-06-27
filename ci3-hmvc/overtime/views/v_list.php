<!-- PHP HELPER -->
<!-- ============================================================== -->


<!-- CUSTOM STYLING -->
<!-- ============================================================== -->
<style>
table th,td { text-align : center}
#btn_add {
  color: #fff;
}
#btn_print {
  color: #000;
}
#btn_add:hover {
  background-color: blue;
}
</style>

<!-- CONTENT -->
<!-- ============================================================== -->
<div class="page-title">
  <div class="title_left">
    <h3><?= $page_title; ?></h3>
  </div>
  <!-- <div class="title_right">
    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">Go!</button>
        </span>
      </div>
    </div>
  </div> -->
</div>
<div class="clearfix"></div>
<div class="msgbox"></div>
<?= (isset($flashMsg)) ? $flashMsg : null ;?>
<?= (isset($errorMsg)) ? $errorMsg : null ;?>

<div class="row" style="display: block;">
  <div class="col-md-12 col-sm-12">
    <div class="x_panel">
      <div class="x_title">
        <!-- <h2>Sub Title</h2> -->
        <a href="<?=base_url('overtime/modify')?>" class="btn btn-primary btn-sm" id="btn_add_xxx"><i class="fa fa-plus-circle"></i> Add</a>

        <ul class="nav navbar-right panel_toolbox">
          <li>&nbsp;</li>
          <li><a href="#" class="btn btn-warning btn-sm" id="btn_print"><i class="fa fa-print"></i> Print</a></li>
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
<!-- Search Start -->
<!-- ================================================================================  -->
      <!--  -->
    <form id="frm_filter" class="form-horizontal">
      <div class="col-md-6 pull-left">
        <div class="input-group input-daterange">

          <input type="text" id="start_date" class="form-control date-range-filter myDatepicker" placeholder="Filter Overtime from:">

          <div class="input-group-addon">to</div>

          <input type="text" id="end_date" class="form-control date-range-filter myDatepicker">

        </div>
      </div>
      <!--  -->

      <div class="col-md-4">
            <input type="button" name="btn_filter_bydate" id="btn_filter_bydate" value="Filter" class="btn btn-info btn-sm" />
            <input type="button" name="btn_reload" id="btn_reload" value="Reload" class="btn btn-secondary btn-sm" />
      </div>
    </form>
<!-- Search End -->
<!-- ================================================================================  -->

        <!-- Responsive With Wrapping -->
        <!-- <table id="my_table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"> -->
        
        <!-- Responsive WITHOUT Wrapping -->
        <table id="my_table" class="table table-striped table-sm table-bordered dt-responsive" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>OT From</th>
              <th>OT To</th>
              <th>OT Type</th>
              <th>Reason</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- SHOW MODAL -->
<!-- ============================================================== -->
<!-- <?php if(isset($show_modal)){ $this->load->view($show_modal); } ?> -->

<!-- SHOW MODAL : Print option-->
<!-- ============================================================== -->
<?php 
include 'frm_print_tab.php';
?>
