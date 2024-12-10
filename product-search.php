<?php include('header.php');?>

        <section id="category-header">
            <?php
                $search=$_POST['search'];
            ?>
        
            <h2>Product on Your Search <a href="#">"<?php echo $search;?>"</a></h2>
          
        </section>
    
        <section id="product1" class="section-p1">
          
            <div class="pro-container">


                 <?php
                    //get the search keyword
                    

                    //sql query to get product based on search key word
                    $sql="SELECT * from tbl_product
                    where product_title like '%$search%' OR description like '%$search%' ";

                    //execute the query
                    $res=mysqli_query($conn,$sql);
                    //rows count
                    $count=mysqli_num_rows($res);

                    //check whether the products is available or not
                    if($count>0)
                    {
                        //product  is available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the details 
                            $id=$row['product_id'];
                            $title=$row['product_title'];
                            $price=$row['price'];
                            $description=$row['description'];
                            $image_name=$row['image_name'];

                            ?>
                               <div class="pro" onclick="window.location.href='<?php echo SITEURL;?>sproduct1.php';">

                                    <?php
                                        //check whether image name is available or not
                                        if($image_name=="")
                                        {
                                            //image not available
                                            echo "<div class='error'>Image not available.</div>";
                                        }

                                        else
                                        {
                                            //image available
                                            ?>
                                             <img src="<?php echo SITEURL; ?>image/products/<?php echo $image_name; ?>" alt="">

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
                                        <h4><?php echo $price;?></h4>
                                    </div>
                                    <a href="<?php echo SITEURL;?>sproduct1.php?product_id=<?php echo $id;?>" class="btn-normal"> See Details</a>
                                </div>

                            <?php
                        }
                    }
                    else
                    {
                        //product is not available
                        echo "<div class='error'>Product is not found.</div>";
                    }
                 
                 ?>
            </div>
        </section>

        <section id="pagination" class="section-p1">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#"><i class="fas fa-long-arrow-alt-right    "></i></a>

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

        

        <?php include('footer.php')?>
         
    
         
</body>
</html>