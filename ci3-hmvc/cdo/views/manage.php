<?php  
	$this->load->module('mydatetime');

	//-To view Flash Message
	if(isset($flash)){ echo $flash; }

	$frmLoc_actionSearch = base_url('cdo/manage');
	$frmLoc_actionPrint = base_url('cdo/printing');
?>

<!-- <section class="box-typical box-typical-max-280 scrollable"> -->
<section class="box-typical">	
	<header class="box-typical-header">
		<div class="tbl-row">
			<div class="tbl-cell"><!-- class="tbl-cell tbl-cell-title" -->
				<h3><?= $page_title ?></h3>
				<h5>
					<?php  
						// Notifikasi error 
						echo validation_errors('<p style="color:red">','</p>');
					?>
				</h5>
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
				<button type="button" class="action-btn" data-toggle="tooltip" data-placement="top" title="Add New Record"><a href="<?=base_url()?>cdo/create"><i class="font-icon font-icon-plus"></i> Add New Record</a></button>
			</div>
		</div>
	</header>
		<table id="table-xs" class="table table-bordered table-hover table-xs">
			<thead>
			<tr>
				<th>#</th>
				<!-- <th>User ID</th> -->
				<th>CDO Type</th>
				<th>Date from</th>
				<th>Date to</th>
				<th>Days Num.</th>
				<th>Reason</th>
				<th>Note</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php  
			$sn = 1;
			if($qryCDO->num_rows() > 0){
				foreach ($qryCDO->result() as $row) { 
					$strDatetime = $row->Datetime_frm;
					$endDatetime = $row->Datetime_to;
					if($row->Type == "Earn"){
						//--Unix Timestamp Convert to Hour
						$difference = floor(($endDatetime - $strDatetime) / 3600);
						//--1 CDO >= 8hrs:
						$CDOnumDays = floor($difference / 8);	
						// $CDOnumDays = $difference;
					} 
					elseif ($row->Type == "Redeem") {
						//--Unix Timestamp Convert to Day 
						$difference = ($endDatetime - $strDatetime) / 86400;
						//--Add 1 day to get CDO num days:
						$CDOnumDays = $difference + 1;
					}

			?>
				<tr>
					<td class="text-center"><?= $sn++ ?></td>
					<!-- <td class="text-center"><?= $row->Usr_id ?></td> -->
					<td class="text-center"><?= $row->Type ?></td>
					<td class="text-center"><?php echo $this->mydatetime->get_nice_date($row->Datetime_frm,'overtime'); ?></td>
					<td class="text-center"><?php echo $this->mydatetime->get_nice_date($row->Datetime_to,'overtime'); ?></td>
					<td><?= $CDOnumDays.' days'; ?></td>
					<td><?= $row->Reason ?></td>
					<td><?= $row->Note ?></td>
					<td class="text-center">
						<a href="<?=base_url().'cdo/create/'.$row->uid; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

	                    <a href="<?=base_url().'cdo/delete/'.$row->uid; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Confirm ?');"><i class="fa fa-trash"></i></a>
						
					</td>
				</tr>
				<?php } ?>
				</tbody>
				<tfooter>
					<td colspan="6" class="text-center">Total</td>
					<td class="text-center">Earn : xx</td>
					<td class="text-center">Redeem : xx</td>
				</tfooter>				
			<?php } else{ ?>
				<td colspan="7" class="text-center">Record not found</td>
			<?php } ?>
				</tbody>
		</table>
</section>

<!-- Modal -->
<div class="modal fade" id="modCDO" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="modal-title">Generate Report</h5>
      </div>
      <div class="modal-body" id="modal-msg"></div>
      <form id="frmCDO" action="action" class="form-horizontal" method="post" role="form">
      <div class="modal-body" id="form-body">
      	<input type="hidden" name="inpUID" id="inpUID">
      	<div class="form-group">
		    <label>Year</label>
		    <select name="optYear" id="optYear" size='1' class="form-control" required>
		      <option value="">...Select Year...</option>
		      <option value="2019">2019</option>
		      <option value="2020">2020</option>		      				
		    </select>
		</div>
		<div class="form-group">
		    <label>Month</label>
		    <select name="optMonth" id="optMonth" size='1' class="form-control" required>
		      <option value="">...Select Month...</option>
		      <?php
			      for ($i = 0; $i < 12; $i++) {
			        $time = strtotime(sprintf('%d months', $i));   
			        $label = date('F', $time);   
			        $value = date('n', $time);
			        echo "<option value='$value'>$label</option>";
			      }
		      ?>
		    </select>
		</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btnSubmit_CDO" id="btnSubmit_CDO" value="Submit">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>	