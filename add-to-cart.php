<?php
 session_start();
 echo "This is add to card";
if(isset($_GET['product_id'])){

    if(isset($_GET['quantity'])){
        $quantity = $_GET['quantity'];
    }else{
        $quantity = 1;
    }
     $product_id = $_GET['product_id'];

   $_SESSION['cart'][$product_id] = array('quantity' => $quantity);
    header('location:cart.php');

   echo '<pre>';
   print_r($_SESSION['cart']);
   echo '</pre>';
 }
?>