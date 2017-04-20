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
	<link href="assets/plugins/dropzone/dropzone.css" rel="stylesheet" /><link href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" />
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
				<h1 class="page-title">Products<small>Update all product details here.</small></h1>
				<!-- BEGIN BREADCRUMB -->
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="ion-home margin-right-5"></i> Dashboard</a></li>
					<li class="active">Edit product</li>
				</ol>
				<!-- END BREADCRUMB -->
			</div>
			<!-- END PAGE HEADING -->
			
			
			

            <div class="container-fluid">
			
			
			
			
			<?php
 // set var to avoid errors
    if(isset($_GET['id'])){
		
$id = $_GET['id'];
$ae=($id + 1);
$af=($id + 2);
$ag=($id - 1);
$ah=($id - 2);

	
?>			
	<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID = '".$id."' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $imga=base64_encode($product_array[$key]['imga']);
	    $imgb=base64_encode($product_array[$key]['imgb']);
	     $imgc=base64_encode($product_array[$key]['imgc']);
        $topa=$product_array[$key]["ProductName"];
        $pria=$product_array[$key]["Price"];
        $priak=$product_array[$key]["Pricea"];
        $qa= $product_array[$key]["qua"];		
	    $cd= $product_array[$key]["code"];
		$wea=$product_array[$key]["ID"];
		$paraa =$product_array[$key]["para"];
		$heda =$product_array[$key]["Head"];
		$cola =$product_array[$key]["cola"];
		$colb =$product_array[$key]["colb"];
		$colc =$product_array[$key]["colc"];
		$cold =$product_array[$key]["cold"];
		$cole =$product_array[$key]["cole"];
		$colf =$product_array[$key]["colf"];
		$colg =$product_array[$key]["colg"];
		$colh =$product_array[$key]["colh"];
		$siza =$product_array[$key]["sizea"];
		$sizb =$product_array[$key]["sizeb"];
		$sizc =$product_array[$key]["sizec"];
		$sizd =$product_array[$key]["sized"];
		$size =$product_array[$key]["sizee"];
		$fea =$product_array[$key]["feature"];
		$gp=$product_array[$key]["grp"];
			    if (!empty($top)) {
		?>	
			
			<?php
			}
		    }
	     }
	
	    ?>	

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
							
							<div class="panel-body">
							
							
								<h3 class="color-grey-700 margin-top-10">Product details</h3>
								<p class="text-light margin-bottom-30">Add / Edit your product details</p>
								
								
								
								
								
								
								
	<?php
if(isset($_GET['updated'])){
    
        //Gather all required data
        $dola    = ($_GET['nameas']);
		$dolb    = ($_GET['headas']);
		$dolc   = ($_GET['priceas']);
		$dolck   = ($_GET['priceno']);
		$dold   = ($_GET['desas']);
		$dole   = ($_GET['feaas']);
		if (!empty($dola)) {
			
			$dataa=$dola;
		}
		else{
			
			$dataa=$topa;
		}
        if (!empty($dolb)) {
			
			$datab=$dolb;
		}
		else{
			
			$datab=$heda;
		}
		if (!empty($dolc)) {
			
			$datac=$dolc;
		}
		else{
			
			$datac=$pria;
		}
		if (!empty($dolck)) {
			
			$datack=$dolck;
		}
		else{
			
			$datack=$priak;
		}
		if (!empty($dold)) {
			
			$datad=$dold;
		}
		else{
			
			$datad=$paraa;
		}
		if (!empty($dole)) {
			
			$datae=$dole;
		}
		else{
			
			$datae=$fea;
		}
		$product = $db_handle->runQuery("UPDATE product SET ProductName='$dataa' ,Head='$datab', Price='$datac', Pricea='$datack',para='$datad'
		,feature='$datae' WHERE ID = '".$id."' ");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_product.php?id=$id");
			}
    
    // Close the mysql connection
    



}
	
