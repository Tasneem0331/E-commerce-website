<?php include('partials/menu.php'); ?>
        <!-------main content section start ------------------>
        <div class="main-content" >

            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <?php
                   if(isset($_SESSION['login']))
                   {
                    echo $_SESSION['login']; //displaying session messsage
                    unset($_SESSION['login']); // revoming session message
                   }
                ?>
                <br><br>
           
               <div class="col-4 text-center">
                <?php 
                //sql query
                $sql="SELECT * from tbl_category";
                //execute query
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);

                ?>
                <h1><?php echo $count;?></h1>
                categories
               </div>
              <div class="col-4 text-center">

              <?php 
                //sql query
                $sql2="SELECT * from tbl_product";
                //execute query
                $res2=mysqli_query($conn,$sql2);
                $count2=mysqli_num_rows($res2);

                ?>
                <h1><?php echo $count2;?></h1>
                Products
              </div>
              <div class="col-4 text-center">

              <?php 
                //sql query
                $sql3="SELECT * from tbl_order";
                //execute query
                $res3=mysqli_query($conn,$sql3);
                $count3=mysqli_num_rows($res3);

                ?>
                <h1><?php echo $count3;?></h1>
                Total Orders
              </div>
              <div class="col-4 text-center">

              <?php 
                //sql query
                $sql5="SELECT * from customer_query";
                //execute query
                $res5=mysqli_query($conn,$sql5);
                $count5=mysqli_num_rows($res5);

                ?>
                <h1><?php echo $count5;?></h1>
                Total Customer Query
              </div>
      
              <div class="col-4 text-center">
                <?php

                //create sql query to get total revenue generated 
                //aggregate function in sql
                $sql4="SELECT sum(total_price) as Total from tbl_order";

                //execute the query 
                $res4=mysqli_query($conn,$sql4);

                //get the value
                $row4=mysqli_fetch_assoc($res4);

                //get the total revenue
                $total_revenue=$row4['Total']
                ?>
                <h1><?php echo $total_revenue ." BDT";?></h1>
                Revenue Generated
              </div>
              <div class="clearfix"></div>
            </div>

        </div>
        
        <!-------main content section end ------------------>
        
      <?php include('partials/footer.php'); ?>