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
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["ProductName"],'id'=>$productByCode[0]["ID"],'hed'=>$productByCode[0]["Head"],'sec'=>$productByCode[0]["imga"],'ship'=>$productByCode[0]["Ship"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 
			'col'=>$_POST["color"],'siz'=>$_POST["size"],'price'=>$productByCode[0]["Price"]));
			
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
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["ProductName"],'id'=>$productByCode[0]["ID"],'hed'=>$productByCode[0]["Head"],'sec'=>$productByCode[0]["imga"],'ship'=>$productByCode[0]["Ship"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 
			'col'=>$_POST["color"],'siz'=>$_POST["size"],'price'=>$productByCode[0]["Price"]));
			
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
<link rel=stylesheet href=css/etalage.css>
<script src=ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js></script>
<script src=js/jquery.etalage.min.js></script>
<script>jQuery(document).ready(function(a){a("#etalage").etalage({thumb_image_width:450,thumb_image_height:550,source_image_width:1000,source_image_height:1200,show_hint:true,click_callback:function(b,c){alert('Callback example:\nYou clicked on an image with the anchor: "'+b+'"\n(in Etalage instance: "'+c+'")')}})});</script>
</head>
<body>
<div id=fb-root></div>
<script>(function(e,a,f){var c,b=e.getElementsByTagName(a)[0];if(e.getElementById(f)){return}c=e.createElement(a);c.id=f;c.src="//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";b.parentNode.insertBefore(c,b)}(document,"script","facebook-jssdk"));</script>
<div id=preloader><img src=images/preloader.gif alt /></div>
<div class=preloader_hide>
<div id=page>
<header>

<div class=menu_block>
<div class="container clearfix">
<?php
		 $product_array = $db_handle->runQuery("SELECT * FROM contact where ID = '1'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $log=base64_encode($product_array[$key]['imga']);
		?>
<div class=logo style="height:50px;">
<a href=index.php><?php  echo"<img  alt='Divaah by Devika' src='data:image/jpeg;base64,$log' >";?></a>
</div>
<?php
			
		    }
	     }
	    ?>

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
<li class=sub-menu><a href=contact.php>CONTACT US</a></li>
</ul>
</div>
</div>
</header>
<section class="breadcrumb parallax margbot30"></section>
<section class="tovar_details padbot70">
<div class=container style="background-color:#f2efe8;box-shadow:0 0 5px 3px #a3a295;padding-top:15px">
<div class=row>
<?php
 // set var to avoid errors
    if(isset($_GET['id'])){
$id = $_GET['id'];
$ae=($id + 1);
$af=($id + 2);
$ag=($id - 1);
$ah=($id - 2);
?>
<div class="col-lg-12 col-md-12">
<div class="tovar_details_header clearfix margbot35">
<h4 class=pull-left><b>HOME / Daily wears</b></h4>
<div class=pull-right>
<a href=daily.php>Back to shop <i class="fa fa-angle-right"></i></a>
</div>
</div>
</div>

<div class="col-lg-2 col-md-2 sidebar_tovar_details"><!--[if IE]>
<ul class="tovar_items_small clearfix">

<?php
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID = '".$ae."' and  trim(coalesce(ProductName, '')) <>'' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $img=base64_encode($product_array[$key]['imga']);
	    $imgf=base64_encode($product_array[$key]['imgb']);
	     $imgt=base64_encode($product_array[$key]['imgc']);
        $top=$product_array[$key]["ProductName"];
		$we=$product_array[$key]["ID"];
        $pri=$product_array[$key]["Price"];	 
	   	    if (!empty($top)) {
		?>
<li class=clearfix>
<a href="daily_single.php?id=<?= $we ?>" class=tovar_item_small_title>
<?php echo"<img class='tovar_item_small_img' src='data:image/jpeg;base64,$img' >"; ?></a>
<br>
<a href="daily_single.php?id=<?= $we ?>" class=tovar_item_small_title><?php echo $top; ?></a>

<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?php echo $pri; ?></span>
</li>
<?php
			}
		    }
	     }
	    ?>
