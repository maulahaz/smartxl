<!-- PHP HELPER -->
<!-- ============================================================== -->
<?php 
  $this->load->module('mydatetime'); 
  $actionURL = base_url('tugmasters/create');
?>

<!-- CUSTOM STYLING -->
<!-- ============================================================== -->
<style>
table th,td { text-align : center}

.input-13 {
  font-size: 13px;
  font-weight: bold;
  /* font-weight: 400; */
  font-style: italic;
}

#btn_add {
  color: #fff;
}
#btn_add:hover {
  background-color: blue;
}
</style>

<!-- CONTENT -->
<!-- ============================================================== -->
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
        <h2><?= $headline; ?></h2>
        <!-- <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul> -->
        <div class="clearfix"></div>
    </div>
      <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <?= (isset($flashMsg)) ? $flashMsg : null  ?>

              <!-- <p class="text-muted font-13 m-b-30 msgbox"></p> -->
                <form id="frm_add_tugmaster" name="frm_add_tugmaster" action="<?= $actionURL;?>" method="post" >
                    <!---------------- MASTER INPUT ------------------->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label for="req_date" class="col-sm-4 col-form-label">Request Date</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control myDatepicker input-13" id="req_date" name="req_date" value="<?=isset($req_date) ? $req_date : set_value('req_date'); ?>"">
                            </div>
                             <!-- value="<?//set_value('username'); ?> -->
                        </div>
                        <div class="form-group row">
                            <label for="req_time" class="col-sm-4 col-form-label">Request Time</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control input-13" id="req_time" name="req_time" value="<?=isset($req_time) ? $req_time : set_value('req_time'); ?>">
                            </div>
                        </div>
                        
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label for="req_by" class="col-sm-4 col-form-label">Request by</label>
                            <div class="col-sm-8">
                              <select class="form-control input-13" id="req_by" name="req_by">
                                  <option value="">--Select--</option>
                                  <?php
                                    // $dtOptions = array('Satu1','Dua2','Tiga3');
                                    // foreach ($dtOptions as $dt) {
                                    foreach ($dtSupervisor->result() as $dt) {
                                    ?>
                                        <option value="<?= $dt->Usr_id ?>" <?= (isset($req_by) && $req_by == $dt->Usr_id) ? "selected" : null ; ?>><?= $dt->Name ?></option>
                                    <?php
                                    }
                                  ?>
                              </select>
                              <!-- <input type="text" class="form-control input-13" id="req_by" name="req_by" value="<?//isset($req_by) ? $req_by : set_value('req_by') ; ?>"> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="team" class="col-sm-4 col-form-label">Team/Shift</label>
                            <div class="col-sm-4">
                              <!-- <input type="text" class="form-control" id="team" name="team" value="<?//isset($team) ? $team : null ; ?>"> -->
                              <select name="team" id="team" class="form-control input-13">
                                <option value="">-- Select --</option>
                                <option value="A">Group A</option>
                                <option value="B">Group B</option>
                                <option value="C">Group C</option>
                                <option value="D">Group D</option>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <!-- <input type="text" class="form-control" id="shift" name="shift" value="<?//isset($shift) ? $shift : null ; ?>"> -->
                              <select name="shift" id="shift" class="form-control input-13">
                                <option value="">-- Select --</option>
                                <option value="1">Morning</option>
                                <option value="2">Night</option>
                              </select>
                            </div>
                        </div>
                      </div>

                    </div>

                    <hr>

                    <!---------------- DETAIL INPUT ------------------->
                    <div class="detail-control pull-right">
                      <button class="btn btn-success btn-sm" id="btn_more" name="btn_more">Add More</button>
                    </div>
                    <div class="container">

                    <table id="tbl_tugmaster_det" class="table table-sm table-striped"> 
                      <thead>
                      <tr>
                        <th class="text-center">Bay</th>
                        <th class="text-center">Container #</th>
                        <th class="text-center">Material</th>
                        <th class="text-center">Batch</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">Destination</th>
                        <th class="text-center">Replace with</th>
                        <th class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody id="row_data">
                        <tr>
                        <td width="90">
                            <select name="txtBayNum[]" id="txtBayNum" class="form-control input-13" >
                            <option value="">--</option>
                            <?php
                                          $optList = array('X1','X2','X3','X4','X5','X6','X7','X8');  
                                          foreach ($optList as $opt) {
                                          ?>
                                              <option value="<?= $opt ?>" <?= (isset($txtBayNum) && $txtBayNum == $opt) ? "selected" : null ; ?>><?= $opt ?></option>
                                          <?php
                                          }
                                      ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control input-13" id="txtContrNum" name="txtContrNum[]" value="<?=set_value('txtContrNum[]');?>">
                        </td>
                        
                        <td width="130">
                          <select name="txtMaterial[]" id="txtMaterial" class="form-control input-13" >
                            <option value="">--</option>
                            <?php
                                          $optList = array('LS4201S','LS4201H','LS4201R','LS4201L','XLPE','Visico','Scrap','Other');  
                                          foreach ($optList as $opt) {
                                          ?>
                                              <option value="<?= $opt ?>" <?= (isset($material) && $material == $opt) ? "selected" : null ; ?>><?= $opt ?></option>
                                          <?php
                                          }
                                      ?>
                          </select>
                        </td>
                        <td width="120">
                          <input type="text" class="form-control input-13" id="txtBatch" name="txtBatch[]" value="<?php echo set_value('txtBatch[]'); ?>">
                        </td>
                        <td width="80">
                          <input type="number" min="1" class="form-control input-13" id="txtQty" name="txtQty[]" value="<?php echo set_value('txtQty[]'); ?>">
                        </td>
                        <td width="110">
                          <select class="form-control input-13"  id="txtUnit" name="txtUnit[]">
                              <option value="" selected="selected">--</option>
                              <?php
                                // A sample product array
                                $unit = array("FOB","HOB","Pallets","Tons", "Kgs");
                                
                                // Iterating through the product array
                                foreach($unit as $r){
                              ?>
                                <option value="<?php echo $r; ?>"><?php echo $r; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                        </td>
                        <td>
                          <input type="text" class="form-control input-13" id="txtDestination" name="txtDestination[]" value="<?=set_value('txtDestination[]');?>">
                        </td>
                        <td>
                          <input type="text" class="form-control input-13" id="txtReplaceWith" name="txtReplaceWith[]" value="<?=set_value('txtReplaceWith[]');?>">
                        </td>

                        <td width="60" class="text-center">
                              <a href="#" class="btn btn-danger btn-sm btn_del_detail"><span class="fa fa-trash-o"></span></a>
                        </td>
                        
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>

                    <hr>

                    <!---------------- FOOTER ------------------------>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label for="operator" class="col-sm-4 col-form-label">Contact person</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control input-13" id="operator" name="operator" value="<?=isset($operator) ? $operator : set_value('operator') ; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="notes" class="col-sm-4 col-form-label">Notes</label>
                            <div class="col-sm-8">
                                <textarea class="form-control input-13" id="notes" name="notes" cols="30" rows="3"><?=isset($notes) ? $notes : set_value('notes') ; ?></textarea>
                            </div>
                        </div>

                      </div>
                    </div>

                    <hr>
                    <!---------------- BUTTONS ------------------------>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_submit" name="btn_submit"  value="Save">Save</button>
                    <!-- <button type="submit" class="btn btn-secondary btn-sm" value="Cancel" id="btn_cancel" name="btn_cancel">Cancel</button> -->
                    <a href="<?=base_url('tugmasters/manage'); ?>" class="btn btn-secondary btn-sm">Back</a>
                </form>
            </div>
        </div>
      </div>
  </div>
</div>

<!-- SHOW MODAL -->
<!-- ============================================================== -->
<?php if(isset($show_modal)){ $this->load->view($show_modal); } ?>