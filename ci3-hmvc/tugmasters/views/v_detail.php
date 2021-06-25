<!-- PHP HELPER -->
<!-- ============================================================== -->
<?php 
  $this->load->module('mydatetime'); 

?>

<!-- CUSTOM STYLING -->
<!-- ============================================================== -->
<style>
table th,td { text-align : center}
td{
  font-size: 13px;
  font-weight: bold;
  font-style: italic;
}
#btn_add {
  color: #fff;
}
#btn_add:hover {
  background-color: blue;
}

.master-field {
  text-align : left;
  height: 30px;
  padding: 5px;
  margin-left: 10px;
}

.master-field-data {
  width: 200px;
  text-align : left;
  border-bottom: 1px solid #ddd;
}

</style>

<!-- CONTENT -->
<!-- ============================================================== -->
<div class="page-title">  
  <div class="title_left">
    <h3><?= $headline; ?></h3>
    
  </div>
  
  <!-- <div class="title_right">
    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">Go!</button>
        </span>
      </div>
    </div>
  </div> -->
</div>
<div class="clearfix"></div>
<div class="msgbox"></div>
<?= (isset($flashMsg)) ? $flashMsg : null ;?>

<div class="row" style="display: block;">
  <div class="col-md-12 col-sm-12">
    <div class="x_panel">
      <div class="x_title">
        <a href="<?=base_url('tugmasters/manage'); ?>" class="btn btn-secondary btn-sm">Back</a>

        <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?=base_url('tugmasters/print/'.$requestID); ?>" class="btn btn-primary"><span class="fa fa-print"></span></a></li>
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li>&nbsp;</li>
        </ul>

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="master-info" style="margin-bottom: 25px">
          <div class="row">
            <div class="col-md-6">
              <table>
                <tr>
                  <td class="master-field" width="200">Request No.</td>
                  <td width="10"></td>
                  <td class="master-field-data" id="req_id">: <?= $requestID; ?></td>
                </tr>
                <tr>
                  <td class="master-field" width="200">Request date</td>
                  <td width="10"></td>
                  <td class="master-field-data">: <?= $dtaTugmaster->Request_dtm; ?></td>
                </tr>
                <tr>
                  <td class="master-field" width="200">Request by</td>
                  <td width="10"></td>  
                  <td class="master-field-data">: <?= $dtaTugmaster->Name; ?></td>
                </tr>
              </table> 
            </div>
            <div class="col-md-6"> 
              <table>
                <tr>
                  <td class="master-field" width="200">Group Team</td>
                  <td width="10"></td>
                  <td class="master-field-data" id="req_id">: <?= $dtaTugmaster->Team; ?></td>
                </tr>
                <tr>
                  <td class="master-field" width="200">Shift</td>
                  <td width="10"></td>
                  <td class="master-field-data">: <?= $dtaTugmaster->Shift; ?></td>
                </tr>
                <tr>
                  <td class="master-field" width="200">Operator</td>
                  <td width="10"></td>
                  <td class="master-field-data">: <?= $dtaTugmaster->Operator; ?></td>
                </tr>
              </table>
            </div>   
          </div>
        </div>
        <hr style="margin-bottom: 25px"> 
        
        <!-- Responsive With Wrapping -->
        <!-- <table id="my_table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"> -->
        
        <!-- Responsive WITHOUT Wrapping -->
        <table id="my_table_detXX" class="table table-striped table-sm table-bordered dt-responsive" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th width="50">Bay#</th>
              <th width="120">Container</th>
              <th width="150">Material</th>
              <th width="100">Qty</th>
              <th>Destination</th>
              <th>Replace with</th>
              <th>Notes</th>
            </tr>
          </thead>
          <tbody>
            <?php if(isset($dtItems) && $dtItems->num_rows()>0): ?>
            <?php
              $sn = 1;
              foreach ($dtItems->result() as $row){
              ?>
              <tr>
                <td><?= $row->Bay_no;?></td>
                <td><?= $row->Container_no;?></td>
                <td class="text-left"><?= $row->Material.' '.$row->Batch ;?></td>
                <td class="text-left"><?= $row->Qty.' '.$row->Unit;?></td>
                <td class="text-left"><?= $row->Destination;?></td>
                <td class="text-left"><?= $row->Replace_with;?></td>
                <td class="text-left"><?= $row->Notes;?></td>
              </tr>     

              <?php
              }
              ?>
              <?php else: ?>
                <tr>
                  <td colspan="7">Data not available</td>
                </tr>
              <?php endif; ?>
          </tbody>
          
        </table>
      </div>
    </div>
  </div>
