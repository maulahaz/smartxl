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
        <a href="<?=base_url('keyreg/modify')?>" class="btn btn-primary btn-sm" id="btn_add_xxx"><i class="fa fa-plus-circle"></i> Add</a>

        <ul class="nav navbar-right panel_toolbox">
          <li>&nbsp;</li>
          <li><a href="#" class="btn btn-warning btn-sm" id="btn_print"><i class="fa fa-print"></i> Print</a></li>
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        
        <!-- Responsive With Wrapping -->
        <!-- <table id="my_table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"> -->
        
        <!-- Responsive WITHOUT Wrapping -->
        <table id="my_table" class="table table-striped table-sm table-bordered dt-responsive" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Key Type</th>
              <th>Reason</th>
              <th>Taken date</th>
              <th>Taken By</th>
              <th>Returned date</th>
              <th>Returned By</th>
              <th>Notes</th>
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
<?php if(isset($show_modal)){ $this->load->view($show_modal); } ?>
