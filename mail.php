<?php
$to      = "admin@divaah.com";
$nam = $_POST['name'];
$subject = $_POST['subject'];
$mess = $_POST['message'];
$ph = $_POST['phone'];
$emai = $_POST['email'];
$header = $_POST['name'] . "\r\n" .
    $_POST['email']. "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$header = "MIME-Version: 1.0" . "\r\n";
$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table style='background-color: #4CAF50;    color: white; background-repeat:no-repeat; text-align:center; width:450px; margin:0;'  border='1'>
<tr>
<td>Name:</td>
<td>$nam</td>
</tr>
<tr>
<td>Email :</td>
<td>$emai</td>
</tr>
<tr>
<td>Phone :</td>
<td>$ph</td>
</tr>
<tr>
<td>Subject :</td>
<td>$subject</td>
</tr>
<tr>
<td>Message :</td>
<td>$mess</td>
</tr>
</table>
</body>
</html>
";


	$retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
             header('Location: contact.php'); 
         }else {
            echo "Message could not be sent...";
         }
?>
