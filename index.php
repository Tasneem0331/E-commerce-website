
<?php include('header.php');?>

        <section id="hero">
            <h4>Trade-in-offer</h4>
            <h2>Super value deals</h2>
            <h1>On all products</h1>
            <p>Save more with cupons& up to 70% off</p>
            <button>Shop Now</button>
        </section>

        <section id="feature" class="section-p1">
            <div class="fe-box">
                <img src="image/features/f1.png" alt="">
                <h6>Free Shipping</h6>

            </div>
            <div class="fe-box">
                <img src="image/features/f2.png" alt="">
                <h6>Online Order</h6>

            </div>
            <div class="fe-box">
                <img src="image/features/f3.png" alt="">
                <h6>Save Money</h6>

            </div>
            <div class="fe-box">
                <img src="image/features/f4.png" alt="">
                <h6>Promotions</h6>

            </div>
            <div class="fe-box">
                <img src="image/features/f5.png" alt="">
                <h6>Happy Sell</h6>

            </div>
            <div class="fe-box">
                <img src="image/features/f6.png" alt="">
                <h6>Support</h6>

            </div>
        </section>
        

        
        <!--------------------------Featured Product Section------------------->
        <section id="product1" class="section-p1">
            <h2>Featured Product</h2>
            <p>Summer Collection New Morden Design</p>
            <div class="pro-container">
                <?php
                //create sql to display the featured product from database
                $sql="SELECT * from tbl_product 
                where featured='Yes' and active='Yes'
                ";

                //execute the query 
                $res=mysqli_query($conn,$sql);

                //count the row to check whether the featured product is available or not
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    //product available
                    while($row=mysqli_fetch_assoc($res))
                    {
                    $id=$row['product_id'];
                    $title=$row['product_title'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    ?>
                    <div class="pro" onclick="window.location.href='sProduct1.php';">

                    <?php
                    //check whether image is available or not

                    if($image_name=="")
                    {
                        //image not avaiable
                        echo "<div class='error'>Image not Available.</div>";
                    }
                    else
                    {
                        //image available
                        ?>
                        <img src="<?php echo SITEURL;?>image/products/<?php echo $image_name;?>" alt="">

                        <?php

                    }

                    ?>

                        
                        <div class="des">
                            <h5><?php echo $title;?></h5>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4><?php echo $price.' BDT';?></h4>
                        </div>
                        <a href="<?php echo SITEURL;?>sproduct1.php?product_id=<?php echo $id;?>" class="btn-normal"> See Details</a>
                        <!--<a href="<?php echo SITEURL;?>cart.php?product_id=<?php echo $id?>"><i class="fa fa-shopping-cart cart"></i></a>-->
                    </div>
                    <?php
                    }
                }
                else
                {
                    //product does not available
                    echo "<div class='error'>Featured Product is not available.</div>";
                }
                ?>                        
            </div>
        </section>

        <section id="bannar" class="section-m1">
            <h4>Repair Services</h4>
            <h2>Up to <span>70% Off</span> - All t-Shirt & Accessories</h2>
            <button class="normal">Explore More</button>

        </section>

        <!--new Arrivals section-->

        <section id="product1" class="section-p1">
            <h2>New Arrivals</h2>
            <p>Summer Collection New Morden Design</p>
            <div class="pro-container">
                <?php
                //create sql to display the featured product from database
                $sql2="SELECT * from tbl_product 
                where new_arrival='Yes' and active='Yes'
                ";

                //execute the query 
                $res2=mysqli_query($conn,$sql2);

                //count the row to check whether the featured product is available or not
                $count2=mysqli_num_rows($res2);

                if($count2>0)
                {
                    //product available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                    $id=$row2['product_id'];
                    $title=$row2['product_title'];
                    $price=$row2['price'];
                    $image_name=$row2['image_name'];
                    ?>
                    <div class="pro" onclick="window.location.href='sProduct1.php';">

                    <?php
                    //check whether image is available or not

                    if($image_name=="")
                    {
                        //image not avaiable
                        echo "<div class='error'>Image not Available.</div>";
                    }
                    else
                    {
                        //image available
                        ?>
                        <img src="<?php echo SITEURL;?>image/products/<?php echo $image_name;?>" alt="">

                        <?php

                    }

                    ?>

                        
                        <div class="des">
                            <h5><?php echo $title;?></h5>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4><?php echo $price.' BDT';?></h4>
                        </div>
                        <a href="<?php echo SITEURL;?>sproduct1.php?product_id=<?php echo $id;?>" class="btn-normal"> See Details</a>
                    </div>
                    <?php
                    }
                }
                else
                {
                    //product does not available
                    echo "<div class='error'>Featured Product is not available.</div>";
                }
                ?>                        
            </div>

        </section>

        <section id="sm-banner" class="section-p1" >
            <div  class="banner-box">
                <h4>creazy deals</h4>
                <h2>buy 1 get 1 free</h2>
                <span>The best classic dress is on sale at cara</span>
                <button class="white">Learn More</button>

            </div>
            <div  class="banner-box  banner-box2">
                <h4>spring/summer</h4>
                <h2>upcoing season</h2>
                <span>The best classic dress is on sale at cara</span>
                <button class="white">Collection</button>

            </div>
        </section>

        <section id="bannar3">
            <div  class="banner-box">
                <h2>SEASONAL SALE</h2>
                <h3>Winter Colection -50% OFF</h3>
            </div>

            <div  class="banner-box banner-box2">
                <h2>NEW FOOTWEAR COLECTION</h2>
                <h3>Spring / Summer 2024</h3>
            </div>

            <div  class="banner-box banner-box3">
                <h2>T-SHIRTS</h2>
                <h3>New Trendy Prints</h3>
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

        <script src="script.js"></script>
    </body>
</html>