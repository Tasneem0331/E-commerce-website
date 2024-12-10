<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
       <h1>Manage Category</h1>
       <br><br>
         <?php
           if(isset($_SESSION['add-category'])) // checking whether the session set or not
              {
                echo $_SESSION['add-category']; //displaying session messsage
                unset($_SESSION['add-category']); // revoming session message
              }
          
           if(isset($_SESSION['remove'])) // checking whether the session set or not
              {
                echo $_SESSION['remove']; //displaying session messsage
                unset($_SESSION['remove']); // revoming session message
              }
        
           if(isset($_SESSION['delete'])) // checking whether the session set or not
              {
                echo $_SESSION['delete']; //displaying session messsage
                unset($_SESSION['delete']); // revoming session message
              }
          
           if(isset($_SESSION['no_category_found'])) // checking whether the session set or not
              {
                echo $_SESSION['no_category_found']; //displaying session messsage
                unset($_SESSION['no_category_found']); // revoming session message
              }
              if(isset($_SESSION['update'])) // checking whether the session set or not
              {
                echo $_SESSION['update']; //displaying session messsage
                unset($_SESSION['update']); // revoming session message
              }
              if(isset($_SESSION['upload'])) // checking whether the session set or not
              {
                echo $_SESSION['upload']; //displaying session messsage
                unset($_SESSION['upload']); // revoming session message
              }
              if(isset($_SESSION['failed_remove_img'])) // checking whether the session set or not
              {
                echo $_SESSION['failed_remove_img']; //displaying session messsage
                unset($_SESSION['failed_remove_img']); // revoming session message
              }

          ?>
                <br> <br>
                <!----------Button to add category----------------->
                <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
       <br><br><br>
                <table class="tbl_full">
                    <tr>
                        <th>Serial No</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>   <!-------------- update or delete option-------->
                    </tr>
                    <?php
                      //Query to get all category from database
                      $sql="SELECT * from tbl_category";

                      //execute the query
                      $res=mysqli_query($conn,$sql);
                      
                      //count the rows
                      $count=mysqli_num_rows($res);

                      //create serial_no variable and assign value as 1
                      $sn=1;


                      //check whether we have data in the database or not
                      if($count>0)
                      {
                        //we have data in DB
                        //get the data and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['category_id'];
                            $image_name=$row['image_name'];
                            $title=$row['title'];
                            $featured=$row['featured'];
                            $active=$row['active'];

                            //to write html inside php i will break the php and start the php again and between them i write html code
                            ?>


                            <tr>
                               <td><?php echo $sn++;?></td>
                               <td><?php echo $title;?></td>

                               <td>
                                  <?php
                                     
                                     //check whether image name is availabe or not
                                     if($image_name!="")
                                     {
                                        //display the image
                                        ?>
                                        <img src="<?php echo SITEURL;?>image/category/<?php echo $image_name;?>" width="100px" height="100px">

                                        <?php
                                     }
                                     else
                                     {
                                        //display the message
                                        echo "<div class='error'>Image not added</div>";
                                     }
                                  ?>
                               </td>

                               <td><?php echo $featured?></td>
                               <td><?php echo $active;?></td>
                               <td>
                                 <a href="<?php echo SITEURL;?>admin/update-category.php?category_id=<?php echo $id;?>" class="btn-secondary"> Update Category</a>
                                 <a href="<?php echo SITEURL;?>admin/delete-category.php?category_id=<?php echo $id; ?> & image_name=<?php echo $image_name;?>" class="btn-danger"> Delete category</a>
                           
                                </td>
            
                            </tr>
                

                            <?php

                        }

                      }
                      else
                      {
                        //we dont have data in DB
                        //we'll display the message inside table
                        ?>

                        <tr>
                            <td colspan="2"><div class='error'>No category added</div></td>

                        </tr>

                        <?php

                      }
                    ?>

                </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>