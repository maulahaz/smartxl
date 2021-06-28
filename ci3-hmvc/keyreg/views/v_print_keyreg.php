<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title; ?></title>
  <link href="<?= base_url(); ?>t_gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <style type="text/css" media="print">
    @page { size: landscape; }
  </style>

</head>
<body>
  <h3 style="text-align: center"><?=$pageTitle; ?></h3>
  <table>
    <tr>
      <td>From date </td>
      <td>:</td>
      <td><?=date("d-M-Y", strtotime($fromDate)); ?></td>
    </tr>
    <tr>
      <td>Until date </td>
      <td>:</td>
      <td><?=date("d-M-Y", strtotime($untilDate)); ?></td>
    </tr>
  </table>

  <table class="table table-bordered table-stripped table-sm mt-4">
    <thead>
      <tr>
        <th>No</th>
        <th>Key</th>
        <th>Taken Date</th>
        <th>Taken By</th>
        <th>Reason</th>
        <th>Return Date</th>
        <th>Return By</th>
        <th>Notes</th>
      </tr>      
    </thead>
    <tbody>
      <?php $no = 1; ?>
      <?php foreach ($qry->result() as $row) :?>
        <tr>
          <td><?=$no++; ?></td>
          <td><?=$row->Keyreg_type; ?></td>
          <td><?=date("d-M-Y H:i", strtotime($row->Taken_dtm)); ?></td>
          <td><?=$row->Taken_by; ?></td>
          <td><?=$row->Reason; ?></td>
          <td><?=date("d-M-Y H:i", strtotime($row->Return_dtm)); ?></td>
          <td><?=$row->Return_by; ?></td>
          <td><?=$row->Notes; ?></td>
        </tr>
      <?php endforeach; ?>       
    </tbody>
  </table>

  <script src="<?= base_url(); ?>t_gentelella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    window.print();
  </script>
</body>
</html>