<?php
$mysql_host = "45.113.122.66";
$mysql_database = "currycui_divaah"; //create the database called "comment_sys"
$mysql_user = "currycui_me";
$mysql_password = "password";
mysql_connect($mysql_host,$mysql_user,$mysql_password);
mysql_select_db($mysql_database);
 $dbLink = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());} 
?>