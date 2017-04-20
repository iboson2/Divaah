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
    
	<!-- Oswald / Title Font -->
		<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
	<link href="../../../netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<style>
		
		.snip1585 {
		  background-color: #000;
		  color: #fff;
		  display: inline-block;
		  font-family: 'Roboto', sans-serif;
		  font-size: 24px;
		  margin: 8px;
		  max-width: 362px;
		  min-width: 250px;
		  overflow: hidden;
		  position: relative;
		  text-align: center;
		  width: 100%;
		}

		.snip1585 * {
		  -webkit-box-sizing: border-box;
		  box-sizing: border-box;
		  -webkit-transition: all 0.45s ease;
		  transition: all 0.45s ease;
		}

		.snip1585:before,
		.snip1585:after {
		  background-color: rgba(0, 0, 0, 0.5);
		  border-top: 50px solid rgba(0, 0, 0, 0.5);
		  border-bottom: 50px solid rgba(0, 0, 0, 0.5);
		  position: absolute;
		  top: 0;
		  bottom: 0;
		  left: 0;
		  right: 0;
		  content: '';
		  -webkit-transition: all 0.3s ease;
		  transition: all 0.3s ease;
		  z-index: 1;
		  opacity: 0;
		}

		.snip1585:before {
		  -webkit-transform: scaleY(2);
		  transform: scaleY(2);
		}

		.snip1585:after {
		  -webkit-transform: scaleY(2);
		  transform: scaleY(2);
		}

		.snip1585 img {
		  vertical-align: top;
		  max-width: 100%;
		  backface-visibility: hidden;
		}

		.snip1585 figcaption {
		  position: absolute;
		  top: 0;
		  bottom: 0;
		  left: 0;
		  right: 0;
		  align-items: center;
		  z-index: 1;
		  display: flex;
		  flex-direction: column;
		  justify-content: center;
		  line-height: 1.1em;
		  opacity: 1;
		  z-index: 2;
		  -webkit-transition-delay: 0s;
		  transition-delay: 0s;
		}

		.snip1585 h3 {
		  font-size: 40px;
		  font-weight: 400;
		  letter-spacing: 1px;
		  margin: 0;
		  text-transform: uppercase;
		}

		.snip1585 h3 span {
		  display: block;
		  font-weight: 700;
		}

		.snip1585 a {
		  position: absolute;
		  top: 0;
		  bottom: 0;
		  left: 0;
		  right: 0;
		  z-index: 3;
		}

		.snip1585:hover > img,
		.snip1585.hover > img {
		  opacity: 0.9;
		}

		.snip1585:hover:before,
		.snip1585.hover:before,
		.snip1585:hover:after,
		.snip1585.hover:after {
		  -webkit-transform: scale(1);
		  transform: scale(1);
		  opacity: 1;
		}

		.snip1585:hover figcaption,
		.snip1585.hover figcaption {
		  opacity: 1;
		  -webkit-transition-delay: 0.1s;
		  transition-delay: 0.1s;
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
					<div class="logo">
						<a href="index.php" style="height:50px;" ><?php  echo"<img  alt='Divaah by Devika' src='data:image/jpeg;base64,$log' >";?></a>
					</div><!-- //LOGO -->
			<?php
			
		    }
	     }
	    ?>			<!-- //LOGO -->
					
					
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
						<li class="sub-menu first active"><a href="daily.php" >DAILY WEARS</a></li>
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
		<section class="breadcrumb women parallax margbot30">
			
			<!-- CONTAINER -->
			<div class="container">
				<h2>DAILY WEARS</h2>
			</div><!-- //CONTAINER -->
		</section><!-- //BREADCRUMBS -->
		
		
		<!-- SHOP BLOCK -->
		<section class="shop">
			<!-- CONTAINER -->
			<div class="container" style="background-color:#f2efe8; box-shadow: 0 0 5px 3px #a3a295; padding-top:15px;">
			
				<!-- ROW -->
				<div class="row">
					<!-- SHOP PRODUCTS -->
					<div class="col-lg-12 col-sm-12 col-sm-12 padbot50">
						
						<!-- SHOP BANNER -->
						<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM image where ID = '17'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["Name"];
        $log=base64_encode($product_array[$key]['img']);	 
	    
        
		?>	
						<div align="center" class="banner_block margbot15">
							<a class="banner nobord" href="javascript:void(0);" ><?php  echo"<img  alt='sample70' src='data:image/jpeg;base64,$log' >";?></a>
						</div><!-- //SHOP BANNER -->


<?php
			
		    }
	     }
	    ?>								
					</div>
					<div class="col-lg-12 col-sm-12 col-sm-12 padbot50">
						<!-- CONTAINER -->
						<div class="container" style=" padding: 15px 15px;">
						
							<!-- ROW -->
							<div class="row">
							<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM image where ID = '19'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["Name"];
        $log=base64_encode($product_array[$key]['img']);	 
	    
        
		?>	
								<figure class="snip1585 col-lg-4 col-sm-4 col-sm-4" style="background-color: transparent;">
									
									<?php  echo"<img  alt='sample70' src='data:image/jpeg;base64,$log' >";?>
									<figcaption>
										<h3 style="color:#f9af46;"><?= $bos ?><span></span></h3>
									</figcaption>
									<a href="dailykurti.php"></a>
								</figure>
								
			<?php
			
		    }
	     }
	    ?>					
								
								
			<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM image where ID = '20'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["Name"];
        $log=base64_encode($product_array[$key]['img']);	 
	    
        
		?>						
								
								
								
								<figure class="snip1585 col-lg-4 col-sm-4 col-sm-4" style="background-color: transparent;">
									
									<?php  echo"<img  alt='sample109' src='data:image/jpeg;base64,$log' >";?>
									<figcaption>
										<h3 style="color:#f9af46;"><?= $bos ?><span></span></h3>
									</figcaption>
									<a href="dailysarees.php"></a>
								</figure>
								
			<?php
			
		    }
	     }
	    ?>					
								
			<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM image where ID = '21'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["Name"];
        $log=base64_encode($product_array[$key]['img']);	 
	    
        
		?>						
								
								
								
								
								<figure class="snip1585 col-lg-4 col-sm-4 col-sm-4" style="background-color: transparent;">
									
									<?php  echo"<img  alt='sample106' src='data:image/jpeg;base64,$log' >";?>
									<figcaption>
										<h3 style="color:#f9af46;"><?= $bos ?></span></h3>
									</figcaption>
									<a href="dailysalwar.php"></a>
								</figure>
								
								
							<?php
			
		    }
	     }
	    ?>	
								
								
							</div><!-- //ROW -->
						</div><!-- //CONTAINER -->
					</div>
				</div>
			</div>
		</section><!-- //SHOP -->
		<br><br>
	
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

</html>