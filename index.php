<!DOCTYPE html>
<html lang=en>
<head>
<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
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
<style>@import url(https://fonts.googleapis.com/css?family=Poppins:300,700);.snip1581{font-family:'Poppins:400,700',Arial,sans-serif;position:relative;display:inline-block;overflow:hidden;margin:8px;min-width:250px;max-width:370px;width:100%;background-color:#000;color:#FFF;text-align:left;font-size:16px;box-shadow:0 0 5px rgba(0,0,0,0.15)}.snip1581 *{-webkit-transition:all .35s;transition:all .35s;-webkit-box-sizing:border-box;box-sizing:border-box}.snip1581 img{max-width:100%;vertical-align:top}.snip1581 figcaption{position:absolute;top:0;bottom:0;left:0;right:0;padding:20px;background-image:-webkit-linear-gradient(bottom,rgba(0,0,0,0.8) 0,transparent 100%);background-image:linear-gradient(to top,rgba(0,0,0,0.8) 0,transparent 100%);display:flex;flex-direction:column;justify-content:flex-end}.snip1581 h3{font-size:44px;font-weight:400;line-height:1;letter-spacing:1px;text-transform:uppercase;margin:3px 0}.snip1581 .title1{font-weight:700;color:#FFF}.snip1581 .title2{color:#f9af46;font-weight:300}.snip1581 .title3{font-weight:700;font-size:25px;color:#FFF}.snip1581 a{position:absolute;top:0;bottom:0;left:0;right:0}.snip1581:hover img,.snip1581.hover img{-webkit-transform:scale(1.3) rotate(5deg);transform:scale(1.3) rotate(0deg)}@import url(https://fonts.googleapis.com/css?family=Lato:400,700);@import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);.snip1487{font-family:'Lato',Arial,sans-serif;position:relative;float:left;overflow:hidden;margin:10px 1%;min-width:250px;max-width:365px;width:100%;color:#fff;text-align:center;font-size:16px;background-color:#000;line-height:1.5em}.snip1487 *,.snip1487 *:before,.snip1487 *:after{-webkit-box-sizing:border-box;box-sizing:border-box;-webkit-transition:all .25s linear;transition:all .25s linear}.snip1487 img{width:calc(120%);backface-visibility:hidden;vertical-align:top}.snip1487 figcaption{position:absolute;top:50%;width:100%;-webkit-transform:translateY(-25%);transform:translateY(-25%);padding:5px 40px;opacity:0}.snip1487 h3{margin:0;text-transform:uppercase;font-weight:700;color:#f9af46;font-size:35px}.snip1487 p{font-weight:400;margin:0;font-size:25px}.snip1487 i{position:absolute;color:#fff;font-size:34.375px;line-height:55px;width:55px;bottom:0;right:0;background-color:#c0392b;-webkit-transform:translateX(55px);transform:translateX(55px)}.snip1487 a{position:absolute;top:0;bottom:0;left:0;right:0}.snip1487:hover img,.snip1487.hover img{zoom:1;filter:alpha(opacity=20);-webkit-opacity:.2;opacity:.2;-webkit-transform:translateX(-40px);transform:translateX(-40px)}.snip1487:hover figcaption,.snip1487.hover figcaption{-webkit-transform:translateY(-50%);transform:translateY(-50%);opacity:1}.snip1487:hover i,.snip1487.hover i{-webkit-transform:translateX(0);transform:translateX(0)}.border{border-top:1px solid #5a3814;height:1px;margin:15px auto 0;position:relative;width:35%}.border:before{background-color:#5a3814;content:"";height:10px;left:50%;margin-left:-20px;position:absolute;top:-5px;width:40px}.title{padding-top:15px;padding-bottom:60px}.title h2{text-transform:uppercase;font-weight:700;font-size:30px;color:#5a3814}.color{color:#f9af46}.carousel-content{color:#f9af46;display:flex;align-items:center;width:100%}#text-carousel{width:100%;height:auto;font-size:14px;padding:50px}.FixedHeightContainer{float:right;height:250px;width:250px;overflow:auto}</style>
</head>
<body>
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
<div id=preloader><img src=images/preloader.gif alt /></div>
<div class=preloader_hide>
<div id=page>
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
<?php echo $item["price"]; ?></span><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>"><span></span> <i>Remove</i></a>
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
<div><a id=btnEmpty href="index.php?action=empty" href=javascript:; class=simpleCart_empty onclick=resetForm(this.form)>
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
<?php echo $item["price"]; ?></span><a href="index.php?go=remove&code=<?php echo $item["code"]; ?>"><span></span><i>Remove</i></a>
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
<a id=btnEmpty href="index.php?go=empty" href=javascript:; class=simpleCart_empty onclick=resetForm(this.form)>
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
<li class="sub-menu first active"><a href=index.php>HOME</a></li>
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
</header>
<section id=home class=padbot0>
<div class="flexslider top_slider">
<ul class=slides>
<li class=slide1>
<div class=container>
<div class=flex_caption1>
<p class="title1 captionDelay2 FromTop"></p>
<p class="title2 captionDelay3 FromTop"></p>
</div>
<a class=flex_caption2 href=daily.php><div class=middle><span>shop</span>now</div></a>
</div>
</li>
<li class=slide2>
<div class=container>
<div class=flex_caption1>
<p class="title1 captionDelay2 FromTop"></p>
<p class="title2 captionDelay3 FromTop"></p>
</div>
<a class=flex_caption2 href=party.php><div class=middle><span>shop</span>now</div></a>
</div>
</li>
<li class=slide3>
<div class=container>
<div class=flex_caption1>
<p class="title1 captionDelay2 FromTop"></p>
<p class="title2 captionDelay3 FromTop"></p>
</div>
<a class=flex_caption2 href=new_arrival.php><div class=middle><span>shop</span>now</div></a>
</div>
</li>
</ul>
</div>
</section>
<br><br>
<section class=tovar_section>
<div class=container style=padding-top:15px>
<div class=row>
<div id=features>
<div class=item>
<div class=features-item>
<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM image where ID = '1'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["Name"];
        $log=base64_encode($product_array[$key]['img']);	 
	    
        
		?>
<figure style="box-shadow:0 0 10px 5px #a3a295" class=snip1581>
<?php  echo"<img  alt='Divaah by Devika' src='data:image/jpeg;base64,$log' >";?>
<figcaption>
<h3 class=title1></h3>
<h3 class=title2><?= $bos ?></h3>
<h3 class=title3></h3>
</figcaption><a href=dailykurti.php></a>
</figure>
<?php
			
		    }
	     }
	    ?>
