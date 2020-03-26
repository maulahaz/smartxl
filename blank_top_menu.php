<?php  
if(isset($_SESSION['user_id'])){
	$login_id = $_SESSION['user_id'];
} else{
	$login_id = 'Guess';
}

?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>XLPE - (CI-HMVC learning by MHz)</title>

	<!-- <link href="<?= base_url() ?>assets_startui/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144"> -->
	<!-- <link href="<?= base_url() ?>assets_startui/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114"> -->
	<link href="<?= base_url() ?>assets_startui/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="<?= base_url() ?>assets_startui/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="<?= base_url() ?>assets_startui/img/favicon.png" rel="icon" type="image/png">
	<link href="<?= base_url() ?>assets_startui/img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?= base_url() ?>assets_startui/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="<?= base_url() ?>assets_startui/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="<?= base_url() ?>assets_startui/css/separate/vendor/bootstrap-datetimepicker.min.css">	
<link rel="stylesheet" href="<?= base_url() ?>assets_startui/css/separate/vendor/bootstrap-daterangepicker.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets_startui/css/lib/clockpicker/bootstrap-clockpicker.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets_startui/css/separate/vendor/bootstrap-select/bootstrap-select.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets_startui/css/lib/font-awesome/font-awesome.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets_startui/css/lib/bootstrap/bootstrap.min.css">


