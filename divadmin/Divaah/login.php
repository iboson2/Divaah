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
	
	<title>Divaah by Devika- Login</title>
	
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
<body class="auth-page height-auto bg-blue-600">
	<!-- BEGIN CONTENT -->
	<div class="wrapper animated fadeInDown">
		<div class="panel overflow-hidden">
			<div class="bg-light-blue-500 padding-top-25 no-margin-bottom font-size-20 color-white text-center text-uppercase">
				<i class="ion-log-in margin-right-5"></i> Sign In to Divaah by Devika
			</div>
			
			
			
			
		<?php
 
 // it will never let you open index(login) page if session is set
 
 require_once 'dbconnect.php';
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
  
   $res=mysql_query("SELECT userId, userName, userPass FROM admin WHERE userName='$user' or userEmail='$user'");
   $row=mysql_fetch_array($res);
   $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
   
   if( $count == 1 && $row['userPass']==$password ) {
    $_SESSION['user'] = $row['userId'];
    header("Location:index.php");
   } else {
     echo"<h6 align='center'><font color='red'>";
    $errMSG = "Incorrect Credentials, Try again...";
	  echo $errMSG;
	   
	  echo"</font></h6>";

   }
}
  
 }

?>			
			
			
			
			
			<form id="checkform" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
				<div class="alert bg-light-blue-500 text-center color-white no-radius no-margin padding-top-15 padding-bottom-30 padding-left-20 padding-right-20">Please sign in to Divaah by Devika's dashboard</div>
				<div class="box-body padding-md">
				
					<div class="form-group">
						<input type="text" name="user" class="form-control input-lg" placeholder="Username"/>
					</div>
					
					<div class="form-group">
						<input type="password" name="pass" class="form-control input-lg" placeholder="Password"/>
					</div>        
					
					<div class="form-group margin-top-20">
						<input type="checkbox" class="js-switch" id="checkbox" checked /><label for="checkbox" class="font-size-12 normal margin-left-10">Remember Me</label>
					</div>       
					
					<button type="submit" name="btn-login" class="btn btn-dark bg-light-green-500 padding-10 btn-block color-white"><i class="ion-log-in"></i> Sign in</button>  
				</div>
			</form>
			
			
			
			
			
			
			
			
			
			<div class="panel-footer padding-md no-margin no-border bg-light-blue-500 text-center color-white">&copy; 2017 Divaah by Devika <br>Powered by <a href="http://ibosoninnov.com">I-Boson Innovations.</a></div>
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