?>							
								
								
								
								
								
								
								
								
								
								
								
											
								<form  action="divaah_product.php" method="get">
								<input type="hidden" value="<?= $wea ?>" name="id">
									<div class="form-group">
										<label for="message" class="control-label">Product name</label>
										<input type="text" class="form-control" id="input-text" name="nameas" placeholder="<?php echo $topa; ?>">
									</div>
									<div class="form-group">
										<label for="message" class="control-label">Product Heading</label>
										<input type="text" class="form-control" id="input-text" name="headas" placeholder="<?php echo $heda; ?>">
									</div>
									<div class="form-group">
										<label for="message" class="control-label">OfferPrice</label>
										<input type="text" class="form-control" id="input-text" name="priceas" placeholder="<?php echo $pria; ?>">
									</div>
									<div class="form-group">
										<label for="message" class="control-label">RealPrice</label>
										<input type="text" class="form-control" id="input-text" name="priceno" placeholder="<?php echo $priak; ?>">
									</div>
									
									
									<div class="form-group">
										<label for="message" class="control-label">Product description</label>
					<textarea class="form-control bs-texteditor" rows="7" name="desas"  placeholder="<?php echo wordwrap($paraa,150,"<br>\n");?>"></textarea>
									</div>
									
									<div class="form-group">
										<label for="message" class="control-label">Product Features</label>
					<textarea class="form-control bs-texteditor" rows="7" name="feaas" placeholder="<?php echo wordwrap($fea,150,"<br>\n");?>"></textarea>
									</div>
									
									<input type="submit" name="updated" value="Update" class="btn btn-success">
								</form>
							</div>
							
							
							<br><br><br>
							
							
							
							
							
							
							
	<?php
if(isset($_GET['updatedb'])){
  

        
        //Gather all required data
        $typa    = ($_GET['typea']);
		$typb    = ($_GET['typeb']);
		$typc   = ($_GET['typec']);
		$typd   = ($_GET['typed']);
		$type   = ($_GET['typee']);
		$typf   = ($_GET['typef']);
		$typg   = ($_GET['typeg']);
		$typh   = ($_GET['typeh']);
		if (!empty($typa)) {
			
			$dataf=$typa;
		}
		
        if (!empty($typb)) {
			
			$datag=$typb;
		}
		
		if (!empty($typc)) {
			
			$datah=$typc;
		}
		
		if (!empty($typd)) {
			
			$datai=$typd;
		}
		
		if (!empty($type)) {
			
			$dataj=$type;
		}
		
		if (!empty($typf)) {
			
			$datak=$typf;
		}
		
		if (!empty($typg)) {
			
			$datal=$typg;
		}
		
		if (!empty($typh)) {
			
			$datam=$typh;
		}
		
		$product = $db_handle->runQuery("UPDATE product SET cola='$dataf' ,colb='$datag', colc='$datah',cold='$datai'
		,cole='$dataj',colf='$datak',colg='$datal',colh='$datam' WHERE ID = '".$id."' ");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_product.php?id=$id");
			}
    
    // Close the mysql connection
    



}
	
