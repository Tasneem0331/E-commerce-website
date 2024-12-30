<?php
include('header.php');
if(!isset($_SESSION['cart']))
{
    $_SESSION['cart']=[]; /// Initialize as an empty array if not set
}

$cart=$_SESSION['cart'];

?>

<section id="page-header" class="cart-header">
    <h2>#cart</h2>
    <p>Add your coupon code & SAVE upto 70%!</p>
</section>

<section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Prodcut</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
         <?php
         if (isset($_SESSION['cart-empty'])) // checking whether the session set or not
         {
             echo "<br>";
             echo $_SESSION['cart-empty']; //displaying session messsage
             unset($_SESSION['cart-empty']); // revoming session message
         }
         ?>
            <?php
                //print_r($cart);

                //declare a varibale to track total amount
                $total=0;
                if(!empty($cart))
                {
                    foreach($cart as $key=>$value)
                    {
                        //echo $key.": ".$value['quantity']."<br>";
                        //write sql to get the information of the product
                        if (!is_numeric($key)) {
                            //echo "Invalid product_id detected in the cart.";
                            continue;
                        }
                    $sql = "SELECT * from tbl_product where product_id=$key";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_assoc($res);

                    $image_name = $row['image_name'];
                    $product_title = $row['product_title'];
                    $price = $row['price'];
                    ?>
                    <tr>
                        <td><a href="deleteCart.php?product_id=<?php echo $key;?>"><i class="fa-regular fa-circle-xmark"></i></a></td>
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image is not avilable</div>";
                        } 
                        else {
                            //image iavailable
                        ?>
                            <td><img src="<?php echo SITEURL; ?>image/products/<?php echo $image_name; ?>" alt=""></td>

                        <?php
                        }
                        ?>
                        
                        <td class="product">
                        <a href="<?php echo SITEURL;?>sproduct1.php?product_id=<?php echo $key?>"><?php echo $product_title ?></a>
                        </td>
                        <td><i class="fa-solid fa-bangladeshi-taka-sign"></i><?php echo " ".$price; ?></td>
                        
                        <td><?php echo $value['quantity'] ?></td>
                        <td> <i class="fa-solid fa-bangladeshi-taka-sign"></i><?php echo " ".$price * $value['quantity']; ?></td>
                    </tr>
                <?php
                $total+=$price * $value['quantity'];
                    }
            }
            else
            {
               $_SESSION['cart-empty']="<div class='error'>Your Cart is empty.</div>";
               //redirect to cart.php
               header('location'.SITEURL.'cart.php');
            }
            ?>
        </tbody>
    </table>

</section>

<section id="card-add" class="section-p1">
    <!--
<div id="cupon">
        <h3>Apply Coupon</h3>
        <div>
            <input type="text" placeholder="Enter your Coupon">
            <button class="normal">Apply</button>
        </div>

    </div>
            -->


    <div id="Subtotal">
        <h3>Cart Totals</h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td><i class="fa-solid fa-bangladeshi-taka-sign"></i><?php echo " ".$total?></td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>Free</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong><i class="fa-solid fa-bangladeshi-taka-sign"></i><?php echo " ".$total?></strong></td>
            </tr>
        </table>
        <form action="checkout.php" method="post">
            <button type="submit" class="normal">Proceed to Checkout</button>
        </form>
    
    </div>
    
</section>



<?php include('footer.php'); ?>

<script src="script.js"></script>
</body>

</html>