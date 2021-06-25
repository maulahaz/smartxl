<script type="text/javascript">
// Screening/List =======================================================
	$('#myForm').parsley();
	
	$('#myForm').on('submit', function(ev){
		ev.preventDefault();
		if($('#myForm').parsley().isValid()){
			// save();
			// simpan();
			simpan_dt();
		}
	});	

	let save_method;

	$('#btnAdd').on('click', function(ev){
		ev.preventDefault();
		save_method = "create";

		$('#myForm')[0].reset();
		$('#myForm').parsley().reset();
		$('#myModal .modal-header .modal-title').text('Register Health Screening');
		$('#myModal').modal('show');
	});

	function edit(uid){
		save_method = "update";
		$('#myForm')[0].reset();
		
		action_url = myBaseURL + 'screening/ajax_edit/' + uid;
		$.ajax({
			url: action_url,
			type: 'post',
			dataType: 'json',
			success: function(res){
				$('[name="inpUID"]').val(uid);
				$('[name="inpEmpID"]').val(res.Emp_id);
				$('[name="inpName"]').val(res.Name);
				$('[name="inpPhone"]').val(res.Phone);
				$('[name="inpEmirateID"]').val(res.Emirate_id);
				$('[name="optDept"]').val(res.Dept);
				$('[name="optScrDate"]').val(res.Screen_dt);
				$('#myModal .modal-header .modal-title').text('Edit Data');
				$('#myModal').modal('show');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error getting data, please contact Administrator');
			}
		});
	}

	function simpan(){
		let action_url;
		action_url = myBaseURL + 'screening/ajax_action_ext/' + save_method;

		$.ajax({
			url: action_url,
			type: 'post',
			data: $('#myForm').serialize(),
			dataType: 'json',
			success: function(res){
				$('#myModal').modal('hide');
				if(res.isSuccess === true){
					// $('.msgbox').html(
					// 	'<div class="alert alert-success" role="alert"> '+
					// 	res.pesan +
					// 	'</div>'
					// );
					alert(res.pesan);

				}else{
					if(res.pesan instanceof Object){
						$.each(res.pesan, function(index, value){
							// $('.msgbox').append(value);
							alert(value);
						});
					}
				}
				
				location.reload();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error during save execution, please contact Administrator');
			}
		});
	}

	function simpan_dt(){
		let action_url;
		action_url = myBaseURL + 'screening/ajax_action_ext/' + save_method;

		//reset
		$('.msgbox').html();

		$.ajax({
			url: action_url,
			type: 'post',
			data: $('#myForm').serialize(),
			dataType: 'json',
			success: function(res){
				$('#myModal').modal('hide');
				if(res.isSuccess === true){
					$('.msgbox').html(
						'<div class="alert alert-success" role="alert"> '+
						res.pesan +
						'</div>'
					);

				}else{
					if(res.pesan instanceof Object){
						$.each(res.pesan, function(index, value){
							$('.msgbox').append(value);
						});
					}
				}

				tbl_manage.ajax.reload(null, false);

			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error during save execution, please contact Administrator');
			}
		});
	}

	function save(){
		let action_url;
		action_url = myBaseURL + 'screening/ajax_action/' + save_method;

		$.ajax({
			url: action_url,
			type: 'post',
			data: $('#myForm').serialize(),
			dataType: 'json',
			success: function(res){
				$('#myModal').modal('hide');
				//NGGAK AKAN MUNCUL ALERT, KRN PAGE DI RELOAD DI NEXT STEP CODE:
				// $(".msgbox").html(
				// 	'<div class="alert alert-success" role="alert">'+
		  //             'Alert message'+
		  //             '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
		  //               '<span aria-hidden="true">&times;</span>'+
		  //             '</button>'+
		  //           '</div>'
				// 	);
				alert(res.pesan);
				location.reload();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error during save execution, please contact Administrator');
			}
		});
	}

	function del(id){
		if(confirm('Are you sure delete this data ?')){
			$.ajax({
			url: myBaseURL + 'screening/ajax_delete/' + id,
			type: 'post',
			dataType: 'json',
			success: function(res){
				alert(res.pesan);
				location.reload();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error during delete execution, please contact Administrator');
			}
		});
		}
	}

// Screening/Manage =======================================================	
	let tbl_manage;
	// alert(1);
	tbl_manage = $('#tbl_manage').DataTable({
		'ajax' :  myBaseURL + 'screening/fetch_datatable'
	});

	// $(function() {
	// 	$('#tbl_manage').DataTable({
	// 	});
	// });

</script>