<!-- PHP HELPER -->
<!-- ============================================================== -->
<?php 
    $actionURL = base_url('keyreg/modify/').$updateID;
    // $keyReg = explode(',', $Keyreg_type);
    $keyReg = explode(',', $kr_type);
?>

<!-- CUSTOM STYLING -->
<!-- ============================================================== -->
<style>

</style>

<!-- CONTENT -->
<!-- ============================================================== -->

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
        <h2><?= $page_title; ?></h2>
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
                <form method="post" name="frmCreate" action="<?= $actionURL;?>">
                    <div class="form-group row">
                        <div class="col-sm-2">Key</div>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1" name="kr_type[]" value="MOS" <?= (in_array('MOS', $keyReg)) ? "checked" : ""; ?>><label class="form-check-label">
                                MOS
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1" name="kr_type[]" value="Engineer" <?= (in_array('Engineer', $keyReg)) ? "checked" : ""; ?>>
                                <label class="form-check-label">
                                Engineer Key
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1" name="kr_type[]" value="Other" <?= (in_array('Other', $keyReg)) ? "checked" : ""; ?>>
                                <label class="form-check-label">
                                Other
                                </label>
                            </div>
                        </div>             
                    </div>
                    <div class="form-group row">
                        <label for="taken_date" class="col-sm-2 col-form-label">Taken date/time</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control myDatepicker" id="taken_date" name="taken_date" value="<?=$taken_date; ?>">
                        </div>
                        <div class="col-sm-2">
                            <input type="time" class="form-control" id="taken_time" name="taken_time" value="<?= $taken_time ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="taken_by" class="col-sm-2 col-form-label">Taken by</label>
                        <div class="col-sm-5">
                            <!-- <input type="text" class="form-control" id="taken_by" name="taken_by" value=""> -->
                            <select class="form-control" id="taken_by" name="taken_by">
                            <?php  
                                foreach ($userOptions as $key => $value) {
                                ?>
                                    <option value="<?= $key ?>" <?= ($taken_by == $key) ? "selected" : null ; ?>><?= $value ?></option>
                                <?php
                                }
                            ?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="reason" name="reason" value="<?= $reason ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="return_date" class="col-sm-2 col-form-label">Return date/time</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control myDatepicker" id="return_date" name="return_date" value="<?= $return_date; ?>">
                        </div>
                        <div class="col-sm-2">
                            <input type="time" class="form-control" id="return_time" name="return_time" value="<?= $return_time; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="return_by" class="col-sm-2 col-form-label">Return by</label>
                        <div class="col-sm-5">
                            <!-- <input type="text" class="form-control" id="return_by" name="return_by"> -->
                            <select class="form-control" id="return_by" name="return_by">
                            <?php  
                                foreach ($userOptions as $key => $value) {
                                ?>
                                    <option value="<?= $key ?>" <?= ($return_by == $key) ? "selected" : null ; ?>><?= $value ?></option>
                                <?php
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="notes" class="col-sm-2 col-form-label">Notes</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="notes" name="notes" value="<?= $notes ?>">
                        </div>
                    </div>
                    <br><hr>
                    <button type="submit" class="btn btn-primary btn-sm" value="Save" id="btn_save" name="btn_save">Save</button>
                    <!-- <button type="submit" class="btn btn-secondary btn-sm" value="Cancel" id="btn_cancel" name="btn_cancel">Cancel</button> -->
                    <a href="<?=base_url(); ?>/keyreg/list" class="btn btn-secondary btn-sm">Back</a>
                </form>
            </div>
        </div>
      </div>
  </div>
</div>

<!-- SHOW MODAL -->
<!-- ============================================================== -->
<?php if(isset($show_modal)){ $this->load->view($show_modal); } ?>