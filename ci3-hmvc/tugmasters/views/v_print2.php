<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$title; ?></title>

    <!-- Bootstrap -->
    <link href="<?= base_url(); ?>t_gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>t_gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Forcing to Landscape printing -->
    <style type="text/css" media="print">
      @page { size: landscape; }
    </style>
    
    <style>
      
    </style>

  </head>

  <body>
    <div class="row">
      <div class="col-sm-12">
        Dear <strong>Terminal Handling Dept,</strong>
        <br><br>
        <p>We Would like you to replace our 4 Loaded containers with containers as per listed in the table below.</p>  
        <p>Kindly inform your Tug Master Operator to contact XLPE Control room by radio and take signed this mail/form from XLPE operation before removing Container.</p>
        <br>Best Regard,
        <br><strong><u>XLPE Supervisor</u></strong>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-12 tbl-request">
        <h5 class="panel-title"><strong><u> Container summary</u></strong></h5>
        <h5 class="pull-right"><small>Request #2010203</small></h5>

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
                    <td colspan="7" class="text-center">Data not available</td>
                  </tr>    
              <?php endif; ?>       
            </tbody>
          </table>

      </div>
    </div>
    <div class="row confirmation">
      <div class="col-sm-12">
        <p>I hereby acknowledge that the container as per listed above is safe and secure to take by Tug Master Operator.</p>
        <strong>XLPE Operator</strong>
        <br><br><br>
        <p><u>XLPE Operator</u></p>
        <small>30-October-2020</small>
      </div>
    </div>
  </body>
</html>