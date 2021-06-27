<!-- PHP HELPER -->
<!-- ============================================================== -->
<?php 
    $actionURL = base_url('overtime/modify/').$updateID;
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
                        <label for="ot_from_date" class="col-sm-2 col-form-label">Overtime From</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control myDatepicker" id="ot_from_date" name="ot_from_date" value="<?=isset($ot_from_date) ? $ot_from_date : null; ?>">
                        </div>
                        <div class="col-sm-2">
                            <input type="time" class="form-control" id="ot_from_time" name="ot_from_time" value="<?=isset($ot_from_time) ? $ot_from_time : null; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ot_until_date" class="col-sm-2 col-form-label">Overtime Upto</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control myDatepicker" id="ot_until_date" name="ot_until_date" value="<?=isset($ot_until_date) ? $ot_until_date : null; ?>">
                        </div>
                        <div class="col-sm-2">
                            <input type="time" class="form-control" id="ot_until_time" name="ot_until_time" value="<?=isset($ot_until_time) ? $ot_until_time : null; ?>">

                        </div>
                        <!-- <div class='input-group date col-sm-2'>
                            <input type='text' class="form-control myTimepicker" />
                            <span class="input-group-addon">
                               <span class="fa fa-clock-o"></span>
                            </span>
                        </div> -->
                    </div>
                    <div class="form-group row">
                        <label for="reason" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-6">
                            <select id="category" name="category" value="<?=isset($category) ? $category : null; ?>" class="form-control">
                                <?php  
                                    $options = array(
                                        '100%'=>'100% - Extra hours',
                                        '150%'=>'150% - Overtime on off-day',
                                        '250%'=>'250% - Overtime 250%',
                                        '400%'=>'400% - Overtime on public holiday');
                                    foreach ($options as $key =>$value) {
                                        if(isset($category) && $category == $key){
                                            echo '<option value="'.$key.'" selected="selected">'.$value.'</option>';
                                        } else{
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                        }
                                    }
                                ?>
                            </select>
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
                    <a href="<?=base_url(); ?>/overtime/list" class="btn btn-secondary btn-sm">Back</a>
                </form>
            </div>
        </div>
      </div>
  </div>
</div>

<!-- SHOW MODAL -->
<!-- ============================================================== -->
<?php if(isset($show_modal)){ $this->load->view($show_modal); } ?>