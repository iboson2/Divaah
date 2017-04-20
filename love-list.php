<!DOCTYPE html>
<html lang="en">

<head>
<?php

session_start();

require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["go"])) {
switch($_GET["go"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["ProductName"],'id'=>$productByCode[0]["ID"],
			'hed'=>$productByCode[0]["Head"],'sec'=>$productByCode[0]["imga"],'ship'=>$productByCode[0]["Ship"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'col'=>$_POST["color"],'siz'=>$_POST["size"],'price'=>$productByCode[0]["Price"]));
			
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
			'hed'=>$productByCode[0]["Head"],'sec'=>$productByCode[0]["imga"],'ship'=>$productByCode[0]["Ship"], 'code'=>$productByCode[0]["code"],
			'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["Price"]));
			
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
    
	<!-- Oswald / Title Font -->
		<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
	<link href="../../../netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

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
</head>
<body>

<!-- PRELOADER -->
<div id="preloader"><img src="images/preloader.gif" alt="" /></div>
<!-- //PRELOADER -->
<div class="preloader_hide">

	<!-- PAGE -->
	<div id="page">
	
		<!-- HEADER -->
		<header>
			
			<!-- TOP INFO -->
			<div class="top_info">
				
				<!-- CONTAINER -->
				
			
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
<div><a id="btnEmpty" href="love-list.php?action=empty" href="javascript:;" class="simpleCart_empty" onclick="resetForm(this.form);">
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
								<a id="btnEmpty" href="love-list.php?go=empty" href="javascript:;" class="simpleCart_empty" onclick="resetForm(this.form);">
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
		
		
		<!-- LOVE LIST BLOCK -->
		<section class="love_list_block">
			
			<!-- CONTAINER -->
			<div class="container" style="background-color:#f2efe8; box-shadow: 0 0 5px 3px #a3a295; padding-top:15px;">
				<!-- ROW -->
				<div class="row">
					
					<!-- CART TABLE -->
					<div class="col-lg-12 col-md-12 padbot40">
					
						<h3 class="pull-left"><b>Love list</b></h3>
					
						<div class="pull-right">
							<a href="dailysarees.php" >Back to shop <i class="fa fa-angle-right"></i></a>
						</div>
						
					</div>
				
				</div>
			
				<!-- ROW -->
				<div class="row">
					
					<!-- CART TABLE -->
					<div class="col-lg-12 col-md-12 padbot40">
					<?php
if(isset($_SESSION["cart_itemc"])){
    $item_total = 0;
?>					
						<table class="shop_table">
							<thead>
								<tr>
									<th class="product-thumbnail"></th>
									<th class="product-name">Item</th>
									<th class="product-name">Details</th>
									<th class="product-price">Price</th>
									<th class="product-add-bag"></th>
									<th class="product-remove"></th>
								</tr>
							</thead>
							<tbody>
							<?php	
						
    foreach ($_SESSION["cart_itemc"] as $item){
		$roc = base64_encode( $item["sec"]); 
			$cd=$item["code"];			
		?>
								<tr class="cart_item">
									<td class="product-thumbnail"><a href="party_single.php" >
									<?php echo"<img class='cart_item_product' src='data:image/jpeg;base64,$roc' >"; ?></a></td>
									<td class="product-name">
										<a href="daily_single.php?id=<?= $item["id"]; ?>"><?php echo $item["name"]; ?></a>
										
									</td>
		                            <td class="product-name">
										<a href="party_single.php"><?php echo $item["hed"]; ?></a>
								
									</td>
									<td class="product-price">&nbsp;<i class="fa fa-inr"></i>&nbsp;  <?php echo $item["price"]; ?></td>

<td class="product-add-bag"><a class="add_bag" href=" " onclick="document.getElementById('my_form<?= $cd?>').submit();return false;" >
<i class="fa fa-shopping-cart"></i><span>Add to bag</span></a></td>

														<?php echo"<form id='my_form$cd' method='post' action='love-list.php?action=add&code=$cd'>
         <input type='hidden' name='quantity' value='1' size='2' />

        </form>"; ?>	
									<td class="product-remove"><a href="love-list.php?go=remove&code=<?php echo $item["code"]; ?>"><span>Delete</span> <i>X</i></a></td>
								</tr>
	<?php } ?>
							</tbody>
						</table>
						<?php
	
}
else{
?>	
<div class="row">
					<div class="col-lg-12 col-md-12 padbot60">
						<br><br>
						<p align="center"><font size="14px">YOUR LOVE LIST IS EMPTY</font></p>
						<br><br></div>
				</div><!-- //ROW -->

<?php
}
?>
					</div><!-- //CART TABLE -->
					
					
				</div><!-- //ROW -->
			</div><!-- //CONTAINER -->
		</section><!-- //LOVE LIST BLOCK -->
		
		<br><br>
		<!-- FOOTER -->
		<footer style="background-color:#5a3814;">
			
			<!-- CONTAINER -->
			<div class="container" data-animated='fadeInUp'>
				
				<!-- ROW -->
				<div class="row">
					<div align="left" class="col-lg-2 col-md-2 col-sm-6 padbot30">
						<h4>About Us</h4>
						<p align="left">Lorem ipsum dolor sit amet, consectetur adipisicing elit adipisicing. Ipsam, vero, provident Ipsam, vero, provident, eum eligendi blanditiis ex explicabo vitae nostrum facilis asperiores dolorem illo officiis ratione vel fugiat.</p>
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
							<img src="img/divaah.png" alt="Divaah by Devika" /> 
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
							<li><a href="#">Shipping</a></li>
							<li><a href="#">Terms of use</a></li>
							<li><a href="#">Privacy Policy</a></li>
							
						</ul>
					</div>
					<div align="right" class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
						<h4>Contact Us</h4>
						<div class="foot_address"><span>Divaah by Devika</span>Address line</div>
						<div class="foot_phone">
							<i class="fa fa-phone fa-lg"></i>
							<span>&nbsp;&nbsp;+91-815 794 7660</span>
						</div>
						<div class="foot_mail">
							<i class="fa fa-envelope fa-lg"></i>
							<span>&nbsp;&nbsp;info@divaah.com</font></span>
						</div>
						<br>
						<div class="social">
							<a href="https://facebook.com/divaahbydevika" ><i class="fa fa-facebook"></i></a>
							<a href="https://twitter.com/divaahbydevika" ><i class="fa fa-twitter"></i></a>
							<a href="https://instagram.com/divaahbydevika" ><i class="fa fa-instagram"></i></a>
						</div>
					</div>
				</div><!-- //ROW -->
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
	</div><!-- //PAGE -->
</div>

<!-- TOVAR MODAL CONTENT -->
<div id="modal-body" class="clearfix">
	<div id="tovar_content"></div>
	<div class="close_block"></div>
</div><!-- TOVAR MODAL CONTENT -->

	<!-- SCRIPTS -->
	<!--[if IE]><script src="https://php5shiv.googlecode.com/svn/trunk/php5.js"></script><![endif]-->
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
	
	<script>
		if (top != self) top.location.replace(self.location.href);
	</script>
	
</body>

</html>