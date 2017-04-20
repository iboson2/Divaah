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
						<li class="active">
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
            <div class="page-head">
				<h1 class="page-title">Home<small>Update home page details here.</small></h1>
				<!-- BEGIN BREADCRUMB -->
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="ion-home margin-right-5"></i> Dashboard</a></li>
					<li class="active">Home</li>
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
					
		$product_array = $db_handle->runQuery("SELECT * FROM image where ID = '1' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $imga=base64_encode($product_array[$key]['img']);
	    

		?>	
			
			<?php
			
		    }
	     }
	
	    ?>			 
	<?php
 require_once("config.php");
if(isset($_POST['updatea'])){
  
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        // Connect to the database
      
 
        //Gather all required data
        
        $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
        
 
        // Create the SQL query
 
        $query =  "UPDATE image SET img='$data' WHERE ID='1'";
        // Execute the query
        $result = $dbLink->query($query);

        // Check if it was successfull
        if($result){
            header("Location: divaah_home.php");
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }}
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    } 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';}

}
?>						
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">Kurti</h3>
								<p class="text-light margin-bottom-30">Drag’n’drop the image for kurti.</p>
								<?php echo"<img alt='' style='width:50%;' src='data:image/jpeg;base64,$imga' >"; ?>
								<form  action="divaah_home.php" method="post" enctype="multipart/form-data"><br>
									<input type="file"  name="uploaded_file" accept="image/*"><br>
									<button type="submit" name="updatea" class="btn btn-success">Update</button>
								</form>
							</div>
							
							
<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM image where ID = '2' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $imgb=base64_encode($product_array[$key]['img']);
	    

		?>	
			
			<?php
			
		    }
	     }
	
	    ?>			 
	<?php
 require_once("config.php");
if(isset($_POST['updateb'])){
  
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        // Connect to the database
      
 
        //Gather all required data
        
        $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
        
 
        // Create the SQL query
 
        $query =  "UPDATE image SET img='$data' WHERE ID='2'";
        // Execute the query
        $result = $dbLink->query($query);

        // Check if it was successfull
        if($result){
            header("Location: divaah_home.php");
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }}
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    } 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';}

}
?>							
							
							
							
							
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">Sarees</h3>
								<p class="text-light margin-bottom-30">Drag’n’drop the image for sarees.</p>								
								<?php echo"<img alt='' style='width:50%;' src='data:image/jpeg;base64,$imgb' >"; ?>			
								<form  action="divaah_home.php" method="post" enctype="multipart/form-data"><br>
									<input type="file" name="uploaded_file" accept="image/*"><br>
									<button type="submit" name="updateb" class="btn btn-success">Update</button>
								</form>
							</div>
							
							
							
	<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM image where ID = '3' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $imgc=base64_encode($product_array[$key]['img']);
	    

		?>	
			
			<?php
			
		    }
	     }
	
	    ?>			 
	<?php
 require_once("config.php");
if(isset($_POST['updatec'])){
  
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        // Connect to the database
      
 
        //Gather all required data
        
        $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
        
 
        // Create the SQL query
 
        $query =  "UPDATE image SET img='$data' WHERE ID='3'";
        // Execute the query
        $result = $dbLink->query($query);

        // Check if it was successfull
        if($result){
            header("Location: divaah_home.php");
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }}
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    } 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';}

}
?>								
							
							
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">Salwar Materials</h3>
								<p class="text-light margin-bottom-30">Drag’n’drop the image for salwar materials.</p>
								<?php echo"<img alt='' style='width:50%;' src='data:image/jpeg;base64,$imgc' >"; ?>
											
								<form  action="divaah_home.php" method="post" enctype="multipart/form-data"><br>
									<input type="file" name="uploaded_file" accept="image/*"><br>
									<button type="submit" name="updatec" class="btn btn-success">Update</button>
								</form>
							</div>
		
		
		
		
		
		
            <div class="row products">
<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID between 1 and 8 ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){	    
		 
 $img=base64_encode($product_array[$key]['imga']);
	    $imgf=base64_encode($product_array[$key]['imgb']);
	     $imgt=base64_encode($product_array[$key]['imgc']);
        $top=$product_array[$key]["ProductName"];
        $pri=$product_array[$key]["Price"];	 
	    $cd= $product_array[$key]["code"];
		$we=$product_array[$key]["ID"];
		
		?>	
                        
                        <div class="col-md-3 col-sm-4">
                            <div class="product">
                                <a href="divaah_product.php">
                                    
									<?php  echo"<img class='img-responsive' src='data:image/jpeg;base64,$img' >";?>
                                </a>
                                <div class="text">
                                    <h3><a href="divaah_product.php"><?=$top ?></a></h3>
                                    <p class="price"><i class="fa fa-inr"></i> <?=$pri ?>.00</p>
									<form action="divaah_product.php" method="get">
									<input type="hidden" value="<?= $we ?>" name="id">
				<button type="submit" class="btn btn-success">Edit details</button>
									</form><br><br>
									
                                    
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
                       
           <?php 
		}
		}
		
