<!DOCTYPE html>
<html lang="en">

<head>
<?php

session_start();

  
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["ProductName"],'hed'=>$productByCode[0]["Head"],'sec'=>$productByCode[0]["imga"],'ship'=>$productByCode[0]["Ship"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["Price"]));
			
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
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">
<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM details where ID = '1'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $bos=$product_array[$key]["title"];
        $log=base64_encode($product_array[$key]['imga']);	 
	    
        
		?>
    <title>
       <?= $bos ?>
    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">



</head>

<body>



    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top"> 
        <div class="container">
            
            <div class="col-md-12" data-animate="fadeInDown">
                <ul class="menu">
                    <?php

 require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
	echo"<li>";
  echo" <a href='#' data-toggle='modal' data-target='#login-modal'>Login</a>";
  echo"</li>";
  echo"<li>";
  echo" <a  href='register.php'>Register</a>";
  echo"</li>";
 } else if(isset($_SESSION['user'])!="") {
	 echo"<li>";
  echo"<a href='logout.php?logout'>Logout</a>";
  echo"</li>";
 } 
?>
                    <li><a href="contact.php">Contact</a>
                    </li>
                    <li><a href="text.php">About us</a>
                    </li>
                </ul>
            </div>
        </div>
       <?php
 
 require_once 'dbconnect.php';
 
 // it will never let you open index(login) page if session is set
 
 
 $error = false;
 
 if( isset($_POST['btn-login']) ) { 
  
  // prevent sql injections/ clear user invalid inputs
  $user = trim($_POST['user']);
  $user = strip_tags($user);
  $user = htmlspecialchars($user);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs
  
 
  
  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }
  
  // if there's no error, continue to login
  if (!$error) {
   
   $password = hash('sha256', $pass); // password hashing using SHA256
  
   $res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userName='$user'");
   $row=mysql_fetch_array($res);
   $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
   
   if( $count == 1 && $row['userPass']==$password ) {
    $_SESSION['user'] = $row['userId'];
    header("Location: index.php");
   } else {
     echo"<h6 align='center'><font color='red'>";
    $errMSG = "Incorrect Credentials, Try again...";
	  echo $errMSG;
	  echo"</font></h6>";
   }
}
  
 }
?>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">

                        <form  method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
			
   <div class="form-group">
                                <input type="text" name="user" class="form-control" id="email-modal" placeholder="Username">
								 
                            </div>
                            <div class="form-group">
                                <input type="password" name="pass" class="form-control" id="password-modal" placeholder="password">
								 
                            </div>

                            <p class="text-center">
                                <button type="submit" class="btn btn-primary" name="btn-login"><i class="fa fa-sign-in"></i> Log in</button>
								
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a></p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    
<?php  echo"<img class='hidden-xs' alt='Obaju logo' src='data:image/jpeg;base64,$log' >";?>
                </a>
				<?php
			
		    }
	     }
	    ?>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                    <a class="btn btn-default navbar-toggle" href="basket.html">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">3 items in cart</span>
                    </a>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">
                <ul class="nav navbar-nav navbar-left">
				
                    <li ><a href="index.php">Home</a>
                    </li >
					<li></li>
					<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM cat where ID = '1'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $cat=$product_array[$key]["cat"];
        $suba=$product_array[$key]["suba"];	 
	    $subb= $product_array[$key]["subb"];
        
		?>	
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200"><?= $cat ?><b class="caret"></b></a>
                        <ul class="dropdown-menu" style="width:20%;">
                            <li>
                               <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5><a href="category-full.php"><?= $suba ?></a></h5>
											<h5><a href="category-fullb.php"><?= $subb ?></a></h5>
											
                                       </div>
                                      
                                        
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
<?php
			
		    }
	     }
	    ?>
		<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM cat where ID = '2'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $cat=$product_array[$key]["cat"];
        $suba=$product_array[$key]["suba"];	 
	    $subb= $product_array[$key]["subb"];
        
		?>	
                    <li   class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200"><?= $cat ?><b class="caret"></b></a>
                        <ul class="dropdown-menu" style="width:20%;">
                            <li>
                               <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5><a href="category-fullc.php"><?= $suba ?></a></h5>
											<h5><a href="category-fulld.php"><?= $subb ?></a></h5>
											
                                       </div>
                                      
                                        
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
<?php
			
		    }
	     }
	    ?>
		<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM cat where ID = '3'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $cat=$product_array[$key]["cat"];
        $suba=$product_array[$key]["suba"];	 
	    $subb= $product_array[$key]["subb"];
        
		?>	
                    <li class="active" class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200"><?= $cat ?><b class="caret"></b></a>
                        <ul class="dropdown-menu" style="width:20%;">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5><a href="category-fulle.php"><?= $suba ?></a></h5>
											<h5><a href="category-fullf.php"><?= $subb ?></a></h5>
											
                                       </div>
                                      
                                        
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
					<?php
			
		    }
	     }
	    ?>
		<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM cat where ID = '4'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $cat=$product_array[$key]["cat"];
        $suba=$product_array[$key]["suba"];	 
	    $subb= $product_array[$key]["subb"];
        
		?>	
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200"><?= $cat ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu" style="width:20%;">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5><a href="category-fullg.php"><?= $suba ?></a></h5>
											<h5><a href="category-fullh.php"><?= $subb ?> </a></h5>
											
                                       </div>
                                      
                                        
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
					
	<?php
			
		    }
	     }
	    ?>			
		<?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM cat where ID = '5'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $cat=$product_array[$key]["cat"];
        $suba=$product_array[$key]["suba"];	 
	    $subb= $product_array[$key]["subb"];
        
		?>	
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200"><?= $cat ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu" style="width:20%;">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5><a href="category-fulli.php"><?= $suba ?></a></h5>
											<h5><a href="category-fullj.php"><?= $subb ?> </a></h5>
											
                                       </div>
                                      
                                        
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
					
	<?php
			
		    }
	     }
	    ?>		
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">

                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i>
					<span class="hidden-sm"><span id="cart-item-count"><?php if(!empty($_SESSION["cart_item"])){ echo count($_SESSION["cart_item"]);} else{ echo "0"; } ?></span> items</span></a>
					<a id="btnEmpty" href="category-fullf.php?action=empty" href="javascript:;" class="simpleCart_empty" onclick="resetForm(this.form);">