<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM image where ID = '2'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["Name"];
        $log=base64_encode($product_array[$key]['img']);	 
	    
        
		?>
<figure style="box-shadow:0 0 10px 5px #a3a295" class=snip1581>
<?php  echo"<img  alt='Divaah by Devika' src='data:image/jpeg;base64,$log' >";?>
<figcaption>
<h3 class=title1></h3>
<h3 class=title2><?= $bos ?></h3>
<h3 class=title3></h3>
</figcaption><a href=dailysarees.php></a>
</figure>
<?php
			
		    }
	     }
	    ?>
<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM image where ID = '3'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["Name"];
        $log=base64_encode($product_array[$key]['img']);	 
	    
        
		?>
<figure style="box-shadow:0 0 10px 5px #a3a295" class=snip1581>
<?php  echo"<img  alt='Divaah by Devika' src='data:image/jpeg;base64,$log' >";?>
<figcaption>
<h3 class=title1></h3>
<h3 class=title2><?= $bos ?></h3>
<h3 class=title3></h3>
</figcaption><a href=dailysalwar.php></a>
</figure>
<?php
			
		    }
	     }
	    ?>
</div>
</div>
</div>
</div>
</div>
</section>
<section class=tovar_section>
<div class=container style="background-color:#f2efe8;box-shadow:0 0 5px 3px #a3a295;padding-top:15px">
<div class=col-lg-12>
<div class="title text-center">
<h2>Latest <span class=color>Trends</span></h2>
<div class=border></div>
</div>
</div>
<div class=row>
<div class=tovar_wrapper data-appear-top-offset=-100 data-animated=fadeInUp>
<?php
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID BETWEEN '1' AND '8'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $img=base64_encode($product_array[$key]['imga']);
	    $imgf=base64_encode($product_array[$key]['imgb']);
	    $imgt=base64_encode($product_array[$key]['imgc']);
        $top=$product_array[$key]["ProductName"];
        $pri=$product_array[$key]["Price"];
		$qa=$product_array[$key]["qua"];
		$qb=$product_array[$key]["quab"];
        $pria=$product_array[$key]["Pricea"];		
	    $cd= $product_array[$key]["code"];
		$we=$product_array[$key]["ID"];
		$para =$product_array[$key]["para"];
		$hed =$product_array[$key]["Head"];
	    if (!empty($top)) {
		
         
	
		?>
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12 padbot40">
<div class="tovar_item tovar_sale">
<div class=tovar_img>
<a href="daily_single.php?id=<?= $we ?>">
<?php  echo"<img class='img' src='data:image/jpeg;base64,$img' >";?>
</a>
<div class=tovar_item_btns>
<?php
if($qa > $qb){
	?>
<table align=center>
<tr>
<td colspan=2>
<form action=daily_single.php method=get>
<input type=hidden name=id value=<?= $we?>>
<button type=submit class="open-project tovar_view">quick view</button>
</form>
</td>
</tr>
<tr height=5px></tr>
<tr>
<td>
<a class=add_bag href=" " onclick="document.getElementById('my_form<?= $cd?>').submit();return false"><i class="fa fa-shopping-cart"></i></a>
<?php echo"<form id='my_form$cd' method='post' action='index.php?action=add&code=$cd'>
         <input type='hidden' name='quantity' value='1' size='2' />

        </form>"; ?>
</td>
<td>
<a class=add_lovelist href onclick="document.getElementById('my_forms<?= $cd?>').submit();return false"><i class="fa fa-heart"></i></a>
<?php echo"<form id='my_forms$cd' method='post' action='index.php?go=add&code=$cd'>
         <input type='hidden' name='quantity' value='1' size='2' />

        </form>"; ?>
</td>
</tr>
</table>
</div>
</div>
<div class="tovar_description clearfix">
<a href="daily_single.php?id=<?= $we   ?>" class=tovar_title>
<?=$top ?></a>
<span class=tovar_price>&nbsp;<i class="fa fa-inr"></i>&nbsp;<?=$pri ?>.00</span>
<?php if (!empty($pria)) { ?>
<span class=tovar_price>&nbsp;<b><i class="fa fa-inr"></i>&nbsp;<strike><?=$pria ?>.00</strike></b></span>
<?php } ?>
</div>
</div>
</div>
<?php }else{ ?>

<table align=center>
<tr>
<td colspan=2>

<button type=submit class="open-project tovar_view">OUT OF STOCK</button>

</td>
</tr>
</table>
</div>
</div>
<div class="tovar_description clearfix">
<a href=" " class=tovar_title>
<?=$top ?></a>
<span class=tovar_price>&nbsp;<i class="fa fa-inr"></i>&nbsp;<?=$pri ?>.00</span>
<?php if (!empty($pria)) { ?>
<span class=tovar_price>&nbsp;<b><i class="fa fa-inr"></i>&nbsp;<strike><?=$pria ?>.00</strike></b></span>
<?php } ?>
</div>
</div>
</div>
<?php } ?>

<?php
			}
		    }
	     }
	    ?>
