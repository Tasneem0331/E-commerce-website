<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Manage Product</h1>
    <br><br><br>
                <!----------Button to add admin----------------->
                <a href="<?php echo SITEURL;?>admin/add-product.php" class="btn-primary">Add Product</a>
                <br><br>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }
                    if(isset($_SESSION['failed_remove_img']))
                    {
                        echo $_SESSION['failed_remove_img'];
                        unset($_SESSION['failed_remove_img']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['upload-image']))
                    {
                        echo $_SESSION['upload-image'];
                        unset($_SESSION['upload-image']);
                    }
                    if(isset($_SESSION['no_product_found']))
                    {
                        echo $_SESSION['no_product_found'];
                        unset($_SESSION['no_product_found']);
                    }
                    
                    
                    
                
                ?>
                <br>

                
                <table class="tbl_full">
                    <tr>
                        <th>Serial No</th>
                        <th>Product Title</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>   
                        <th>Featured</th>
                        <th>New Arrival</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        //create sql query to get all the food 
                        $sql="SELECT * from 
                        tbl_product ";

                        //execute the query
                        $res=mysqli_query($conn,$sql);

                        //count rows to checked whether we have products or not
                        $count=mysqli_num_rows($res);
                        if($count>0)
                        {
                            //we have products in database
                            //create sn variable  and set default value as 1
                            $sn=1;

                            //get the products from database and display 
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the value from individual columns
                                $id=$row['product_id'];
                                $title=$row['product_title'];
                                $price=$row['price'];
                                $category_id=$row['category_id'];
                          
                                $image_name=$row['image_name'];
                                $featured=$row['featured'];
                                $new_arrival=$row['new_arrival'];
                                $active=$row['active'];
                                

                                //sql for showing the category name 
                                $sql2 ="SELECT title from tbl_category where category_id='$category_id'";

                                //execute the query 
                                $result=mysqli_query($conn,$sql2);
                                $row2=mysqli_fetch_assoc($result);
                                
                                $category_title=$row2['title'];

                                ?>

                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $title;?></td>
                                    <td><?php echo $category_title;?></td>
                                    
                                    <td><?php echo $price.' BDT'?></td>
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
                                    <td><?php echo $featured;?></td>
                                    <td><?php echo $new_arrival;?></td>
                                    <td><?php echo $active;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-product.php?product_id=<?php echo $id;?>" class="btn-secondary"> Update Product</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-product.php?product_id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Delete product</a>
                           
                                    </td>
                                 </tr>
                                <?php

                            }

                        }
                        else
                        { 
                            //product not added in database
                            echo "<tr><td colspan='9' class='error'>Product Not added Yet</td></tr>";

                        }


                    ?>
                    
                </table>
    </div>

</div>


<?php include('partials/footer.php'); ?>