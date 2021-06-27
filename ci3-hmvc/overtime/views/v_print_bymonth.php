<?php  
  $this->load->model("overtime_mdl");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title; ?></title>
  <link href="<?= base_url(); ?>t_gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
<!-- LANDSCAPE PRINTING -->
<!-- ====================================================================== -->
<!-- 
  <style type="text/css" media="print">
    @page { size: landscape; }
  </style> 
-->

<!-- CUSTOM STYLING -->
<!-- ============================================================== -->
<style>
table th,td { text-align : center}
</style>

</head>
<body>
  <h3 style="text-align: center"><?=$pageTitle; ?></h3>
  <hr>
  <table>
    <tr>
      <td style="text-align: left">Employee </td>
      <td>:</td>
      <td style="text-align: left"><strong><?=strtoupper($loginID) ." (". $this->session->userdata('sesName').")"; ?></strong></td>
    </tr>
    <tr>
      <td style="text-align: left">Month </td>
      <td>:</td>
      <td style="text-align: left"><strong><?=date("F", mktime(0, 0, 0, $otMonth, 10)); ?></strong></td>
    </tr>
    <tr>
      <td style="text-align: left">Year </td>
      <td>:</td>
      <td style="text-align: left"><strong><?=$otYear; ?></strong></td>
    </tr>
  </table>

  <table class="table table-bordered table-stripped table-sm mt-4">
    <thead>
      <tr>
        <th>No</th>
        <th>Overtime From</th>
        <th>Overtime To</th>
        <th>Category</th>
        <th>Reason</th>
      </tr>      
    </thead>
    <tbody>
      <?php $no = 1; ?>
      <?php foreach ($qry->result() as $row) :?>
        <tr>
          <!-- <td><?//$no++; ?></td> -->
          <td><?=$row->TglOT; ?></td>
          <!-- <td><?// $this->mydatetime->get_nice_date($row->ot_date_from,'overtime');?></td>
          <td><?// $this->mydatetime->get_nice_date($row->ot_date_to,'overtime'); ?></td> -->
          <td><?=$row->ot_date_from; ?></td>
          <td><?=$row->ot_date_to; ?></td>
          <td><?=$row->ot_category; ?></td>
          <td style="text-align: left"><?=$row->ot_reason; ?></td>
        </tr>
      <?php endforeach; ?>       
    </tbody>
  </table>

  <script src="<?= base_url(); ?>t_gentelella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    // window.print();
  </script>
</body>
</html>