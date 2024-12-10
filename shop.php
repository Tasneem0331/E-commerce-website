<?php include('header.php');?>

        <section id="page-header">
        
            <h2>#stayHome</h2>
         
            <p>Save more with cupons & up to 70% off!</p>
          
        </section>


        <section id="product1" class="section-p1 filter">
            
            <div class="pro-container sec2">
                <?php
                //create sql to display the featured product from database
                $sql="SELECT * from tbl_product 
                where  active='Yes'
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
                    <div class="pro">

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
                            <h4><?php echo $price.' BDT'?></h4>
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
            <div class="sec1" >
                Lorem ipsum dolor sit, amet  adipisicing elit. Accusantium ullam asperiores illum soluta sapiente expedita reiciendis, accusamus incidunt. Assumenda sed pariatur libero officia et praesentium veritatis quae eligendi atque, voluptates natus nihil nemo quia expedita odit inventore reiciendis maiores! Voluptatibus, explicabo ipsa. Dicta facilis, repellat distinctio praesentium cumque odit quibusdam!
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
        

        <script src="script.js"></script>
    </body>
</html>