</div>
</div>
</div>
</section>
<br><br>
<section id=counter class=parallax-section>
<div class=container>
<div class=row>
<div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration=500ms>
<div class=counters-item>
<br>
<i class="fa fa-globe fa-3x"></i>
<h3>Worldwide <br> Shipping</h3>
</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration=500ms data-wow-delay=200ms>
<div class=counters-item>
<br>
<i class="fa fa-check-square fa-3x"></i>
<h3>Assured <br> Quality</h3>
</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration=500ms data-wow-delay=400ms>
<div class=counters-item>
<br>
<i class="fa fa-star fa-3x"></i>
<h3>Elegant <br> collection</h3>
</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInDown" data-wow-duration=500ms data-wow-delay=600ms>
<div class="counters-item kill-margin-bottom">
<br>
<i class="fa fa-truck fa-3x"></i>
<h3>Free shipping <br> in India</h3>
</div>
</div>
</div>
</div>
</section>
<section class=tovar_section>
<div class=container style=padding-top:15px>
<div class=row>
<div id=features>
<div class=item>
<div class=features-item>
<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM product where ID = '601'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["ProductName"];
        $log=base64_encode($product_array[$key]['imga']);	 
	    $par=$product_array[$key]["Head"];
        $we=$product_array[$key]["ID"];
		?>
<figure class=snip1487 style="box-shadow:0 0 10px 5px #a3a295">
<?php  echo"<img  alt='sample79' src='data:image/jpeg;base64,$log' >";?>
<figcaption>
<h3><?= $bos ?></h3><br>
<p><?= $par ?></p>
</figcaption><i class=ion-plus-round></i>
<a href="daily_single.php?id=<?= $we ?>"></a>
</figure>
<?php
			
		    }
	     }
	    ?>
<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM product where ID = '602'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["ProductName"];
        $log=base64_encode($product_array[$key]['imga']);	 
	    $par=$product_array[$key]["Head"];
        $we=$product_array[$key]["ID"];
		?>
