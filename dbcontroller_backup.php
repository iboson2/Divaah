<?php

$GLOBALS['a'] = '45.113.122.66';
$GLOBALS['b'] = 'currycui_me';
$GLOBALS['c'] = 'password';
$GLOBALS['d'] = 'currycui_divaah';


$rating_tableName     = 'ratings';
$rating_unitwidth     = 15;
$rating_dbname        = $GLOBALS['d'];
$units=5;
function connect(){
	$host=$GLOBALS['a'];
 $uname=$GLOBALS['b'];
 $pass=$GLOBALS['c'];
 $rating_dbname = $GLOBALS['d'];

$con = mysql_connect($host,$uname,$pass);

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($rating_dbname, $con);}




$mysql_host = $GLOBALS['a'];
$mysql_database = $GLOBALS['b']; //create the database called "comment_sys"
$mysql_user = $GLOBALS['c'];
$mysql_password = $GLOBALS['d'];

mysql_connect($mysql_host,$mysql_user,$mysql_password);
mysql_select_db($mysql_database); 



class DBController {
	
	
	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->selectDB($conn);
		}
	}
	
	function connectDB() {
		$conn = mysql_connect($GLOBALS['a'],$GLOBALS['b'],$GLOBALS['c']);
		return $conn;
	}
	
	function selectDB($conn) {
		mysql_select_db($GLOBALS['d'],$conn);
		
	}
	
	
	
	
	
	function runQuery($query) {
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysql_query($query);
		$rowcount = mysql_num_rows($result);
		return $rowcount;	
	}
}

?>