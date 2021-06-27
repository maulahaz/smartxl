<script>
  // alert(1);
  const myBaseURL = '<?php echo site_url(); ?>';
  let table;

  $('.myDatepicker').datetimepicker({
        format: 'DD-MMM-YYYY'
  });

  $(function () {
    $('.myTimepicker').datetimepicker({
        format: 'hh:mm A'
    });
  });  

  fetchDatatable();

  function fetchDatatable()
  {
    var startDt = $('#start_date').val();
    var endDt = $('#end_date').val();

    var myDatatable = $('#my_table').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      /// Load data for the table's content from an Ajax source:
      "ajax": {
        "url": myBaseURL + "overtime/ajaxRead",
        "type": "POST",
        "data":{
          start_date:getUnixDate(startDt), end_date:getUnixDate(endDt)
        },
      },
      //Set column definition initialisation properties.
      "columnDefs": [
        { 
          "targets": [ 0,-1 ], //first and last column
          "orderable": false, //set not orderable
        },
      ],
    });
  }

  function reloadTable(){
    $('#frm_filter')[0].reset();
    $('#my_table').DataTable().destroy();
    //myDatatable.ajax.reload(); //reload datatable ajax || null,false
    fetchDatatable();
  }

  $('#btn_reload').click(function(){
    reloadTable();
    // table.ajax.reload(null,false);
  });

  $('#btn_filter_bydate').click(function(){
    var startDt = $('#start_date').val();
    var endDt = $('#end_date').val();
    if(startDt != '' && endDt !=''){
      $('#my_table').DataTable().destroy();
      // myDatatable.ajax.reload();
      fetchDatatable();
    } else{
      alert("Both Date is Required");
    }
  });

  /// Action for Form Print in case Different Tab Menu is clicked:
  ///============================================================= 
  $('#tb_month-tab').on('click', function(ev){
    var formAction = myBaseURL + 'overtime/printByMonth'
    // alert('Test');
    ev.preventDefault();
    $('#my_form')[0].reset();
    $("#my_form").attr("action", formAction);
  });  

  $('#tb_date-tab').on('click', function(ev){
    var formAction = myBaseURL + 'overtime/printByDate'
    // alert('Test');
    ev.preventDefault();
    $('#my_form')[0].reset();
    $("#my_form").attr("action", formAction);
  });

  $('#btn_print').on('click', function(ev){
    // alert('Test');
    ev.preventDefault();

    $('#my_form')[0].reset();
    $('#btn_submit').text('Submit');
    $('#btn_submit').attr('disabled',false);
    $('#my_modal .modal-header .modal-title').text('Print Overtime');
    $('#my_modal').modal('show');
        
  });

  function getUnixDate(myDate)
  {
    // var date = new Date(myDate).getTime() / 1000;
    var date = parseInt((new Date(myDate).getTime() / 1000).toFixed(0))
    return date;
  }

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
  }

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
  }

</script>