?>	

						
							
							<div class="panel-body">	
								<form  action="divaah_product.php" method="get">
								<input type="hidden" value="<?= $wea ?>" name="id">
									<div class="form-group">
										<label for="message" class="control-label">Color</label><div class="skin-section">
										  <ul class="list-inline col-lg-12">
											<li>
	<input type="text" name="typea" class="form-control" pattern="^[a-z\A-Z\d\.]{0,9}$" id="input-text"
	
	placeholder="<?php if(!empty($cola)){echo $cola;}else{echo"Color 1";}?>">
	
	<br>
											</li>
											<li>
	<input type="text" name="typeb" class="form-control" pattern="^[a-z\A-Z\d\.]{0,9}$" id="input-text" 
	placeholder="<?php if(!empty($colb)){echo $colb;}else{echo"Color 2";}?>">
	<br>
											</li>
											<li>
	<input type="text" name="typec" class="form-control" pattern="^[a-z\A-Z\d\.]{0,9}$" id="input-text" 
	placeholder="<?php if(!empty($colc)){echo $colc;}else{echo"Color 3";}?>">
	<br>
											</li>
											<li>
	<input type="text" name="typed" class="form-control" pattern="^[a-z\A-Z\d\.]{0,9}$" id="input-text" 
	placeholder="<?php if(!empty($cold)){echo $cold;}else{echo"Color 4";}?>">
	<br>
											</li>
											<li>
	<input type="text" name="typee" class="form-control" pattern="^[a-z\A-Z\d\.]{0,9}$" id="input-text" 
	placeholder="<?php if(!empty($cole)){echo $cole;}else{echo"Color 5";}?>">
	<br>
											</li>
											<li>
	<input type="text" name="typef" class="form-control" pattern="^[a-z\A-Z\d\.]{0,9}$" id="input-text" 
	placeholder="<?php if(!empty($colf)){echo $colf;}else{echo"Color 6";}?>">
	<br>
											</li>
											<li>
	<input type="text" name="typeg" class="form-control" pattern="^[a-z\A-Z\d\.]{0,9}$" id="input-text" 
	placeholder="<?php if(!empty($colg)){echo $colg;}else{echo"Color 7";}?>">
	<br>
											</li>
											<li>
    <input type="text" name="typeh" class="form-control" pattern="^[a-z\A-Z\d\.]{0,9}$" id="input-text" 
	placeholder="<?php if(!empty($colh)){echo $colh;}else{echo"Color 8";}?>">
<br>
											</li>
										  </ul>
										</div>
										<button type="submit" name="updatedb" class="btn btn-success">Update</button>
									</form>
									</div>
									
									
									
									
	<?php
if(isset($_GET['updatedc'])){
    
        //Gather all required data
        $chea    = ($_GET['checka']);
		$cheb    = ($_GET['checkb']);
		$chec   = ($_GET['checkc']);
		$ched   = ($_GET['checkd']);
		$chee   = ($_GET['checke']);
		$chef   = ($_GET['checkf']);
		
	
if (!empty($chef)) {
			
			$datan='0';
			$datao='0';
			$datap='0';
			$dataq='0';
			$datar='0';
		}
		else{
		

	if (!empty($chea)) {
			
			$datan='S';
		}
		else{
			
			$datan=$sizea;
		}
        if (!empty($cheb)) {
			
			$datao='M';
		}
		else{
			
			$datao=$sizeb;
		}
		if (!empty($chec)) {
			
			$datap='L';
		}
		else{
			
			$datap=$sizec;
		}
		if (!empty($ched)) {
			
			$dataq='XL';
		}
		else{
			
			$dataq=$sized;
		}
		if (!empty($chee)) {
			
			$datar='XLL';
		}
		else{
			
			$datar=$sizee;
		}
		
		}
		$product = $db_handle->runQuery("UPDATE product SET sizea='$datan' ,sizeb='$datao', sizec='$datap',sized='$dataq'
		,sizee='$datar' WHERE ID = '".$id."' ");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_product.php?id=$id");
			}
    
    // Close the mysql connection
    



}
	
