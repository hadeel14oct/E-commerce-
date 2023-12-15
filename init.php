<?php 
include 'connect.php';
$tbl = "includes/templates/";
$css="layout/css/";
$js= "layout/js/";
include "includes/functions/functions.php";
include "includes/languages/english.php";
 include $tbl . "header.php"; 
 if (!isset($nonavbar)){
 	include $tbl.  "navbar.php"; 
 }


