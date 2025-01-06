<?php

include('config/constants.php');



// Check if the user is logged in
if (!isset($_SESSION['userlogin']) || empty($_SESSION['userlogin'])) {
    // User is not logged in, redirect to login page
    header('Location:'.SITEURL.'logIn.php');
} 
else {
    // User is logged in, allow access to the checkout page
    //echo $_SESSION['customerEmail'] ."<br>". $_SESSION['customerId']."<br>";
    //echo "Welcome, " . $_SESSION['userlogin'] . "! You can proceed to checkout.";
    // Include the rest of your checkout page code here
    $cart=$_SESSION['cart'];
    
    if(isset($_SESSION['cart']))
    {
        $total=0;
        foreach($cart as $key => $value)
        {
            $sql_cart="SELECT * from tbl_product where product_id=$key";
            $result_cart=mysqli_query($conn,$sql_cart);
            $row_cart=mysqli_fetch_assoc($result_cart);
            $total+=$row_cart['price']* $value['quantity'];
        }

    }
    if(isset($_POST['submit']))
    {
        $userId=$_SESSION['customerId'];
        $username=$_POST['full_name'];
        $address=$_POST['address'];
        $mobile=$_POST['phn_no'];
        $order_date=date("Y-m-d h:i:sa");

        //write sql
       
       $insertOrder= "INSERT INTO tbl_order (user_id,total_price,order_status,receiver_name,receiver_address,receiver_phn,payment_mode,order_date)
       VALUES ('$userId', '$total', 'Order Placed','$username','$address','$mobile','Cash On Delivery','$order_date')";

      

       //if order is inserted then insert the order items
       if(mysqli_query($conn,$insertOrder)){
        $orderId=mysqli_insert_id($conn);

        foreach($cart as $key => $value)
        {
            $sql_cart="SELECT * from tbl_product where product_id=$key";
            $result_cart=mysqli_query($conn,$sql_cart);
            $row_cart=mysqli_fetch_assoc($result_cart);
           $quantity=$value['quantity'];
           $Product_price=$row_cart['price'];
           $product_size=$value['size'];
           $insertOrderItem= "INSERT INTO orderitems (order_id,product_id,product_price,product_quantity,product_size)
           VALUES ('$orderId', '$key','$Product_price','$quantity','$product_size')";

           if(mysqli_query($conn,$insertOrderItem))
           {
             $_SESSION['Place Order']="<div class='success'>Order successfull.</div>";
                //redirect to home page
             header('location:'.SITEURL.'index.php');
           }
        }

       
       

       

       }

    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Registration Form</title>
        <link rel="stylesheet" href="SignInform.css">

    </head>
    <body>
    <div class="container">
        <?php
       
        ?>
        <h2>Shop Checkout</h2>
        <br>
        <form action="" method="post">
            <label for="Full Name">Full Name</label>
            <input type="text" id="full" name="full_name" required>

            <label type="address">Address</label>
            <input type="text" id="address" name="address">

            <label for="Phn no">Phone Number</label>
            <input type="tel" id="phn no" name="phn_no">
            <br><br>

           
        
    </div>
   

        <div id="Subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td><?php echo $total?>.00/-</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td>Payment method</td>
                    <td>Cash On Delivery</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong><?php echo $total?>.00/-</strong></td>
                </tr>
            </table>
            
                <input type="submit"  name="submit" value="Place Order" class="btn-normal">
                </form>
        </div>
  


    </body>


    
    <?php
}
?>