?>		   
                       
						
				</div>	
		
		
		
		
		
		
		
		
		
		
		













		
							
		<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID = '601' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $imgwr=base64_encode($product_array[$key]['imga']);
	    $erta =$product_array[$key]["ProductName"];
		$ertb =$product_array[$key]["para"];
		$wem =$product_array[$key]["ID"];

		?>	
			
									
								
							
							
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">Special products</h3>
								<p class="text-light margin-bottom-30">Drag’n’drop the image for Special products.</p>
								
								<?php echo"<img alt='' style='width:50%;' src='data:image/jpeg;base64,$imgwr' >"; ?>
								<br><br>
								<form action="divaah_product.php" method="get">
									<input type="hidden" value="<?= $wem ?>" name="id">
				<button type="submit" class="btn btn-success">Edit details</button>
									</form>
								
			<?php
			
		    }
	     }
	
	    ?>							
								
								
							
							
							
	<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID = '602' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $imgwr=base64_encode($product_array[$key]['imga']);
	    $erta =$product_array[$key]["ProductName"];
		$ertb =$product_array[$key]["para"];
		$wem =$product_array[$key]["ID"];

		?>	
			
									
								
							
							
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">Special products</h3>
								<p class="text-light margin-bottom-30">Drag’n’drop the image for Special products.</p>
								
								<?php echo"<img alt='' style='width:50%;' src='data:image/jpeg;base64,$imgwr' >"; ?>
								<br><br>
								<form action="divaah_product.php" method="get">
									<input type="hidden" value="<?= $wem ?>" name="id">
				<button type="submit" class="btn btn-success">Edit details</button>
									</form>
								
			<?php
			
		    }
	     }
	
	    ?>							
							
							
							
							
<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID = '603' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $imgwr=base64_encode($product_array[$key]['imga']);
	    $erta =$product_array[$key]["ProductName"];
		$ertb =$product_array[$key]["para"];
		$wem =$product_array[$key]["ID"];

		?>	
			
									
								
							
							
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">Special products</h3>
								<p class="text-light margin-bottom-30">Drag’n’drop the image for Special products.</p>
								
								<?php echo"<img alt='' style='width:50%;' src='data:image/jpeg;base64,$imgwr' >"; ?>
								<br><br>
								<form action="divaah_product.php" method="get">
									<input type="hidden" value="<?= $wem ?>" name="id">
				<button type="submit" class="btn btn-success">Edit details</button>
									</form>
								
			<?php
			
		    }
	     }
	
	    ?>							
			
							
							
		<br><br>					
							
							
							
			 <div class="row products">
<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID between 9 and 16 ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){	    
		 
 $img=base64_encode($product_array[$key]['imga']);
	    $imgf=base64_encode($product_array[$key]['imgb']);
	     $imgt=base64_encode($product_array[$key]['imgc']);
        $top=$product_array[$key]["ProductName"];
        $pri=$product_array[$key]["Price"];	 
	    $cd= $product_array[$key]["code"];
		$we=$product_array[$key]["ID"];
		
		?>	
                        
                        <div class="col-md-3 col-sm-4">
                            <div class="product">
                                <a href="divaah_product.php">
                                    
									<?php  echo"<img class='img-responsive' src='data:image/jpeg;base64,$img' >";?>
                                </a>
                                <div class="text">
                                    <h3><a href="divaah_product.php"><?=$top ?></a></h3>
                                    <p class="price"><i class="fa fa-inr"></i> <?=$pri ?>.00</p>
									<form action="divaah_product.php" method="get">
									<input type="hidden" value="<?= $we ?>" name="id">
				<button type="submit" class="btn btn-success">Edit details</button>
									</form><br><br>
									
                                    
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
                       
           <?php 
		}
		}
		
?>		   
                       
						
				</div>					
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">What people say about US</h3>
								<p class="text-light margin-bottom-30">Add / Edit suggestions</p>
									





