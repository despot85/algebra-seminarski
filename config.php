<?php 

$mysql_host = "localhost";
$mysql_database = "kolekcija";
$mysql_user = "root";
$mysql_password = "";


$connection = new PDO("mysql:dbname=" . $mysql_database . 
";host=" . $mysql_host . ";charset=utf8",$mysql_user, $mysql_password, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