<figure class=snip1487 style="box-shadow:0 0 10px 5px #a3a295">
<?php  echo"<img  alt='sample75' src='data:image/jpeg;base64,$log' >";?>
<figcaption>
<h3><?= $bos ?></h3><br>
<p><?= $par ?></p>
</figcaption><i class=ion-plus-round></i>
<a href="daily_single.php?id=<?= $we ?>"></a>
</figure>
<?php
			
		    }
	     }
	    ?>
<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM product where ID = '603'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["ProductName"];
        $log=base64_encode($product_array[$key]['imga']);	 
	    $par=$product_array[$key]["Head"];
        $we=$product_array[$key]["ID"];
		?>
<figure class=snip1487 style="box-shadow:0 0 10px 5px #a3a295">
<?php  echo"<img  alt='sample77' src='data:image/jpeg;base64,$log' >";?>
<figcaption>
<h3><?= $bos ?></h3><br>
<p><?= $par ?></p>
</figcaption><i class=ion-plus-round></i>
<a href="daily_single.php?id=<?= $we ?>"></a>
</figure>
<?php
			
		    }
	     }
	    ?>
</div>
</div>
</div>
</div>
</div>
</section>
<section class=tovar_section>
<div class=container style="background-color:#f2efe8;box-shadow:0 0 5px 3px #a3a295;padding-top:15px">
<div class=col-lg-12>
<div class="title text-center">
<h2>New <span class=color>Arrivals</span></h2>
<div class=border></div>
</div>
</div>
<div class=row>
<div class=tovar_wrapper data-appear-top-offset=-100 data-animated=fadeInUp>
<?php
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID BETWEEN '9' AND '16'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $img=base64_encode($product_array[$key]['imga']);
	    $imgf=base64_encode($product_array[$key]['imgb']);
	     $imgt=base64_encode($product_array[$key]['imgc']);
        $top=$product_array[$key]["ProductName"];
        $pri=$product_array[$key]["Price"];
        $qa=$product_array[$key]["qua"];
		$qb=$product_array[$key]["quab"];
		$pria=$product_array[$key]["Pricea"];
	    $cd= $product_array[$key]["code"];
		$we=$product_array[$key]["ID"];
		$para =$product_array[$key]["para"];
		$hed =$product_array[$key]["Head"];
	    if (!empty($top)) {
		?>
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12 padbot40">
<div class="tovar_item tovar_sale">
<div class=tovar_img>
<a href="daily_single.php?id=<?= $we ?>">
<?php  echo"<img class='img' src='data:image/jpeg;base64,$img' >";?>
</a>
<div class=tovar_item_btns>
<?php
if($qa > $qb){
	?>
<table align=center>
<tr>
<td colspan=2>
<form action=daily_single.php method=get>
<input type=hidden name=id value=<?= $we?>>
<button type=submit class="open-project tovar_view">quick view</button>
</form>
</td>
</tr>
<tr height=5px></tr>
<tr>
<td>
<a class=add_bag href=" " onclick="document.getElementById('my_form<?= $cd?>').submit();return false"><i class="fa fa-shopping-cart"></i></a>
<?php echo"<form id='my_form$cd' method='post' action='index.php?action=add&code=$cd'>
         <input type='hidden' name='quantity' value='1' size='2' />

        </form>"; ?>
</td>
<td>
<a class=add_lovelist href onclick="document.getElementById('my_forms<?= $cd?>').submit();return false"><i class="fa fa-heart"></i></a>
<?php echo"<form id='my_forms$cd' method='post' action='index.php?go=add&code=$cd'>
         <input type='hidden' name='quantity' value='1' size='2' />

        </form>"; ?>
</td>
</tr>
</table>
</div>
</div>
<div class="tovar_description clearfix">
<a href="daily_single.php?id=<?= $we   ?>" class=tovar_title>
<?=$top ?></a>
<span class=tovar_price>&nbsp;<i class="fa fa-inr"></i>&nbsp;<?=$pri ?>.00</span>
<?php if (!empty($pria)) { ?>
<span class=tovar_price>&nbsp;<b><i class="fa fa-inr"></i>&nbsp;<strike><?=$pria ?>.00</strike></b></span>
<?php } ?>
</div>
</div>
</div>
<?php }else{ ?>

<table align=center>
<tr>
<td colspan=2>

<button type=submit class="open-project tovar_view">OUT OF STOCK</button>

</td>
</tr>
</table>
</div>
</div>
<div class="tovar_description clearfix">
<a href=" " class=tovar_title>
<?=$top ?></a>
<span class=tovar_price>&nbsp;<i class="fa fa-inr"></i>&nbsp;<?=$pri ?>.00</span>
<?php if (!empty($pria)) { ?>
<span class=tovar_price>&nbsp;<b><i class="fa fa-inr"></i>&nbsp;<strike><?=$pria ?>.00</strike></b></span>
<?php } ?>
</div>
</div>
</div>
<?php } ?>

<?php
			}
		    }
	     }
	    ?>
