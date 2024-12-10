<?php include('header.php');?>
<?php
    //check whether id is passed or not

    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $category_id=$_GET['category_id'];

        //get the category title here
        $sql="SELECT title from tbl_category 
        where category_id=$category_id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //get the value from data base
        $row=mysqli_fetch_assoc($res);

        //get the title
        $category_title=$row['title'];
    }

    else
    {
        //category not passed
        //redirect to home page

        header('location:'.SITEURL);
    }

?>

    <section id="category-header">
        
        <h2>Product on <a href="#">"<?php echo $category_title?>"</a></h2>
      
    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">

            <?php

                //write sql to get the product on corresponding category
                $sql2="SELECT * from tbl_product 
                where category_id=$category_id";

                //execute the query 
                $result =mysqli_query($conn,$sql2);

                //count the no of row
                $count=mysqli_num_rows($result);
                
                //if count >0 then there is product on this category

                if($count>0)
                {
                    //product is available
                    while($row2=mysqli_fetch_assoc($result))
                    {
                        $id=$row2['product_id'];
                        $image_name=$row2['image_name'];
                        $price=$row2['price'];
                        $product_title=$row2['product_title'];
                        ?>
                        <div class="pro" onclick="window.location.href='<?php echo SITEURL;?>sproduct1.php'">
                            <?php
                            if($image_name=="")
                            {
                                //image not found
                                echo "<div class='error'>Image is not available</div>";
                            }
                            else
                            {
                                //image is available
                                ?>
                                <img src="<?php echo SITEURL;?>image/products/<?php echo $image_name;?>" alt="">
                                <?php
                            }
                            ?>

                            <div class="des">
                        
                                <h5><?php echo $product_title;?></h5></h5>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4><?php echo $price.' BDT'?></h4>
                        
                            </div>
                            
                            <a href="<?php echo SITEURL;?>sproduct1.php?product_id=<?php echo $id;?>" class="btn-normal"> See Details</a>
                        </div>

                        <?php  
                    }
                }

                else
                {
                    //product is not available
                    echo "<div class='error'>No product is available on this category .</div>";
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
    <?php include('footer.php');?>

</body>
</html>