<?php

require_once("dbcontroller.php");
$db_handle = new DBController();



$data = $_POST;

$pr= $data['purpose'];
$am= $data['amount'];
$preq= $data['payment_id'];
$pid= $data['payment_request_id'];
$st= $data['status'];

$nam= $_GET['nam'];
$las= $_GET['las'];
$ph= $_GET['phone'];
$em= $_GET['em'];
$saa= $_GET['saa'];
$sab= $_GET['sab'];
$reg= $_GET['reg'];
$cty= $_GET['cty'];
$pin= $_GET['pin'];
$cnt= $_GET['cnt'];

echo $ph;
echo $ex;
    $retval = $db_handle->runQuery("INSERT INTO pro(purpose, amount,phone,status,preq,pid,nam,las,em,saa,sab,reg,cty,pin,cnt)
	 VALUES ('$pr',' $am', '$ph','$st','$preq','$pid','$nam','$las','$em','$saa','$sab','$reg','$cty','$pin','$cnt');");

	 
	 
	 
	 
	 




 
	 
?>