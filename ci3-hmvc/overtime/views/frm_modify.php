<!-- Modal -->
<div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="modal-title">Modal title</h5>
      </div>
      <div class="modal-body" id="modal-msg"></div>
      <form id="my_form" action="action" class="form-horizontal" method="post" role="form">
      <div class="modal-body" id="form-body">
      		
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
      	<input type="hidden" name="inpUID" id="inpUID">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Save">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>		