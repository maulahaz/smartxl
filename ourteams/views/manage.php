<?php 

if(isset($flash)){ $flash;}

$create_page_url = base_url()."accounts/edit";

$this->load->module('mydatetime');
$this->load->module('site_security');
$usrLevel = $this->site_security->_get_user_level();

?>
<h3 class="description">OUR TEAM</h3>
<!-- <div style="display: inline-block; text-align: right; width: 100%"> -->
<div class="widget-content">
    <div class="controls pull-left">  
      <?php  
      echo form_open('ourteams/manage');
      ?>
      <select name="cboSearch" id="">
        <option value="">Search By...</option>
        <option value="usr_ID">Employee ID</option>
        <option value="usr_Name">Name</option>
        <option value="usr_Email">Email</option>
        <option value="usr_Position">Position</option>
        <option value="usr_Phone1">Phone</option>
      </select>

      <input type="text" name="txtSearch">

      <button type="submit" name="btnSearch" class="btn btn-default btn-sm" value="Search">Search</button>
      
      <?php
      echo form_close();
      ?>

    </div>
    <div class="controls pull-left">  
        <?php  
        if(isset($tot_data)){
          echo "Search result : ".$tot_data." record(s) found";
        }

        ?>

    </div>
    <div class="controls pull-right">
      <?php      
      if($usrLevel == 5){ ?>
      <button type="button" class="btn btn-inline btn-primary btn-sm" id="btnAdd_Ourteams"><span class="fa fa-plus"></span> Add New Data</button>
        <!-- <a href="<?php echo base_url('accounts/create') ;?>" title="New record"></a> -->
      <?php
      }
      ?>      
    </div>
</div>
    <!-- </div> -->
    <table id="table-sm" class="table table-bordered table-hover table-sm">
      <thead>
        <tr>
          <th width="1" style="text-align: center;">
            #
          </th>
          <th style="text-align: center;">Emp.ID</th>
          <th style="text-align: center;">Name</th>
          <th style="text-align: center;">Position</th>
          <th style="text-align: center;">Email</th>
          <th style="text-align: center;">Phone</th>
          <th style="text-align: center;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sn = $page + 1;
        foreach ($team_data->result() as $row){
          $edt_uid = base_url()."accounts/edit/".$row->uid;
          $del_uid = base_url()."accounts/delconf/".$row->uid;
          // $det_uid = base_url()."accounts/profile/".$row->uid;
          // $my_date = $this->mydatetime->get_nice_date_str($row->charge_date,'mydate') ;

          ?>
          <tr>
            <td><?= $sn++; ?></td>
            <td><?= $row->usr_ID; ?></td>
            <td><?= $row->usr_Name; ?></td>
            <td><?= $row->usr_Position; ?></td>
            <td><?= $row->usr_Email; ?></td>
            <td><?= $row->usr_Phone1; ?></td>
            <td style="text-align: center; vertical-align: middle;" >
            <!-- dropdown button -->
              <div class="btn-group">
                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#"><span class="fa fa-file-text-o"></span> Detail</a>
                  <a class="dropdown-item" href="<?= $edt_uid ?>"><span class="fa fa-edit"></span> Edit</a>
                  <a class="dropdown-item" href="<?= $del_uid ?>"><span class="fa fa-trash-o"></span> Delete</a>
                </div>
              </div>
            <!-- /dropdown button -->  
              
            </td>
          </tr>     

          <?php
        }
        ?>
      </tbody>
    </table>
    <td><?= $halamanku; ?></td>

<!-- Modal -->
<div class="modal fade" id="modlOurteams" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="modal-title">Modal title</h5>
      </div>
      <div class="modal-body" id="modal-msg"></div>
      <form id="frmOurteams" action="action" class="form-horizontal" method="post" role="form">
      <div class="modal-body" id="form-body">
      		<input type="hidden" name="inpUID" id="inpUID">
		<!-- <div class="form-group">
		    <label for="inpTitle">Title</label>		    
		    <input type="text" class="form-control" name="inpTitle" id="inpTitle" placeholder="Etask Title">
	  	</div> -->
	  	<div class="form-group">
		    <label for="inpTitle">Title</label>
		    <!-- <input type="text" class="form-control" name="inpAssignTo" id="inpAssignTo"> -->
		    <?php  
		    	$add_drp_code1 = 'class="form-control option-select" id="inpTitle"';
		    	echo form_dropdown('inpTitle', $optionsEtaskTitle, 'default', $add_drp_code1);
		    ?>
	  	</div>
	  	<div class="form-group">
		    <label for="inpAssignTo">Assign To</label>
		    <!-- <input type="text" class="form-control" name="inpAssignTo" id="inpAssignTo"> -->
		    <?php  
		    	$add_drp_code2 = 'class="form-control option-select" id="inpAssignTo"';
		    	echo form_dropdown('inpAssignTo', $optionsAssignTo, 'default', $add_drp_code2);
		    ?>
	  	</div>
	  	<div class="form-group">
		    <label for="inpAssignDate">Assign Date</label>
		    <input type="text" class="form-control date datepicker_only" name="inpAssignDate" id="inpAssignDate">

	  	</div>
	  	<div class="form-group">
		    <label for="inpTargetDate">Target Date</label>
		    <input type="text" class="form-control date datepicker_only" name="inpTargetDate" id="inpTargetDate">
	  	</div>
		<div class="form-group">
		    <label for="optStatus">Job Status</label>
		    <select class="form-control" name="optStatus" id="optStatus">
		      <option value="UnComplete">UnComplete</option>
		      <option value="Completed">Completed</option>
		      <option value="Cancel">Cancel</option>
		    </select>
		</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btnSubmit_Ourteams" id="btnSubmit_Ourteams" value="Submit">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>	    