<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM say where ID = '1' ");
	   
	    foreach($product_array as $key=>$value){
	   
		$par = $product_array[$key]["Para"];
		$fb  = $product_array[$key]["fb"];
		$tw  = $product_array[$key]["tw"];
		$gm  = $product_array[$key]["gm"];
		$nam = $product_array[$key]["name"];
			
		    }
	    
	
	    ?>	




<?php
if(isset($_GET['updat'])){
    
        //Gather all required data
        $dola   = ($_GET['nameas']);
		$dolb   = ($_GET['paras']);
		$dolc   = ($_GET['fbas']);
		$dold   = ($_GET['twas']);
		$dole   = ($_GET['gmas']);
		if (!empty($dola)) {
			
			$dataa=$dola;
		}
		else{
			
			$dataa=$nam;
		}
        if (!empty($dolb)) {
			
			$datab=$dolb;
		}
		else{
			
			$datab=$par;
		}
		if (!empty($dolc)) {
			
			$datac=$dolc;
		}
		else{
			
			$datac=$fb;
		}
		if (!empty($dold)) {
			
			$datad=$dold;
		}
		else{
			
			$datad=$tw;
		}
		if (!empty($dole)) {
			
			$datae=$dole;
		}
		else{
			
			$datae=$gm;
		}
		$product = $db_handle->runQuery("UPDATE say SET name='$dataa' ,Para='$datab', fb='$datac',tw='$datad'
		,gm='$datae' WHERE ID = '1' ");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_home.php");
			}
    
    // Close the mysql connection
    



}
	
?>			
					
								<form  action="divaah_home.php" method="get">
								<h5 class="color-grey-700 margin-top-10">Suggestion #1</h5>
									<div class="form-group">
										<div class="form-group">
<textarea class="form-control bs-texteditor" name="paras" rows="7" placeholder="<?php echo $par; ?>"></textarea>
										</div>
									
									<div class="form-group">
<label for="input-text" class="control-label"><i class="fa fa-facebook"></i> Name</label>
<input type="text" class="form-control" name="nameas" id="input-text" placeholder="<?php echo $nam; ?>">
										</div>
										<div class="form-group">
<label for="input-text" class="control-label"><i class="fa fa-facebook"></i> Facebook</label>
<input type="text" class="form-control" name="fbas" id="input-text" placeholder="<?php echo $fb; ?>">
										</div>
										
										<div class="form-group">
<label for="input-text" class="control-label"><i class="fa fa-google-plus"></i> Google Plus</label>
<input type="text" class="form-control" name="gmas" id="input-text" placeholder="<?php echo $gm; ?>">
										</div>
										
										<div class="form-group">
<label for="input-text" class="control-label"><i class="fa fa-twitter"></i> Twitter</label>
<input type="text" class="form-control" name="twas" id="input-text" placeholder="<?php echo $tw; ?>">
										</div>
										
									</div>
									
									<button type="submit" name="updat" class="btn btn-success">Update</button>
									
								</form>		
						<br><br>
									



<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM say where ID = '2' ");
	   
	    foreach($product_array as $key=>$value){
	   
		$parD =$product_array[$key]["Para"];
		$fbD  =$product_array[$key]["fb"];
		$twD  =$product_array[$key]["tw"];
		$gmD  =$product_array[$key]["gm"];
		$namD =$product_array[$key]["name"];
			
		    }
	    
	
	    ?>	




<?php
if(isset($_GET['updata'])){
    
        //Gather all required data
        $dolaD   = ($_GET['nameas']);
		$dolbD   = ($_GET['paraas']);
		$dolcD   = ($_GET['fbas']);
		$doldD   = ($_GET['twas']);
		$doleD   = ($_GET['gmas']);
		if (!empty($dolaD)) {
			
			$dataaD=$dolaD;
		}
		else{
			
			$dataaD=$namD;
		}
        if (!empty($dolbD)) {
			
			$databD=$dolbD;
		}
		else{
			
			$databD=$parD;
		}
		if (!empty($dolcD)) {
			
			$datacD=$dolcD;
		}
		else{
			
			$datacD=$fbD;
		}
		if (!empty($doldD)) {
			
			$datadD=$doldD;
		}
		else{
			
			$datadD=$twD;
		}
		if (!empty($doleD)) {
			
			$dataeD=$doleD;
		}
		else{
			
			$dataeD=$gmD;
		}
		$product = $db_handle->runQuery("UPDATE say SET name='$dataaD' ,Para='$databD', fb='$datacD',tw='$datadD'
		,gm='$dataeD' WHERE ID = '2' ");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_home.php");
			}
    
    // Close the mysql connection
    



}
	
