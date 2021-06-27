<?php  

	$this->load->module('mydatetime');

	//-To view Flash Message
	if(isset($flash)){ echo $flash; }

	$frmLoc_actionSearch = base_url('overtime/read');
	$frmLoc_actionPrint = base_url('overtime/printing');
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

			<form action="<?= $frmLoc_actionSearch; ?>" method="post">
			<div class="col-md-1">
				Search :
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<div class='input-group date datepicker_only'>
						<input type='text' class="form-control" name="ot_date_from" id="ot_date_from" placeholder="Date and Time From"/>
						<span class="input-group-addon">
							<i class="font-icon font-icon-calend"></i>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<div class='input-group date datepicker_only'>
						<input type='text' class="form-control" name="ot_date_to" id="ot_date_to" placeholder="Date and Time To"/>
						<span class="input-group-addon">
							<i class="font-icon font-icon-calend"></i>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-3">
			<!-- <div class="tbl-cell pull-left"> -->

				<!-- Search Button -->
				<button type="submit" class="btn" name="submit" value="Search" data-toggle="tooltip" data-placement="top" title="Search"><i class="fa fa-search"></i> </button>

				<!-- Printing Button -->
				<button type="button" class="btn" name="print" value="Print" data-toggle="modal" data-target="#modalPrint">
					<span class="tags" data-toggle="tooltip" data-placement="top" title="Print">
					<i class="fa fa-print"></i> 
					</span>
				</button>	
			<!-- </div> -->
			</div>
			</form>
			<!-- <div class="tbl-cell tbl-cell-action-bordered pull-right"> -->
			<div class="tbl-cell pull-right">
				<button type="button" class="action-btn" data-toggle="tooltip" data-placement="top" title="Add New Record"><a href="<?=base_url()?>overtime/create"><i class="font-icon font-icon-plus"></i> Add New Record</a></button>
			</div>
		</div>
	</header>
		<table id="table-xs" class="table table-bordered table-hover table-xs">
			<thead>
			<tr>
				<th width="50" class="text-center">#</th>
				<th width="150" class="text-center">OT From</th>
				<th width="150" class="text-center">OT To</th>
				<th width="80" class="text-center">OT Type</th>
				<th>Reason</th>
				<th width="100" class="text-center">Action</th>
			</tr>
			</thead>
			<tbody>
			<?php  
			$sn = 1;
			if($ot_record->num_rows() > 0){
				foreach ($ot_record->result() as $row) { ?>
				<tr>
					<td class="text-center"><?= $sn++ ?></td>
					<td class="text-center"><?php echo $this->mydatetime->get_nice_date($row->ot_date_from,'overtime'); ?></td>
					<td class="text-center"><?php echo $this->mydatetime->get_nice_date($row->ot_date_to,'overtime'); ?></td>
					<td class="text-center"><?= $row->ot_category ?></td>
					<td><?= $row->ot_reason ?></td>
					<td class="text-center">
						<a href="<?=base_url().'overtime/create/'.$row->uid; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

	                    <a href="<?=base_url().'overtime/del/'.$row->uid; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Confirm ?');"><i class="fa fa-trash"></i></a>
						
					</td>
				</tr>
				<?php } ?>
			<?php } else{ ?>
				<td colspan="6" class="text-center">Record not found</td>
			<?php } ?>
			</tbody>
		</table>
</section>

<!-- Modal for Printing -->
<!-- Catatan: Trigger dari Button harus ber type: Button, Bukan Submit. Klo Submit, nanti modalnya gak akan muncul -->
<!-- Modal -->
<div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel">Print Data</h4>
      </div>
      <div class="modal-body">

        <form id="myForm" action="<?= $frmLoc_actionPrint; ?>" method="post" class="form-horizontal">
          <input type="hidden" name="txtUID" id="txtUID">
        	<div class="form-group">
		    <label for="txtBulan">Bulan</label>
		    <select class="form-control" name="txtBulan" id="txtBulan" size='1'>
                <?php
                for ($i = 0; $i < 12; $i++) {
                  $time = strtotime(sprintf('%d months', $i));   
                  // $time = $i; 
                  $label = date('F', $time);   
                  $value = date('n', $time);
                  echo "<option value='$value'>$label</option>";
                }
                ?>
            </select>
		  </div>
		  <div class="form-group">
		    <label for="txtTahun">Tahun</label>
		    <select class="form-control" name="txtTahun" id="txtTahun">
                <?php
                  for ($year = 2015; $year <= 2030; $year++) {
                    $time = strtotime($year);
                    $lblYear = date('Y', $time); 
                    $selected = (isset($lblYear) && $lblYear == $year) ? 'selected' : '';
                    echo "<option value=$year $selected>$year</option>";
                  }
                ?>
            </select>
		  </div>

                          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" id="submitPrint" name="submitPrint" value="Print" class="btn btn-primary">Print</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal End -->