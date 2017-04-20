<!DOCTYPE html>
<html lang="en">

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
	<title>Divaah by Devika</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Divaah Online Boutique strives to make every purchase a positive experience. Our top priorities are excellent customer service, exceptionally quick order processing, ultra fast shipping times, and a hassle-free return policy. We value your feedback, whether positive or constructive and we are continuously working to improve your experience.">
	<meta name="author" content="">
	
	<link rel="shortcut icon" href="images/favicon.ico">
    
	<!-- CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/flexslider.css" rel="stylesheet" type="text/css" />
	<link href="css/fancySelect.css" rel="stylesheet" media="screen, projection" />
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
		<!-- Owl Carousel -->
        <link rel="stylesheet" href="css/owl.carousel.css">
    
	<!--
		Google Font
		=========================== -->                    
		
		<!-- Oswald / Title Font -->
		<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
	<link href="../../../netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	
	<style>
		.border {
			border-top: 1px solid #5a3814;
			height: 1px;
			margin: 15px auto 0;
			position: relative;
			width: 35%;
		}

		.border:before {
			background-color: #5a3814;
			content: "";
			height: 10px;
			left: 50%;
			margin-left: -20px;
			position: absolute;
			top: -5px;
			width: 40px;
		}
		.title {
			padding-top: 15px;
			padding-bottom: 60px;
		}

		.title h2 {
			text-transform: uppercase;
			font-weight: 700;
			font-size: 36px;
			color: #5a3814;
			line-height: 30px;
		}
		.color {
			color: #f9af46;
		}


	/* 
	Generic Styling, for Desktops/Laptops 
	*/
	table { 
	  width: 80%; 
	  border-collapse: collapse; 
	}
	/* Zebra striping */
	tr:nth-of-type(odd) { 
	}
	th { 
	  color: white; 
	  font-weight: bold; 
	}
	td, th { 
	  padding: 6px; 
	  border: 0px solid #ccc; 
	  text-align: left; 
	}
	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 0px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 0px solid #eee; 
		position: relative;
		padding-left: 0%; 
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
}
	</style>
	
</head>
<body>
<style>
.FixedHeightContainer
		{
		  float:right;
		  height: 250px;
		  width:250px;
		  overflow: auto;
		}
		.Content
		{
		  
		}
	</style>
