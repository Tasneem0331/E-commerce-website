<?Php
include('config/constants.php');

    if(isset($_GET['product_id']))
    {
        $product_id=$_GET['product_id'];
        unset($_SESSION['cart'][$product_id]);
        
         header('location:'.SITEURL.'cart.php');
    }


?>