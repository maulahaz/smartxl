<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$title; ?></title>
  <link href="<?= base_url(); ?>t_gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CUSTOM STYLE -->
  <style>
      /* GENERAL */
      /* -------------------------------------- */
      table th,td { text-align : center}
      ul {list-style-type: none;}
      .company{
        display: flex;
        border-bottom: 1px solid #3989c6;
        justify-content: space-between;
        align-items: center;

      }
      .comp-logo{
        display: flex;
        align-items: center;
      }
      .logo{
        width: 100px;
        height: 120px;
        padding: 10px;
      }

      .report-title{
        text-align: center;
        padding: 20px;
      }
      .notes{
        font-size: 1.2em;
        padding-left: 16px;
        border-left: 6px solid #3989c6
      }
  </style>
  <!-- Forcing to Landscape printing -->
  <style type="text/css" media="print">
    @page { size: landscape; }
  </style> 

</head>
<body>
<?php  
  $logo = getProfile('Logo');
?>
<div>
    <div class="row top-header">
        <div class="col-sm-12">
          <div class="row">
              <div class="company">
                <div class="comp-logo">
                  <img class="logo" src="<?=($logo != "") ? base_url('uploads/configs/').$logo : base_url('assets/img/no-image.jpg') ; ?>" class="img-responsive">
                  <h3><?= getProfile('Company_name'); ?></h3>              
                </div>
              </div> 
          </div>
          <div class="row report-title">
              <h2 class="title">TUGMASTER REQUEST</h2>
          </div>
        <div class="row">
          <div class="col-sm-6">
            <address>
            <strong>TO:</strong><br>
              <strong><span style="font-size: .8em;">TERMINAL HANDLING</span></strong><br>
            </address>
          </div>
        </div>  
        <div class="row">
          <div class="col-sm-12">
            <p>Please provide us x number of Container</p><br>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>Item summary</strong></h3>
          </div>
          <div class="panel-body">
            <div class="table">
              <table class="table table-striped table-sm table-bordered">
                <thead>
                  <tr>
                    <th width="50">Bay#</th>
                    <th width="120">Container</th>
                    <th width="200">Material</th>
                    <th width="100">Qty</th>
                    <th width="100">Destination</th>
                    <th width="120">Replace with</th>
                    <th>Notes</th>
                  </tr>     
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php if (isset($dtItems) && $dtItems->num_rows()>0 ) :?>
                    <?php foreach ($dtItems->result() as $row) :?>
                      <tr>
                        <td><?= $row->Bay_no;?></td>
                        <td><?= $row->Container_no;?></td>
                        <td class="text-left"><?= $row->Material.' '.$row->Batch ;?></td>
                        <td class="text-center"><?= $row->Qty.' '.$row->Unit;?></td>
                        <td class="text-center"><?= $row->Destination;?></td>
                        <td class="text-center"><?= $row->Replace_with;?></td>
                        <td class="text-left"><?= $row->Notes;?></td>
                      </tr> 
                    <?php endforeach; ?>  
                  <?php else: ?>
                     <tr>
                        <td colspan="7">Data not available</td>
                      </tr>    
                  <?php endif; ?>       
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="notes">
        <h5><strong>Additional Notes :</strong></h5>
        <div>
          <p>Please contact OPERATOR in Radio Channel: <strong>B3-OPS XLPE</strong>.</p>
        </div>
    </div>
</div>
  <script src="<?= base_url(); ?>t_gentelella/vendors/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url(); ?>t_gentelella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      // window.print();
    });
  </script>
</body>
</html>