</div>

<!-- SHOW MODAL -->
<!-- ============================================================== -->
<?php if(isset($show_modal)){ $this->load->view($show_modal); } ?>

<div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel">Add New Record</h4>
      </div>
      <div class="modal-body">

        <form id="my_form" action="action" method="post" class="form-horizontal">
      
        <div class="form-group">
        <label for="bay_no">Bay Number</label>
        <select name="bay_no" id="bay_no" class="form-control" >
          <option value="">--Please select--</option>
          <?php
                        $optList = array('X1','X2','X3','X4','X5','X6','X7','X8');  
                        foreach ($optList as $opt) {
                        ?>
                            <option value="<?= $opt ?>" <?= (isset($bay_no) && $bay_no == $opt) ? "selected" : null ; ?>><?= $opt ?></option>
                        <?php
                        }
                    ?>
        </select> 
        </div>

        <div class="form-group">
        <label for="container_num">Container number</label>
        <input type='text' class="form-control" name="container_num" id="container_num" placeholder="Container number">
      </div>

      <div class="form-group">
        <label for="material">Material</label>
        <select name="material" id="material" class="form-control" >
          <option value="">--Please select--</option>
          <?php
                        $optList = array('LS4201S','LS4201H','LS4201R','LS4201L','XLPE','Scrap','Other');  
                        foreach ($optList as $opt) {
                        ?>
                            <option value="<?= $opt ?>" <?= (isset($material) && $material == $opt) ? "selected" : null ; ?>><?= $opt ?></option>
                        <?php
                        }
                    ?>
        </select> 
        </div>

        <div class="form-group">
        <label for="batch">Batch</label>
        <input type='number' class="form-control" name="batch" id="batch" placeholder="Batch">
      </div>

        <div class="form-group">
        <label for="qty">Quantity</label>
        <input type='number' class="form-control" name="qty" id="qty" placeholder="Quantity">
      </div>

        <div class="form-group">
        <label for="uom">Unit</label>
        <select name="uom" id="uom" class="form-control" >
          <option value="">--Please select--</option>
          <?php
                        $optList = array('FOB','HOB','Pallets','Bags','Tons','Kgs');  
                        foreach ($optList as $opt) {
                        ?>
                            <option value="<?= $opt ?>" <?= (isset($uom) && $uom == $opt) ? "selected" : null ; ?>><?= $opt ?></option>
                        <?php
                        }
                    ?>
        </select> 
        </div>

        <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control" >
          <option value="">--Please select--</option>
          <?php
                        $optList = array(
                                "Empty", 
                        "Loading in progress", 
                        "On Hold", 
                        "Ready to pull out-Email not sent", 
                        "Ready to pull out-Email sent", 
                        "Completed"); 
                        foreach ($optList as $opt) {
                        ?>
                            <option value="<?= $opt ?>" <?= (isset($status) && $status == $opt) ? "selected" : null ; ?>><?= $opt ?></option>
                        <?php
                        }
                    ?>
          <?php
                        /*$optList = array(
                              "0" => "Empty", 
                      "1" => "Loading in progress", 
                      "2" => "On Hold", 
                      "3" => "Ready to pull out-Email not sent", 
                      "4" => "Ready to pull out-Email sent", 
                      "5" => "Completed"); 
                        foreach ($optList as $key =>$value) {
                            if(isset($status) && $status == $key){
                                echo '<option value="'.$key.'" selected="selected">'.$value.'</option>';
                            } else{
                                echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        }*/
                    ?>
        </select> 
        </div>
                          
      </div>
      <div class="modal-footer">
        <input type="hidden" id="req_no" name="req_no" value="<?= isset($requestID) ? $requestID : null;?>">
        <input type="hidden" id="uid_detail" name="uid_detail" value="<?= isset($uid_detail) ? $uid_detail : null;?>">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" id="btn_submit" name="btn_submit" value="Submit" class="btn btn-sm btn-primary">Add New Record</button>
      </div>
      </form>
    </div>
  </div>
</div>