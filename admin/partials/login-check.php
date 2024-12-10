<?php
//authorization and excess control
//checked whether the user is logged in or not that is called authorization
 if(!isset($_SESSION['user']))  //if user session is not set
 {
   //user is not logged in
   //redirect to login page with a message
   $_SESSION['no-login-msg']="<div class='error'>Please Login to access Admin Panel.</div>";
   //redirect to login page
   header('location:'.SITEURL.'admin/admin-login.php');

 }
?>