<!DOCTYPE html>
<html lang=en>
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
<meta charset=utf-8>
<title>Divaah by Devika</title>
<meta name=viewport content="width=device-width, initial-scale=1.0">
<meta name=description content>
<meta name=author content>
<link rel="shortcut icon" href=images/favicon.ico>
<link href=css/bootstrap.min.css rel=stylesheet type=text/css />
<link href=css/flexslider.css rel=stylesheet type=text/css />
<link href=css/fancySelect.css rel=stylesheet media="screen, projection" />
<link href=css/animate.css rel=stylesheet type=text/css media=all />
<link href=css/style.css rel=stylesheet type=text/css />
<link rel=stylesheet href=css/owl.carousel.css>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel=stylesheet type=text/css>
<link href=../../../netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css rel=stylesheet>
<style>.FixedHeightContainer{float:right;height:250px;width:250px;overflow:auto}</style>
</head>
<body>
<div id=preloader><img src=images/preloader.gif alt /></div>
<div class=preloader_hide>
<div id=page>
<header>
<div class=top_info>
<div class="container clearfix">
<ul class=secondary_menu>
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
</ul>
</div>
</div>
<div class=menu_block>
<div class="container clearfix">
<?php
		 $product_array = $db_handle->runQuery("SELECT * FROM contact where ID = '1'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $log=base64_encode($product_array[$key]['imga']);
		?>
<div class=logo>
<a href=index.php><?php  echo"<img  alt='Divaah by Devika' src='data:image/jpeg;base64,$log' >";?></a>
</div>
<?php
			
		    }
	     }
	    ?>
<div class=top_search_form>
<a class=top_search_btn href=javascript:void(0)><i class="fa fa-search"></i></a>
<form method=get action=#>
<input type=text name=search value=Search onFocus="if(this.value=='Search')this.value=''" onBlur="if(this.value=='')this.value='Search'" />
</form>
</div>
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
<div class=cart_total>
<div class=clearfix><span class=cart_subtotal>bag subtotal: <b>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?=$prd ?></b></span></div>
<div><a id=btnEmpty href="checkout3.php?action=empty" href=javascript:; class=simpleCart_empty onclick=resetForm(this.form)>
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
<div class=cart_total>
<div class=clearfix><span class=cart_subtotal>bag subtotal: <b>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?=$prd ?></b></span></div>
<div>
<a id=btnEmpty href="checkout3.php?go=empty" href=javascript:; class=simpleCart_empty onclick=resetForm(this.form)>
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
<li class=sub-menu><a href=contact.php>CONTACT US</a></li>
</ul>
</div>
</div>
</header>
<section class="breadcrumb parallax margbot30"></section>
<section class=checkout_page>
<div class=container style="background-color:#f2efe8;box-shadow:0 0 5px 3px #a3a295;padding-top:15px">
<div class=row>
<div class="col-lg-12 col-md-12 padbot40">
<h3 class=pull-left><b>Check out</b></h3>
<div class=pull-right>
<a href=shopping-bag.php>Back to shopping bag <i class="fa fa-angle-right"></i></a>
</div>
</div>
<div class=checkout_block>
<ul class=checkout_nav>
<li class=done_step2>1. Shipping Address</li>
<li class=done_step2>2. Delivery</li>
<li class=done_step>3. Confirm Order</li>
<li class=active_step>4. Payment</li>
</ul>
<div class="checkout_payment clearfix">
<form class="checkout_form clearfix" action=checkout5.php method=get>
<div class="payment_method padbot70">
<p class=checkout_title><b>payment Method</b></p>
<ul class=clearfix>
<li>
<input id=ridio1 type=radio name=radio hidden />
<label for=ridio1>Visa<br><img src=images/visa.jpg alt /></label>
</li>
<li>
<input id=ridio2 type=radio name=radio hidden />
<label for=ridio2>Master Card<br><img src=images/master_card.jpg alt /></label>
</li>
<li>
<input id=ridio3 type=radio name=radio hidden />
<label for=ridio3>PayPal<br><img src=images/paypal.jpg alt /></label>
</li>
<li>
<input id=ridio4 type=radio name=radio hidden />
<label for=ridio4>Discover<br><img src=images/discover.jpg alt /></label>
</li>
<li>
<input id=ridio5 type=radio name=radio hidden />
<label for=ridio5>Skrill<br><img src=images/skrill.jpg alt /></label>
</li>
</ul>
</div>
<div class="credit_card_number padbot70">
<p class=checkout_title><b>Credit Card Number</b></p>
<form class="credit_card_number_form clearfix" action=checkout5.php method=get>
<input type=text name="card number" value=Number onFocus="if(this.value=='Number')this.value=''" onBlur="if(this.value=='')this.value='Number'" />
<div class=margrightminus20>
<select class=basic required>
<option value>MMM</option>
<option>JAN</option>
<option>FEB</option>
<option>MAR</option>
<option>APR</option>
<option>MAY</option>
<option>JUN</option>
<option>JUL</option>
<option>AUG</option>
<option>SEP</option>
<option>OCT</option>
<option>NOV</option>
<option>DEC</option>
</select>
<select class="basic last" required>
<option value>YYYY</option>
<option>2017</option>
<option>2018</option>
<option>2019</option>
<option>2020</option>
<option>2021</option>
<option>2022</option>
<option>2023</option>
<option>2024</option>
<option>2025</option>
<option>2026</option>
<option>2027</option>
<option>2028</option>
</select>
</div>
<br>
<input type=submit value="Continue"/>
</form>
</div>
<div class=clear></div>
<div class=checkout_delivery_note><i class="fa fa-exclamation-circle"></i>Express delivery options are available for in-stock items only.</div>
<a class="btn inactive" href=checkout3.php>Go to previous step</a>
</form>
</div>
</div>
</div>
</section>
<br><br>
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
<li><a href=#>Latest Trends</a></li>
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
<div class=foot_logo>
<span>Divaah by Devika &copy; 2017</span> |
<span>All Rights Reserved.</span>
</div>
<div class=copyright_inf>
<span>Design and Developed by <a href=http://ibosoninnov.com>I-Boson Innovations</span> |
<a class=back_top href=javascript:void(0)>Back to Top <i class="fa fa-angle-up"></i></a>
</div>
</div>
</div>
</footer>
</div>
</div>
<div id=modal-body class=clearfix>
<div id=tovar_content></div>
<div class=close_block></div>
</div>
<!--[if IE]><script src=http://php5shiv.googlecode.com/svn/trunk/php5.js></script><![endif]-->
<!--[if IE]><html class=ie lang=en> <![endif]-->
<script src=js/jquery.min.js type=text/javascript></script>
<script src=js/bootstrap.min.js type=text/javascript></script>
<script src=js/jquery.sticky.js type=text/javascript></script>
<script src=js/parallax.js type=text/javascript></script>
<script src=js/jquery.flexslider-min.js type=text/javascript></script>
<script src=js/jquery.jcarousel.js type=text/javascript></script>
<script src=js/jqueryui.custom.min.js type=text/javascript></script>
<script src=js/fancySelect.js></script>
<script src=js/animate.js type=text/javascript></script>
<script src=js/myscript.js type=text/javascript></script>
</body>
</html>