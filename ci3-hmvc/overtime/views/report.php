<?php  
	$this->load->module('mydatetime');
?>

<!-- <section class="box-typical box-typical-max-280 scrollable"> -->
<section class="box-typical">	
	<header class="box-typical-header">
		<div class="tbl-row">
			<div class="tbl-cell"><!-- class="tbl-cell tbl-cell-title" -->
				<h3><?= $page_title ?></h3>
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