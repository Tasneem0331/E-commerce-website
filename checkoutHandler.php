<?php
include('config/constants.php');

// Check if the user is logged in
if (!isset($_SESSION['userlogin']) || empty($_SESSION['userlogin'])) 
{
    // User is logged in, proceed to the checkout page
    //header('Location:'.SITEURL.'logIn.php');
    echo "User is not logged In ";
    exit;
} 
else
 {
    // User is not logged in, redirect to login page
    //header('Location:'.SITEURL.'checkout.php');
    echo "user is logged in";
    exit;
}
?>