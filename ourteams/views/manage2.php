<link href="<?php echo base_url();?>mycustoms/ourteams2.css" rel="stylesheet">

<?php 
  $this->load->module('site_security');
  $usrLevel = $this->site_security->_get_user_level();

  if(isset($flash)){ $flash;}

  $create_url = base_url()."accounts/create";

?>

<div class="container">
    <h1 class="times">XLPE Teams</h1>
    <?php      
    if($usrLevel == 5){ ?>
      <div class="float-left"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a>
      </div>
    <?php
    }
    ?>  
      <!-- <div>
        <a href="<?= $create_url; ?>"><button type="button" class="btn btn-primary">Add New Accounts</button></a>
      </div> -->
    <div style="text-align: right; margin-bottom:20px;">
        <?php  
          echo form_open('ourteams/search');
          // echo form_dropdown('search_by',$search_opts,'',$attributes);
        ?>
        <select name="search_by2" id="">
          <option value="">Search By...</option>
          <option value="usr_ID">Employee ID</option>
          <option value="usr_Name">Name</option>
          <option value="usr_Position">Position</option>
          <option value="usr_Phone1">Phone</option>
        </select>

        <input type="text" name="search_it">
        
        <input type="submit" name="search" value="Search">
        <?php
          echo form_close();
        ?>

    </div>
    <div style="text-align: left">
      <?php  
        if(isset($tot_data)){
          echo "<b>Search result : </b>".$tot_data." record(s) found";
        }

      ?>

    </div>

  <div class="row center-block">
    <?php
      foreach ($team_data->result() as $row){
        $det_uid = base_url()."accounts/edit/".$row->uid;
    ?>
    <div class="col-md-6">
       <div class='team-box'>
        <div class="media">
          <div class="media-left media-middle">
              <img src="<?= base_url() ?>big_pics/<?= $row->usr_Big_pic ?>" class="media-object img-thumbnail" style="width:100px">
          </div>
          <div class="media-body">
            <!-- <h5 class="media-heading pull-right">Won: 3</h5> -->
            <h4 class="media-heading" style="color:#575c63; font-weight: bold;"><a href="<?= $det_uid;?>"><?= $row->usr_Name ?></a></h4>
            <div class="team-box-info">
              <p><?= $row->usr_Position ?></p>
              <?php  
              if($row->usr_Phone1 > 0){
              ?>  
              <p><span class="glyphicon glyphicon-phone"> <?= $row->usr_Phone1 ?></p>
              <?php  
              } else{
              ?>  
              <p><span class="glyphicon glyphicon-phone"> -- </p>
              <?php 
              }
              ?>
          </div>
          <div class="team-box-info">
            <p> </p>    
          </div>
          <div class="team-box-info">
            <p></p>    
          </div>
          <div class="team-box-info">
            <?php  
            if($row->usr_Phone1 > 0){
            ?>  
            <p><span class="glyphicon glyphicon-envelope"> <?= $row->usr_Email ?> </span></p> 
            <?php  
            } else{
            ?>  
            <p><span class="glyphicon glyphicon-envelope"> -- </span></p>
            <?php 
            }
            ?>          
               </div>
          </div>
          <!-- media-body -->
        </div>
        <!-- media -->
    </div>
    <!-- team-box -->
  
  </div>
  <!-- col -->

  <?php
      }
  ?>
</div>
<!-- foreach -->
<!-- container-->
<!-- MODAL ADD -->
            <form>
            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Employee ID</label>
                            <div class="col-md-10">
                              <input type="text" name="usr_ID" id="usr_ID" class="form-control" placeholder="brw01234">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Employee Name</label>
                            <div class="col-md-10">
                              <input type="text" name="usr_Name" id="usr_Name" class="form-control" placeholder="Employee Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                              <input type="text" name="usr_Mail" id="usr_Mail" class="form-control" placeholder="Email">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL ADD-->
