<div class="container-fluid">
    <div class="row">
	
<?php $this->load->module('mydatetime');?>

<h1><?= $page_title; ?></h1>

<?php if(isset($flash)){ echo $flash; } ; ?>
<?php echo validation_errors("<p style='color: red;'>","</p>"); ?>

<div class="widget-content">
	<div class="controls pull-right">
		<button type="button" class="btn btn-inline btn-primary ladda-button" id="btnAdd_Keyreg"><span class="fa fa-plus"></span> Add New Data</button>
	</div>	
</div>
<div class="row">
	
</div>
<div class="widget-content" style="margin-bottom: 40px">
	<div class="controls pull-left">
		<!-- Filtering -->
		<!-- Show only Supv login , User Level = 2-->
	    <?php if($this->site_security->_get_user_level() >= 2) { ?>
		Filter by
	    <select name="optStatus" id="optStatus">
    	  <option value="">Select..</option>
	      <option value="Taken By">Taken By</option>
	      <option value="Key Type">Key Type</option>
	      <option value="Notes">Notes</option>
	    </select>
	    <input type="text" name="inpSearch" id="">
		<button type="button" class="btn btn-success btn-sm ladda-button" id="btnSearch_KeyregList"><span class="fa fa-search"></span> Search</button>

		<?php } ?>
	</div>	
</div>	



<table id="tblKeyreg" class="table table-bordered table-hover table-sm">
	<thead>
	<tr>
		<th width="3" style="text-align: center;">
			#
		</th>
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
	<tbody>
	<?php
	$sn = 1;
	if($qryKeyreg->num_rows() > 0){}
	foreach ($qryKeyreg->result() as $row){
	?>
	<tr>
		<td><?= $sn++; ?></td>
		<td>
			<ul class="list-unstyled">
				<li><?=($row->Key_type1 ? '<i class="glyphicon glyphicon-ok"></i>' : '<i class="glyphicon glyphicon-remove"></i>')?> : Eng. Key</li>
				<li> <?=($row->Key_type2 ? '<i class="glyphicon glyphicon-ok"></i>' : '<i class="glyphicon glyphicon-remove"></i>')?> : MOS Key</li>
				<li><?=($row->Key_type3 ? '<i class="glyphicon glyphicon-ok"></i>' : '<i class="glyphicon glyphicon-remove"></i>')?> : Oth Key</li>
			</ul>			
		</td>
		<td><?=$row->Reason ?></td>
		<!-- <td><?= $this->mydatetime->get_nice_date_str($row->Taken_dt, "overtime") ?></td> -->
		<td>
		<?php 
			if($row->Taken_dt == 0 || $row->Taken_dt == null){
				echo "No data";
			} else{
				$tkn = $this->mydatetime->get_nice_date_str($row->Taken_dt, "overtime");
				echo $tkn;
			}	
		?>
		</td>
		<td><?=$row->Taken_by ?></td>
		<td>
		<?php 
			if($row->Returned_dt == 0 || $row->Returned_dt == null){
				echo "No data";
			} else{
				$rtn = $this->mydatetime->get_nice_date_str($row->Returned_dt, "overtime");
				echo $rtn;
			}	
		?>
		</td>
		<!-- <td><?= $this->mydatetime->get_nice_date_str($row->Returned_dt, "overtime") ?></td> -->
		<td><?=$row->Returned_by ?></td>
		<td><?=$row->Notes ?></td>

		<td style="text-align: center; vertical-align: middle;" >

			<a href="<?= base_url('keyreg/edit') ?>" class="btn btn-warning btn-sm ladda-button" id="btnEdit_Keyreg" data-uid="<?= $row->uid;?>"><span class="fa fa-pencil"></span></a>            
			<a href="<?= base_url('keyreg/delete/').$row->uid ?>" class="btn btn-danger btn-sm ladda-button" id="btnDelete_Keyreg"><span class="fa fa-trash-o"></span></a>
		</td>
	</tr>			

	<?php
	}
	?>

	</tbody>
</table>


    </div><!--.row-->
</div><!--.container-fluid-->

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="modlKeyreg" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<form id="frmKeyreg" action="action" class="form-horizontal" method="post" role="form">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="modal-title">Modal title</h5>
      </div>
      <div id="modal-msg"></div>
      
      <div class="modal-body" id="form-body">
      		<input type="hidden" name="inpUID" id="inpUID">
		<!-- <div class="form-group">
		    <label for="inpTitle">Title</label>		    
		    <input type="text" class="form-control" name="inpTitle" id="inpTitle" placeholder="Etask Title">
	  	</div> -->
	  	<div class="form-group">
		    <label for="inpTitle">Key Usage Type</label>
		    &nbsp;&nbsp;&nbsp;<input type="checkbox" id="cbxEngkey" name="cbxEngkey" value="1">  Engineer Key
		    <br>
		    &nbsp;&nbsp;&nbsp;<input type="checkbox" id="cbxMoskey" name="cbxMoskey" value="1">  MOS Key
		    <br>
		    &nbsp;&nbsp;&nbsp;<input type="checkbox" id="cbxOthkey" name="cbxOthkey" value="1">  Other Key

	  	</div>
	  	<div class="form-group">
		    <label for="inpReason">Reason</label>
		    <textarea class="form-control" name="inpReason" id="inpReason" cols="30" rows="3"></textarea>
	  	</div>
	  	<div class="form-group">
		    <label for="inpTakenDate">Taken Date</label>
		    <input type="text" class="form-control date datetimepicker-1" name="inpTakenDate" id="inpTakenDate">

	  	</div>
	  	<div class="form-group">
		    <label for="inpTakenBy">Taken By</label>
		    <?php  
		    $add_drp_code1 = 'class="form-control option-select" id="inpTakenBy"';
		    echo form_dropdown('inpTakenBy', $optionsUserList, 'default', $add_drp_code1);
		    ?>
	  	</div>
		<div class="form-group">
		    <label for="inpReturnedDate">Returned Date</label>
		    <input type="text" class="form-control date datetimepicker-1" name="inpReturnedDate" id="inpReturnedDate">

	  	</div>
	  	<div class="form-group">
		    <label for="inpReturnedBy">Returned By</label>
		    <?php  
		    $add_drp_code2 = 'class="form-control option-select" id="inpReturnedBy"';
		    echo form_dropdown('inpReturnedBy', $optionsUserList, 'default', $add_drp_code2);
		    ?>
	  	</div>
        <div class="form-group">
		    <label for="inpNotes">Notes</label>
		    <textarea class="form-control" name="inpNotes" id="inpNotes" cols="30" rows="3"></textarea>

	  	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btnSubmit_Keyreg" id="btnSubmit_Keyreg" value="Submit">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>		