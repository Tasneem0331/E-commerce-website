<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Order Details</h1>
    <br><br><br>
              
                <table class="tbl_full">
                    <tr>
                        <th>Serial No</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Size</th>
                    </tr>

                    <?php
                    $id=$_GET['id'];
                    //get all the orders from the database
                    $sql="SELECT * from orderitems where order_id=$id";
                    //execute query
                    $res=mysqli_query($conn,$sql);
                    //count the rows
                    $count=mysqli_num_rows($res);
                    if($count>0)
                    {
                        //order available
                        $SL_NO=1;
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get all the order details
                            $product_id=$row['product_id'];

                             

                            //get product details
                            $sql2="SELECT product_title,image_name from tbl_product where product_id=$product_id";
                            $res2=mysqli_query($conn,$sql2);
                            $row2=mysqli_fetch_assoc($res2);
                            $product_title=$row2['product_title'];
                            $image_name=$row2['image_name'];
                            $price=$row['product_price'];
                            $product_quantity=$row['product_quantity'];
                            $product_size=$row['product_size'];
                        
                            ?>
                              <tr>
                            <td><?php echo $SL_NO++;?></php></td>
                            <td>
                            <?php 
                                //check whether we have image or not
                                 if($image_name=="")
                                    {
                                      //we dont have image to display ,so display error msg
                                      echo "<div class='error'>Image Not added.</div>";
                                    }
                                else
                                    {
                                        //image is available,so display image
                                        ?>
                                        <img src="<?php echo SITEURL;?>image/products/<?php echo $image_name;?>" width="100px">

                                        <?php

                                    }
                                    ?>
                            </td>
                            <td><?php echo $product_title;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $product_quantity;?></td>
                            <td><?php echo $product_size;?></td>

                        </tr>
                            <?php

                        }
                    }
                    ?>
                   
                </table>
    </div>

</div>


<?php include('partials/footer.php'); ?>