<?php
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID = '".$af."' and  trim(coalesce(ProductName, '')) <>'' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $img=base64_encode($product_array[$key]['imga']);
	    $imgf=base64_encode($product_array[$key]['imgb']);
	    $imgt=base64_encode($product_array[$key]['imgc']);
        $top=$product_array[$key]["ProductName"];
        $pri=$product_array[$key]["Price"];	
        $we=$product_array[$key]["ID"];		
	   	    if (!empty($top)) {
				
		?>
<li class=clearfix>
<a href="daily_single.php?id=<?= $we ?>" class=tovar_item_small_title>
<?php echo"<img class='tovar_item_small_img' src='data:image/jpeg;base64,$img' >"; ?>
</a>
<br>
<a href="daily_single.php?id=<?= $we ?>" class=tovar_item_small_title><?php echo $top; ?></a>

<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?php echo $pri; ?></span>
</li>
<?php
			}
		    }
	     }
	    ?>
<?php
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID = '".$ag."' and  trim(coalesce(ProductName, '')) <>'' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $img=base64_encode($product_array[$key]['imga']);
	    $imgf=base64_encode($product_array[$key]['imgb']);
	     $imgt=base64_encode($product_array[$key]['imgc']);
        $top=$product_array[$key]["ProductName"];
        $pri=$product_array[$key]["Price"];	
		$we=$product_array[$key]["ID"];
        $coord_array = 1;		
	   	    if (!empty($top)) {
		?>
<li class=clearfix>
<a href="daily_single.php?id=<?= $we ?>" class=tovar_item_small_title>
<?php echo"<img class='tovar_item_small_img' src='data:image/jpeg;base64,$img' >"; ?>
</a><br>
<a href="daily_single.php?id=<?= $we ?>" class=tovar_item_small_title><?php echo $top; ?></a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?php echo $pri; ?></span>
</li>
<?php
			}
		    }
	     }
	    ?>
<?php
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID = '".$ah."' and  trim(coalesce(ProductName, '')) <>'' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $img=base64_encode($product_array[$key]['imga']);
	    $imgf=base64_encode($product_array[$key]['imgb']);
	     $imgt=base64_encode($product_array[$key]['imgc']);
		 $we=$product_array[$key]["ID"];
        $top=$product_array[$key]["ProductName"];
        $pri=$product_array[$key]["Price"];	 
	   	    if (!empty($top)) {
		?>
<li class=clearfix>
<a href="daily_single.php?id=<?= $we ?>" class=tovar_item_small_title>
<?php echo"<img class='tovar_item_small_img' src='data:image/jpeg;base64,$img' >"; ?>
<a>
<a href="daily_single.php?id=<?= $we ?>" class=tovar_item_small_title>
<?php echo $top; ?></a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?php echo $pri; ?></span>
</li>
<?php
			}
		    }
	     }
	    ?>
</ul><![endif]-->
</div>
<?php
					
		$product_array = $db_handle->runQuery("SELECT * FROM product where ID = '".$id."' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $imga=base64_encode($product_array[$key]['imga']);
	    $imgb=base64_encode($product_array[$key]['imgb']);
	     $imgc=base64_encode($product_array[$key]['imgc']);
        $topa=$product_array[$key]["ProductName"];
        $pria=$product_array[$key]["Price"];
        $priab=$product_array[$key]["Pricea"];
        $qa=$product_array[$key]["qua"];
		$qb=$product_array[$key]["quab"];		
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
		
<div class="col-lg-10 col-md-10 tovar_details_wrapper clearfix">
<div class="clearfix padbot40">
<div class="tovar_view_fotos clearfix">
<div id=examples>

<?php
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|ip(hone|od)|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}