<!-- PRELOADER -->
<div id="preloader"><img src="images/preloader.gif" alt="" /></div>
<!-- //PRELOADER -->
<div class="preloader_hide">

	<!-- PAGE -->
	<div id="page">
	
		<!-- HEADER -->
		<header>
			
			<!-- TOP INFO -->
			<!-- TOP INFO -->
			
			
			<!-- MENU BLOCK -->
			<div class="menu_block" >
			
				<!-- CONTAINER -->
				<div class="container clearfix">
					
					<!-- LOGO -->
					<?php
		 $product_array = $db_handle->runQuery("SELECT * FROM contact where ID = '1'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $log=base64_encode($product_array[$key]['imga']);
		?>
					<div class="logo" style="height:50px;">
						<a href="index.php" ><?php  echo"<img  alt='Divaah by Devika' src='data:image/jpeg;base64,$log' >";?></a>
					</div><!-- //LOGO -->
			<?php
			
		    }
	     }
	    ?>			<!-- //LOGO -->
					
					
					<!-- SEARCH FORM -->
					<!-- SEARCH FORM -->
					
					
					<!-- SHOPPING BAG -->
					<div class="shopping_bag">
					
						<a class="shopping_bag_btn" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i><p>Your cart</p>
						<span><font color="red" size="4"><?php if(!empty($_SESSION["cart_item"])){ echo count($_SESSION["cart_item"]);} else{ echo "0"; } ?></font></span>
						
						</a>
						<div class="cart FixedHeightContainer">
						<div class="Content">
						<?php	
						{
    $item_total = 0;						
    foreach ($_SESSION["cart_item"] as $item){
		$roc = base64_encode( $item["sec"]); 
						
		?>
							<ul class="cart-items">
								<li class="clearfix">
								<?php echo"<img class='cart_item_product' src='data:image/jpeg;base64,$roc' >"; ?>
									<a href="dailysarees.php" class="cart_item_title"><?php echo $item["name"]; ?></a>
									<span class="cart_item_price"><?php echo $item["quantity"]; ?> ×  &nbsp;<i class="fa fa-inr"></i>&nbsp; 
									<?php echo $item["price"]; ?></span>
								</li>
								
							</ul>
							<?php
										
        $item_total += ($item["price"]*$item["quantity"]);
										
										if($item_total>= '500')
										{
											$prd= $item_total;
										}
										else{
											$prd = ($item_total + $item["ship"]);
										}
	
	}
		?>	
							<div class="cart_total">
	<div class="clearfix"><span class="cart_subtotal">bag subtotal: <b>&nbsp;<i class="fa fa-inr"></i>&nbsp;  <?=$prd ?></b></span></div>
<div><a id="btnEmpty" href="index.php?action=empty" href="javascript:;" class="simpleCart_empty" onclick="resetForm(this.form);">
Empty Cart
</a></div>
<?php
						
}
?>
								<button class="btn btn-sm" onclick="window.location.href='checkout.php'">Checkout</button>
								<br><br>
								<button class="btn btn-sm" onclick="window.location.href='shopping-bag.php'">Shopping bag</button>
								
							</div>
							</div>
						</div>
					</div><!-- //SHOPPING BAG -->
					
					
					
					
					
					
					
					
				
					
				<div class="love_list">
						<a class="love_list_btn" href="javascript:void(0);" ><i class="fa fa-heart-o"></i><p>Love list</p><span><font color="red" size="4"><?php if(!empty($_SESSION["cart_itemc"])){ echo count($_SESSION["cart_itemc"]);} else{ echo "0"; } ?></font></span></a>
						<div class="cart FixedHeightContainer">
						<div class="Content">
							<?php	
{
    $item_total = 0;						
    foreach ($_SESSION["cart_itemc"] as $item){
		$roc = base64_encode( $item["sec"]); 
						
		?>		
							<ul class="cart-items">
							<li>cart</li>
								<li class="clearfix">
								<?php echo"<img class='cart_item_product' src='data:image/jpeg;base64,$roc' >"; ?>
									<a href="dailysarees.php" class="cart_item_title"><?php echo $item["name"]; ?></a>
									<span class="cart_item_price"><?php echo $item["quantity"]; ?> ×  &nbsp;<i class="fa fa-inr"></i>&nbsp; 
									<?php echo $item["price"]; ?></span>
								</li>
								
							</ul>
							<?php
										
        $item_total += ($item["price"]*$item["quantity"]);
										
										if($item_total>= '500')
										{
											$prd= $item_total;
										}
										else{
											$prd = ($item_total + $item["ship"]);
										}
	}
		?>	
							<div class="cart_total">
	<div class="clearfix"><span class="cart_subtotal">bag subtotal: <b>&nbsp;<i class="fa fa-inr"></i>&nbsp;  <?=$prd ?></b></span></div>
								<div>
								<a id="btnEmpty" href="index.php?go=empty" href="javascript:;" class="simpleCart_empty" onclick="resetForm(this.form);">
Empty Cart
</a></div>
	<?php

}

?>							<button class="btn btn-sm" onclick="window.location.href='checkout.php'">Checkout</button>
								<br><br>
								<button class="btn btn-sm" onclick="window.location.href='love-list.php'">Love List</button>
							</div>
						</div>
					</div>	
					</div>	
					
					
					<!-- MENU -->
					<ul class="navmenu center">
						<li class="sub-menu"><a href="index.php" >HOME</a></li>
						<li class="sub-menu"><a href="daily.php" >DAILY WEARS</a></li>
						<li class="sub-menu"><a href="party.php" >PARTY WEARS</a></li>
						<li class="sub-menu"><a href="new_arrival.php" >NEW ARRIVALS</a></li>
						<?php

if (!isset($_SESSION['user'])) {
	echo"<li>";
  echo" <a href='my-account.php' >Login</a>";
  echo"</li>";
  echo"<li>";
  echo" <a href='register.php' >Register</a>";
  echo"</li>";
 } else if(isset($_SESSION['user'])!="") {
	 echo"<li>";
  echo"<a href='logout.php?logout'>Logout</a>";
  echo"</li>";
 } 
