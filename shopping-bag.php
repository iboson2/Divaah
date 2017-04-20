﻿<!DOCTYPE html>
<html lang=en>
<head>
<?php session_start(); require_once("dbcontroller.php"); $db_handle=new DBController(); if(!empty($_GET["go"])) { switch($_GET["go"]) { case "add": if(!empty($_POST["quantity"])) { $productByCode=$db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["ProductName"],'id'=>$productByCode[0]["ID"],
'hed'=>$productByCode[0]["Head"],'sec'=>$productByCode[0]["imga"],'ship'=>$productByCode[0]["Ship"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"],'col'=>$_POST["color"],'siz'=>$_POST["size"],'price'=>$productByCode[0]["Price"]));
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
'hed'=>$productByCode[0]["Head"],'sec'=>$productByCode[0]["imga"],'ship'=>$productByCode[0]["Ship"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"],'col'=>$_POST["color"],'siz'=>$_POST["size"],'price'=>$productByCode[0]["Price"]));
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
<meta name="description" content="Divaah Online Boutique strives to make every purchase a positive experience. Our top priorities are excellent customer service, exceptionally quick order processing, ultra fast shipping times, and a hassle-free return policy. We value your feedback, whether positive or constructive and we are continuously working to improve your experience.">
<meta name=author content>
<link rel="shortcut icon" href=images/favicon.ico>
<link href=css/bootstrap.min.css rel=stylesheet type=text/css />
<link href=css/flexslider.css rel=stylesheet type=text/css />
<link href=css/fancySelect.css rel=stylesheet media="screen, projection" />
<link href=css/animate.css rel=stylesheet type=text/css media=all />
<link href=css/style.css rel=stylesheet type=text/css />
<link rel=stylesheet href=css/owl.carousel.css>
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel=stylesheet type=text/css>
<link href=../../../netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css rel=stylesheet>
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
<div id=preloader><img src=images/preloader.gif alt /></div>
<div class=preloader_hide>
<div id=page>
<header>

<div class=menu_block>
<div class="container clearfix">
<?php $product_array=$db_handle->runQuery("SELECT * FROM contact where ID = '1'");
if (!empty($product_array)) {
foreach($product_array as $key=>$value){
$log=base64_encode($product_array[$key]['imga']);
?>
<div class=logo style="height:50px;">
<a href=index.php><?php echo"<img alt='Divaah by Devika' src=data:image/jpeg;base64,$log>";?></a>
</div>
<?php } } ?>

<div class=shopping_bag>
<a class=shopping_bag_btn href=javascript:void(0)><i class="fa fa-shopping-cart"></i><p>Your cart</p>
<span><font color=red size=4><?php if(!empty($_SESSION["cart_item"])){ echo count($_SESSION["cart_item"]);} else{ echo "0"; } ?></font></span>
</a>
<div class="cart FixedHeightContainer">
<div class=Content>
<?php { $item_total=0; foreach ($_SESSION["cart_item"] as $item){ $roc=base64_encode( $item["sec"]); ?>
<ul class=cart-items>
<li class=clearfix>
<?php echo"<img class=cart_item_product src=data:image/jpeg;base64,$roc>"; ?>
<a href=dailysarees.php class=cart_item_title><?php echo $item["name"]; ?></a>
<span class=cart_item_price><?php echo $item["quantity"]; ?> × &nbsp;<i class="fa fa-inr"></i>&nbsp;
<?php echo $item["price"]; ?></span>
</li>
</ul>
<?php $item_total +=($item["price"]*$item["quantity"]); if($item_total>= '500')
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
<div><a id=btnEmpty href="index.php?action=empty" href=javascript:; class=simpleCart_empty onclick=resetForm(this.form)>
Empty Cart
</a></div>
<?php } ?>
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
<?php { $item_total=0; foreach ($_SESSION["cart_itemc"] as $item){ $roc=base64_encode( $item["sec"]); ?>
<ul class=cart-items>
<li>cart</li>
<li class=clearfix>
<?php echo"<img class=cart_item_product src=data:image/jpeg;base64,$roc>"; ?>
<a href=dailysarees.php class=cart_item_title><?php echo $item["name"]; ?></a>
<span class=cart_item_price><?php echo $item["quantity"]; ?> × &nbsp;<i class="fa fa-inr"></i>&nbsp;
<?php echo $item["price"]; ?></span>
</li>
</ul>
<?php $item_total +=($item["price"]*$item["quantity"]); if($item_total>= '500')
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
<a id=btnEmpty href="index.php?go=empty" href=javascript:; class=simpleCart_empty onclick=resetForm(this.form)>
Empty Cart
</a></div>
<?php } ?> <button class="btn btn-sm" onclick="window.location.href='checkout.php'">Checkout</button>
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
<?php if (!isset($_SESSION['user'])) { echo"<li>";
echo" <a href=my-account.php>Login</a>";
echo"</li>";
echo"<li>";
echo" <a href=register.php>Register</a>";
echo"</li>";
} else if(isset($_SESSION['user'])!="") {
echo"<li>";
echo"<a href=logout.php?logout>Logout</a>";
echo"</li>";
}
?>
<li class=sub-menu><a href=contact.php>CONTACT US</a></li>
</ul>
</div>
</div>
</header>
<section class="breadcrumb parallax margbot30"></section>
<section class=shopping_bag_block>
<div class=container style="background-color:#f2efe8;box-shadow:0 0 5px 3px #a3a295;padding-top:15px">
<div class=row>
<div class="col-lg-12 col-md-12 padbot40">
<h3 class=pull-left><b>Shopping bag</b></h3>
<div class=pull-right>
<a href=dailysarees.php>Back to shop <i class="fa fa-angle-right"></i></a>
</div>
</div>
</div>
<div class=row>
<div class="col-lg-9 col-md-9 padbot40">
<?php if(isset($_SESSION["cart_item"])){ $item_total=0; ?> <table class=shop_table>
<thead>
<tr>
<td class=product-thumbnail></td>
<td class=product-name><b>Item</b></td>
<td class=product-price><b>Price</b></td>
<td class=product-quantity><b>Quantity</b></td>
<td class=product-name></td>
<td class=product-subtotal><b>Total</b></td>
<td class=product-remove></td>
</tr>
</thead>
<tbody>
<?php foreach ($_SESSION["cart_item"] as $item){ $roc=base64_encode( $item["sec"]); $cd=$item["code"]; $df=$item["quantity"]; ?>
<tr class=cart_item>
<td class=product-thumbnail>
<a href="daily_single.php?id=<?= $item["id"]; ?>"><?php echo"<img class=cart_item_product src=data:image/jpeg;base64,$roc>"; ?></a></td>
<td class=product-name>
<a href="daily_single.php?id=<?= $item["id"]; ?>"><?php echo $item["name"]; ?><ul>
<li> <?php echo $item["col"]; ?></li><li><?php echo $item["siz"]; ?></li></ul></a>
</td>
<td class=product-price>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?php echo $item["price"]; ?></td>
<td class=product-price>&nbsp;&nbsp;
<?php echo"<form method=post action='shopping-bag.php?action=add&code=$cd'>
<input type=text name=quantity size=1 placeholder='$df ' style=width:40px;height:25px />
<button type=submit style=position:absolute>ADD</button>
</form>"; ?>
</td>
<td></td>
<td></td>
<style>::-webkit-input-placeholder{color:red;transition:opacity 250ms ease-in-out}</style>
<?php $pd=($item["quantity"]*$item["price"]);?>
<td class=product-subtotal>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?php echo $pd ?></td>
<td class=product-remove><a href="shopping-bag.php?action=remove&code=<?php echo $item["code"]; ?>"><span>Delete</span> <i>X</i></a></td>
</tr>
<?php $item_total +=($item["price"]*$item["quantity"]); } ?>
</tbody>
</table>
</div>
<div id=sidebar class="col-lg-3 col-md-3 padbot50">
<div class="sidepanel widget_bag_totals">
<h3>BAG TOTALS</h3>
<table class=bag_total>
<tr class="cart-subtotal clearfix">
<th>Sub total</th>
<td>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?=$item_total ?></td>
</tr>
<tr class="shipping clearfix">
<th>SHIPPING</th>
<td>Free</td>
</tr>
<tr class="total clearfix">
<th>Total</th>
<td>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?=$item_total ?></td>
</tr>
</table>
<a class="btn active" href=checkout.php>Check out</a>
<a class="btn inactive" href=index.php>Continue shopping</a>
</div>
</div>
<?php } else{ ?>
<div class=row>
<div class="col-lg-12 col-md-12 padbot60">
<br><br>
<p align=center><font size=16px>Your Shopping-bag is Empty</font></p>
<br><br></div>
</div>
<?php } ?>
</div>
</div>
</section>
<br><br>
<footer style=background-color:#5a3814>
<div class=container data-animated=fadeInUp>
<?php $product_array=$db_handle->runQuery("SELECT * FROM contact where ID = '1'");
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
<?php echo"<img alt='Divaah by Devika' src=data:image/jpeg;base64,$log>";?>
</a>
</div>
<div class=respond_clear_768></div>
<div align=right class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
<h4>Divaah by Devika</h4>
<ul class=foot_menu>
<?php if (!isset($_SESSION['user'])) { echo"<li>";
echo" <a href=my-account.php>Login</a>";
echo"</li>";
echo"<li>";
echo" <a href=register.php>Register</a>";
echo"</li>";
} else if(isset($_SESSION['user'])!="") {
echo"<li>";
echo"<a href=logout.php?logout>Logout</a>";
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
<div class=foot_address><span>Divaah by Devika</span><?=$ad ?></div>
<div class=foot_phone>
<i class="fa fa-phone fa-lg"></i>
<span>&nbsp;&nbsp;<?=$ph ?></span>
</div>
<div class=foot_mail>
<i class="fa fa-envelope fa-lg"></i>
<span>&nbsp;&nbsp;<?=$em ?></font></span>
</div>
<br>
<div class=social>
<a href="<?= $fb ?>"><i class="fa fa-facebook"></i></a>
<a href="<?= $tw ?>"><i class="fa fa-twitter"></i></a>
<a href="<?= $ig ?>"><i class="fa fa-instagram"></i></a>
</div>
</div>
</div>
<?php } } ?>
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
</footer>
</div>
</div>
<div id=modal-body class=clearfix>
<div id=tovar_content></div>
<div class=close_block></div>
</div>
<!--[if IE]><script src=https://php5shiv.googlecode.com/svn/trunk/php5.js></script><![endif]-->
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