</div>
</div>
</div>
</section>
<br><br>
<section id=testimonial class="parallax-section new_arrivals padbot50">
<div class=container>
<div id=text-carousel class="carousel slide" data-ride=carousel>
<div class=row>
<div class="sub-title text-center wow fadeInDown" data-wow-duration=500ms>
<h3 style=color:#FFF>What People Say About Us</h3>
</div>
<div class="col-xs-offset-2 col-xs-8">
<div class=carousel-inner>
<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM say where ID = '1'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $nam=$product_array[$key]["name"];
        $para=$product_array[$key]["Para"];	 
	    $fb=$product_array[$key]["fb"];
        $tw=$product_array[$key]["tw"];
		$gm=$product_array[$key]["gm"];
		?>
<div class="item active">
<div class=carousel-content>
<div>
<div class=client-thumb>
<img src=img/logo.png class=img-responsive alt="Divaah by Devika">
</div><br>
<p><?= $para ?></p>
<p align=right> - <?= $nam ?></p>
<table align=center width=30% class=social1>
<tr>
<td align=center><a href=<?= $fb ?>><i class="fa fa-facebook-square fa-lg"></i></a></td>
<td align=center><a href=<?= $tw ?>><i class="fa fa-twitter-square fa-lg"></i></a></td>

</tr>
</table>
</div>
</div>
</div>
<?php
			
		    }
	     }
	    ?>
<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM say where ID = '2'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $nam=$product_array[$key]["name"];
        $para=$product_array[$key]["Para"];	 
	    $fb=$product_array[$key]["fb"];
        $tw=$product_array[$key]["tw"];
		$gm=$product_array[$key]["gm"];
		?>
<div class=item>
<div class=carousel-content>
<div>
<div class=client-thumb>
<img src=img/logo.png class=img-responsive alt="Divaah by Devika">
</div><br>
<p><?= $para ?></p>
<p align=right> - <?= $nam ?></p>
<table align=center width=30% class=social1>
<tr>
<td align=center><a href=<?= $fb ?>><i class="fa fa-facebook-square fa-lg"></i></a></td>
<td align=center><a href=<?= $tw ?>><i class="fa fa-twitter-square fa-lg"></i></a></td>

</tr>
</table>
</div>
</div>
</div>
<?php
			
		    }
	     }
	    ?>
<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM say where ID = '3'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $nam=$product_array[$key]["name"];
        $para=$product_array[$key]["Para"];	 
	    $fb=$product_array[$key]["fb"];
        $tw=$product_array[$key]["tw"];
		$gm=$product_array[$key]["gm"];
		?>
<div class=item>
<div class=carousel-content>
<div>
<div class=client-thumb>
<img src=img/logo.png class=img-responsive alt="Divaah by Devika">
</div><br>
<p><?= $para ?></p>
<p align=right> - <?= $nam ?></p>
<table align=center width=30% class=social1>
<tr>
<td align=center><a href=<?= $fb ?>><i class="fa fa-facebook-square fa-lg"></i></a></td>
<td align=center><a href=<?= $tw ?>><i class="fa fa-twitter-square fa-lg"></i></a></td>

</tr>
</table>
</div>
</div>
</div>
<?php
			
		    }
	     }
	    ?>
</div>
</div>
</div>
<a class="left carousel-control" href=#text-carousel data-slide=prev>
</a>
<a class="right carousel-control" href=#text-carousel data-slide=next>
</a>
</div>
</div>
</section>
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
</div></footer></div></div>
<div id=modal-body class=clearfix>
<div id=tovar_content></div>
<div class=close_block></div>
</div>
<script src=js/jquery.min.js type=text/javascript></script>
<script src=js/bootstrap.min.js type=text/javascript></script>
<script src=js/jquery.sticky.js type=text/javascript></script>
<script src=js/parallax.js type=text/javascript></script>
<script src=js/jquery.flexslider-min.js type=text/javascript></script>
<script src=js/jquery.jcarousel.js type=text/javascript></script>
<script src=js/fancySelect.js></script>
<script src=js/animate.js type=text/javascript></script>
<script src=js/myscript.js type=text/javascript></script>
<script src=js/owl.carousel.min.js type=text/javascript></script>
<script>if(top!=self){top.location.replace(self.location.href)};</script>
</body>
</html>