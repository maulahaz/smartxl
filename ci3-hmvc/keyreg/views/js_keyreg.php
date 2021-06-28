<script>
// alert(1);
	const myBaseURL = '<?php echo base_url(); ?>';
	let myDatatable;
	let saveMethod;
	let actionURL;

	fetchData();

	function fetchData(action){
		myDatatable = $('#my_table').DataTable({
			'ajax': myBaseURL + 'keyreg/ajaxAction/read',
			columnDefs: [ 
		  	{ orderable: false, targets: [0,-1] }, 
	  	],
		});  	
	};

	// $('#my_form').parsley();

	$('#my_form').on('submit', function(ev){
		ev.preventDefault();
		// if($('#my_form').parsley().isValid()){
			save();
		// }
	});

	$('#btn_add').on('click', function(ev){
		// alert('Test');
		ev.preventDefault();
		saveMethod = "create";

		$('#my_form')[0].reset();
		$('#my_modal .modal-header .modal-title').text('Add New Etask');
		$('#my_modal').modal('show');
        
	});

	function edit(uid){
		saveMethod = "update";
		var dataID = $(this).data('uid');
		$('#my_form')[0].reset();
		
		actionUrl = myBaseURL + 'keyreg/ajaxEdit/' + uid;
		$.ajax({
			url: actionUrl,
			type: 'post',
			// data: $('#myForm').serialize(),
			dataType: 'json',
			success: function(res){
				uAssignDate = unixDate_to_myDate(res.Assign_date);
				uTargetDate = unixDate_to_myDate(res.Target_date);
				// alert(timeDB + '-' + res.Origin + '-' + res.Destination);
				$('[name="inpUID"]').val(uid);
				$('[name="inpTitle"]').val(res.Etask_uid);
				$('[name="inpAssignTo"]').val(res.Assign_to);
				$('[name="inpAssignDate"]').val(uAssignDate);
				$('[name="inpTargetDate"]').val(uTargetDate);
				$('[name="optStatus"]').val(res.Status);
				$('#my_modal .modal-header .modal-title').text('Edit Etask');
				$('#my_modal').modal('show');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error getting data, please contact Administrator');
			}
		});
	};

	function save(){
		actionURL = myBaseURL + 'keyreg/ajaxAction/' + saveMethod;

		$.ajax({
			url: actionURL,
			type: 'post',
			data: $('#my_form').serialize(),
			dataType: 'json',
			success: function(res){
				$(".msgbox").empty();
				$('#my_modal').modal('hide');
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
				myDatatable.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error during save execution, please contact Administrator');
			}
		});
	}

	function del(uid){
		if(confirm('Are you sure delete this data ?')){
			$.ajax({
				url: myBaseURL + 'keyreg/ajaxDelete/' + uid,
				type: 'post',
				dataType: 'json',
				success: function(res){
					$('.msgbox').html(
						'<div class="alert alert-success" role="alert"> '+
						res.pesan +
						'</div>'
					);

					myDatatable.ajax.reload(null, false);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert('Error during delete execution, please contact Administrator');
				}
			});
		}
	};

	$('.myDatepicker').datetimepicker({
        format: 'DD-MMM-YYYY'
    });

	function datetime_to_mydate(mysqlDate){
		let z = new Date(mysqlDate);
		let months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	 	let year = z.getFullYear();
	 	let month = months[z.getMonth()];
	 	// let month = z.getMonth()+1; // Using numerical Month
	 	let date = awalNol(z.getDate());
	 	let hrs = awalNol(z.getHours());
	 	let mnts = awalNol(z.getMinutes());
	  	// let secs = z.getSeconds();
		let formatted_date = date + '-' + month + '-' + year + " " + hrs + ":" + mnts; //mysqlDate.getDate() + "-" + (mysqlDate.getMonth() + 1) + "-" + mysqlDate.getFullYear()
		// console.log(formatted_date);
		return formatted_date;
		
	};

	function unixDate_to_myDate(UNIX_timestamp_date){
	  var a = new Date(UNIX_timestamp_date * 1000);
	  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	  var year = a.getFullYear();
	  var month = months[a.getMonth()];
	  var date = a.getDate();
	  // var hour = a.getHours();
	  // var min = a.getMinutes();
	  // var sec = a.getSeconds();
	  var time = date + '-' + month + '-' + year;// + ' ' + hour + ':' + min + ':' + sec ;
	  return time;
	};

	function unixDateTime_to_myTime(UNIX_timestamp_DateTime){
	  var a = new Date(UNIX_timestamp_DateTime * 1000);
	  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	  var year = a.getFullYear();
	  var month = months[a.getMonth()];
	  var date = a.getDate();
	  var hour = "0" + a.getHours() - 2;
	  var min = "0" + a.getMinutes();
	  var sec = a.getSeconds();
	  // var time = hour + ':' + min;
	  var time = hour + ':' + min.substr(-2);
	  return time;
	};

	$('#btn_print').on('click', function(ev){
		// alert('Test');
		ev.preventDefault();

		$('#my_form_report')[0].reset();
		$('#btn_submit').text('Submit');
		$('#btn_submit').attr('disabled',false);
		$('#my_modal .modal-header .modal-title').text('Print Key Register');
		$('#my_modal').modal('show');
        
	});

	$('#my_form_reportXXX').on('submit', function(ev){
		ev.preventDefault();
		// $('#btn_submit').text('Processing...');
		// $('#btn_submit').attr('disabled',true);

		$.ajax({
			// url: myBaseURL + 'keyreg/report',
			url: myBaseURL + 'keyreg/test',
			type: 'post',
			data: $('#my_form_report').serialize(),
			dataType: 'json',
			// success: function(res){
			// 	console.log(res);
				// $('#my_modal').modal('hide');

				// if(res.status == 'Fail'){
				// 	$('.msgbox').html(
				// 		'<div class="alert alert-success" role="alert"> '+
				// 		res.msg +
				// 		'</div>'
				// 	);
				// } else{
				// 	location.reload();
				// }
		// 	},
		// 	error: function(jqXHR, textStatus, errorThrown){
		// 		alert('Error during execution, please contact Administrator');
		// 	}
		});
	});

</script>