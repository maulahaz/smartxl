<?php 
	if(isset($flash)){
		echo $flash;
	}

	$create_page_url = base_url()."charging/create";

	$this->load->module('mydatetime');
?>

<h1><?= $header; ?></h1>
<div class="row">
	
	<div class="col">
		<a href="<?php echo base_url('charging/create') ;?>"> <button type="button" class="btn btn-inline btn-primary btn-sm ladda-button" style="margin-bottom: 20px;">+ Add New Data</button></a>
		
	</div>

</div>
<!-- === -->



<!-- ==== -->

<!-- Table -->

	<table id="table-sm" class="table table-bordered table-hover table-sm">
		<thead>
		<tr>
			<th width="1" style="text-align: center;">
				#
			</th>
			<th style="text-align: center;">Charge Date</th>
			<th style="text-align: center;">Material</th>
			<th style="text-align: center;">Qty</th>
			<th style="text-align: center;">UOM</th>
			<th style="text-align: center;">Lot Num</th>
			<th style="text-align: center;">Charge By</th>
			<th style="text-align: center;">Charge To</th>
			<th style="text-align: center;">Notes</th>
			<th style="text-align: center;">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php

	$sn = $page + 1;
	foreach ($data_det->result() as $row){
		$edt_uid = base_url()."charging/create/".$row->uid;
		// $del_uid = base_url()."charging/del/".$row->uid;
		$del_uid = base_url()."charging/delconf/".$row->uid;
		$my_date = $this->mydatetime->get_nice_date($row->charging_dt,'mydate')	;
		// $my_date = $this->mydatetime->get_nice_date_str($row->charge_date,'mydate')	;
	?>
	<tr>
		<td><?= $sn++; ?></td>
		<td><?= $my_date ?></td>
		<!-- <td><?= $row->charge_date; ?></td> -->
		<td><?= $row->material; ?></td>
		<td><?= $row->qty; ?></td>
		<td><?= $row->uom; ?></td>
		<td><?= $row->lotnum; ?></td>
		<td><?= $row->charge_by; ?></td>
		<td><?= $row->charge_to; ?></td>
		<td><?= $row->notes; ?></td>
		<td style="text-align: center; vertical-align: middle;" >
			<a href="<?= $edt_uid ?>" class="btn btn-success btn-sm ladda-button"><span class="fa fa-edit"></span></a>
			<a href="<?= $del_uid ?>" class="btn btn-danger btn-sm ladda-button"><span class="fa fa-trash-o"></span></a>
			<!--With confirmation 
				<a href="<?= $del_uid ?>" onclick="return confirm('Sure to delete this data ?')" class="btn btn-danger btn-sm ladda-button"><span class="fa fa-trash-o"></span></a> 
			-->
		</td>
	</tr>			

	<?php
	}
	?>
		</tbody>
	</table>
	<?= $halamanku; ?>
	