if(isMobile()){
	echo"<ul>";
	
	echo"<li>";
	
	echo"<img class='source_image' src='data:image/jpeg;base64,$imgb' >";	 
	 echo"</li>";
	echo"</ul>";
	 
	 
}
	else{?>
	
	<ul id=etalage>
<li>
<?php if (!empty($imga)) { ?>
<?php echo"<img class='etalage_thumb_image' src='data:image/jpeg;base64,$imga' >"; ?>
<?php echo"<img class='etalage_source_image' src='data:image/jpeg;base64,$imga' >"; ?>
<?php } ?>
</li>
<li>
<?php if (!empty($imgb)) { ?>
<?php echo"<img class='etalage_thumb_image' src='data:image/jpeg;base64,$imgb' >"; ?>
<?php echo"<img class='etalage_source_image' src='data:image/jpeg;base64,$imgb' >"; ?>
<?php } ?>
</li>
<li>
<?php if (!empty($imgc)) { ?>
<?php echo"<img class='etalage_thumb_image' src='data:image/jpeg;base64,$imgc' >"; ?>
<?php echo"<img class='etalage_source_image' src='data:image/jpeg;base64,$imgc' >"; ?>
<?php } ?>
</li>
</ul>
	<?php } ?>

</div>
</div>
<div class=tovar_view_description>
<div class=tovar_view_title><?php echo $heda; ?></div><br>
<div class="clearfix tovar_brend_price">
<div class="pull-left tovar_brend"><?php echo $topa; ?></div>
<div class="pull-right tovar_view_price"><?php if (!empty($priab)){?><b><strike style="font-weight:200;"><i class="fa fa-inr"></i>&nbsp;<?=$priab ?></strike></b><?php } ?>
&nbsp;<i class="fa fa-inr"></i>&nbsp;<?php echo $pria; ?></div>
</div>
<form name="loginform" method=post  action="daily_single.php?id=<?= $wea?>&action=add&code=<?= $cd?> " onSubmit="return validateForm();">
<div class=tovar_color_select>
<?php 
								if(empty($cola || $colb || $colc || $cold || $cole || $colf || $colg || $colh)){
								
								}
								else{?>

<p>Select color</p>
<select class=basic name=color required>
<option value=" ">Color</option>
<?php if (!empty($cola)) { ?>
<option value=<?= $cola ?>><?php echo $cola; ?></option>
<?php } ?>
<?php if (!empty($colb)) { ?>
<option value=<?= $colb ?>><?php echo $colb; ?></option>
<?php } ?>
<?php if (!empty($colc)) { ?>
<option value=<?= $colc ?>><?php echo $colc; ?></option>
<?php } ?>
<?php if (!empty($cold)) { ?>
<option value=<?= $cold ?>><?php echo $cold; ?></option>
<?php } ?>
<?php if (!empty($cole)) { ?>
<option value=<?= $cole ?>><?php echo $cole; ?></option>
<?php } ?>
<?php if (!empty($colf)) { ?>
<option value=<?= $colf ?>><?php echo $colf; ?></option>
<?php } ?>
<?php if (!empty($colg)) { ?>
<option value=<?= $colg ?>><?php echo $colg; ?></option>
<?php } ?>
<?php if (!empty($colh)) { ?>
<option value=<?= $colh ?>><?php echo $colh; ?></option>
<?php } ?>
</select>
<?php } ?>
</div>
<div class=tovar_size_select>
<?php 
								if(empty($siza || $sizb || $sizc || $sizd || $size)){
								
								}
								else{?>
<div class=clearfix>
<p class=pull-left>Select SIZE</p>
<span>Size & Fit</span>
</div>
<select class=basic name=size required>
<option value=" ">Size</option>
<?php if (!empty($siza)) { ?>
<option value=<?= $siza ?>><?php echo $siza; ?></option>
<?php } ?>
<?php if (!empty($sizb)) { ?>
<option value=<?= $sizb ?>><?php echo $sizb; ?></option>
<?php } ?>
<?php if (!empty($sizc)) { ?>
<option value=<?= $sizc ?>><?php echo $sizc; ?></option>
<?php } ?>
<?php if (!empty($sizd)) { ?>
<option value=<?= $sizd ?>><?php echo $sizd; ?></option>
<?php } ?>
<?php if (!empty($size)) { ?>
<option value=<?= $size ?>><?php echo $size; ?></option>
<?php } ?>
</select>
<?php } ?>
</div>
<div class=tovar_view_btn>
<div class=clearfix>
<p class=pull-left>Quantity</p>
</div>
<input type="hidden" name="high" value="<?= $qa ?>" >
<input type="hidden" name="low" value="<?= $qb ?>" > 
<input type="text" name="quantity"  size="1" required>
 <input  type="submit" value="Add to bag">

