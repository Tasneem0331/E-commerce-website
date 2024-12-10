<?php include('header.php');?>
        <section id="pro-details" class="section-p1" >
            <?php
                //check whether the id is passed or not
                if(isset($_GET['product_id']))
                {
                    //product id is set and get the id
                    $product_id=$_GET['product_id'];

                    //write sql to get the data from database
                    $sql="SELECT * from tbl_product 
                    where product_id=$product_id
                    
                    ";

                    //execute the query
                    $res=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_assoc($res);

                    $product_title=$row['product_title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    $category_id=$row['category_id'];

                    //write another sql to get the details based on category id
                    $sql2="SELECT title from tbl_category 
                    where category_id=$category_id";

                    //execute the query
                    $res2=mysqli_query($conn,$sql2);

                    $row2=mysqli_fetch_assoc($res2);
                    $category_title=$row2['title'];
                
                }

                else
                {
                    //product is not passed so redirect to home page
                    header('location:'.SITEURL);
                }
            ?>
            
            <div class="single-pro-image">

                <img src="<?php echo SITEURL;?>image/products/<?php echo $image_name;?>" alt="" width="100%" id="MainImg">
                <!--
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="image/products/f2.jpg" alt="" width="100%" class="small-img">

                    </div>
                    <div class="small-img-col">
                        <img src="image/products/f1.jpg" alt="" width="100%" class="small-img">

                    </div>
                    <div class="small-img-col">
                        <img src="image/products/f3.jpg" alt="" width="100%" class="small-img">

                    </div>
                    <div class="small-img-col">
                        <img src="image/products/f4.jpg" alt="" width="100%" class="small-img">

                    </div>


                </div>
                 -->

            </div>
           
            <div class="single-pro-details">
                <h6>Home/<?php echo $category_title;?></h6>
                <h4><?php echo $product_title;?></h4>
                <h2><?php echo $price .' BDT';?></h2>
                <form action="<?php echo SITEURL;?>cart.php" method="GET">
                <select name="size">
                    <option value="">Select Size</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="Small">Small</option>
                    <option value="Large">Large</option>
                </select>
                
                    <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
                    <input type="number" name="quantity" value="1">
                    <button class="btn-normal" type="submit">Add to Cart</button>
                </form>
                <h4>Product Details</h4>
                <span>
                    <?php echo $description;?>
                </span>
            </div>


        </section>
        <section id="product1" class="section-p1">
             <?php
                //write sql to get the same category product 
                $sql3="SELECT * from tbl_product 
                where category_id=$category_id and product_id <> $product_id and image_name IS NOT NULL";

                //execute the sql
                $result=mysqli_query($conn,$sql3);

                //count the no of row
                $count=mysqli_num_rows($result);
                if($count>0)
                     {  
                        ?>
                        <h2>You may also like</h2>
                        <div class="pro-container">
                            <?php
                            
                                while($row3=mysqli_fetch_assoc($result))

                                    {   $cat_pro_id=$row3['product_id'];
                                        $cat_pro_image=$row3['image_name'];
                                        $cat_pro_title=$row3['product_title'];
                                        $cat_pro_price=$row['price'];

                                        ?>
                                        <div class="pro">
                                            
                                        <img src="<?php echo SITEURL;?>image/products/<?php echo $cat_pro_image;?>" alt="">
                                        <div class="des">
                                            <h5><?php echo $cat_pro_title;?></h5>
                                            <div class="star">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h4><?php echo $cat_pro_price;?></h4>
                                        </div>
                                        <a href="<?php echo SITEURL;?>sproduct1.php?product_id=<?php echo $cat_pro_id;?>" class="btn-normal"> See Details</a>
                                        <!--<a href="#"><i class="fa fa-shopping-cart cart"></i></a> -->
                                        </div>
                                    <?php

                                }
                        }
                    else
                    {  //no product found in this category

                    }
                ?>
           
              </div>

        </section>

        <section id="newsletter" class="section-p1 section-m1">
            <div class="news">
                <h4>Sign Up For Newsletter</h4>
                <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>

            </div>
            <div class="form">
                <input type="text" placeholder="Your email address">
                <button class="normal">Sign Up</button>

            </div>

        </section>

        <?php include('footer.php');?>
        <!--
        <script>
            var MainImg=document.getElementById("MainImg");
            var smallImg=document.getElementsByClassName("small-img");
           for(let i=0; i<smallImg.length;i++){
            smallImg[i].onclick=function(){
                MainImg.src=smallImg[i].src;
            };
           }


        </script>
        

        <script src="script.js"></script>
                -->
    </body>
</html>