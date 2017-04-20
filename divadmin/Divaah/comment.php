<!DOCTYPE php>
<html lang="en">
<!-- BEGIN HEAD -->
<?php

require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<link rel="shortcut icon" href="assets/img/favicon.ico">
	
	<title>Divaah by Devika - Admin</title>
	
	<!-- BEGIN CORE FRAMEWORK -->
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<!-- END CORE FRAMEWORK -->
	
	<!-- BEGIN PLUGIN STYLES -->
	<link href="assets/plugins/animate/animate.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-slider/css/slider.css" rel="stylesheet" />
	<link href="assets/plugins/rickshaw/rickshaw.min.css" rel="stylesheet" />
	<link href="assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
	<!-- END PLUGIN STYLES -->
	
	<!-- BEGIN THEME STYLES -->
	<link href="assets/css/material.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href="assets/css/plugins.css" rel="stylesheet" />
	<link href="assets/css/helpers.css" rel="stylesheet" />
	<link href="assets/css/responsive.css" rel="stylesheet" />
	<!-- END THEME STYLES -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-leftside fixed-header">
	<!-- BEGIN HEADER -->
	<header>
		<div style="background-color: #3a4c5c;"><a href="index.php"><img src="assets/img/logo.png"/></a></div>
		<nav class="navbar navbar-static-top">
			<a href="#" class="navbar-btn sidebar-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
			<div class="navbar-header">
				<ul class="nav navbar-nav pull-left">
					<li><li><a href='logout.php?logout' class="button" title="Logout"><font size="4px">Logout </font><i class="ion-log-out"></i></a></li></li>
					<li class="dropdown dropdown-inverse">
						<a href="divaah_register.php" class="button" title="Add User"><i class="ion-person-add"></i></a>
						
					</li>
				</ul>
			</div>
            <div class="navbar-right">
				<form role="search" class="navbar-form pull-left" method="post" action="#">
					<div class="btn-inline">
						<input type="text" class="form-control padding-right-35" placeholder="Search..."/>
						<button class="btn btn-link no-shadow bg-transparent no-padding padding-right-10" type="button"><i class="ion-search"></i></button>
					</div>
				</form>
			</div>
        </nav>
    </header>
	<!-- END HEADER -->
		 
	<div class="wrapper">
		<!-- BEGIN LEFTSIDE -->
        <div class="leftside">
			<div class="sidebar">
			<br><br>
				<!-- BEGIN RPOFILE -->
				<div class="nav-profile">
					<div class="info">
						<a href="#">Admin</a>
						
					</div>
					
				</div>
				<!-- END RPOFILE -->
				<!-- BEGIN NAV -->
				<div class="title">Navigation</div>
					<ul class="nav-sidebar">
						<li class="active">
                            <a href="index.php">
                                <i class="ion-navicon-round"></i> <span>Dashboard</span>
                            </a>
                        </li>
						<li>
                            <a href="divaah_home.php">
                                <i class="ion-home"></i> <span>Home</span>
                            </a>
                        </li>
                       <li class="nav-dropdown">
                            <a href="#">
                                <i class="ion-beaker"></i> <span>Daily Wears</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
								<li><a href="divaah_daily.php">Daily Wears</a></li>
                                <li><a href="divaah_daily_kurti.php">Kurti</a></li>
                                <li><a href="divaah_daily_sarees.php">Sarees</a></li>
                                <li><a href="divaah_daily_salwar.php">Salwar Materials</a></li>
								
                            </ul>
                        </li>
                        <li class="nav-dropdown">
                            <a href="#">
                                <i class="ion-beaker"></i> <span>Party Wears</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
								<li><a href="divaah_party.php">Party Wears</a></li>
                                <li><a href="divaah_party_sarees.php">Sarees</a></li>
                                <li><a href="divaah_party_salwar.php">Salwars</a></li>
								
                            </ul>
                        </li>
						<li>
							<a href="divaah_newarrivals.php">
								<i class="ion-beaker"></i> <span>New Arrivals</span>
							</a>
						</li>
						<li>
							<a href="divaah_contact.php">
								<i class="ion-document-text"></i> <span>Contact Page</span>
							</a>
						</li>
						<li>
							<a href="divaah_footer.php">
								<i class="ion-compose"></i> <span>Footer</span>
							</a>
						</li>
						<li>
							<a href="divaah_images.php">
								<i class="ion-image"></i> <span>Images</span>
							</a>
						</li>
                    </ul>
					<!-- END NAV -->
					
			</div><!-- /.sidebar -->
        </div>
		<!-- END LEFTSIDE -->

		<!-- BEGIN RIGHTSIDE -->
        <div class="rightside bg-grey-100">
			<!-- BEGIN PAGE HEADING -->
			<br><br>
			<br><br>
            <div class="page-head bg-grey-100">
				<h1 class="page-title">Dashboard<small>Welcome to Divaah by Devika</small></h1>
			</div>
			<!-- END PAGE HEADING -->

            <div class="container-fluid">
				<div class="row">
					
				<?php
		$product_arrayx = $db_handle->runQuery("SELECT count(status) as 'statusa' FROM pro where status = 'Credit'");
	    if (!empty($product_arrayx)) { 
	    foreach($product_arrayx as $key=>$value){
	    $gd=$product_arrayx[$key]["statusa"]; ?>	
					
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="index.php">
						<div class="panel bg-blue-400">
							<div class="panel-body padding-15-20">
								<div class="clearfix">
									<div class="pull-left">
										<div class="color-white font-size-26 font-roboto font-weight-600" data-toggle="counter" data-start="0" data-from="0" data-to="343" data-speed="500" data-refresh-interval="10"></div>
										<div class="display-block color-blue-50 font-weight-600"><i class="ion-plus-round"></i>TOTAL PURCHASE</div>
									</div>
									<div class="pull-right">
										<i class="font-size-36 color-blue-100 ion-ios-cart"></i>
									</div>
								</div>
								<div class="progress progress-animation progress-xs margin-top-25 margin-bottom-5">
									<div class="progress-bar bg-blue-100" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									</div>
								</div>
								<div class="font-size-11 clearfix color-blue-50 font-weight-600">
									<div class="pull-left">Total</div>
									<div class="pull-right"><?= $gd ?></div>
								</div>
							</div>
						</div><!-- /.panel -->
						</a>
					</div><!-- /.col -->	
					
			<?php
		}
		}
		?>		
					
					
			<?php
		$product_arrays = $db_handle->runQuery("SELECT count(comment) as 'commenta' FROM comments ");
	    if (!empty($product_arrays)) { 
	    foreach($product_arrays as $key=>$value){
	    $com=$product_arrays[$key]["commenta"]; ?>
		
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<a href="#">
						<div class="panel bg-red-400">
							<div class="panel-body padding-15-20">
								<div class="clearfix">
									<div class="pull-left">
										<div class="color-white font-size-26 font-roboto font-weight-600" data-toggle="counter" data-start="0" data-from="0" data-to="5613" data-speed="500" data-refresh-interval="10"></div>
										<div class="display-block color-red-50 font-weight-600"><i class="ion-plus-round"></i>USERS COMMENTS</div>
									</div>
									<div class="pull-right">
										<i class="font-size-36 color-red-100 ion-email-unread"></i>
									</div>
								</div>
								<div class="progress progress-animation progress-xs margin-top-25 margin-bottom-5">
									<div class="progress-bar bg-red-100" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									</div>
								</div>
								<div class="font-size-11 clearfix color-red-50 font-weight-600">
									<div class="pull-left">Total</div>
									<div class="pull-right"><?= $com ?></div>
								</div>
							</div>
						</div><!-- /.panel -->
						</a>
					</div><!-- /.col -->
						
<?php
		}
		}
		?>


