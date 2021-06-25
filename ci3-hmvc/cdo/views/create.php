<?php  
	$form_location = base_url('cdo/create/'.$update_id);
	
?>

<section class="box-typical box-typical-padding">	
	<header class="box-typical-header">
		<div class="tbl-row">
			<div class="tbl-cell">
				<h2><?= $page_title ?></h2>
				<hr>
				<?php
					//-To view Flash Message
					if(isset($flash)){ echo $flash; }

					//-To veiw error from input validation
					// echo validation_errors("<div class='alert alert-warning'><strong>","</strong></div>");
					echo validation_errors('<div class="error" style="color:red;">', '</div>');
				?>
			</div>
		</div>
	</header>
		<form action="<?= $form_location; ?>" method="post">
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="txtType">CDO Type</label>
				<div class="col-sm-4">
					<select name="txtType" id="txtType" value="<?= (isset($txtType)) ? $txtType : "" ;?>" class="form-control">
						<option value="">Select CDO Type...</option>
						<?php  
							$data_list = array('Earn','Redeem');
							foreach ($data_list as $dt) {
								if($dt == $txtType){
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
				<label class="col-sm-2 form-control-label">Date/Time from</label>
				<div class="col-md-4">
					<div class="form-group">
						<div class='input-group date datetimepicker-1' id="txtDatetimeFrm">
							<input type='text' class="form-control" name="txtDatetimeFrm" id="txtDatetimeFrm" value="<?= (isset($txtDatetimeFrm)) ? $txtDatetimeFrm : "" ;?>" placeholder="Date and Time from"/>
							<span class="input-group-addon">
								<i class="font-icon font-icon-calend"></i>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 form-control-label">Date/Time to</label>
				<div class="col-md-4">
					<div class="form-group">
						<div class='input-group date datetimepicker-1' id="txtDatetimeTo">
							<input type='text' class="form-control" name="txtDatetimeTo" id="txtDatetimeTo" value="<?= (isset($txtDatetimeTo)) ? $txtDatetimeTo : "" ;?>" placeholder="Date/Time to"/>
							<span class="input-group-addon">
								<i class="font-icon font-icon-calend"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="txtReason">Reason</label>
				<div class="col-sm-4">

						<select name="txtReason" id="txtReason" value="<?= (isset($txtReason)) ? $txtReason : "" ;?>" class="form-control">
							<option value="">Select Reason...</option>
							<?php  
								$data_list = array(
									'Annual leave coverage',
									'Sick leave coverage',
									'Training coverage',
									'Visico octabin campaigne',
									'Shutdown activities',
									'Turn around activities',
									'Public holiday',
									'Other'
								);
								foreach ($data_list as $dt) {
									if($dt == $txtReason){
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
				<label class="col-sm-2 form-control-label" for="txtNote">Note</label>
				<div class="col-sm-4">
					<textarea name="txtNote" id="txtNote" cols="60" rows="3"><?= (isset($txtNote)) ? $txtNote : "" ;?></textarea>
				</div>
			</div>
			<div class="form-action">
				<button type="submit" class="btn btn-sm" name="submit" value="Submit">Save</button>
				<button type="submit" class="btn btn-sm btn-default" name="submit" value="Cancel">Cancel</button>
			</div>

		</form>
</section>