<link rel="stylesheet" href="<?= base_url() ?>assets_startui/css/lib/datatables-net/dataTables.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets_startui/css/main.css">
<link rel="stylesheet" href="<?= base_url() ?>assets_startui/css/lib/sweetalert2/sweetalert2.min.css">
<!-- <link rel="stylesheet" href="<?= base_url() ?>assets_bs4/tempusdominus-bootstrap-4.min.css"> -->
<style type="text/css">
body { background: #edeaef !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>
</head>
<!-- <body class="with-side-menu"> -->
<body class="horizontal-navigation">
	<header class="site-header">
		<div class="container-fluid">			
			<a href="<?= base_url() ?>" class="site-logo" style="font-weight: bold; font-size: 30px; color: black;">XLPE Smart</a>
<!-- 	            
            <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
            	<span>toggle menu</span>
            </button>

            <button class="hamburger hamburger--htla">
            	<span>toggle menu</span>
            </button>
	        -->     
            <div class="site-header-content">
            	<div class="site-header-content-in">
            		<div class="site-header-shown">

            			<div class="dropdown user-menu">
            				<button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            					<img src="<?= base_url() ?>assets_startui/img/avatar-2-64.png" alt="">
            				</button>
            				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
            					<a class="dropdown-item" href="<?= base_url() ?>#"><span class="font-icon glyphicon glyphicon-user" style="font-weight: bold; font-size: 20px; color: black;"> <?= $login_id ?></span></a>
            					<a class="dropdown-item" href="<?= base_url() ?>accounts/profile"><span class="font-icon glyphicon glyphicon-user"></span>Profile</a>
            					<a class="dropdown-item" href="<?= base_url() ?>#"><span class="font-icon glyphicon glyphicon-cog"></span>Settings</a>
            					<a class="dropdown-item" href="<?= base_url() ?>#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Help</a>
            					<div class="dropdown-divider"></div>
            					<?php if($login_id != 'Guess'){ ?>
	            					<a class="dropdown-item" href="<?= base_url() ?>accounts/logout"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
	            				<?php }else{ ?>
	            					<a class="dropdown-item" href="<?= base_url() ?>accounts/login"><span class="font-icon glyphicon glyphicon-log-in"></span>Login</a>
	            				<?php } ?>
            				</div>
            			</div>
            			
            			<button type="button" class="burger-right">
            				<i class="font-icon-menu-addl"></i>
            			</button>
            		</div><!--.site-header-shown-->
            		<div class="site-header-collapsed"">
	                    <div class="site-header-collapsed-in pull-left">

	                        <div class="dropdown" style="margin:0px 10px">
	                            <button class="btn btn-rounded dropdown-toggle" id="dd-header-add" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:140px">
	                                About Us
	                            </button>
	                            <div class="dropdown-menu" aria-labelledby="dd-header-add">
	                                <a class="dropdown-item" href="<?= base_url();?>ourteams">Our teams</a>
	                                <a class="dropdown-item" href="#">Contact Us</a>
	                            </div>
	                        </div>

	                        <div class="dropdown" style="margin:0px 10px">
	                            <button class="btn btn-rounded dropdown-toggle" id="dd-header-add" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:140px">
	                                Activities
	                            </button>
	                            <div class="dropdown-menu" aria-labelledby="dd-header-add">
	                                <a class="dropdown-item" href="<?= base_url();?>charging">Charging Additive</a>
	                                <a class="dropdown-item" href="<?= base_url();?>etask">Etask</a>
	                                <a class="dropdown-item" href="<?= base_url();?>packaging">Packaging</a>
	                            </div>
	                        </div>

	                        <div class="dropdown" style="margin:0px 10px">
	                            <button class="btn btn-rounded dropdown-toggle" id="dd-header-add" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:140px">
	                                Personal
	                            </button>
	                            <div class="dropdown-menu" aria-labelledby="dd-header-add">
	                                <a class="dropdown-item" href="<?= base_url();?>overtime">Overtime</a>
	                                <a class="dropdown-item" href="#">Another link</a>
	                            </div>
	                        </div>

	                        <div class="dropdown" style="margin:0px 10px">
	                            <button class="btn btn-rounded dropdown-toggle" id="dd-header-add" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:140px">
	                                Safety
	                            </button>
	                            <div class="dropdown-menu" aria-labelledby="dd-header-add">
	                                <a class="dropdown-item" href="<?= base_url();?>bypass">Interlock Bypass</a>
	                                <a class="dropdown-item" href="#">Another link</a>
	                            </div>
	                        </div>
	                        
	                    </div><!--.site-header-collapsed-in-->
	                </div><!--.site-header-collapsed-->	            

            	</div><!--site-header-content-in-->

            </div><!--.site-header-content-->
        </div><!--.container-fluid-->
    </header><!--.site-header-->



	    <div class="page-content" style="margin-top: -70px">
	    	
	    	<div class="container-fluid">

	    		<?php echo $this->load->view($view_module.'/'.$view_file); ?>

	    	</div><!--container-fluid-->
	    </div><!--page-content -->

	    <!-- javascript -->

	    <script src="<?= base_url() ?>assets_startui/js/lib/jquery/jquery.min.js"></script>
	    
	    <script src="<?= base_url() ?>assets_startui/js/lib/datatables-net/datatables.min.js"></script>
	    <script src="<?= base_url() ?>assets_startui/js/lib/tether/tether.min.js"></script>
	    <script src="<?= base_url() ?>assets_startui/js/lib/bootstrap/bootstrap.min.js"></script>
	    <script src="<?= base_url() ?>assets_startui/js/plugins.js"></script>

	    <script type="text/javascript" src="<?= base_url() ?>assets_startui/js/lib/moment/moment-with-locales.min.js"></script>
	    



	    <script type="text/javascript" src="<?= base_url() ?>assets_startui/js/lib/eonasdan-bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	    <script src="<?= base_url() ?>assets_startui/js/lib/clockpicker/bootstrap-clockpicker.min.js"></script>
	    <script src="<?= base_url() ?>assets_startui/js/lib/clockpicker/bootstrap-clockpicker-init.js"></script>
	    <script src="<?= base_url() ?>assets_startui/js/lib/daterangepicker/daterangepicker.js"></script>
	    <script src="<?= base_url() ?>assets_startui/js/lib/bootstrap-select/bootstrap-select.min.js"></script>
	    <script src="<?= base_url() ?>assets_startui/js/lib/sweetalert2/sweetalert2.min.js"></script>
	    <!-- Custom JS -->
	    <script src="<?= base_url() ?>assets/js/Packaging.js"></script>
	    <script src="<?= base_url() ?>assets/js/Etask.js"></script>
		<?php 
		if(isset($js_file)){
			$this->load->view($js_file); 
		}	
		?>
											

	    <script>
			const myBaseURL = '<?php echo base_url(); ?>';

	    	$(function() {

	    		$('.my_date_1').datetimepicker({
	    			singleDatePicker: true,
	    			showDropdowns: true,
	    			timePicker: false,
	    			debug: false,
	    			format:'DD-MMM-YYYY',
	    			// locale: {
				    //   format: 'DD-MMM-YYYY'
				    // }
				});

			/* ==========================================================================
			 Datepicker
			 ========================================================================== */

			 $('.datepicker_only').datetimepicker({
			 	widgetPositioning: {
			 		horizontal: 'right'
			 	},
			 	// format: 'LT',
			 	debug: false,
			 	format:'DD-MMM-YYYY',
			    // minDate: getFormattedDate(new Date())
			});

			 $('.datetimepicker-1').datetimepicker({
			 	widgetPositioning: {
			 		horizontal: 'right'
			 	},
			 	// format: 'LT',
			 	debug: false,
			 	format:'DD-MMM-YYYY HH:mm',
			    // minDate: getFormattedDate(new Date())
			});

			 $('.datetimepicker-2').datetimepicker({
			 	widgetPositioning: {
			 		horizontal: 'right'
			 	},
			 	format: 'LT',
			 	debug: false
			 });
			});

	    	$('#my_datetimepicker').datetimepicker({
	    		format: 'mm/dd/yyyy',
	    		startDate: '-3d',
	    		widgetPositioning: {
	    			horizontal: 'right'
	    		},
	    	});

	    	$('#daterange3').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			});

	    	// Startdate and EndDate
	    	$('#startdate,#enddate').datetimepicker({
                useCurrent: false,
                minDate: moment()
            });
            $('#startdate').datetimepicker().on('dp.change', function (e) {
                var incrementDay = moment(new Date(e.date));
                incrementDay.add(1, 'days');
                $('#enddate').data('DateTimePicker').minDate(incrementDay);
                $(this).data("DateTimePicker").hide();
            });
            $('#enddate').datetimepicker().on('dp.change', function (e) {
                var decrementDay = moment(new Date(e.date));
                decrementDay.subtract(1, 'days');
                $('#startdate').data('DateTimePicker').maxDate(decrementDay);
                 $(this).data("DateTimePicker").hide();
            });

            // tempusdominus Startdate and EndDate
            $(function () {
            $('#datetimepicker7').datetimepicker();
            $('#datetimepicker8').datetimepicker({
                useCurrent: false
            });
            $("#datetimepicker7").on("change.datetimepicker", function (e) {
                $('#datetimepicker8').datetimepicker('minDate', e.date);
            });
            $("#datetimepicker8").on("change.datetimepicker", function (e) {
                $('#datetimepicker7').datetimepicker('maxDate', e.date);
            });
        });

	    </script>
	    <script src="<?= base_url() ?>assets_startui/js/app.js"></script>


	</body>
	</html>