?>	
						<li class="sub-menu"><a href="contact.php" >CONTACT US</a></li>
					</ul><!-- //MENU -->
				</div><!-- //MENU BLOCK -->
			</div><!-- //CONTAINER -->
		</header><!-- //HEADER -->
		<!-- BREADCRUMBS -->
		<section class="breadcrumb parallax margbot30"></section>
		<!-- //BREADCRUMBS -->
		
		<!-- MY ACCOUNT PAGE -->
		<section class="tovar_details padbot70">
			<!-- CONTAINER -->
			<div class="container"  style="background-color:#f2efe8; box-shadow: 0 0 3px 1px #a3a295;">
					<!-- ROW -->
					<div class="row padbot30">
						
						<!-- section title -->
						<div class="title text-center wow fadeInDown">
							<h2> Create <span class="color">Account</span></h2>
							<div class="border"></div>
						</div>
						<!-- /section title -->
 <?php

 if ( isset($_POST['btn-signup']) ) {
  include_once 'dbconnect.php';
  $error = false;
  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  
  $last = trim($_POST['last']);
  $last = strip_tags($last);
  $last = htmlspecialchars($last);
  
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  
  $ph = trim($_POST['ph']);
  $ph = strip_tags($ph);
  $ph = htmlspecialchars($ph);
  
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  $adg = substr($email, -3);
$adh= substr($ph, 2, 5);

 $ref= "*D".$adh."*";
  
  
  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
  
  // password encrypt using SHA256();
  $password = hash('sha256', $pass);
  
  // if there's no error, continue to signup
  if( !$error ) {
   
   $query = "INSERT INTO users(userName,lastName,userEmail,userph,userPass,repas) VALUES('$name','$last','$email','$ph','$password','$ref')";
   $res = mysql_query($query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now >";
	
    unset($name);
    unset($email);
    unset($pass);
	header("Location:my-account.php");
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
    
  }
  
  
 }
?>    					
					<div class="clearfix">
					<font color="red"><?php
   if ( isset($errMSG) ) {
    echo "$errMSG" ;
    }
   ?></font><br>
					
						<div class="col-md-12">
							
							<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
								<table class="table1" align="center" width="80%">
									<tr>
										<td>
											<label class="label"><font size="3px" color= "#f9af46"> First Name: <sup>*</sup></font></label><br>
		<input name="name" onclick="this.value=''; this.style.color='#f9af46'" class="col" type="text" placeholder="Your First Name" required/>
		<font color="red"><?php echo $nameError; ?></font>								</td>
										<td></td>
										<td>
											<label class="label"><font size="3px" color= "#f9af46"> Last Name: <sup>*</sup></font></label><br>
		<input onclick="this.value=''; this.style.color='#f9af46'" name="last" class="col" type="text" placeholder="Your Last Name" required/>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label" ><font size="3px" color= "#f9af46"> Email ID: <sup>*</sup></font></label><br>
		<input onclick="this.value=''; this.style.color='#f9af46'" name="email" class="col" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Your Email" required/><font color="red"><?php echo $emailError; ?></font>
										</td>
										<td></td>
										<td>
											<label class="label"><font size="3px" color= "#f9af46"> Mobile: <sup>*</sup></font></label><br>
		<input onclick="this.value=''; this.style.color='#f9af46'"  class="col" name="ph" type="text" minlength="10" maxlength="10"  pattern="^\d{10}$" placeholder="Your Mobile number" required/>
										</td>
									</tr>
									<tr>
										<td>
											<label class="label"><font size="3px" color= "#f9af46"> Password: <sup>*</sup></font></label><br>
		<input onclick="this.value=''; this.style.color='#f9af46'" class="col" name="pass" type="password"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" if(this.checkValidity()) form.password_two.pattern = this.value;" placeholder="Enter a password" required/><font color="red"><?php echo $passError; ?></font>
										</td>
										<td></td>
										<td>
											<label class="label"><font size="3px" color= "#f9af46"> Confirm Password: <sup>*</sup></font></label><br>
											<input onclick="this.value=''; this.style.color='#f9af46'" class="col" name="password_two" type="password"  onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');"  placeholder="Re-enter password" required/>
										</td>
									</tr>
									<tr>
										<td align="left"><button class="btn btn-sm" type="submit" name="btn-signup">CREATE ACCOUNT</button></td>
										<td></td>
										<td></td>
									</tr>
								</table>
							</form>
							<br><br>	
						</div>
						
					
					</div><!-- //ROW -->
				</div>
			</div><!-- //CONTAINER -->
		</section><!-- //MY ACCOUNT PAGE -->
		</section>
		
	
		<!-- FOOTER -->
		<footer style="background-color:#5a3814;">
			
			<!-- CONTAINER -->
			<div class="container" data-animated='fadeInUp'>
			<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM contact where ID = '1'");
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
		?>				
				
				<!-- ROW -->
				<div class="row">
					<div align="left" class="col-lg-2 col-md-2 col-sm-6 padbot30">
						<h4>About Us</h4>
						<p align=left><?= $ab ?></p><a href="about.php">...Read More</a>
					</div>
					
					<div align="left" class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
						<h4>Navigation</h4>
						<ul class="foot_menu">
							<li><a href="index.php">Home</a></li>
							<li><a href="daily.php">Daily Wears</a></li>
							<li><a href="party.php">Party Wears</a></li>
							<li><a href="new_arrival.php">New Arrivals</a></li>
							
						</ul>
					</div>
					
					<div class="respond_clear_480"></div>
					
					<div align="center" class="col-lg-4 col-md-4 col-sm-6 padbot30">
						<a href="index.php">
						<?php  echo"<img  alt='Divaah by Devika' src='data:image/jpeg;base64,$log' >";?>
							 
						</a>
					</div>
					
					<div class="respond_clear_768"></div>
					
					<div align="right" class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
						<h4>Divaah by Devika</h4>
						<ul class="foot_menu">
							<?php

if (!isset($_SESSION['user'])) {
	echo"<li>";
  echo" <a href='my-account.php' >Login</a>";
  echo"</li>";
  echo"<li>";
  echo" <a href='register.php' >Register</a>";
  echo"</li>";
 } else if(isset($_SESSION['user'])!="") {
	 echo"<li>";
  echo"<a href='logout.php?logout'>Logout</a>";
  echo"</li>";
 } 
?>	
							<li><a href="ships.php">Shipping</a></li>
<li><a href="term.php">Terms of use</a></li>
<li><a href="priva.php">Privacy Policy</a></li>
							
						</ul>
					</div>
					<div align="right" class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
						<h4>Contact Us</h4>
						<div class="foot_address"><span>Divaah by Devika</span><?= $ad ?></div>
						<div class="foot_phone">
							<i class="fa fa-phone fa-lg"></i>
							<span>&nbsp;&nbsp;<?= $ph ?></span>
						</div>
						<div class="foot_mail">
							<i class="fa fa-envelope fa-lg"></i>
							<span>&nbsp;&nbsp;<?= $em ?></font></span>
						</div>
						<br>
						<div class="social">
							<a href="<?= $fb ?>"><i class="fa fa-facebook"></i></a>
							<a href="<?= $tw ?>" ><i class="fa fa-twitter"></i></a>
							<a href="<?= $ig ?>" ><i class="fa fa-instagram"></i></a>
						</div>
					</div>
				</div><!-- //ROW -->
				<?php
			
		    }
	     }
	    ?>	
			</div><!-- //CONTAINER -->
						
			<!-- COPYRIGHT -->
			<div class=copyright style=background-color:#5a3814>
