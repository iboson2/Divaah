<!DOCTYPE html>
<html lang=en>
<head>
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
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel=stylesheet type=text/css>
<link href=../../../netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css rel=stylesheet>
<link rel=stylesheet href=css/etalage.css>
<script src=ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js></script>
<script src=js/jquery.etalage.min.js></script>
<script>jQuery(document).ready(function(a){a("#etalage").etalage({thumb_image_width:450,thumb_image_height:550,source_image_width:1000,source_image_height:1200,show_hint:true,click_callback:function(b,c){alert('Callback example:\nYou clicked on an image with the anchor: "'+b+'"\n(in Etalage instance: "'+c+'")')}})});</script>
</head>
<body>
<div id=preloader><img src=images/preloader.gif alt /></div>
<div class=preloader_hide>
<div id=page>
<header>
<div class=top_info>
<div class="container clearfix">
<ul class=secondary_menu>
<li><a href=my-account.php>LOGIN</a></li>
<li><a href=register.php>REGISTER</a></li>
</ul>
</div>
</div>
<div class=menu_block>
<div class="container clearfix">
<?php $product_array=$db_handle->runQuery("SELECT * FROM contact where ID = '1'");
if (!empty($product_array)) {
foreach($product_array as $key=>$value){
$log=base64_encode($product_array[$key]['imga']);
?>
<div class=logo>
<a href=index.php><?php echo"<img alt='Divaah by Devika' src=data:image/jpeg;base64,$log>";?></a>
</div>
<?php } } ?>
<div class=top_search_form>
<a class=top_search_btn href=javascript:void(0)><i class="fa fa-search"></i></a>
<form method=get action=#>
<input type=text name=search value=Search onFocus="if(this.value=='Search')this.value=''" onBlur="if(this.value=='')this.value='Search'" />
</form>
</div>
<div class=shopping_bag>
<a class=shopping_bag_btn href=javascript:void(0)><i class="fa fa-shopping-cart"></i><p>Your cart</p><span>2</span></a>
<div class=cart>
<ul class=cart-items>
<li class=clearfix>
<img class=cart_item_product src=img/divaah/38.jpg alt />
<a href=dailysarees.php class=cart_item_title>Product ID: ###</a>
<span class=cart_item_price>1 × &nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</li>
<li class=clearfix>
<img class=cart_item_product src=img/divaah/48.jpg alt />
<a href=partysalwars.php class=cart_item_title>Product ID: ###</a>
<span class=cart_item_price>2 × &nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</li>
</ul>
<div class=cart_total>
<div class=clearfix><span class=cart_subtotal>bag subtotal: <b>&nbsp;<i class="fa fa-inr"></i>&nbsp; 3000.00</b></span></div>
<button class="btn btn-sm" onclick="window.location.href='checkout.php'">Checkout</button>
<br><br>
<button class="btn btn-sm" onclick="window.location.href='shopping-bag.php'">Shopping bag</button>
</div>
</div>
</div>
<div class=love_list>
<a class=love_list_btn href=javascript:void(0)><i class="fa fa-heart-o"></i><p>Love list</p><span>0</span></a>
<div class=cart>
<ul class=cart-items>
<li>Cart is empty</li>
</ul>
<div class=cart_total>
<div class=clearfix><span class=cart_subtotal>bag subtotal: <b>&nbsp;<i class="fa fa-inr"></i>&nbsp; 0</b></span></div>
<button class="btn btn-sm" onclick="window.location.href='checkout.php'">Checkout</button>
<br><br>
<button class="btn btn-sm" onclick="window.location.href='love-list.php'">Love List</button>
</div>
</div>
</div>
<ul class="navmenu center">
<li class=sub-menu><a href=index.php>HOME</a></li>
<li class=sub-menu><a href=daily.php>DAILY WEARS</a></li>
<li class="sub-menu first active"><a href=party.php>PARTY WEARS</a></li>
<li class=sub-menu><a href=new_arrival.php>NEW ARRIVALS</a></li>
<li class=sub-menu><a href=contact.php>CONTACT US</a></li>
</ul>
</div>
</div>
</header>
<section class="breadcrumb parallax margbot30"></section>
<section class="tovar_details padbot70">
<div class=container style="background-color:#f2efe8;box-shadow:0 0 5px 3px #a3a295;padding-top:15px">
<div class=row>
<div class="col-lg-12 col-md-12">
<div class="tovar_details_header clearfix margbot35">
<h4 class=pull-left><b>HOME / Party wears > product ID: ###</b></h4>
<div class=pull-right>
<a href=party.php>Back to shop <i class="fa fa-angle-right"></i></a>
</div>
</div>
</div>
<div class="col-lg-2 col-md-2 sidebar_tovar_details">
<ul class="tovar_items_small clearfix">
<li class=clearfix>
<img class=tovar_item_small_img src=img/divaah/11.jpg alt />
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</li>
<li class=clearfix>
<img class=tovar_item_small_img src=img/divaah/13.jpg alt />
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</li>
<li class=clearfix>
<img class=tovar_item_small_img src=img/divaah/15.jpg alt />
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</li>
<li class=clearfix>
<img class=tovar_item_small_img src=img/divaah/17.jpg alt />
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</li>
</ul>
</div>
<div class="col-lg-10 col-md-10 tovar_details_wrapper clearfix">
<div class="clearfix padbot40">
<div class="tovar_view_fotos clearfix">
<div id=examples>
<ul id=etalage>
<li>
<a href=optionallink.php>
<img class=etalage_thumb_image src=img/divaah/32.jpg />
<img class=etalage_source_image src="img/divaah/32.jpg"/>
</a>
</li>
<li>
<img class=etalage_thumb_image src=img/divaah/33.jpg />
<img class=etalage_source_image src=img/divaah/33.jpg />
</li>
<li>
<img class=etalage_thumb_image src=img/divaah/31.jpg />
<img class=etalage_source_image src=img/divaah/31.jpg />
</li>
</ul>
</div>
</div>
<div class=tovar_view_description>
<div class=tovar_view_title>Product name</div><br>
<div class="clearfix tovar_brend_price">
<div class="pull-left tovar_brend">Product ID: ###</div>
<div class="pull-right tovar_view_price">&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</div>
</div>
<div class=tovar_color_select>
<p>Select color</p>
<a class=color1 href=javascript:void(0)></a>
<a class="color2 active" href=javascript:void(0)></a>
<a class=color3 href=javascript:void(0)></a>
<a class=color4 href=javascript:void(0)></a>
</div>
<div class=tovar_size_select>
<div class=clearfix>
<p class=pull-left>Select SIZE</p>
<span>Size & Fit</span>
</div>
<a class="sizeS active" href=javascript:void(0)>S</a>
<a class=sizeM href=javascript:void(0)>M</a>
<a class=sizeL href=javascript:void(0)>L</a>
<a class=sizeXL href=javascript:void(0)>XL</a>
<a class=sizeXXL href=javascript:void(0)>XXL</a>
</div>
<div class=tovar_view_btn>
<select class=basic>
<option value>QTY</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
</select>
<a class=add_bag href=javascript:void(0)><i class="fa fa-shopping-cart"></i>Add to bag</a>
<a class=add_lovelist href=javascript:void(0)><i class="fa fa-heart"></i></a>
</div>
<div class="tovar_shared clearfix">
<table align=center width=100% class=social2>
<tr>
<td colspan=5 align=center><p>Share with friends: </p></td>
</tr>
<tr height=5px></tr>
<tr>
<td align=center><a href=#><i class="fa fa-facebook"></i></a></td>
<td align=center><a href=#><i class="fa fa-twitter"></i></a></td>
<td align=center><a href=#><i class="fa fa-instagram"></i></a></td>
<td align=center><a href=#><i class="fa fa-google-plus"></i></a></td>
<td align=center><a href=#><i class="fa fa-pinterest"></i></a></td>
</tr>
</table>
</div>
</div>
</div>
<div class=tovar_information>
<ul class="tabs clearfix">
<li class=current>Description</li>
<li>Features</li>
<li>Reviews (2)</li>
</ul>
<div class="box visible">
<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<p>Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst. </p>
</div>
<div class=box>
Original Levi 501 <br>
Button fly<br>
Regular fit<br>
waist 28"-32 =16"hem<br>
waist 33" = 17" hem<br>
waist 34"-40"=18" hem<br>
Levi's have started to introduce the red tab with just the (R) (registered trade mark) on the red tab<br><br>
Size Details:<br>
All sizes from 28-40 waist<br>
Leg length 30", 32", 34", 36"
</div>
<div class=box>
<ul class=comments>
<li>
<div class=clearfix>
<p class=pull-left><strong><a href=javascript:void(0)>John Doe</a></strong></p>
<span class=date>2013-10-09 09:23</span>
<div class="pull-right rating-box clearfix">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
</div>
</div>
<p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque.</p>
</li>
<li>
<div class=clearfix>
<p class=pull-left><strong><a href=javascript:void(0)>John Doe</a></strong></p>
<span class=date>2013-10-09 09:23</span>
<div class="pull-right rating-box clearfix">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
</div>
</div>
<p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque.</p>
</li>
</ul>
<h3>WRITE A REVIEW</h3>
<p>Now please write a (short) review....(min. 200, max. 2000 characters)</p>
<div class=clearfix>
<form action=#>
<input type=text placeholder=Name required/>
<textarea id=review-textarea></textarea>
<label class="pull-left rating-box-label">Your Rate:</label>
<div class="pull-left rating-box clearfix">
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
</div>
<input type=submit class="dark-blue big" value="Submit a review">
</form>
</div>
</div>
</div>
</div>
</div>
<div class=row>
<section class="new_arrivals padbot50">
<div class=container style=padding-top:15px>
<h2>you may also like</h2>
<div class=jcarousel-wrapper>
<div class=jCarousel_pagination>
<a href=javascript:void(0) class=jcarousel-control-prev><i class="fa fa-angle-left"></i></a>
<a href=javascript:void(0) class=jcarousel-control-next><i class="fa fa-angle-right"></i></a>
</div>
<div id=jcarousel_id class=jcarousel>
<ul>
<li>
<div class=tovar_item_new>
<div class=tovar_img>
<img src=img/divaah/1.jpg alt />
<a class="open-project tovar_view" href=party_single.php>quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</div>
</div>
</li>
<li>
<div class=tovar_item_new>
<div class=tovar_img>
<img src=img/divaah/3.jpg alt />
<a class="open-project tovar_view" href=party_single.php>quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</div>
</div>
</li>
<li>
<div class=tovar_item_new>
<div class=tovar_img>
<img src=img/divaah/5.jpg alt />
<a class="open-project tovar_view" href=party_single.php>quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</div>
</div>
</li>
<li>
<div class=tovar_item_new>
<div class=tovar_img>
<img src=img/divaah/7.jpg alt />
<a class="open-project tovar_view" href=party_single.php>quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</div>
</div>
</li>
<li>
<div class=tovar_item_new>
<div class=tovar_img>
<img src=img/divaah/9.jpg alt />
<a class="open-project tovar_view" href=party_single.php>quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</div>
</div>
</li>
<li>
<div class=tovar_item_new>
<div class=tovar_img>
<img src=img/divaah/60.jpg alt />
<a class="open-project tovar_view" href=party_single.php>quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</div>
</div>
</li>
<li>
<div class=tovar_item_new>
<div class=tovar_img>
<img src=img/divaah/62.jpg alt />
<a class="open-project tovar_view" href=party_single.php>quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</div>
</div>
</li>
<li>
<div class=tovar_item_new>
<div class=tovar_img>
<img src=img/divaah/64.jpg alt />
<a class="open-project tovar_view" href=party_single.php>quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</div>
</div>
</li>
<li>
<div class=tovar_item_new>
<div class=tovar_img>
<img src=img/divaah/66.jpg alt />
<a class="open-project tovar_view" href=party_single.php>quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</div>
</div>
</li>
<li>
<div class=tovar_item_new>
<div class=tovar_img>
<img src=img/divaah/68.jpg alt />
<a class="open-project tovar_view" href=party_single.php>quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href=party_single.php>Product ID: ###</a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; 1500.00</span>
</div>
</div>
</li>
</ul>
</div>
</div>
</div>
</section>
</div>
</div>
</section>
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
<li><a href=#>Latest Trends</a></li>
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
<li><a href=my-account.php>Login</a></li>
<li><a href=register.php>Register</a></li>
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
<!--[if IE]><script src=https://php5shiv.googlecode.com/svn/trunk/html5.js></script><![endif]-->
<!--[if IE]><html class=ie lang=en> <![endif]-->
<script src=js/jquery.min.js type=text/javascript></script>
<script src=js/bootstrap.min.js type=text/javascript></script>
<script src=js/jquery.sticky.js type=text/javascript></script>
<script src=js/parallax.js type=text/javascript></script>
<script src=js/jquery.flexslider-min.js type=text/javascript></script>
<script src=js/jquery.jcarousel.js type=text/javascript></script>
<script src=js/fancySelect.js></script>
<script src=js/animate.js type=text/javascript></script>
<script src=js/myscript.js type=text/javascript></script>
</body>
</html>