?>





									
								<form  action="divaah_home.php" method="get">
								<h5 class="color-grey-700 margin-top-10">Suggestion #2</h5>
									<div class="form-group">
										<div class="form-group">
											<textarea class="form-control bs-texteditor" name="paras" rows="7" placeholder="<?php echo $parD; ?>"></textarea>
										</div>
									<div class="form-group">
											<label for="input-text" class="control-label"><i class="fa fa-facebook"></i> Name</label>
											<input type="text" class="form-control" name="nameas" id="input-text" placeholder="<?php echo $namD; ?>">
										</div>
										<div class="form-group">
											<label for="input-text" class="control-label"><i class="fa fa-facebook"></i> Facebook</label>
											<input type="text" class="form-control" name="fbas" id="input-text" placeholder="<?php echo $fbD; ?>">
										</div>
										
										<div class="form-group">
											<label for="input-text" class="control-label"><i class="fa fa-google-plus"></i> Google Plus</label>
											<input type="text" class="form-control" name="gmas" id="input-text" placeholder="<?php echo $gmD; ?>">
										</div>
										
										<div class="form-group">
											<label for="input-text" class="control-label"><i class="fa fa-twitter"></i> Twitter</label>
											<input type="text" class="form-control" name="twas" id="input-text" placeholder="<?php echo $twD; ?>">
										</div>
										
									</div>
									
									<button type="submit" name="updata" class="btn btn-success">Update</button>
									
								</form>
								
								<br><br>
									





<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM say where ID = '3' ");
	   
	    foreach($product_array as $key=>$value){
	   
		$parT =$product_array[$key]["Para"];
		$fbT  =$product_array[$key]["fb"];
		$twT  =$product_array[$key]["tw"];
		$gmT  =$product_array[$key]["gm"];
		$namT =$product_array[$key]["name"];
			
		    }
	    
	
	    ?>	




<?php
if(isset($_GET['updataS'])){
    
        //Gather all required data
        $dolaT    = ($_GET['nameas']);
		$dolbT    = ($_GET['paraas']);
		$dolcT   = ($_GET['fbas']);
		$doldT   = ($_GET['twas']);
		$doleT   = ($_GET['gmas']);
		if (!empty($dolaT)) {
			
			$dataaT=$dolaT;
		}
		else{
			
			$dataaT=$namT;
		}
        if (!empty($dolbT)) {
			
			$databT=$dolbT;
		}
		else{
			
			$databT=$parT;
		}
		if (!empty($dolcT)) {
			
			$datacT=$dolcT;
		}
		else{
			
			$datacT=$fbT;
		}
		if (!empty($doldT)) {
			
			$datadT=$doldT;
		}
		else{
			
			$datadT=$twT;
		}
		if (!empty($doleT)) {
			
			$dataeT=$doleT;
		}
		else{
			
			$dataeT=$gmT;
		}
		$product = $db_handle->runQuery("UPDATE say SET name='$dataaT' ,Para='$databT', fb='$datacT',tw='$datadT',gm='$dataeT' WHERE ID = '3' ");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_home.php");
			}
    
    // Close the mysql connection
    



}
	
?>


									
								<form  action="divaah_home.php" method="get">
								<h5 class="color-grey-700 margin-top-10">Suggestion #3</h5>
									<div class="form-group">
										<div class="form-group">
											<textarea class="form-control bs-texteditor" name="paras" rows="7" placeholder="<?php echo $parT; ?>"></textarea>
										</div>
									<div class="form-group">
											<label for="input-text" class="control-label"><i class="fa fa-facebook"></i> Name</label>
											<input type="text" class="form-control" name="nameas" id="input-text" placeholder="<?php echo $namT; ?>">
										</div>
										<div class="form-group">
											<label for="input-text" class="control-label"><i class="fa fa-facebook"></i> Facebook</label>
											<input type="text" class="form-control" name="fbas" id="input-text" placeholder="<?php echo $fbT; ?>">
										</div>
										
										<div class="form-group">
											<label for="input-text" class="control-label"><i class="fa fa-google-plus"></i> Google Plus</label>
											<input type="text" class="form-control" name="gmas" id="input-text" placeholder="<?php echo $gmT; ?>">
										</div>
										
										<div class="form-group">
											<label for="input-text" class="control-label"><i class="fa fa-twitter"></i> Twitter</label>
											<input type="text" class="form-control" name="twas" id="input-text" placeholder="<?php echo $twT; ?>">
										</div>
										
									</div>
									
									<button type="submit" name="updataS" class="btn btn-success">Update</button>
									
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