<?php
		$product_arrayw = $db_handle->runQuery("SELECT count(userEmail) as 'uemail' FROM users ");
	    if (!empty($product_arrayw)) { 
	    foreach($product_arrayw as $key=>$value){
	    $ur=$product_arrayw[$key]["uemail"]; ?>
		
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<a href="user.php">
						<div class="panel bg-teal-500">
							<div class="panel-body padding-15-20">
								<div class="clearfix">
									<div class="pull-left">
										<div class="color-white font-size-26 font-roboto font-weight-600" data-toggle="counter" data-start="0" data-from="0" data-to="1230" data-speed="500" data-refresh-interval="10"></div>
										<div class="display-block color-teal-50 font-weight-600"><i class="ion-plus-round"></i>REGISTERED USERS</div>
									</div>
									<div class="pull-right">
										<i class="font-size-36 color-teal-100 ion-person-add"></i>
									</div>
								</div>
								<div class="progress progress-animation progress-xs margin-top-25 margin-bottom-5">
									<div class="progress-bar bg-teal-100" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									</div>
								</div>
								<div class="font-size-11 clearfix color-teal-50 font-weight-600">
									<div class="pull-left">Total</div>
									<div class="pull-right"><?= $ur ?></div>
								</div>
							</div>
						</div><!-- /.panel -->
						</a>
					</div><!-- /.col -->	
	<?php
		}
		}
		?>				
								
					<?php
		$product_arrayk = $db_handle->runQuery("SELECT count(email) as 'Email' FROM email ");
	    if (!empty($product_arrayk)) { 
	    foreach($product_arrayk as $key=>$value){
	    $ed=$product_arrayk[$key]["Email"]; ?>				
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<a href="newslet.php">
						<div class="panel bg-blue-grey-400">
							<div class="panel-body padding-15-20">
								<div class="clearfix">
									<div class="pull-left">
										<div class="color-white font-size-26 font-roboto font-weight-600" data-toggle="counter" data-start="0" data-from="0" data-to="152" data-speed="500" data-refresh-interval="10"></div>
										<div class="display-block color-blue-grey-50 font-weight-600"><i class="ion-plus-round"></i>NEWSLETTER</div>
									</div>
									<div class="pull-right">
										<i class="font-size-36 color-blue-grey-100 ion-social-rss"></i>
									</div>
								</div>
								<div class="progress progress-animation progress-xs margin-top-25 margin-bottom-5">
									<div class="progress-bar bg-blue-grey-100" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
										<span class="sr-only">60% Complete</span>
									</div>
								</div>
								<div class="font-size-11 clearfix color-blue-grey-50 font-weight-600">
									<div class="pull-left">Total</div>
									<div class="pull-right"><?= $ed ?></div>
								</div>
							</div>
						</div><!-- /.panel -->
						</a>
					</div><!-- /.col -->
				
<?php
		}
		}
		?>
					
					
					
					
					
					
				</div><!-- /.row -->

                <div class="row">
					<div class="col-lg-12"> 
						<div class="panel">
							<div class="panel-title no-border bg-white">
								<div class="panel-head"><i class="ion-arrow-graph-up-right"></i> Customer Comments</div>
								<div class="panel-tools">
									<a href="#" data-toggle="dropdown"><i class="ion-gear-a"></i></a>  
									<ul class="dropdown-menu pull-right margin-right-10">
										
										<li>
											<a href=" " onclick="printDiv('printableArea')"><i class="ion-ios-printer"></i> Print </a>
										</li>
										<li>
											<a href="#"><i class="ion-refresh"></i> Refresh </a>
										</li>										
                                    </ul>
									<a href="#" class="panel-refresh"><i class="ion-refresh"></i></a>
									<a href="#" class="panel-close"><i class="ion-close"></i></a>
								</div>
							</div>
							
							<script>
							function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

							
							</script>
							
							<div id="printableArea">
							<div class="panel-body padding-top-5">
								<div class="row">
									<div class="col-lg-12">
										<table style=" border:1px solid #000; padding:15px; width:1050px;  ">
										<tr style="background-color:#e3e3e3; text-align:center; ">
										<td style=" border:1px solid #000;">Name</td>
										<td style=" border:1px solid #000;">Email</td>
										<td style=" border:1px solid #000;">Comment</td>
										<td style=" border:1px solid #000;">Date and Time</tds>
										<td style=" border:1px solid #000;">Code</td>
										<td style=" border:1px solid #000;">Remove</td>
																			
										</tr>
										
										
										
										
										
										
	<?php
