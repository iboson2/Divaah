<!DOCTYPE html>
<html lang=en>
<head>
<?php
ob_start();
session_start();
if (!isset($_SESSION['user'])) { header("Location:my-account.php"); }
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
<meta name="description" content="Divaah Online Boutique strives to make every purchase a positive experience. Our top priorities are excellent customer service, exceptionally quick order processing, ultra fast shipping times, and a hassle-free return policy. We value your feedback, whether positive or constructive and we are continuously working to improve your experience.">
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
</head>
<body>
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
<style>.FixedHeightContainer{float:right;height:250px;width:250px;overflow:auto}</style>

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
<div><a id=btnEmpty href="checkout.php?action=empty" href=javascript:; class=simpleCart_empty onclick=resetForm(this.form)>
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
<a id=btnEmpty href="checkout.php?go=empty" href=javascript:; class=simpleCart_empty onclick=resetForm(this.form)>
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
<li class=active_step>1. Shipping Address</li>
<li>2. Confirm Order</li>
<li class=last>3. Payment</li>
</ul>
<form class="checkout_form clearfix" action=checkout3.php method=GET>
<div class="checkout_form_input first_name">
<label>First Name <span class=color_red>*</span></label>
<input type=text name="fna" value  placeholder required/>
</div>
<div class="checkout_form_input last_name">
<label>Last name <span class=color_red>*</span></label>
<input type=text name="lna" value pattern=[a-zA-Z][a-zA-Z\s]{0,15} placeholder required/>
</div>
<div class="checkout_form_input phone">
<label>Phone <span class=color_red>*</span></label>
<input type=text name="pha" value minlength=10 maxlength=10 pattern=^\d{10}$ placeholder required/>
</div>
<div class="checkout_form_input last E-mail">
<label>e-mail <span class=color_red>*</span></label>
<input type=text name="maila" value pattern=[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$ placeholder required/>
</div>
<div class="checkout_form_input2 adress">
<label>Street Address 1 <span class=color_red>*</span></label>
<input type=text name="saa" value  placeholder required/>
</div>
<div class="checkout_form_input2 last adress">
<label>Street Address 2</label>
<input type=text name="sba" value  placeholder required />
</div>
<hr class=clear>
<div class="checkout_form_input country">
<label>Landmark <span class=color_red>*</span></label>
<input type=text name="cnta" value  placeholder required/>
</div>
<div class="checkout_form_input sity">
<label>City <span class=color_red>*</span></label>
<input type=text name="ctya" value  placeholder required />
</div>
<div class="checkout_form_input territory">
<label>Country</label>


<select name="tera" required>
	<option value="Afghanistan" title="Afghanistan">Afghanistan</option>
	<option value="Åland Islands" title="Åland Islands">Åland Islands</option>
	<option value="Albania" title="Albania">Albania</option>
	<option value="Algeria" title="Algeria">Algeria</option>
	<option value="American Samoa" title="American Samoa">American Samoa</option>
	<option value="Andorra" title="Andorra">Andorra</option>
	<option value="Angola" title="Angola">Angola</option>
	<option value="Anguilla" title="Anguilla">Anguilla</option>
	<option value="Antarctica" title="Antarctica">Antarctica</option>
	<option value="Antigua and Barbuda" title="Antigua and Barbuda">Antigua and Barbuda</option>
	<option value="Argentina" title="Argentina">Argentina</option>
	<option value="Armenia" title="Armenia">Armenia</option>
	<option value="Aruba" title="Aruba">Aruba</option>
	<option value="Australia" title="Australia">Australia</option>
	<option value="Austria" title="Austria">Austria</option>
	<option value="Azerbaijan" title="Azerbaijan">Azerbaijan</option>
	<option value="Bahamas" title="Bahamas">Bahamas</option>
	<option value="Bahrain" title="Bahrain">Bahrain</option>
	<option value="Bangladesh" title="Bangladesh">Bangladesh</option>
	<option value="Barbados" title="Barbados">Barbados</option>
	<option value="Belarus" title="Belarus">Belarus</option>
	<option value="Belgium" title="Belgium">Belgium</option>
	<option value="Belize" title="Belize">Belize</option>
	<option value="Benin" title="Benin">Benin</option>
	<option value="Bermuda" title="Bermuda">Bermuda</option>
	<option value="Bhutan" title="Bhutan">Bhutan</option>
	<option value="Bolivia, Plurinational State of" title="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
	<option value="Bonaire, Sint Eustatius and Saba" title="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
	<option value="Bosnia and Herzegovina" title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
	<option value="Botswana" title="Botswana">Botswana</option>
	<option value="Bouvet Island" title="Bouvet Island">Bouvet Island</option>
	<option value="Brazil" title="Brazil">Brazil</option>
	<option value="British Indian Ocean Territory" title="British Indian Ocean Territory">British Indian Ocean Territory</option>
	<option value="Brunei Darussalam" title="Brunei Darussalam">Brunei Darussalam</option>
	<option value="Bulgaria" title="Bulgaria">Bulgaria</option>
	<option value="Burkina Faso" title="Burkina Faso">Burkina Faso</option>
	<option value="Burundi" title="Burundi">Burundi</option>
	<option value="Cambodia" title="Cambodia">Cambodia</option>
	<option value="Cameroon" title="Cameroon">Cameroon</option>
	<option value="Canada" title="Canada">Canada</option>
	<option value="Cape Verde" title="Cape Verde">Cape Verde</option>
	<option value="Cayman Islands" title="Cayman Islands">Cayman Islands</option>
	<option value="Central African Republic" title="Central African Republic">Central African Republic</option>
	<option value="Chad" title="Chad">Chad</option>
	<option value="Chile" title="Chile">Chile</option>
	<option value="China" title="China">China</option>
	<option value="Christmas Island" title="Christmas Island">Christmas Island</option>
	<option value="Cocos (Keeling) Islands" title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
	<option value="Colombia" title="Colombia">Colombia</option>
	<option value="Comoros" title="Comoros">Comoros</option>
	<option value="Congo" title="Congo">Congo</option>
	<option value="Congo, the Democratic Republic of the" title="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
	<option value="Cook Islands" title="Cook Islands">Cook Islands</option>
	<option value="Costa Rica" title="Costa Rica">Costa Rica</option>
	<option value="Côte d'Ivoire" title="Côte d'Ivoire">Côte d'Ivoire</option>
	<option value="Croatia" title="Croatia">Croatia</option>
	<option value="Cuba" title="Cuba">Cuba</option>
	<option value="Curaçao" title="Curaçao">Curaçao</option>
	<option value="Cyprus" title="Cyprus">Cyprus</option>
	<option value="Czech Republic" title="Czech Republic">Czech Republic</option>
	<option value="Denmark" title="Denmark">Denmark</option>
	<option value="Djibouti" title="Djibouti">Djibouti</option>
	<option value="Dominica" title="Dominica">Dominica</option>
	<option value="Dominican Republic" title="Dominican Republic">Dominican Republic</option>
	<option value="Ecuador" title="Ecuador">Ecuador</option>
	<option value="Egypt" title="Egypt">Egypt</option>
	<option value="El Salvador" title="El Salvador">El Salvador</option>
	<option value="Equatorial Guinea" title="Equatorial Guinea">Equatorial Guinea</option>
	<option value="Eritrea" title="Eritrea">Eritrea</option>
	<option value="Estonia" title="Estonia">Estonia</option>
	<option value="Ethiopia" title="Ethiopia">Ethiopia</option>
	<option value="Falkland Islands (Malvinas)" title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
	<option value="Faroe Islands" title="Faroe Islands">Faroe Islands</option>
	<option value="Fiji" title="Fiji">Fiji</option>
	<option value="Finland" title="Finland">Finland</option>
	<option value="France" title="France">France</option>
	<option value="French Guiana" title="French Guiana">French Guiana</option>
	<option value="French Polynesia" title="French Polynesia">French Polynesia</option>
	<option value="French Southern Territories" title="French Southern Territories">French Southern Territories</option>
	<option value="Gabon" title="Gabon">Gabon</option>
	<option value="Gambia" title="Gambia">Gambia</option>
	<option value="Georgia" title="Georgia">Georgia</option>
	<option value="Germany" title="Germany">Germany</option>
	<option value="Ghana" title="Ghana">Ghana</option>
	<option value="Gibraltar" title="Gibraltar">Gibraltar</option>
	<option value="Greece" title="Greece">Greece</option>
	<option value="Greenland" title="Greenland">Greenland</option>
	<option value="Grenada" title="Grenada">Grenada</option>
	<option value="Guadeloupe" title="Guadeloupe">Guadeloupe</option>
	<option value="Guam" title="Guam">Guam</option>
	<option value="Guatemala" title="Guatemala">Guatemala</option>
	<option value="Guernsey" title="Guernsey">Guernsey</option>
	<option value="Guinea" title="Guinea">Guinea</option>
	<option value="Guinea-Bissau" title="Guinea-Bissau">Guinea-Bissau</option>
	<option value="Guyana" title="Guyana">Guyana</option>
	<option value="Haiti" title="Haiti">Haiti</option>
	<option value="Heard Island and McDonald Islands" title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
	<option value="Holy See (Vatican City State)" title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
	<option value="Honduras" title="Honduras">Honduras</option>
	<option value="Hong Kong" title="Hong Kong">Hong Kong</option>
	<option value="Hungary" title="Hungary">Hungary</option>
	<option value="Iceland" title="Iceland">Iceland</option>
	<option value="India" title="India">India</option>
	<option value="Indonesia" title="Indonesia">Indonesia</option>
	<option value="Iran, Islamic Republic of" title="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
	<option value="Iraq" title="Iraq">Iraq</option>
	<option value="Ireland" title="Ireland">Ireland</option>
	<option value="Isle of Man" title="Isle of Man">Isle of Man</option>
	<option value="Israel" title="Israel">Israel</option>
	<option value="Italy" title="Italy">Italy</option>
	<option value="Jamaica" title="Jamaica">Jamaica</option>
	<option value="Japan" title="Japan">Japan</option>
	<option value="Jersey" title="Jersey">Jersey</option>
	<option value="Jordan" title="Jordan">Jordan</option>
	<option value="Kazakhstan" title="Kazakhstan">Kazakhstan</option>
	<option value="Kenya" title="Kenya">Kenya</option>
	<option value="Kiribati" title="Kiribati">Kiribati</option>
	<option value="Korea, Democratic People's Republic of" title="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
	<option value="Korea, Republic of" title="Korea, Republic of">Korea, Republic of</option>
	<option value="Kuwait" title="Kuwait">Kuwait</option>
	<option value="Kyrgyzstan" title="Kyrgyzstan">Kyrgyzstan</option>
	<option value="Lao People's Democratic Republic" title="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
	<option value="Latvia" title="Latvia">Latvia</option>
	<option value="Lebanon" title="Lebanon">Lebanon</option>
	<option value="Lesotho" title="Lesotho">Lesotho</option>
	<option value="Liberia" title="Liberia">Liberia</option>
	<option value="Libya" title="Libya">Libya</option>
	<option value="Liechtenstein" title="Liechtenstein">Liechtenstein</option>
	<option value="Lithuania" title="Lithuania">Lithuania</option>
	<option value="Luxembourg" title="Luxembourg">Luxembourg</option>
	<option value="Macao" title="Macao">Macao</option>
	<option value="Macedonia, the former Yugoslav Republic of" title="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
	<option value="Madagascar" title="Madagascar">Madagascar</option>
	<option value="Malawi" title="Malawi">Malawi</option>
	<option value="Malaysia" title="Malaysia">Malaysia</option>
	<option value="Maldives" title="Maldives">Maldives</option>
	<option value="Mali" title="Mali">Mali</option>
	<option value="Malta" title="Malta">Malta</option>
	<option value="Marshall Islands" title="Marshall Islands">Marshall Islands</option>
	<option value="Martinique" title="Martinique">Martinique</option>
	<option value="Mauritania" title="Mauritania">Mauritania</option>
	<option value="Mauritius" title="Mauritius">Mauritius</option>
	<option value="Mayotte" title="Mayotte">Mayotte</option>
	<option value="Mexico" title="Mexico">Mexico</option>
	<option value="Micronesia, Federated States of" title="Micronesia, Federated States of">Micronesia, Federated States of</option>
	<option value="Moldova, Republic of" title="Moldova, Republic of">Moldova, Republic of</option>
	<option value="Monaco" title="Monaco">Monaco</option>
	<option value="Mongolia" title="Mongolia">Mongolia</option>
	<option value="Montenegro" title="Montenegro">Montenegro</option>
	<option value="Montserrat" title="Montserrat">Montserrat</option>
	<option value="Morocco" title="Morocco">Morocco</option>
	<option value="Mozambique" title="Mozambique">Mozambique</option>
	<option value="Myanmar" title="Myanmar">Myanmar</option>
	<option value="Namibia" title="Namibia">Namibia</option>
	<option value="Nauru" title="Nauru">Nauru</option>
	<option value="Nepal" title="Nepal">Nepal</option>
	<option value="Netherlands" title="Netherlands">Netherlands</option>
	<option value="New Caledonia" title="New Caledonia">New Caledonia</option>
	<option value="New Zealand" title="New Zealand">New Zealand</option>
	<option value="Nicaragua" title="Nicaragua">Nicaragua</option>
	<option value="Niger" title="Niger">Niger</option>
	<option value="Nigeria" title="Nigeria">Nigeria</option>
	<option value="Niue" title="Niue">Niue</option>
	<option value="Norfolk Island" title="Norfolk Island">Norfolk Island</option>
	<option value="Northern Mariana Islands" title="Northern Mariana Islands">Northern Mariana Islands</option>
	<option value="Norway" title="Norway">Norway</option>
	<option value="Oman" title="Oman">Oman</option>
	<option value="Pakistan" title="Pakistan">Pakistan</option>
	<option value="Palau" title="Palau">Palau</option>
	<option value="Palestinian Territory, Occupied" title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
	<option value="Panama" title="Panama">Panama</option>
	<option value="Papua New Guinea" title="Papua New Guinea">Papua New Guinea</option>
	<option value="Paraguay" title="Paraguay">Paraguay</option>
	<option value="Peru" title="Peru">Peru</option>
	<option value="Philippines" title="Philippines">Philippines</option>
	<option value="Pitcairn" title="Pitcairn">Pitcairn</option>
	<option value="Poland" title="Poland">Poland</option>
	<option value="Portugal" title="Portugal">Portugal</option>
	<option value="Puerto Rico" title="Puerto Rico">Puerto Rico</option>
	<option value="Qatar" title="Qatar">Qatar</option>
	<option value="Réunion" title="Réunion">Réunion</option>
	<option value="Romania" title="Romania">Romania</option>
	<option value="Russian Federation" title="Russian Federation">Russian Federation</option>
	<option value="Rwanda" title="Rwanda">Rwanda</option>
	<option value="Saint Barthélemy" title="Saint Barthélemy">Saint Barthélemy</option>
	<option value="Saint Helena, Ascension and Tristan da Cunha" title="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
	<option value="Saint Kitts and Nevis" title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
	<option value="Saint Lucia" title="Saint Lucia">Saint Lucia</option>
	<option value="Saint Martin (French part)" title="Saint Martin (French part)">Saint Martin (French part)</option>
	<option value="Saint Pierre and Miquelon" title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
	<option value="Saint Vincent and the Grenadines" title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
	<option value="Samoa" title="Samoa">Samoa</option>
	<option value="San Marino" title="San Marino">San Marino</option>
	<option value="Sao Tome and Principe" title="Sao Tome and Principe">Sao Tome and Principe</option>
	<option value="Saudi Arabia" title="Saudi Arabia">Saudi Arabia</option>
	<option value="Senegal" title="Senegal">Senegal</option>
	<option value="Serbia" title="Serbia">Serbia</option>
	<option value="Seychelles" title="Seychelles">Seychelles</option>
	<option value="Sierra Leone" title="Sierra Leone">Sierra Leone</option>
	<option value="Singapore" title="Singapore">Singapore</option>
	<option value="Sint Maarten (Dutch part)" title="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
	<option value="Slovakia" title="Slovakia">Slovakia</option>
	<option value="Slovenia" title="Slovenia">Slovenia</option>
	<option value="Solomon Islands" title="Solomon Islands">Solomon Islands</option>
	<option value="Somalia" title="Somalia">Somalia</option>
	<option value="South Africa" title="South Africa">South Africa</option>
	<option value="South Georgia and the South Sandwich Islands" title="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
	<option value="South Sudan" title="South Sudan">South Sudan</option>
	<option value="Spain" title="Spain">Spain</option>
	<option value="Sri Lanka" title="Sri Lanka">Sri Lanka</option>
	<option value="Sudan" title="Sudan">Sudan</option>
	<option value="Suriname" title="Suriname">Suriname</option>
	<option value="Svalbard and Jan Mayen" title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
	<option value="Swaziland" title="Swaziland">Swaziland</option>
	<option value="Sweden" title="Sweden">Sweden</option>
	<option value="Switzerland" title="Switzerland">Switzerland</option>
	<option value="Syrian Arab Republic" title="Syrian Arab Republic">Syrian Arab Republic</option>
	<option value="Taiwan, Province of China" title="Taiwan, Province of China">Taiwan, Province of China</option>
	<option value="Tajikistan" title="Tajikistan">Tajikistan</option>
	<option value="Tanzania, United Republic of" title="Tanzania, United Republic of">Tanzania, United Republic of</option>
	<option value="Thailand" title="Thailand">Thailand</option>
	<option value="Timor-Leste" title="Timor-Leste">Timor-Leste</option>
	<option value="Togo" title="Togo">Togo</option>
	<option value="Tokelau" title="Tokelau">Tokelau</option>
	<option value="Tonga" title="Tonga">Tonga</option>
	<option value="Trinidad and Tobago" title="Trinidad and Tobago">Trinidad and Tobago</option>
	<option value="Tunisia" title="Tunisia">Tunisia</option>
	<option value="Turkey" title="Turkey">Turkey</option>
	<option value="Turkmenistan" title="Turkmenistan">Turkmenistan</option>
	<option value="Turks and Caicos Islands" title="Turks and Caicos Islands">Turks and Caicos Islands</option>
	<option value="Tuvalu" title="Tuvalu">Tuvalu</option>
	<option value="Uganda" title="Uganda">Uganda</option>
	<option value="Ukraine" title="Ukraine">Ukraine</option>
	<option value="United Arab Emirates" title="United Arab Emirates">United Arab Emirates</option>
	<option value="United Kingdom" title="United Kingdom">United Kingdom</option>
	<option value="United States" title="United States">United States</option>
	<option value="United States Minor Outlying Islands" title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
	<option value="Uruguay" title="Uruguay">Uruguay</option>
	<option value="Uzbekistan" title="Uzbekistan">Uzbekistan</option>
	<option value="Vanuatu" title="Vanuatu">Vanuatu</option>
	<option value="Venezuela, Bolivarian Republic of" title="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
	<option value="Viet Nam" title="Viet Nam">Viet Nam</option>
	<option value="Virgin Islands, British" title="Virgin Islands, British">Virgin Islands, British</option>
	<option value="Virgin Islands, U.S." title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
	<option value="Wallis and Futuna" title="Wallis and Futuna">Wallis and Futuna</option>
	<option value="Western Sahara" title="Western Sahara">Western Sahara</option>
	<option value="Yemen" title="Yemen">Yemen</option>
	<option value="Zambia" title="Zambia">Zambia</option>
	<option value="Zimbabwe" title="Zimbabwe">Zimbabwe</option>
</select>












&nbsp;(<font color="red">Free shipping across India</font>)
</div>
<div class="checkout_form_input last postcode">
<label>Postcode <span class=color_red>*</span></label>
<input type=text name="pcoda" value pattern=[a-zA-Z0-9]{0,8}$ placeholder required/>
</div>


<div class=clear></div>
<div class=checkout_form_note>All fields marked with (<span class=color_red>*</span>) are required</div>
<input type=submit value="Continue" >
</form>
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
 } else if(isset($_SESSION['user'])!=""){
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
</div>
<div class=copyright style=background-color:#5a3814>
<div class="container clearfix">
<div class=foot_logo><br>
<span>Divaah by Devika &copy; 2017</span> |
<span>All Rights Reserved.</span>
</div>
<div class=copyright_inf>
<span>Design and Developed by&nbsp;<a style="color:white;" href=https://ibosoninnov.com >I-Boson Innovations</a></span>

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