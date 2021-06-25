<?php  
	$this->load->module('mydatetime');

	//-To view Flash Message
	if(isset($flash)){ echo $flash; }

?>

<!-- <section class="box-typical box-typical-max-280 scrollable"> -->
<section class="box-typical">	
	<header class="box-typical-header">
		<div class="tbl-row">
			<div class="tbl-cell"><!-- class="tbl-cell tbl-cell-title" -->
				<h3><?= $page_title ?></h3>
				<h5>
					<?php  
						// Notifikasi error on Form Validation
						echo validation_errors();
					?>
				</h5>
				<div class="msgbox"></div>
			</div>
			
		</div>
		<div class="input-daterange">
			<!-- <div class="tbl-cell tbl-cell-action-bordered pull-right"> -->
			<div class="tbl-cell pull-right">
				<button type="button" class="action-btn" id="btnAdd" data-toggle="tooltip" data-placement="top" title="Register"><a href="#"><i class="font-icon font-icon-plus"></i> Register</a></button>
			</div>
		</div>
	</header>
		<section class="card">
			<div class="card-block">
				<table id="tbl_manage" class="display table table-bordered" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th>#</th>
						<th>Emp.ID</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Emirate ID</th>
						<th>Scr. Date</th>
						<th>Note</th>
						<th>Options</th>
					</tr>
					</thead>
				</table>
			</div>
		</section>

</section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="modal-title">Modal Title</h5>
      </div>
      <div class="modal-body" id="modal-msg"></div>
      <!-- <form id="myForm" action="action" class="form-horizontal" method="post" role="form"> -->
      <form id="myForm" role="form">
      <div class="modal-body" id="form-body">
      	<input type="hidden" name="inpUID" id="inpUID">
      	<div class="form-group">
		    <label>Employee ID</label>
		    <input class="form-control" type="text" name="inpEmpID" id="inpEmpID" data-parsley-trigger="keyup" data-parsley-pattern="^(brw)\d{5}$" placeholder="brwXXXXX" required>
		</div>
		<div class="form-group">
		    <label>Name</label>
		    <input class="form-control"  type="text" name="inpName" id="inpName" data-parsley-trigger="keyup" required>
		</div>
		<div class="form-group">
		    <label>Emirate ID</label>
		    <input type="text" class="form-control"  name="inpEmirateID" id="inpEmirateID" data-parsley-length="[18, 18]" required>
		</div>
		<div class="form-group">
		    <label>Phone</label>
		    <input type="number" class="form-control" name="inpPhone" id="inpPhone" data-parsley-length="[10, 10]" required>
		</div>
		<div class="form-group">
		    <label>Department</label>
		    <select name="optDept" id="optDept" size='1' class="form-control" required>
		      <option value="">--Select--</option>
		      <?php 
		      // $optData = array('--Select--', 'Ada', 'Order', 'Kosong'); 
		      ?>
		      <?php foreach($optDepartment->result() as $row): ?>
			  <option value="<?= $row->Dept_code ?>"><?= $row->Department ?></option>
			  <?php endforeach; ?>
		    </select>
		</div>
		<div class="form-group">
		    <label>Screening Date</label>
		    <select name="optScrDate" id="optScrDate" size='1' class="form-control" required>
		      <option value="">--Select--</option>
		      <?php 
		      // $optData = array('--Select--', 'Ada', 'Order', 'Kosong'); 
		      // 
		      ?>
		      <?php foreach($count_screening_sched->result() as $row): ?>
	      	  <?php  $sc_date = $this->mydatetime->get_nice_date($row->ScreeningDate, "mydate"); ?>
			  <option value="<?= $row->ScreeningDate ?>"><?= $sc_date."  (".$row->Registered." person Registered)" ?></option>
			  <?php endforeach; ?>
		    </select>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary" name="btnSubmit" id="btnSubmit" value="Submit" onclick="save()">Submit</button> -->
        <button type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" value="Submit">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>