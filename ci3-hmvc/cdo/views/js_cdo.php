<script>
  // alert(1);
  const myBaseURL = '<?php echo site_url(); ?>';
  let dataTable;

  $('.myDatepicker').datetimepicker({
        format: 'DD-MMM-YYYY'
  });

  fetchDatatable();

  function fetchDatatable()
  {
    // var startDt = $('#start_date').val();
    // var endDt = $('#end_date').val();

    myDatatable = $('#my_table').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [], //Initial no order.
      "ajax": {
        "url": myBaseURL + "cdo/ajaxRead",
        "type": "POST",
        // "data":{
        //   start_date:getUnixDate(startDt), end_date:getUnixDate(endDt)
        // },
      },
      "columnDefs": [
        { 
          "targets": [ 0,-1 ], //first and last column
          "orderable": false, //set not orderable
        },
      ],
    });
  }

  function reloadDatatable()
  {
    myDatatable.ajax.reload(null, false);
  }

  $('#btn_reload').click(function(){
    reloadDatatable();
  });

</script>