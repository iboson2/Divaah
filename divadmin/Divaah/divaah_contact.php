<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
<?php
ob_start();
session_start();

require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["go"])) {
switch($_GET["go"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["ProductName"],'id'=>$productByCode[0]["ID"],
			'hed'=>$productByCode[0]["Head"],'sec'=>$productByCode[0]["imga"],'ship'=>$productByCode[0]["Ship"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["Price"]));
			
			if(!empty($_SESSION["cart_itemc"])) {
				if(in_array($productByCode[0]["code"],$_SESSION["cart_itemc"])) {
					foreach($_SESSION["cart_itemc"] as $k => $v) {
							if($productByCode[0]["code"] == $k)
								$_SESSION["cart_itemc"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_itemc"] = array_merge($_SESSION["cart_itemc"],$itemArray);
				}
			} else {
				$_SESSION["cart_itemc"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_itemc"])) {
			foreach($_SESSION["cart_itemc"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_itemc"][$k]);				
					if(empty($_SESSION["cart_itemc"]))
						unset($_SESSION["cart_itemc"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_itemc"]);
	break;	
}
}

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["ProductName"],'id'=>$productByCode[0]["ID"],
			'hed'=>$productByCode[0]["Head"],'sec'=>$productByCode[0]["imga"],'ship'=>$productByCode[0]["Ship"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["Price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],$_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
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
	<link href="assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" />
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
						<li>
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
						<li class="active">
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
            <div class="page-head">
				<h1 class="page-title">Contact<small>Update contact details here.</small></h1>
				<!-- BEGIN BREADCRUMB -->
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="ion-navicon-round margin-right-5"></i> Dashboard</a></li>
					<li class="active">Contact Page</li>
				</ol>
				<!-- END BREADCRUMB -->
			</div>
			<!-- END PAGE HEADING -->

            <div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel">
							<div class="panel-title bg-transparent">
								<div class="panel-tools">
									<a href="#" data-toggle="dropdown"><i class="ion-gear-a"></i></a>  
									<ul class="dropdown-menu pull-right margin-right-10">
										<li>
											<a href="#"><i class="ion-gear-a"></i> Settings </a>
										</li>
										<li>
											<a href="#"><i class="ion-ios-printer"></i> Print </a>
										</li>
										<li>
											<a href="#"><i class="ion-refresh"></i> Refresh </a>
										</li>
									</ul>
									<a href="#" class="panel-refresh"><i class="ion-refresh"></i></a>
									<a href="#" class="panel-close"><i class="ion-close"></i></a>
								</div>
							</div>
			
<?php
	    $product_array = $db_handle->runQuery("SELECT * FROM contact where ID = '2'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $ab=$product_array[$key]["about"];
        $log=base64_encode($product_array[$key]['imgb']);	 
	    $ad=$product_array[$key]["address"];
        $ph=$product_array[$key]["phone"];
		$em=$product_array[$key]["email"];
		$fb=$product_array[$key]["fb"];
		$tw=$product_array[$key]["tw"];
		$ig=$product_array[$key]["ig"];
		}
		}
		?>			

		
		
		<?php
if(isset($_GET['updated'])){
    
        //Gather all required data
        $dola    = ($_GET['adas']);
		
		if (!empty($dola)) {
			
			$dataa=$dola;
		}
		else{
			
			$dataa=$ad;
		}
        
		$product = $db_handle->runQuery("UPDATE contact SET address='$dataa' WHERE ID = '2' ");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_contact.php");
			}
    
  
}
	
?>	
		
			
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">Address</h3>
								<p class="text-light margin-bottom-30">Remove and add your address</p>
											
								<form  action="divaah_contact.php" method="get">
									<div class="form-group">
										<textarea class="form-control bs-texteditor" name="adas" rows="7" placeholder="<?php echo $ad; ?>"></textarea>
									</div>
									<button type="submit" name="updated" class="btn btn-success">Update</button>
								</form>
							</div>		
							
							
							
							
							
							
							
	<?php
if(isset($_GET['updateds'])){
    
        //Gather all required data
        $dola    = ($_GET['phas']);
		$dolb    = ($_GET['emas']);
		if (!empty($dola)) {
			
			$dataa=$dola;
		}
		else{
			
			$dataa=$ph;
		}
        if (!empty($dolb)) {
			
			$datab=$dolb;
		}
		else{
			
			$datab=$em;
		}
		$product = $db_handle->runQuery("UPDATE contact SET phone='$dataa' , email='$datab' WHERE ID = '2' ");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_contact.php");
			}
    
    // Close the mysql connection
    



}
	
?>							
							
							
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">Contact Details</h3>
								<p class="text-light margin-bottom-30">Add / Edit your contact details</p>
											
								<form role="form" action="divaah_contact.php" method="get">
								
									<div class="form-group">
										<label for="input-text" class="control-label"><a href="#" ><i class="fa fa-phone"></i> Phone</a></label>
										<input type="text" class="form-control" name="phas" id="input-text" placeholder="<?php echo $ph; ?>">
									</div>
									
									<div class="form-group">
										<label for="input-text" class="control-label"><a href="#" ><i class="fa fa-envelope"></i> Mail ID</a></label>
										<input type="text" class="form-control" name="emas" id="input-text" placeholder="<?php echo $em; ?>">
									</div>
									
									<button type="submit" name="updateds" class="btn btn-success">Update</button>
								</form>
							</div>
							
						</div>
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
	
	<!-- dropzone -->
    <script src="assets/plugins/dropzone/dropzone.min.js"></script>
		
	<!-- maniac -->
	<script src="assets/js/maniac.js" type="text/javascript"></script>
	
	<script>
		maniac.loaddropzone();
	</script>
	
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>