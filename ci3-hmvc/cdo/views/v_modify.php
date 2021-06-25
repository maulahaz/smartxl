<!-- PHP HELPER -->
<!-- ============================================================== -->
<?php 
    $actionURL = base_url('cdo/modify/').$updateID;
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
                <form id="frm_modify" name="frm_modify" action="<?= $actionURL;?>" method="post" >
                    
                    <div class="form-group row">
                        <label for="cdo_type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="cdo_type" name="cdo_type">
                                <option value="">--Select--</option>
                            <?php
                                $options = array('Earn','Redeem');  
                                foreach ($options as $dt) {
                                ?>
                                    <option value="<?= $dt ?>" <?= (isset($cdo_type) && $cdo_type == $dt) ? "selected" : null ; ?>><?= $dt ?></option>
                                <?php
                                }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="from_date" class="col-sm-2 col-form-label">Date From</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control myDatepicker" id="from_date" name="from_date" value="<?=isset($from_date) ? $from_date : null; ?>">
                        </div>
                        <div class="col-sm-2">
                            <input type="time" class="form-control" id="from_time" name="from_time" value="<?=isset($from_time) ? $from_time : null; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="to_date" class="col-sm-2 col-form-label">Date to</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control myDatepicker" id="to_date" name="to_date" value="<?=isset($to_date) ? $to_date : null; ?>">
                        </div>
                        <div class="col-sm-2">
                            <input type="time" class="form-control" id="to_time" name="to_time" value="<?=isset($to_time) ? $to_time : null; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="reason" name="reason">
                                <option value="">--Select--</option>
                            <?php
                                $options = array(
                                    'Annual leave coverage',
                                    'Sick leave coverage',
                                    'Training coverage',
                                    'Visico octabin campaigne',
                                    'Shutdown activities',
                                    'Turn around activities',
                                    'Others'
                                );  
                                foreach ($options as $dt) {
                                ?>
                                    <option value="<?= $dt ?>" <?= (isset($reason) && $reason == $dt) ? "selected" : null ; ?>><?= $dt ?></option>
                                <?php
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reason" class="col-sm-2 col-form-label">Notes</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="notes" name="notes" cols="30" rows="4"><?=isset($notes) ? $notes : null ; ?></textarea>
                        </div>
                    </div>

                    <br><hr>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_submit" name="btn_submit"  value="Save">Save</button>
                    <!-- <button type="submit" class="btn btn-secondary btn-sm" value="Cancel" id="btn_cancel" name="btn_cancel">Cancel</button> -->
                    <a href="<?=base_url('cdo/list'); ?>" class="btn btn-secondary btn-sm">Back</a>
                </form>
            </div>
        </div>
      </div>
  </div>
</div>

<!-- SHOW MODAL -->
<!-- ============================================================== -->
<?php if(isset($show_modal)){ $this->load->view($show_modal); } ?>