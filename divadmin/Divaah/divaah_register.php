<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	
	<link rel="shortcut icon" href="assets/img/favicon.ico">
	<title>Divaah by Devika - Register</title>
	
	<!-- BEGIN CORE FRAMEWORK -->
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<!-- END CORE FRAMEWORK -->
	
	<!-- BEGIN PLUGIN STYLES -->
	<link href="assets/plugins/animate/animate.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrapValidator/bootstrapValidator.min.css" rel="stylesheet" />
	<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
	<!-- END PLUGIN STYLES -->
	
	<!-- BEGIN THEME STYLES -->
	<link href="assets/css/material.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href="assets/css/plugins.css" rel="stylesheet" />
	<link href="assets/css/helpers.css" rel="stylesheet" />
	<link href="assets/css/responsive.css" rel="stylesheet" />
	<!-- END THEME STYLES -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="auth-page height-auto bg-teal-600">
	<!-- BEGIN CONTENT -->
	<div class="wrapper animated fadeInDown">
		<div class="panel overflow-hidden">
			<div class="bg-teal-500 padding-top-25 no-padding-bottom font-size-20 color-white text-center text-uppercase">
				<i class="ion-person-add margin-right-5"></i> Create a new account
			</div>
			
			
			
			
			
			
	<?php

 if ( isset($_POST['btn-signup']) ) {
  include_once 'dbconnect.php';
  $error = false;
  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  
  $last = trim($_POST['last']);
  $last = strip_tags($last);
  $last = htmlspecialchars($last);
  
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  
  $passb = trim($_POST['passb']);
  $passb = strip_tags($passb);
  $passb = htmlspecialchars($passb);
  
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT userEmail FROM admin WHERE userEmail='$email'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
  if($pass !== $passb)
  {
	  $error = true;
	$passErrorb = "Repeat the same password";  
  }
  // password encrypt using SHA256();
  $password = hash('sha256', $pass);
  
  // if there's no error, continue to signup
  if( !$error ) {
   
   $query = "INSERT INTO admin(userName,lastName,userEmail,userPass) VALUES('$name','$last','$email','$password')";
   $res = mysql_query($query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now >";
	
    unset($name);
    unset($email);
    unset($pass);
	header("Location:login.php");
	
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
    
  }
  
  
 }
?>   		
			
			
		<font color="red"><?php
   if ( isset($errMSG) ) {
    echo "$errMSG" ;
    }
   ?></font>	
			
			
			
			<form id="checkform" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
				<div class="alert bg-teal-500 text-center color-white no-radius no-margin padding-top-15 padding-bottom-30 padding-left-20 padding-right-20">Create your own private account by one click</div>
				<div class="box-body padding-md">
					<div class="row">
						<div class="form-group col-lg-6">
							<label for="firstname" class="control-label">First Name</label>
							<input type="text" name="name" id="firstname" class="form-control input-lg" placeholder="Firstname" required="required" />
							<font color="red"><?php echo $nameError; ?></font>
						</div>
						
						<div class="form-group col-lg-6">
							<label for="lastname" class="control-label">Last Name</label>
							<input type="text" name="last" id="lastname" class="form-control input-lg" placeholder="Lastname" required="required" />
						</div>
					</div>
					
					<div class="row">
						<div class="form-group col-lg-12">
							<label for="Username" class="control-label">Email</label>
							<input type="text" name="email" id="Username" class="form-control input-lg" placeholder="Email ID" required="required" />
							<font color="red"><?php echo $emailError; ?></font>
						</div>
					</div>
									
					<div class="form-group">
						<label for="password" class="control-label">Password</label>
						<input type="password" name="pass" id="password" class="form-control input-lg" placeholder="Password" required="required"/>
						<font color="red"><?php echo $passError; ?></font>
					</div>  
					
					<div class="form-group">
						<label for="repeat-password" class="control-label">Repeat Password</label>
						<input type="password" name="passb" id="repeat-password" class="form-control input-lg" placeholder="Password" required="required"/>
						<font color="red"><?php echo $passErrorb; ?></font>
					</div>  
					
					<div class="form-group margin-top-20">
						<input type="checkbox" class="js-switch" id="checkbox" checked /><label for="checkbox" class="font-size-12 normal margin-left-10">I agree to the <a href="#">terms of use.</a></label>
					</div>                
					
					<button type="submit" name="btn-signup" class="btn btn-dark bg-green-500 padding-10 btn-block color-white"><i class="ion-plus"></i> Create profile</button>  
				</div>
			</form>
			<div class="panel-footer padding-md no-margin no-border bg-teal-500 text-center color-white">&copy; 2017 Divaah by Devika<br> Powered by <a href="http://ibosoninnov.com">I-Boson Innovations.</a></div>
		</div>
	</div>
	<!-- END CONTENT -->
		
	<!-- BEGIN JAVASCRIPTS -->
	
	<!-- BEGIN CORE PLUGINS -->
	<script src="assets/plugins/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap/js/holder.js"></script>
	<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="assets/js/core.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	
	<!-- bootstrap validator -->
	<script src="assets/plugins/bootstrapValidator/bootstrapValidator.min.js" type="text/javascript"></script>
	
	<!-- switchery -->
	<script src="assets/plugins/switchery/switchery.min.js" type="text/javascript"></script>
	
	<!-- maniac -->
	<script src="assets/js/maniac.js" type="text/javascript"></script>
	<script type="text/javascript">
		maniac.loadvalidator();
		maniac.loadswitchery();
	</script>
	
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>