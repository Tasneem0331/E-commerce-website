<?php include('header.php');?>

    <!-- CAtegories Section Starts Here -->
    <section id="category"class="categories">
        <br><br><br>
    <h2>Explore Products </h2>
        <div class="container">
            

            <?php

            //create sql query to display the category from database
            $sql="SELECT * from tbl_category
            where active='Yes'";

            //execute the query
            $res=mysqli_query($conn,$sql);

            //count rows to check whether category is available or not
            $count=mysqli_num_rows($res);

            if($count>0)

            {
                //category is available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the value like id,image,title
                    $id=$row['category_id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                        <a href="<?php echo SITEURL;?>category-products.php?category_id=<?php echo $id;?>">
                        <div class="c1">
                            <?php
                            //check whether image is available or not
                            if($image_name=="") 
                            {
                                //display the message
                                echo "<div class='error'>Image not available</div> ";
                            }
                            else
                            {
                                //image is available
                                ?>
                                 <img src="<?php echo SITEURL; ?>image/category/<?php echo $image_name;?>" alt="Pizza" >

                                <?php
                               
                            }
                            ?>
                                
                                <h3><?php echo $title;?></h3>
                            </div>
                        </a>
                    <?php
                }
            }
            else
            {
                //category is not available
                echo "<div class='error'>Category not added</div>";

            }

        
            ?>
            </div>
    </section>
           

    <!-- Categories Section Ends Here -->

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