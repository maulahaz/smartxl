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
			</div>
		</div>
		<div class="input-daterange">
			<div class="col-md-3">
				<a href="javascript:window.history.go(-1);" class="btn btn-default">BACK</a>
			</div>

			<div class="tbl-cell pull-right">
				<!-- Form -->
				<form action="<?= base_url('cdo/make_pdf');?>" method="post">
					<input type="hidden" name="inpMonth" value="<?= $month;?>">
					<input type="hidden" name="inpYear" value="<?= $year;?>">
				<button type="submit" class="btn" name="btnPrintPDF" id="btnPrintPDF">
					<span class="tags" data-toggle="tooltip" data-placement="top" title="Print to PDF">
					<i class="fa fa-print"></i> 
					</span>
				</button>
				<!-- Export to Excel Button -->
				<button type="button" class="btn" name="btnExcel" id="btnExcel">
					<span class="tags" data-toggle="tooltip" data-placement="top" title="Export to Excel">
					<i class="fa fa-file-excel-o"></i> 
					</span>
				</button>
				</form>
			</div>
		</div>
	</header>
		<table id="table-xs" class="table table-bordered table-hover table-xs">
			<thead>
			<tr>
				<th>Date</th>
				<th>CDO Type</th>
				<th>Date From</th>
				<th>Date To</th>
				<th>Reason</th>
				<th>Note</th>
			</tr>
			</thead>
			<tbody>
			<?php  
			if($qryCDO->num_rows() > 0){
				foreach ($qryCDO->result() as $row) { 
			?>
				<tr>
					<td class="text-center"><?= $row->Tgl ?></td>
					<td class="text-center"><?= ($row->Type !="") ? $row->Type : "-" ?></td>
					<td class="text-center"><?= ($row->Datetime_frm !="") ? $this->mydatetime->get_nice_date($row->Datetime_frm,'overtime') : "-"; ?></td>
					<td class="text-center"><?= ($row->Datetime_to !="") ? $this->mydatetime->get_nice_date($row->Datetime_to,'overtime') : "-"; ?></td>
					<td><?= $row->Reason ?></td>
					<td><?= $row->Note ?></td>
				</tr>
	
				<?php } ?>
			</tbody>
			<tfooter>
				<td colspan="4" class="text-center">Total</td>
				<td class="text-center">Earn : xx</td>
				<td class="text-center">Redeem : xx</td>
			</tfooter>
			<?php } else {  ?>
				<td colspan="6" class="text-center">Record not found</td>
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