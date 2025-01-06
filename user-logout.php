<?php
//inclulde contants .php for get url
include('config/constants.php');
//1. destroy the session 
session_destroy(); //unset $_SESSION['user']
//2. redirect to login page
header('location:'.SITEURL.'logIn.php');
unset($_SESSION['cart']);

?>