</form>
<script>
    function validateForm() {
        var un = document.loginform.quantity.value;
        var pw = document.loginform.high.value;
        var xc = document.loginform.low.value;
		 if (un == "0") {
            alert ("Enter a number");
            return false;
        }
        if (un == "1") {
			
			return true;
		}
		else{
        if (un < pw) {
            return true;
        }
        else {
            alert ("Please select lower quantity");
            return false;
        }
		}
		if (pw < xc) {
            return true;
        }
        else {
            alert ("Product out of stock");
            return false;
        }
  }
</script>
<style>
.ser{
	width:10%;
	
}
</style>
</div>
<br><br>
<div class="tovar_shared clearfix">
<table align=left width=100% class=social2>
<tr>
<td colspan=4 ><div class=fb-share-button data-href="https://divaah.com/daily_single.php?id=<?= $wea ?>#" data-layout=button_count data-mobile-iframe=true><a target=_blank href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fdivaah.com%2Fdaily_single.php%3Fid%3D<?= $wea ?>%23&amp;src=sdkpreparse">Share with friends on:&nbsp;&nbsp;<i class="fa fa-facebook"></i></a></td>

</tr>
<tr height=5px></tr>
</a></div>
<tr>


</tr>


</table>
</div>
</div>
</div>
<div class=tovar_information>
<ul class="tabs clearfix">
<li class=current>Description</li>
<li>Features</li>
<li>Reviews</li>
</ul>
<div class="box visible">
<p><?php echo $paraa;?></p>
</div>
<div class=box>
<?php echo $fea; ?>
</div>
<div class=box>
<?php 
// Connect to the database
 include('config.php'); 
$id_post = "1"; //the post or the page id
$id_id =$id;
?>
<?php 
    $sql = mysql_query("SELECT * FROM comments WHERE id_post = '$id_post' and code = '$id_id'") or die(mysql_error());;
    while($affcom = mysql_fetch_assoc($sql)){ 
        $name = $affcom['name'];
        $email = $affcom['email'];
        $comment = $affcom['comment'];
        $date = $affcom['date'];

    ?>
<ul class=comments>
<li>
<div class=clearfix>
<p class=pull-left><strong><a href=javascript:void(0)><?php echo $name; ?></a></strong></p>
<span class=date><span data-utime=1371248446 class=com-dt><?php echo $date; ?></span>
</div>
<p><?php echo $comment; ?></p>
</li>
</ul>
<?php } ?>
<script type=text/javascript src=https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js></script>
<div class=new-com-bt>
<span>Write a comment ...</span>
</div>
<div class=clearfix>
<div class=new-com-cnt>
<input type=text id=name-com name=name-com value placeholder="Your name" />
<input type=hidden id=id-com name=id-com value=<?= $id ?> />
<input type=text id=mail-com name=mail-com value placeholder="Your e-mail adress" />
<textarea class=the-new-com></textarea>
<a href="daily_single.php?id=<?= $id ?>"><button class="big bt-add-com">Post comment</button></a>&nbsp;&nbsp;
<button class="big bt-cancel-com">Cancel</button>
</div>
</div>
</div>
</div>
</div>
<?php
			}
		    }
	     }
	    ?>
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
<?php
		$product_array = $db_handle->runQuery("SELECT * FROM product where Grp = $gp and  trim(coalesce(ProductName, '')) <>'' ");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $img=base64_encode($product_array[$key]['imga']);
	    $imgf=base64_encode($product_array[$key]['imgb']);
	     $imgt=base64_encode($product_array[$key]['imgc']);
        $top=$product_array[$key]["ProductName"];
        $pri=$product_array[$key]["Price"];	 
		$we=$product_array[$key]["ID"];
	   	    if (!empty($top)) {
		?> <li>
<div class=tovar_item_new>
<div class=tovar_img>
<?php echo"<img src='data:image/jpeg;base64,$img' >"; ?>
<a class="open-project tovar_view" href="daily_single.php?id=<?= $we ?>">quick view</a>
</div>
<div class="tovar_description clearfix">
<a class=tovar_item_small_title href="daily_single.php?id=<?= $we ?>"><?php echo $top; ?></a>
<span class=tovar_item_small_price>&nbsp;<i class="fa fa-inr"></i>&nbsp; <?php echo $pri; ?></span>
</div>
</div>
</li>
<?php
			}
		    }
	     }
	    ?>