<div class="container clearfix">
<div class=foot_logo><br>
<span>Divaah by Devika &copy; 2017</span> |
<span>All Rights Reserved.</span>
</div>
<div class=copyright_inf>
<span>Design and Developed by&nbsp;<a href=https://ibosoninnov.com>I-Boson Innovations</a></span>

</div>

</div>
<div style="text-align:right;">
<a class=back_top href=javascript:void(0)>Back to Top <i class="fa fa-angle-up"></i></a>
</div>
</div>
		</footer><!-- //FOOTER -->
	</div><!-- //PAGE -->
</div>

<!-- TOVAR MODAL CONTENT -->
<div id="modal-body" class="clearfix">
	<div id="tovar_content"></div>
	<div class="close_block"></div>
</div><!-- TOVAR MODAL CONTENT -->

	<!-- SCRIPTS -->
	<!--[if IE]><script src="https://php5shiv.googlecode.com/svn/trunk/php5.js"></script><![endif]-->
    <!--[if IE]><php class="ie" lang="en"> <![endif]-->
	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery.sticky.js" type="text/javascript"></script>
	<script src="js/parallax.js" type="text/javascript"></script>
	<script src="js/jquery.flexslider-min.js" type="text/javascript"></script>
	<script src="js/jquery.jcarousel.js" type="text/javascript"></script>
	<script src="js/jqueryui.custom.min.js" type="text/javascript"></script>
	<script src="js/fancySelect.js"></script>
	<script src="js/animate.js" type="text/javascript"></script>
	<script src="js/myscript.js" type="text/javascript"></script>
	
</body>

</html>