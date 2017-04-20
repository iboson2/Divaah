<?php



error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
 
ob_start();

define('DB_DRIVER', 'mysql');
define("DB_HOST", "45.113.122.66");
define("DB_USER", "currycui_me");
define("DB_PASSWORD", "password");
define("DB_DATABASE", "currycui_divaah");



$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);


try {
    $DB = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE, DB_USER, DB_PASSWORD, $dboptions);
} catch (Exception $ex) {
    echo($ex->getMessage());
    die;
}

?>