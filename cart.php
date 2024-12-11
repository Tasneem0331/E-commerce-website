<?php
include('header.php');
$cart = $_SESSION['cart'];

?>
<?php
//check if get the product_id
if (isset($_GET['product_id'])) {

    //successfully get the product id
    //get the product id
    $product_id = $_GET['product_id'];
    $size = $_GET['size'];

    //if quatinty is set then get it or set it to 1
    if (isset($_GET['quantity'])) {
        $quantity = $_GET['quantity'];
    } else {
        //set to 1
        $quantity = 1;
    }

    $_SESSION['cart'][$product_id] = array("quantity" => $quantity ,"size"=>$size);
    //echo '<pre>';
    $cart = $_SESSION['cart'];

    //print_r($cart);
    // echo '</pre>';

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

                foreach ($cart as $key => $value) {
                    //echo $key . ":" . $value['quantity'] . "<br>";


                    //write sql to get the information of the product
                    $sql = "SELECT * from tbl_product where product_id=$key";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_assoc($res);

                    $image_name = $row['image_name'];
                    $product_title = $row['product_title'];
                    $price = $row['price'];
                ?>
                
                    <tr>
                        <td><a href="#"><i class="fa-regular fa-circle-xmark"></i></a></td>
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image is not avilable</div>";
                        } else {
                            //image iavailable
                        ?>
                            <td><img src="<?php echo SITEURL; ?>image/products/<?php echo $image_name; ?>" alt=""></td>

                        <?php
                        }
                        ?>

                        <td class="product">
                            <a href="<?php echo SITEURL;?>sproduct1.php?product_id=<?php echo $row['product_id']?>"><?php echo $product_title ?></a>
                        </td>
                        <td><?php echo $price; ?></td>
                        <td><input type="number" value="<?php echo $value['quantity']?>"></td>
                        <td><?php echo $price * $quantity; ?></td>
                    </tr>


            <?php
                }
            } else {
                //redirect to sproduct1.php page
                header('location:' . SITEURL . 'sproduct1.php');
            }
            ?>
            </tbody>

        </table>

    </section>

    <section id="card-add" class="section-p1">
        <div id="cupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter your Coupon">
                <button class="normal">Apply</button>
            </div>

        </div>

        <div id="Subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>$335</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$335</strong></td>
                </tr>
            </table>
            <button class="normal">Procced to checkout</button>

        </div>

    </section>



    <?php include('footer.php'); ?>

    <script src="script.js"></script>
    </body>

    </html>