</ul>
</div>
</div>
</div>
</section>
</div>
<?php
    }
						
?>
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
<p align=left><?= $ab ?></p><a href=about.php>...Read More</a>
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
<script type=text/javascript>$(function(){$(".new-com-bt").click(function(a){$(this).hide();$(".new-com-cnt").show();$("#name-com").focus()});$(".the-new-com").bind("input propertychange",function(){$(".bt-add-com").css({opacity:0.6});var a=$(this).val().length;if(a){$(".bt-add-com").css({opacity:1})}});$(".bt-cancel-com").click(function(){$(".the-new-com").val("");$(".new-com-cnt").fadeOut("fast",function(){$(".new-com-bt").fadeIn("fast")})});$(".bt-add-com").click(function(){var d=$(".the-new-com");var c=$("#name-com");var b=$("#mail-com");var a=$("#id-com");if(!d.val()){alert("You need to write a comment!")}else{$.ajax({type:"POST",url:"ajax/add-comment.php",data:"act=add-com&id_post="+<?php echo $id_post; ?>+"&name="+c.val()+"&id="+a.val()+"&email="+b.val()+"&comment="+d.val(),success:function(f){d.val("");b.val("");c.val("");a.val("");$(".new-com-cnt").hide("fast",function(){$(".new-com-bt").show("fast");$(".new-com-bt").before(f)})}})}})});</script>
<style>.cmt-container{width:540px;height:auto;min-height:30px;padding:10px;margin:10px auto;background-color:#fff;border:#d3d6db 1px solid;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}.cmt-cnt{width:100%;height:auto;min-height:35px;padding:5px 0;overflow:auto}.cmt-cnt img{width:35px;height:35px;float:left;margin-right:10px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;background-color:#ccc}.thecom{width:auto;height:auto;min-height:35px;background-color:#fff}.thecom h5{display:inline;float:left;font-family:tahoma;font-size:13px;color:#3b5998;margin:0 15px 0 0}.thecom .com-dt{display:inline;float:left;font-size:12px;line-height:18px;color:#ccc}.thecom p{width:auto;margin:5px 5px 5px 45px;color:#4e5665}.new-com-bt{width:100%;height:30px;border:#d3d7dc 1px solid;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;background-color:#f9f9f9;color:#adb2bb;cursor:text}.new-com-bt span{display:inline;font-size:13px;margin-left:10px;line-height:30px}.new-com-cnt{width:100%;height:auto;min-height:110px}.the-new-com{width:98%;height:auto;min-height:70px;padding:5px;margin-bottom:8px;border:#d3d7dc 1px solid;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;background-color:#f9f9f9;color:#333;resize:none}.new-com-cnt input[type="text"]{margin:0;height:20px;padding:5px;border:#d3d7dc 1px solid;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;background-color:#f9f9f9;color:#333;margin-bottom:5px}.cmt-container textarea:focus,.new-com-cnt input[type="text"]:focus{border-color:rgba(82,168,236,0.8);outline:0;outline:thin dotted \9;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.4);-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.4);box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.4)}.bt-add-com{display:inline;float:left;padding:8px 10px;margin-right:10px;background-color:#3498db;color:#fff;cursor:pointer;opacity:.6;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}.bt-cancel-com{display:inline;float:left;padding:8px 10px;border:#d9d9d9 1px solid;background-color:#fff;color:#404040;cursor:pointer;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}.new-com-cnt{width:100%;height:auto;display:none;padding-top:10px;margin-bottom:10px;border-top:#d9d9d9 1px dotted}.shadow{-webkit-box-shadow:0 0 18px rgba(50,50,50,0.31);-moz-box-shadow:0 0 10px rgba(50,50,50,0.31);box-shadow:0 0 5px rgba(50,50,50,0.31)}.wcd{width:33%;height:40px;float:left}.wcd-logo{font-size:36px;color:#fff;text-align:center;float:left;cursor:pointer;color:#fff;font-size:32px;font-family:'Varela Round',sans-serif;-webkit-transition:color .3s ease-in;-moz-transition:color .3s ease-in;x²-o-transition:color .3s ease-in;transition:color .3s ease-in}.wcd-logo:hover{color:#3facff}.wcd-tuto{font-family:'Varela Round',sans-serif;color:#fff;font-size:16px;line-height:36px}.webcodo-top{width:100%;height:40px;background-color:#232323}.clear{clear:both}.grid{background:url(../img/grid.png) 50% no-repeat}.grid:hover{background:#7eb800 url(../img/gridw.png) 50% no-repeat}.grid-active{background:#039fd3 url(../img/gridw.png) 50% no-repeat}.list{background:url(../img/list.png) 50% no-repeat}.list:hover{background:#7eb800 url(../img/listw.png) 50% no-repeat}.list-active{background:#039fd3 url(../img/listw.png) 50% no-repeat}    


















.cd-gallery {
  width: 90%;
  max-width: 1048px;
  margin: 1.5em auto;
}
.cd-gallery::after {
  clear: both;
  content: "";
  display: table;
}
.cd-gallery > li {
  overflow: hidden;
  position: relative;
  margin-bottom: 2em;
  background: #ffffff;
  border-radius: .25em;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
}
.cd-gallery > li > a {
  display: block;
}
@media only screen and (min-width: 768px) {
  .cd-gallery {
    margin: 2em auto;
  }
  .cd-gallery > li {
    width: 48%;
    float: left;
    margin-right: 4%;
    margin-bottom: 2.5em;
  }
  .cd-gallery > li:nth-of-type(2n) {
    margin-right: 0;
  }
}
@media only screen and (min-width: 1048px) {
  .cd-gallery {
    margin: 2.5em auto;
  }
  .no-touch .cd-gallery > li:hover .cd-dots li.selected a {
    /* Slider dots - change background-color of the selected dot when hover over the its parent list item */
    background: #2f2933;
    border-color: #2f2933;
  }
  .no-touch .cd-gallery > li:hover .cd-dots a {
    /* Slider dots - change dot border-color when hover over the its parent list item */
    border-color: #9688a0;
  }
  .no-touch .cd-gallery > li:hover li.move-right, .no-touch .cd-gallery > li:hover li.move-left {
    /* show preview items when hover over the its parent list item */
    opacity: 0.3;
  }
}

.cd-item-wrapper {
  position: relative;
  overflow: hidden;
  margin: 3em 0;
}
.cd-item-wrapper li {
  position: absolute;
  top: 0;
  left: 25%;
  height: 100%;
  width: 50%;
  opacity: 0;
  /* Force Hardware Acceleration */
  -webkit-transform: translateZ(0);
  -moz-transform: translateZ(0);
  -ms-transform: translateZ(0);
  -o-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  will-change: transform, opacity;
  -webkit-transform: translateX(200%) scale(0.7);
  -moz-transform: translateX(200%) scale(0.7);
  -ms-transform: translateX(200%) scale(0.7);
  -o-transform: translateX(200%) scale(0.7);
  transform: translateX(200%) scale(0.7);
  -webkit-transition: -webkit-transform 0.4s, opacity 0.4s;
  -moz-transition: -moz-transform 0.4s, opacity 0.4s;
  transition: transform 0.4s, opacity 0.4s;
}
.cd-item-wrapper li.selected {
  /* selected item */
  position: relative;
  opacity: 1;
  -webkit-transform: translateX(0) scale(1.3);
  -moz-transform: translateX(0) scale(1.3);
  -ms-transform: translateX(0) scale(1.3);
  -o-transform: translateX(0) scale(1.3);
  transform: translateX(0) scale(1.3);
}
.cd-item-wrapper li.move-left {
  /* item on left - preview visible */
  -webkit-transform: translateX(-100%) scale(0.7);
  -moz-transform: translateX(-100%) scale(0.7);
  -ms-transform: translateX(-100%) scale(0.7);
  -o-transform: translateX(-100%) scale(0.7);
  transform: translateX(-100%) scale(0.7);
  opacity: 0.3;
}
.cd-item-wrapper li.move-right {
  /* item on right - preview visible */
  -webkit-transform: translateX(100%) scale(0.7);
  -moz-transform: translateX(100%) scale(0.7);
  -ms-transform: translateX(100%) scale(0.7);
  -o-transform: translateX(100%) scale(0.7);
  transform: translateX(100%) scale(0.7);
  opacity: 0.3;
}
.cd-item-wrapper li.hide-left {
  /* items hidden on the left */
  -webkit-transform: translateX(-200%) scale(0.7);
  -moz-transform: translateX(-200%) scale(0.7);
  -ms-transform: translateX(-200%) scale(0.7);
  -o-transform: translateX(-200%) scale(0.7);
  transform: translateX(-200%) scale(0.7);
}
.cd-item-wrapper li img {
  display: block;
  width: 100%;
}
@media only screen and (min-width: 1048px) {
  .cd-item-wrapper li.move-left,
  .cd-item-wrapper li.move-right {
    /* hide preview items */
    opacity: 0;
  }
  .cd-item-wrapper li.focus-on-left {
    /* class added to the .selected and .move-right items when user hovers over the .move-left item (item preview on the left) */
    -webkit-transform: translateX(3%) scale(1.25);
    -moz-transform: translateX(3%) scale(1.25);
    -ms-transform: translateX(3%) scale(1.25);
    -o-transform: translateX(3%) scale(1.25);
    transform: translateX(3%) scale(1.25);
  }
  .cd-item-wrapper li.focus-on-left.move-right {
    -webkit-transform: translateX(103%) scale(0.7);
    -moz-transform: translateX(103%) scale(0.7);
    -ms-transform: translateX(103%) scale(0.7);
    -o-transform: translateX(103%) scale(0.7);
    transform: translateX(103%) scale(0.7);
  }
  .cd-item-wrapper li.focus-on-right {
    /* class added to the .selected and .move-left items when user hovers over the .move-right item (item preview on the right) */
    -webkit-transform: translateX(-3%) scale(1.25);
    -moz-transform: translateX(-3%) scale(1.25);
    -ms-transform: translateX(-3%) scale(1.25);
    -o-transform: translateX(-3%) scale(1.25);
    transform: translateX(-3%) scale(1.25);
  }
  .cd-item-wrapper li.focus-on-right.move-left {
    -webkit-transform: translateX(-103%) scale(0.7);
    -moz-transform: translateX(-103%) scale(0.7);
    -ms-transform: translateX(-103%) scale(0.7);
    -o-transform: translateX(-103%) scale(0.7);
    transform: translateX(-103%) scale(0.7);
  }
  .cd-item-wrapper li.hover {
    /* class added to the preview items (.move-left or .move-right) when user hovers over them */
    opacity: 1 !important;
  }
  .cd-item-wrapper li.hover.move-left {
    -webkit-transform: translateX(-97%) scale(0.75);
    -moz-transform: translateX(-97%) scale(0.75);
    -ms-transform: translateX(-97%) scale(0.75);
    -o-transform: translateX(-97%) scale(0.75);
    transform: translateX(-97%) scale(0.75);
  }
  .cd-item-wrapper li.hover.move-right {
    -webkit-transform: translateX(97%) scale(0.75);
    -moz-transform: translateX(97%) scale(0.75);
    -ms-transform: translateX(97%) scale(0.75);
    -o-transform: translateX(97%) scale(0.75);
    transform: translateX(97%) scale(0.75);
  }
}

.cd-dots {
  /* not visible in the html document - created using jQuery */
  position: absolute;
  bottom: 95px;
  left: 50%;
  right: auto;
  -webkit-transform: translateX(-50%);
  -moz-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
  padding: .2em;
}
.cd-dots::after {
  clear: both;
  content: "";
  display: table;
}
.cd-dots li {
  display: inline-block;
  float: left;
  margin: 0 5px;
  pointer-events: none;
}
.cd-dots li.selected a {
  background: #2f2933;
  border-color: #2f2933;
}
.cd-dots a {
  display: block;
  height: 6px;
  width: 6px;
  border-radius: 50%;
  border: 1px solid #9688a0;
  /* image replacement */
  overflow: hidden;
  text-indent: 100%;
  white-space: nowrap;
  -webkit-transition: border-color 0.2s, background-color 0.2s;
  -moz-transition: border-color 0.2s, background-color 0.2s;
  transition: border-color 0.2s, background-color 0.2s;
}
@media only screen and (min-width: 1048px) {
  .cd-dots li {
    pointer-events: auto;
  }
  .cd-dots li.selected a {
    background: #cccccc;
    border-color: #cccccc;
  }
  .cd-dots a {
    height: 8px;
    width: 8px;
    border-color: #cccccc;
    /* fix a bug in IE9/10 - transparent anchor not clickable */
    background-color: rgba(255, 255, 255, 0);
  }
}

.cd-item-info {
  height: 90px;
  line-height: 90px;
  padding: 0 2em;
}
.cd-item-info::after {
  clear: both;
  content: "";
  display: table;
}
.cd-item-info b, .cd-item-info .cd-price, .cd-item-info .cd-new-price {
  font-weight: bold;
  font-size: 2rem;
}
.cd-item-info b {
  float: left;
}
.cd-item-info b a {
  color: #2f2933;
}
.cd-item-info .cd-price, .cd-item-info .cd-new-price {
  /* .cd-new-price not visible in the html document - created using jQuery */
  float: right;
}
.cd-item-info .cd-price {
  color: #a5d05e;
  position: relative;
  margin-left: 10px;
  -webkit-transition: color 0.2s;
  -moz-transition: color 0.2s;
  transition: color 0.2s;
}
.cd-item-info .cd-price::after {
  /* crossing line - visible if price is on sale */
  content: '';
  position: absolute;
  top: 50%;
  bottom: auto;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  left: 0;
  height: 2px;
  width: 0%;
  background-color: #a5d05e;
  opacity: 0;
  -webkit-transition: width 0.2s 0s, opacity 0s 0.2s;
  -moz-transition: width 0.2s 0s, opacity 0s 0.2s;
  transition: width 0.2s 0s, opacity 0s 0.2s;
}
.cd-item-info .cd-price.on-sale::after {
  opacity: 1;
  width: 100%;
  -webkit-transition: width 0.2s 0s, opacity 0s 0s;
  -moz-transition: width 0.2s 0s, opacity 0s 0s;
  transition: width 0.2s 0s, opacity 0s 0s;
}
.cd-item-info .cd-new-price {
  /* new price - visible if price is on sale */
  color: #e76363;
  opacity: 0;
  -webkit-transform: translateX(5px);
  -moz-transform: translateX(5px);
  -ms-transform: translateX(5px);
  -o-transform: translateX(5px);
  transform: translateX(5px);
  -webkit-transition: -webkit-transform 0.2s, opacity 0.2s;
  -moz-transition: -moz-transform 0.2s, opacity 0.2s;
  transition: transform 0.2s, opacity 0.2s;
}
.cd-item-info .cd-new-price.is-visible {
  -webkit-transform: translateX(0);
  -moz-transform: translateX(0);
  -ms-transform: translateX(0);
  -o-transform: translateX(0);
  transform: translateX(0);
  opacity: 1;
}
@media only screen and (min-width: 768px) {
  .cd-item-info b, .cd-item-info .cd-price, .cd-item-info .cd-new-price {
    font-size: 2.4rem;
  }
}

.no-js .move-right,
.no-js .move-left {
  display: none;
}

/* -------------------------------- 

xcredits 

-------------------------------- */
.credits {
  width: 90%;
  margin: 2em auto;
  text-align: center;
}

.no-touch .credits a:hover {
  text-decoration: underline;
}














</style>
</body>
</html>