if(isset($_GET['rem'])){
    
        //Gather all required data
        $idf    = ($_GET['idf']);
		$idg    = ($_GET['idg']);
		$idh    = ($_GET['idh']);
		
		
		$product = $db_handle->runQuery("DELETE FROM comments  WHERE id = '".$idf."' and id_post = '".$idg."' and code = '".$idh."'");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"process not done";	
		}
		else{
			header("Location: comment.php");
			}
    
    // Close the mysql connection
  
}
	
?>													
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
							<?php
		$product_array = $db_handle->runQuery("SELECT * FROM comments");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $id=$product_array[$key]["id"];
        $nam=$product_array[$key]["name"];	
		$em=$product_array[$key]["email"];
        $ct=$product_array[$key]["comment"];
        $idp=$product_array[$key]["id_post"];	
		$date=$product_array[$key]["date"];
	    $cd= $product_array[$key]["code"];
		
		
	    if (!empty($ct)) {
		?>			
										<tr>
										<td style=" border:1px solid #000; text-align:center;"><?=$nam ?></td>
										<td style=" border:1px solid #000; text-align:center;"><?=$em ?></td>
										<td style=" border:1px solid #000; text-align:center;"><?=$ct ?></td>
										<td style=" border:1px solid #000; text-align:center;"><?=$date ?></td>
										<td style=" border:1px solid #000; text-align:center;"><?=$cd ?></td>
										<form action="comment.php" method="get">
										<input type="hidden" name="idf" value="<?= $id ?>">
										<input type="hidden" name="idg" value="<?= $idp ?>">
										<input type="hidden" name="idh" value="<?= $cd ?>">
<td style=" border:1px solid #000; text-align:center;"><button type="submit" name="rem" style="background-color: Transparent;"><i class="ion-close"></i></button></td>
</form>
										
										</tr>
		<?php
			}
