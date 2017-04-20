<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.evatheme.com/html/glammy/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Mar 2017 07:10:20 GMT -->
<head>
<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
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
    
	<!-- Oswald / Title Font -->
		<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
	<link href="../../../netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	
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
<?php
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
<!-- PRELOADER -->
<div id="preloader"><img src="images/preloader.gif" alt="" /></div>
<!-- //PRELOADER -->
<div class="preloader_hide">

	<!-- PAGE -->
	<div id="page">
	
		<!-- HEADER -->
		<header>

<div class=menu_block>
<div class="container clearfix">
<?php		 $product_array = $db_handle->runQuery("SELECT * FROM contact where ID = '1'");
 if (!empty($product_array)) { foreach($product_array as $key=>$value){$log=base64_encode($product_array[$key]['imga']);?>
<div class=logo style="height:50px;"><a href=index.php><?php  echo"<img  alt='Divaah by Devika' src='data:image/jpeg;base64,$log' >";?></a></div>
<?php	    }    }	    ?>

<div class=shopping_bag>
<a class=shopping_bag_btn href=javascript:void(0)><i class="fa fa-shopping-cart"></i><p>Your cart</p>
<span><font color=red size=4><?php if(!empty($_SESSION["cart_item"])){ echo count($_SESSION["cart_item"]);} else{ echo "0"; } ?></font></span>
</a>
<div class="cart FixedHeightContainer">
<div class=Content>
<?php	
						{
    $item_total = 0;						
    foreach ($_SESSION["cart_item"] as $item){
		$roc = base64_encode( $item["sec"]); 
						
		?>
<ul class=cart-items>
<li class=clearfix>
<?php echo"<img class='cart_item_product' src='data:image/jpeg;base64,$roc' >"; ?>
<a href=dailysarees.php class=cart_item_title><?php echo $item["name"]; ?></a>
<span class=cart_item_price><?php echo $item["quantity"]; ?> × &nbsp;<i class="fa fa-inr"></i>&nbsp;
<?php echo $item["price"]; ?></span><a href="term.php?action=remove&code=<?php echo $item["code"]; ?>"><span></span> <i>Remove</i></a>
</li>
</ul>
<?php $item_total += ($item["price"]*$item["quantity"]);				
										if($item_total>= '500')
										{
											$prd= $item_total;
										}
										else{
											$prd = ($item_total + $item["ship"]);
										}	
	}?>
<div class=cart_total>
<div class=clearfix><span class=cart_subtotal>bag subtotal: <b>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?=$prd ?></b></span></div>
<div><a id=btnEmpty href="term.php?action=empty" href=javascript:; class=simpleCart_empty onclick=resetForm(this.form)>
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
</div>
<div class=love_list>
<a class=love_list_btn href=javascript:void(0)><i class="fa fa-heart-o"></i><p>Love list</p><span><font color=red size=4><?php if(!empty($_SESSION["cart_itemc"])){ echo count($_SESSION["cart_itemc"]);} else{ echo "0"; } ?></font></span></a>
<div class="cart FixedHeightContainer">
<div class=Content>
<?php	
{
    $item_total = 0;						
    foreach ($_SESSION["cart_itemc"] as $item){
		$roc = base64_encode( $item["sec"]); 
						
		?>
<ul class=cart-items>
<li>cart</li>
<li class=clearfix>
<?php echo"<img class='cart_item_product' src='data:image/jpeg;base64,$roc' >"; ?>
<a href=dailysarees.php class=cart_item_title><?php echo $item["name"]; ?></a>
<span class=cart_item_price><?php echo $item["quantity"]; ?> × &nbsp;<i class="fa fa-inr"></i>&nbsp;
<?php echo $item["price"]; ?></span><a href="term.php?go=remove&code=<?php echo $item["code"]; ?>"><span></span><i>Remove</i></a>
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
<div class=cart_total>
<div class=clearfix><span class=cart_subtotal>bag subtotal: <b>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?=$prd ?></b></span></div>
<div>
<a id=btnEmpty href="term.php?go=empty" href=javascript:; class=simpleCart_empty onclick=resetForm(this.form)>
Empty Cart
</a></div>
<?php

}

?> <button class="btn btn-sm" onclick="window.location.href='checkout.php'">Checkout</button>
<br><br>
<button class="btn btn-sm" onclick="window.location.href='love-list.php'">Love List</button>
</div>
</div>
</div>
</div>
<ul class="navmenu center">
<li class=sub-menu><a href=index.php>HOME</a></li>
<li class=sub-menu><a href=daily.php>DAILY WEARS</a></li>
<li class=sub-menu><a href=party.php>PARTY WEARS</a></li>
<li class=sub-menu><a href=new_arrival.php>NEW ARRIVALS</a></li>
<?php if (!isset($_SESSION['user'])) {
	echo"<li>";
  echo" <a href='my-account.php' >Login</a>";
  echo"</li>";
  echo"<li>";
  echo" <a href='register.php' >Register</a>";
  echo"</li>"; } else if(isset($_SESSION['user'])!="") {
	 echo"<li>";
  echo"<a href='logout.php?logout'>Logout</a>";
  echo"</li>"; } ?>
<li class=sub-menu><a href=contact.php>CONTACT US</a></li>
</ul>
</div>
</div>
</header><!-- //HEADER -->
		
		
		<!-- BREADCRUMBS -->
		<section class="breadcrumb parallax margbot30"></section>
		<!-- //BREADCRUMBS -->
		
		
		<!-- PAGE HEADER -->
		<section class="page_header">
			
			<!-- CONTAINER -->
			<div class="container">
				<h3 class="pull-left"><b>TERMS OF USE</b></h3>
				
				<div class="pull-right">
					<a href="index.php" >Back to shop<i class="fa fa-angle-right"></i></a>
				</div>
			</div><!-- //CONTAINER -->
		</section><!-- //PAGE HEADER -->
		
		
		<!-- ABOUT US INFO -->
		<section class="about_us_info">
			
			<!-- CONTAINER -->
			<div class="container">
				
				<!-- ROW -->
		
				<div class="row">
					<div>
						
						
						<b><h1 align="center">TERMS OF USE</h1></b>
						<p><i>Divaah provide services to you subject to the following conditions. If you shop at Divaah, you accept these conditions. Please read them carefully.</i></p>
						<p>
						<b><h3 align="left"><u>Return</u></h3></b>
						<p><b><u>Return and Exchange of any Divaah product online or in-store is only possible under the following circumstances.</u></b>
						<p>
<b>&#10148; Damaged Goods -</b><i>Our products are carefully inspected before they leave our distribution centre; however, if you are still unsatisfied with your purchase please follow the instructions below. You must notify us via an email with your order number within 2 days of receipt of your purchase from Divaah <br>
A full account credit will be applicable for damaged products. Please note: Purchased items cannot be returned on the basis of colour, patterns or designs. There could be a slight variation in colour depending on the product.
</i>

</p><p>
<b>&#10148; Incorrect Orders -</b><i>In case you have received an item which is not what you had originally ordered, please e-mail us with your order number within 48 hours. Please note: We will only be able to ship the correct order once we receive our wrongly sent merchandise in its original packaging.
</i>
</p><p>
<b>&#10148; Charges -</b><i> The charges for shipping products shopped at Divaah.com depends on the location to which you want your purchases to be shipped. We offer free shipping to customers residing in India. For orders placed outside India, International shipping charges and applicable taxes will be charged to the customer. You might also incur country specific charges. Please check your delivery destination for further details.
</i>
</p><p>
<b>&#10148; Terms of Return & Exchange -</b><i> Returned items must concur to our terms of returns & exchange</i>
</p><p>	
<i>&#10122; You must report the damage of goods within 48 hours of receipt via an email.<br>
 &#10123; Once we confirm and accept your claim your returned merchandize must arrive at Divaah within 30 days after you receive your order. After this we cannot guarantee the exchange or refund.<br>
&#10124; Purchased merchandise to be returned or exchanged must be unused, unwashed and undamaged.Divaah.com will not be liable to incur shipping or insurance charges on merchandise that has been cancelled.<br>&nbsp;&nbsp; We strongly recommend that you ship the merchandize via a service provider that insures you for the value of the goods.<br>
&#10125; Kindly ensure that the returned merchandize includes original labels, tag, receipt and other packaging, Divaah reserves the right to refuse return or exchange in case of missing packaging.<br>
&#10126; All returns will be completed on a credit basis, excluding the cost of shipping. A credit note will be sent to you via e-mail and this can be redeemed during your next purchase.<br>
&#10127; Exchange can only be in the form of repurchase via the credit note
</i></p>
<br><br>
<b><h3 align="left"><u>BILLING</u></h3></b>
<p>
<b>&#10148; </b><i>Billing is an important process while making a purchase. You must provide complete and accurate billing information when you place your order. The order will only be dispatched once the billing process is concluded. The customer copy of the bill will be attached to your package.
</i>
</p>						
<p>
<b>&#10148; PAYMENT METHODS -</b><i>Divaah accepts all major credit and debit cards, Wallet and Net-banking.
</i>
</p>						
<p>
<b>&#10148; PAYMENT GATEWAY -</b><i>Divaah has signed with SBI Bank for accepting credit card, debit Card and net banking transactions. All transactions are securely managed by Instamojo  payment gateway. All credit card, Debit Card, Wallet and net banking transactions are processed over a secure encrypted connection, with the highest level of security and confidentiality. In case of a payment failure, please retry ensuring: Information passed on to payment gateway is accurate i.e. account details, billing address, password (for net banking) Your Internet connection is not disrupted in the process. If your account has been debited after a payment failure, it is normally rolled back to your bank account within 7 business days. You can email us on support@divaah.com or please give us a call with your order number for any clarification.
</i>
</p>						
						
					</div>
					
					
				</div><!-- //ROW -->
				
			</div><!-- //CONTAINER -->
		</section><!-- //ABOUT US INFO -->
		
	
		<!-- FOOTER -->
		<footer style=background-color:#5a3814>
<div class=container data-animated=fadeInUp>
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
<div class=row>
<div align=left class="col-lg-2 col-md-2 col-sm-6 padbot30">
<h4>About Us</h4>
<p align=left><?= $ab ?></p><a href="about.php">...Read More</a>
</div>
<div align=left class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
<h4>Navigation</h4>
<ul class=foot_menu>
<li><a href=index.php>Home</a></li>
<li><a href=daily.php>Daily Wears</a></li>
<li><a href=party.php>Party Wears</a></li>
<li><a href=new_arrival.php>New Arrivals</a></li>

</ul>
</div>
<div class=respond_clear_480></div>
<div align=center class="col-lg-4 col-md-4 col-sm-6 padbot30">
<a href=index.php>
<?php  echo"<img  alt='Divaah by Devika' src='data:image/jpeg;base64,$log' >";?>
</a>
</div>
<div class=respond_clear_768></div>
<div align=right class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
<h4>Divaah by Devika</h4>
<ul class=foot_menu>
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
<div align=right class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
<h4>Contact Us</h4>
<div class=foot_address><span>Divaah by Devika</span><?= $ad ?></div>
<div class=foot_phone>
<i class="fa fa-phone fa-lg"></i>
<span>&nbsp;&nbsp;<?= $ph ?></span>
</div>
<div class=foot_mail>
<i class="fa fa-envelope fa-lg"></i>
<span>&nbsp;&nbsp;<?= $em ?></font></span>
</div>
<br>
<div class=social>
<a href=<?= $fb ?>><i class="fa fa-facebook"></i></a>
<a href=<?= $tw ?>><i class="fa fa-twitter"></i></a>
<a href=<?= $ig ?>><i class="fa fa-instagram"></i></a>
</div>
</div>
</div>
<?php
			
		    }
	     }
	    ?>
</div>
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
	<!--[if IE]><script src="https://php5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if IE]><html class="ie" lang="en"> <![endif]-->
	
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

<!-- Mirrored from demo.evatheme.com/html/glammy/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Mar 2017 07:10:20 GMT -->
</html>