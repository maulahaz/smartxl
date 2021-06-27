<?php  
	$form_location = base_url('overtime/create/'.$update_id);
	
	//-To view Flash Message
	if(isset($flash)){ echo $flash; }

	//-To veiw error from input validation
	echo validation_errors("<div class='alert alert-warning'><strong>","</strong></div>");
?>

<section class="box-typical box-typical-padding">	
	<header class="box-typical-header">
		<div class="tbl-row">
			<div class="tbl-cell">
				<h2><?= $page_title ?></h2>
				<hr>
			</div>
		</div>
	</header>
		<form action="<?= $form_location; ?>" method="post">
			
			<div class="form-group row">
				<label class="col-sm-2 form-control-label">Overtime Date From</label>
				<div class="col-md-4">
					<div class="form-group">
						<div class='input-group date datetimepicker-1' id="ot_date_from">
							<input type='text' class="form-control" name="ot_date_from" id="ot_date_from" value="<?=$ot_date_from ;?>" placeholder="Date and Time From"/>
							<span class="input-group-addon">
								<i class="font-icon font-icon-calend"></i>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 form-control-label">Overtime Date To</label>
				<div class="col-md-4">
					<div class="form-group">
						<div class='input-group date datetimepicker-1' id="ot_date_to">
							<input type='text' class="form-control" name="ot_date_to" id="ot_date_to" value="<?=$ot_date_to ;?>" placeholder="Date and Time To"/>
							<span class="input-group-addon">
								<i class="font-icon font-icon-calend"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="in4">Overtime Category</label>
				<div class="col-sm-4">

						<select name="ot_category" id="in4" value="<?=$ot_category ;?>" class="form-control">
							<?php  
								$data_list = array('100%','150%','250%','400%');
								foreach ($data_list as $dt) {
									if($dt == $ot_category){
										echo '<option value="'.$dt.'" selected="selected">'.$dt.'</option>';
									} else{
										echo '<option value="'.$dt.'">'.$dt.'</option>';
									}
								}
							?>
						</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" id="in5">Reason</label>
				<div class="col-sm-8">
						<select name="ot_reason" id="in5" value="<?=$ot_reason ;?>" class="form-control">
							<?php  
								$data_list = array(
									'Annual leave coverage',
									'Sick leave coverage',
									'Training coverage',
									'Visico octabin campaigne',
									'Shutdown activities',
									'Turn around activities'
								);
								foreach ($data_list as $dt) {
									if($dt == $ot_reason){
										echo '<option value="'.$dt.'" selected="selected">'.$dt.'</option>';
									} else{
										echo '<option value="'.$dt.'">'.$dt.'</option>';
									}
								}
							?>
						</select>
				</div>
			</div>
			<div class="form-action">
				<button type="submit" class="btn btn-sm" name="submit" value="Submit">Save changes</button>
				<button type="submit" class="btn btn-sm btn-default" name="submit" value="Cancel">Cancel</button>
			</div>

		</form>
</section>