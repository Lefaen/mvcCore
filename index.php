<?php
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//header ("Content-Type: text/html; charset=utf-8");

if(file_exists('classes/includeClasses.php')){
    require_once ('classes/includeClasses.php');
}

sql::firstRun();
$user = new user();

if(file_exists('header.php')){
    require_once ('header.php');
}

route::start();


if(file_exists('footer.php')){
    require_once ('footer.php');
}

?>