?>				
											<form  action="divaah_product.php" method="get">
								<input type="hidden" value="<?= $wea ?>" name="id">
									<div class="form-group">
										<label for="message" class="control-label">Size</label><div class="skin-section">
										  <ul class="list-inline col-lg-12">
											<li>
		<input tabindex="9" type="checkbox" name="checka" id="square-checkbox-1" <?php if (!empty($siza)) { echo"checked";}?>>
											  <label for="square-checkbox-1" value="S" class="margin-left-5">S</label>
											</li>
											<li>
		<input tabindex="10" type="checkbox" name="checkb" id="square-checkbox-2" <?php if (!empty($sizb)) { echo"checked"; }?> >
											  <label for="square-checkbox-2" value="M" class="margin-left-5">M</label>
											</li>
											<li>
		<input tabindex="11" type="checkbox" name="checkc" id="square-checkbox-1" <?php if (!empty($sizc)) { echo"checked"; }?>>
											  <label for="square-checkbox-1" value="L" class="margin-left-5">L</label>
											</li>
											<li>
		<input tabindex="12" type="checkbox" name="checkd" id="square-checkbox-2" <?php if (!empty($sizd)) { echo"checked"; }?>>
											  <label for="square-checkbox-2" value="XL" class="margin-left-5">XL</label>
											</li>
											<li>
		<input tabindex="13" type="checkbox" name="checke" id="square-checkbox-2" <?php if (!empty($size)) { echo"checked"; }?>>
											  <label for="square-checkbox-2" value="XXL" class="margin-left-5">XXL</label>
											</li>
											<li>
		<input tabindex="13" type="checkbox" id="square-checkbox-2" name="checkf" <?php if(empty($siza || $sizb || $sizc || $sizd || $size)){echo "checked";} ?>>
											  <label for="square-checkbox-2"  class="margin-left-5">N A</label>
											</li>
										  </ul>
										</div>
									</div>
									
									<button type="submit" name="updatedc" class="btn btn-success">Update</button>
								</form>
							</div>
							
							








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
 
        $query =  "UPDATE product SET imga='$data' WHERE ID='".$id."'";
        // Execute the query
        $result = $dbLink->query($query);

        // Check if it was successfull
        if($result){
            header("Location: divaah_product.php?id=$id");
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
								<h3 class="color-grey-700 margin-top-10">Product Image</h3>
								<p class="text-light margin-bottom-30">Drag’n’drop the product image #1.</p>
								<?php echo"<img alt='' style='width:25%;' src='data:image/jpeg;base64,$imga' >"; ?>
								
								<form  action="divaah_product.php?id=<?= $wea ?>" method="post" enctype="multipart/form-data" ><br>
								
									<input type="file" name="uploaded_file" value="Change Image" ><br>
									<button type="submit" name="updatea" class="btn btn-success">Update</button>
								</form>
							</div>
							
							
							
	<?php
 
if(isset($_POST['updateb'])){
  
if(isset($_FILES['uploaded_filea'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_filea']['error'] == 0) {
        // Connect to the database
      
 
        //Gather all required data
        
        $mimea = $dbLink->real_escape_string($_FILES['uploaded_filea']['type']);
        $dataa = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_filea']['tmp_name']));
        $sizea = intval($_FILES['uploaded_filea']['size']);
        
 
        // Create the SQL query
 
        $query =  "UPDATE product SET imgb='$dataa' WHERE ID='".$id."'";
        // Execute the query
        $result = $dbLink->query($query);

        // Check if it was successfull
        if($result){
            header("Location: divaah_product.php?id=$id");
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }}
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_filea']['error']);
    } 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';}

}
?>						
							
							
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">Product Image</h3>
								<p class="text-light margin-bottom-30">Drag’n’drop the product image #2.</p>
								<?php echo"<img alt='' style='width:25%;' src='data:image/jpeg;base64,$imgb' >"; ?>
								
								<form  action="divaah_product.php?id=<?= $wea ?>" method="post" enctype="multipart/form-data" ><br>
								
									<input type="file" name="uploaded_filea" value="Change Image" ><br>
									<button type="submit" name="updateb" class="btn btn-success">Update</button>
								</form>
							</div>
							
							
							
	<?php
 
if(isset($_POST['updatec'])){
  
if(isset($_FILES['uploaded_fileb'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_fileb']['error'] == 0) {
        // Connect to the database
      
 
        //Gather all required data
        
        $mimeb = $dbLink->real_escape_string($_FILES['uploaded_fileb']['type']);
        $datab = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_fileb']['tmp_name']));
        $sizeb = intval($_FILES['uploaded_fileb']['size']);
        
 
        // Create the SQL query
 
        $query =  "UPDATE product SET imgc='$datab' WHERE ID='".$id."'";
        // Execute the query
        $result = $dbLink->query($query);

        // Check if it was successfull
        if($result){
            header("Location: divaah_product.php?id=$id");
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }}
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_fileb']['error']);
    } 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';}

}
	
?>								
							
							
							<div class="panel-body">
								<h3 class="color-grey-700 margin-top-10">Product Image</h3>
								<p class="text-light margin-bottom-30">Drag’n’drop the product image #2.</p>
								<?php echo"<img alt='' style='width:25%;' src='data:image/jpeg;base64,$imgc' >"; ?>
								
								<form  action="divaah_product.php?id=<?= $wea ?>" method="post" enctype="multipart/form-data" ><br>
								
									<input type="file" name="uploaded_fileb" value="Change Image" ><br>
									<button type="submit" name="updatec" class="btn btn-success">Update</button>
								</form>
							</div>
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
		<?php
if(isset($_GET['stkupb'])){
    
        //Gather all required data
        $dola    = ($_GET['stk']);
	
		if (!empty($dola)) {
			
			$dataa=$dola;
		}
		else{
			
			$dataa=$qa;
		}
       
		$product = $db_handle->runQuery("UPDATE product SET qua='$dataa' WHERE ID = '".$id."' ");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_product.php?id=$id");
			}
    
    // Close the mysql connection
    



}
	
?>									
							
							
							
							
							
	<?php
if(isset($_GET['stkup'])){
    
        //Gather all required data
        
	     $namgg    = ($_GET['nameas']);
		
		$prigg   = ($_GET['priceas']);
		
       
		$producta = $db_handle->runQuery("DELETE FROM pur  WHERE pronam = '".$namgg."' and propri = '".$prigg."'");
		
		$productb = $db_handle->runQuery("UPDATE product SET quab='0',qua='0' WHERE ID = '".$id."' ");
	    
        // Check if it was successfull
        if($productb === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_product.php?id=$id");
			}
    
    // Close the mysql connection
    



}
	
?>								
							
							
							
							
							
							
							
							
							
							
							
							
							<div class="panel-body">
							
							
								<h3 class="color-grey-700 margin-top-10">Stock Details</h3>
								
								<form action="divaah_product.php" method="get">
								<div class="form-group">
								<input type="hidden" class="form-control" id="input-text" name="nameas" value="<?= $topa; ?>">
								<input type="hidden" class="form-control" id="input-text" name="priceas" value="<?= $pria; ?>">
									<input type="hidden" value="<?= $wea ?>" name="id">	
					<input type="submit" name="stkup" value="Remove Stock History" class="btn btn-success">
									</div>
									</form>
									
									<form action="divaah_product.php" method="get">
									<div class="form-group">
										<label for="message" class="control-label">Available Stock</label>
										<input type="hidden" value="<?= $wea ?>" name="id">
					<input type="text" class="form-control" id="input-text" name="stk" placeholder="<?php echo $qa; ?>">
									</div>
									<input type="submit" name="stkupb" value="Update" class="btn btn-success">
									
								</form>
								
								</div>
							
							
							
							<br><br><br><br>
<?php
							
							
	if(isset($_GET['updatedxx'])){
    
      
	

$product = $db_handle->runQuery("UPDATE product SET ProductName = NULL,Price = NULL,Head = NULL,para = NULL,feature = NULL		WHERE  ID = '".$id."' ");
	    
        // Check if it was successfull
        if($product === TRUE){
		echo"ddddddddddddd";	
		}
		else{
			header("Location: divaah_product.php?id=$id");
			}
    
    // Close the mysql connection
    



}

							
							
							
							
	
	}
?>	
							
							<div class="panel-body">
							<form action="divaah_product.php" method="get">
							<input type="hidden" value="<?= $wea ?>" name="id">
							<input type="submit" name="updatedxx" value="Remove This Product" class="btn btn-success">
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