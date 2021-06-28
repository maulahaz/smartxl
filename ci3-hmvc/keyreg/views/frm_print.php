<?php 
	$action = base_url('keyreg/print_keyreg');
?>
<!-- Modal Print-->
<div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-msg"></div>
      <form id="my_form_report" action="<?=$action ?>" class="form-horizontal" method="post" role="form">
      <div class="modal-body" id="form-body">
      		
	  	<div class="form-group">
		    <label for="from_date">From Date</label>
		    <input type="text" class="form-control myDatepicker" name="from_date" id="from_date">
	  	</div>
	  	<div class="form-group">
		    <label for="until_date">Until Date</label>
		    <input type="text" class="form-control myDatepicker" name="until_date" id="until_date">
	  	</div>
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="uid" id="uid">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary" name="btn_submit" id="btn_submit" value="Submit">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>		