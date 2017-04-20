<?php 
$preq= $_GET['payment_id'];
$pid= $_GET['payment_request_id'];
$pfh= $_GET['ib'];
?>
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
						<span><font color="red" size="4">
						<?php if(!empty($_SESSION["cart_item"])){ echo count($_SESSION["cart_item"]);} else{ echo "0"; } ?></font></span>
						
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
		
		
		<!-- LOVE LIST BLOCK -->
		<section class="love_list_block">
			
			<!-- CONTAINER -->
			<div class="container" style="background-color:#f2efe8; box-shadow: 0 0 5px 3px #a3a295; padding-top:15px;">
				<!-- ROW -->
				<div class="row">
					
					<!-- CART TABLE -->
					<div class="col-lg-12 col-md-12 padbot40">
					
						
					
						<div class="pull-right">
							<a href="dailysarees.php" >Back to shop <i class="fa fa-angle-right"></i></a>
						</div>
						
					</div>
				
				</div>
			
				<!-- ROW -->
				<div class="row">
					
					<!-- CART TABLE -->
					<div class="col-lg-12 col-md-12 padbot40">
					
<div class="row">
					<div class="col-lg-12 col-md-12 padbot60">
						<br><br>
						
						
<?php




$product_array = $db_handle->runQuery("SELECT * FROM pro where preq = '$preq' ");
// print_r($product_array);
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
		$ig=$product_array[$key]["id"];
		$pur=$product_array[$key]["purpose"];
		$amt=$product_array[$key]["amount"];
		$ph=$product_array[$key]["phone"];
		$sta=$product_array[$key]["status"];
		$pr=$product_array[$key]["preq"];
		$pi=$product_array[$key]["pid"];
		$nm=$product_array[$key]["nam"];
		$ls=$product_array[$key]["las"];
		$em=$product_array[$key]["em"];
		$saa=$product_array[$key]["saa"];
	    $sab=$product_array[$key]["sab"];
		$sad = str_replace('_',' ',$saa);
        $sar = str_replace('_',' ',$sab);		
		$cty=$product_array[$key]["cty"];
		$pin=$product_array[$key]["pin"];
		$cnt=$product_array[$key]["cnt"];
	    $reg=$product_array[$key]["reg"];
		
		
		
		 if($sta == "Credit"){
       echo"<p align='center'><font size='11px'>Thankyou for shopping with us..</font></p>"; 
	   
	   $to      = 'admin@divaah.com';
$subject = 'Divaah product purchase';


$header = "MIME-Version: 1.0" . "\r\n";
$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$header .= 'From: <admin@divaah.com>' . "\r\n";
$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>Hi,</p>
<br>
<p>Invoice No:$ig</p>
<br>
<u><b>
<p>Customer Address Details</p></b></u>
<table style='background-color:#e3e3e3;    color: black; background-repeat:no-repeat; text-align:left; width:450px; margin:0;'  >
<tr>
<td>Name:</td>
<td>$nm.$ls</td>
</tr>
<tr>
<td>Email :</td>
<td>$em</td>
</tr>
<tr>
<td>Phone :</td>
<td>$ph</td>
</tr>
<tr>
<td>Subject :</td>
<td>$pur</td>
</tr>
<tr>
<td>Address line-1 :</td>
<td>$sad</td></tr><tr>
<td>Address line-2 :</td>
<td>$sar</td></tr><tr>
<td>City :</td>
<td>$cty</td></tr><tr>
<td>pincode :</td>
<td>$pin</td></tr><tr>
<td>Country :</td>
<td>$cnt</td>
</tr>
</table>
<br><br>
<u><b>
<p>Product Details</p></b></u>
";
if(!empty($_SESSION["cart_item"])){  count($_SESSION["cart_item"]);} else{ echo "0"; }

					{
$message.="<table style='background-color:#e3e3e3;    color: black; background-repeat:no-repeat; text-align:left; width:450px; margin:0;'>
<tr><td>Product ID</td><td> Quantity </td><td>price</td></tr>";						
    $item_total = 0;						
    foreach ($_SESSION["cart_item"] as $item){
		$roc = base64_encode( $item["sec"]); 
		$qw= $item["quantity"];
		$sw= $item["name"];
		$pw= $item["price"];
		
$message.= "<tr><td>".$sw."</td><td>".$qw."</td><td>".$pw."</td></tr>"; 


	}
			
$message.="
<tr><td></td><td>Total :</td><td>".$amt."</td></tr>
</table>
</body>
</html>
";
			}
					
					// echo "0";
	$retval = mail ($to,$subject,$message,$header);
	// echo "1";
    
	
	
	
	
	
	
	
	
	
	
	
	
	 $tos      = 'admin@divaah.com,".$em."';
$subjects = 'Divaah product purchase';


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <admin@divaah.com>' . "\r\n";
$messages = "
<html >
<head>

  
  
  <link rel='stylesheet prefetch' href='http:////netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'>

     <style>
    .invoice-box{
        max-width:1000px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        font-size:16px;
        line-height:24px;
        font-family:'Roboto', sans-serif;
        color:#590504;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#590504;
        border-bottom:1px solid #ddd;
        font-weight:500;
		color: #fff;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #590504;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>

  
</head>

<body>

	<div style='text-align:center;'>
		<img src='https://divaah.com/img/divaahnew.png'>
	</div>
<div>
		<h3 style=' sans-serif;color:#590504;text-align:center; font-weight:300; font-size:22px;'>Hi $nm,<br>
		Your order has been received and is being processed.</h3>
		<p>Invoice No:$ig</p>
		</div>
<div class='container'>
				<!-- ROW -->
				<div class='row'>
					
				
				
				<div class='invoice-box'>
					
        <table cellpadding='0' cellspacing='0'>
                                
            
            <tr class='heading'>
                <td>
                    Description
                </td>
                
                <td>
                    Amount
                </td>
            </tr>
            
           
            
            
            
            

		
		
";
if(!empty($_SESSION["cart_item"])){  count($_SESSION["cart_item"]);} else{ echo "0"; }

					{
						
    $item_total = 0;						
    foreach ($_SESSION["cart_item"] as $item){
		 
		$qw= $item["quantity"];
		$sw= $item["name"];
		$pw= $item["price"];
		
$messages.= "


 <tr class='item'>
                <td>
                    $sw  
                </td>
                
                <td>
                    Rs.$pw
                </td>
            </tr>


"; 


	}
			
$messages.="


<tr class='total'>
                <td></td>
                <br>
                <td>
                   Total:Rs.$amt
                </td>
            </tr>
        </table>

    </div>
			</div><!-- //CONTAINER -->

<div>




<p style=' sans-serif;text-align:center;'>We will send you an SMS or Email with an estimated delivery time</p>
		<h4 style=' sans-serif;color:#b26b5d;text-align:center;'> NEED HELP?</h4>
		<p style=' sans-serif;text-align:center;'>
		Feel free to call our Customer care Service on
		<br>
		+91-815 794 7660 or
		<br>
		mail at info@divaah.com
		</p>
		
		<p style=' sans-serif;text-align:center;'>GET IN TOUCH WITH US</p>
  	<div style=' sans-serif;text-align:center;'>
	    <a href='http://facebook.com/divaahbydevika'>FACEBOOK</a><br>	    
	     <a href='https://twitter.com/divaahbydevika'>TWITTER</a><br> 	      
	    <a href='https://www.instagram.com/divaahbydevika/'>INSTAGRAM</a><br><br><br>
		
	  	
		</div>
	  	</div>
  
<div style='background:#b26b5d;height:10px'></div>
<div style='background:#590504;height:10px'></div>
</body>
</html>
";
			}
					
					// echo "0";
	$retval = mail ($tos,$subjects,$messages,$headers);
	
	
	
	
	if(!empty($_SESSION["cart_item"])){  count($_SESSION["cart_item"]);} else{ echo "0"; }

					{
			
    $item_total = 0;						
    foreach ($_SESSION["cart_item"] as $itemh){
		$roc = base64_encode( $item["sec"]); 
		$qwh= $itemh["quantity"];
		$swh= $itemh["name"];
		$pwh= $itemh["price"];
		$ser= $db_handle->runQuery("INSERT INTO pur(pronam,proqua,propri) VALUES ('$swh',' $qwh', '$pwh');");
		
	
		
$fer= $db_handle->runQuery("SELECT sum(proqua) as 'total' FROM pur where pronam='$swh' and propri='$pwh' ");
	
	if($fer == true){
foreach($fer as $key=>$value){	
$sl=$fer[$key]['total'];
$fera= $db_handle->runQuery("UPDATE product SET quab='$sl' WHERE ProductName='$swh';");

}

unset($_SESSION['cart_item']);

	}
		
	}
					}
	
	
	
    }
    else{
		
      echo"<p align='center'><font size='16px'>Payment failed !</font></p>"; 
    }
    
 }
 
}

else{
		
      echo"<a href='success.php?payment_id=$preq&payment_request_id=$pid&ib=cd'><button class='efr'>Continue Payment</button></a></p>"; 
    }	     
?>
	
<style>
.efr {
    background-color: black;
    border: none;
    color: white;
    padding: 16px 45px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
	<br><br></div>
				</div><!-- //ROW -->

					</div><!-- //CART TABLE -->
					
					
				</div><!-- //ROW -->
			</div><!-- //CONTAINER -->
		</section><!-- //LOVE LIST BLOCK -->
		
		<br><br>
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
</footer>
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