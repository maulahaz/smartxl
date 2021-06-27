<html>
<head>
    <title>Convert HTML to PDF in CodeIgniter using Dompdf</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
 <div class="container box">
  <br />
  <h3 align="center">Convert HTML to PDF in CodeIgniter using Dompdf</h3>
  <br />
  <?php
  if(isset($ot_record))
  {
  ?>
  <div class="table-responsive">
   <table class="table table-striped table-bordered">
    <tr>
     <th>#</th>
	 <th>OT From</th>
	 <th>OT To</th>
	 <th>OT Type</th>
	 <th>Reason</th>
    </tr>
   <?php
   $sn=1;
   foreach($ot_record->result() as $row)
   {
    echo '
    <tr>
     <td>'.$sn++.'</td>
     <td>Test</td>
     <td>Test</td>
     <td>'.$row->ot_category.'</td>
     <td>'.$row->ot_reason.'</td>
    </tr>
    ';
   }
   ?>
   </table>
  </div>
  <?php
  }
  ?>
 </div>
</body>
</html>