<?php 
	$action = base_url('overtime/printByMonth');
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
      <!-- <div class="modal-body" id="modal-msg"></div> -->
      <form id="my_form" action="<?=$action ?>" class="form-horizontal" method="post" role="form">
      <div class="modal-body" id="form-body">

        <!--  -->

<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="tb_month-tab" data-toggle="tab" href="#tb_month" role="tab" aria-controls="tb_month" aria-selected="true">By Month</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="tb_date-tab" data-toggle="tab" href="#tb_date" role="tab" aria-controls="tb_date" aria-selected="false">By Date</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="tb_month" role="tabpanel" aria-labelledby="tb_month-tab">
    <div class="form-group">
      <label for="ot_month">Month</label>
        <select name="ot_month" id="ot_month" class="form-control">
          <?php  
            $data_list = array(
              ''=>'--Select--','1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun',
              '7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec'
            );
            foreach ($data_list as $key => $value) {
              echo '<option value="'.$key.'">'.$value.'</option>';
            }
          ?>
        </select>
    </div>
    <div class="form-group">
      <label for="ot_year">Year</label>
        <select name="ot_year" id="ot_year" class="form-control">
          <?php  
            $data_list = array(
              ''=>'--Select--','2019'=>'2019','2020'=>'2020','2021'=>'2021','2022'=>'2022',
              '2023'=>'2023','2024'=>'2024','2025'=>'2025','2026'=>'2026'
            );
            foreach ($data_list as $key => $value) {
              echo '<option value="'.$key.'">'.$value.'</option>';
            }
          ?>
        </select>
    </div>    
  </div>
  <div class="tab-pane fade" id="tb_date" role="tabpanel" aria-labelledby="tb_date-tab">
    <div class="form-group">
      <label for="from_date">From Date</label>
      <input type="text" class="form-control myDatepicker" name="from_date" id="from_date">
    </div>
    <div class="form-group">
      <label for="until_date">Until Date</label>
      <input type="text" class="form-control myDatepicker" name="until_date" id="until_date">
    </div>
  </div>

</div>

        <!--  -->

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