Empty Cart
</a>
                </div>
                <!--/.nav-collapse -->

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

            <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">

			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

		    </span>
                    </div>
                </form>

            </div>
            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

  
<script src="jquery-1.9.0.min.js"></script>
        <script type="text/javascript">
        // fetching records
                            function displayRecords(numRecords, pageNum ) {
                                $.ajax({
                                    type: "GET",
                                    url: "getrecordsf.php",
                                    data: "show=" + numRecords + "&pagenum=" + pageNum ,
                                    cache: false,
                                    beforeSend: function() {
                                        $('.loader').html('<img src="loader.gif" alt="" width="24" height="24" style="padding-left: 400px; margin-top:10px;" >');
                                    },
                                    success: function(html) {
                                        $("#results").html(html);
                                        $('.loader').html('');
                                    }
                                });
                            }

        // used when user change row limit
                            function changeDisplayRowCount(numRecords) {
                                displayRecords(numRecords, 1);
                            }

                            $(document).ready(function() {
                                displayRecords(8, 1);
                            });
        </script>	  

                   
                    <div class="box info-bar">
                        <div class="row">
                            <?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM cat where ID = '3'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $cat=$product_array[$key]["cat"];
        $suba=$product_array[$key]["suba"];	 
	    $subb= $product_array[$key]["subb"];
        
		?>
<h2 align="center">		
		<b><font color="black"><?= $subb ?></font></b></h2>
		<?php
			
		    }
	     }
	    ?>
                            <div class="col-sm-12 col-md-12  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                           
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            
		
		<div align="right" class="products-sort-by breadcrumb">
                                                <strong style="color:#333;">Sort by</strong>
                                                
<select name="show" onChange="changeDisplayRowCount(this.value);" class="form-control">
  <option value="8" <?php if ($_GET["show"] == 8) { echo ' selected="selected"'; }  ?> >item - A to Z</option>
  <option value="7" <?php if ($_GET["show"] == 7) { echo ' selected="selected"'; }  ?> >item - Z to A</option>
  <option value="9" <?php if ($_GET["show"] == 9) { echo ' selected="selected"'; }  ?> >price: high to low</option>
  <option value="15" <?php if ($_GET["show"] == 15) { echo ' selected="selected"'; }  ?> >price: low to high</option>
  <option value="20" <?php if ($_GET["show"] == 20) { echo ' selected="selected"'; }  ?> >Newness</option>
  
</select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
					

                    

                       

                       
                    <div id="results"></div>

                    
                    <!-- /.products -->

                   


                </div>
                <!-- /.col-md-9 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


 <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" style="width:100%;" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4 style="color:#fff; text-align:left;">Pages</h4>

                        <ul>
                            <li><a href="index.php">Home</a>
                            </li>
                            <li><a href="text.php">About us</a>
                            </li>
                            <li><a href="basket.php">Cart</a>
                            </li>
                            <li><a href="contact.php">Contact us</a>
                            </li>
                        </ul>
                        


                       

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4 style="color:#fff; text-align:left;">User section</h4>

                        <ul>
                           <?php

 require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
	echo"<li>";
  echo" <a href='#' data-toggle='modal' data-target='#login-modal'>Login</a>";
  echo"</li>";
  echo"<li>";
  echo" <a  href='register.php'>Register</a>";
  echo"</li>";
 } else if(isset($_SESSION['user'])!="") {
	 echo"<li>";
  echo"<a href='logout.php?logout'>Logout</a>";
  echo"</li>";
 } 
?>
                        </ul>

                       

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4 style="color:#fff; text-align:left;">Where to find us</h4>

                        <?php
		 
	    $product_array = $db_handle->runQuery("SELECT * FROM details where ID = '1'");
	    if (!empty($product_array)) { 
	    foreach($product_array as $key=>$value){
	    $add=$product_array[$key]["address"];
       
	    
        
		?>	
                        <ul style="color:#fff;">
							<li><?php echo wordwrap($add,20,"<br>\n");?></li>
                            
						</ul>
						
						
						<?php
			
		    }
	     }
	    ?>
                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        <h4 style="color:#fff; text-align:left;">Get the news</h4>

                        

                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">
	
			    <button class="btn btn-default" type="button">Subscribe!</button>

			</span>

                            </div>
                            <!-- /input-group -->
                        </form>

                        <hr>

                        <h4 style="color:#fff; text-align:left;">Stay in touch</h4>

                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                        </p>


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 ________________________________
 _________________________________________________________ -->
          <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left" style="color:#fff; ">© 2017 Your name goes here.</p>

                </div>
                <div class="col-md-6">
                    <p class="pull-right" style="color:#fff;">Design and Developed by <a href="https://bootstrapious.com/e-commerce-templates">ibosoninnov.com</a>
                        
                    </p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



    </div>
    <!-- /#all -->


    

    <!-- *** SCRIPTS TO INCLUDE ***__________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>






</body>

</html>