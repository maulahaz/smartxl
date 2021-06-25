<?php  
	$this->load->module('mydatetime');

	//-To view Flash Message
	if(isset($flash)){ echo $flash; }

	$frmLoc_actionSearch = base_url('screening/list');
	$frmLoc_actionPrint = base_url('screening/printing');
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

			<form action="<?= $frmLoc_actionSearch; ?>" method="post">
			<div class="col-md-1">
				Search :
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<div class='input-group date datepicker_only'>
						<input type='text' class="form-control" name="txtDatetimeFrm" id="txtDatetimeFrm" placeholder="Date and Time From"/>
						<span class="input-group-addon">
							<i class="font-icon font-icon-calend"></i>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<div class='input-group date datepicker_only'>
						<input type='text' class="form-control" name="txtDatetimeTo" id="txtDatetimeTo" placeholder="Date and Time To"/>
						<span class="input-group-addon">
							<i class="font-icon font-icon-calend"></i>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-3">
			<!-- <div class="tbl-cell pull-left"> -->

				<button type="submit" class="btn btn-default" name="submit" value="Refresh"><i class="fa fa-refresh"></i> </button>

				<!-- Search Button -->
				<button type="submit" class="btn" name="submit" value="Search" data-toggle="tooltip" data-placement="top" title="Search"><i class="fa fa-search"></i> </button>

				<!-- Printing Button -->
				<button type="button" class="btn" name="btnPrintReport" id="btnPrintReport" value="Print" data-toggle="modal" data-target="#modCDO">
					<span class="tags" data-toggle="tooltip" data-placement="top" title="Print">
					<i class="fa fa-print"></i> 
					</span>
				</button>	
			<!-- </div> -->
			</div>
			</form>
			<!-- <div class="tbl-cell tbl-cell-action-bordered pull-right"> -->
			<div class="tbl-cell pull-right">
				<button type="button" class="action-btn" id="btnAdd" data-toggle="tooltip" data-placement="top" title="Register"><a href="#"><i class="font-icon font-icon-plus"></i> Register</a></button>
			</div>
		</div>
	</header>
		<table id="myTable" class="table table-bordered table-hover table-xs">
			<thead>
			<tr>
				<th>#</th>
				<th>Emp.ID</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Emirate ID</th>
				<th>Scr. Date</th>
				<th>Note</th>
				<th class="text-center">Action</th>
			</tr>
			</thead>
			<tbody>
                <?php  
                if ($qryScreen->num_rows() > 0 ) {
                	// $sn = 1;
                    ($offset < 1) ? $sn = 1 : ($sn = $offset + 1) ; //<-- Numbering due to Pagination
                    foreach ($qryScreen->result() as $row) {
                    $date = $this->mydatetime->get_nice_date($row->Screen_dt,'mydate');                   
                ?>
                <tr>
                    <td><?= $sn++ ?></td>
                    <td><?= $row->Emp_id ?></td>
                    <td><?= $row->Name ?></td>
                    <td><?= $row->Phone ?></td>
                    <td><?= $row->Emirate_id ?></td>
                    <td><?= $date ?></td>                       
                    <td><?= $row->Note ?></td>                    
                    <td class="text-center" style="width: 25px">
						<div class="btn-group">
							<button type="button" class="btn btn-sm btn-inline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a href="javascript:;" class="dropdown-item" onclick="edit(<?= $row->uid ?>)">Edit</a>
								<a href="javascript:;" class="dropdown-item" onclick="del(<?= $row->uid ?>)">Delete</a>
							</div>
						</div>
                    </td>                                    
                </tr>
                <?php 
            		} 
            	} else{
            	?> 
            	<td colspan="8" class="text-center">Data not available</td>
            	<?php } ?>                                                                   
              </tbody>
		</table>
		<?= $halamanku; ?>
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