else{

?>	
		<tr style="background-color:#e3e3e3; text-align:center; ">
 NO COMMENTS RECEIVED 
</tr>		
			
			
	<?php
	}
	     }
		}
	    ?>								
										
										</table>
									</div>
								</div>
                            </div>
							</div>
							
							
							
                        </div><!-- /.panel -->
					</div><!-- /.col -->
				</div><!-- /.row -->
					
				
				<!-- BEGIN FOOTER -->
				<footer class="bg-white">
					<div class="pull-left">
						<span class="pull-left margin-right-15">&copy; 2017 Divaah by Devika Powered by <a href="http://ibosoninnov.com">I-Boson Innovations.</a></span>
					</div>
				</footer>
				<!-- END FOOTER -->
            </div><!-- /.container-fluid -->
        </div><!-- /.rightside -->
    </div><!-- /.wrapper -->
	<!-- END CONTENT -->
		
	<!-- BEGIN JAVASCRIPTS -->
	
	<!-- BEGIN CORE PLUGINS -->
	<script src="assets/plugins/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap/js/holder.js"></script>
	<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
	<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="assets/js/core.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	
	<!-- flot chart -->
	<script src="assets/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
	<script src="assets/plugins/flot/jquery.flot.grow.js" type="text/javascript"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
	
	<!-- sparkline -->
	<script src="assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
	
	<!-- bootstrap slider -->
	<script src="assets/plugins/bootstrap-slider/js/bootstrap-slider.js" type="text/javascript"></script>
	
	<!-- datepicker -->
	<script src="assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
	
	<!-- vectormap -->
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-europe-merc-en.js" type="text/javascript"></script>
	
	<!-- counter -->
	<script src="assets/plugins/jquery-countTo/jquery.countTo.js" type="text/javascript"></script>
	
	<!-- rickshaw -->
	<script src="assets/plugins/rickshaw/vendor/d3.v3.js" type="text/javascript"></script>
	<script src="assets/plugins/rickshaw/rickshaw.min.js" type="text/javascript"></script>
	
	<!-- maniac -->
	<script src="assets/js/maniac.js" type="text/javascript"></script>
	
	<!-- dashboard -->
	<script type="text/javascript">
		maniac.loadchart();
		maniac.loadvectormap();
		maniac.loadbsslider();
		maniac.loadrickshaw();
		maniac.loadcounter();
		maniac.loadprogress();
		maniac.loaddaterangepicker();
	</script> 

	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

<!-- Mirrored from maniac.yakuzi.eu/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Mar 2017 07:37:05 GMT -->
</html>