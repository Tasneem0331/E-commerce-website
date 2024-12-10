<?php include('partials/menu.php') ;?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
        //check whether the id is set or not
        if(isset($_GET['category_id']))
        {
            //get the is and all other details
            //echo "getting the data";
            $id=$_GET['category_id'];

            //create sql query to get all other details
            $sql="SELECT * from tbl_category where category_id=$id";

            //execute the query
            $res=mysqli_query($conn,$sql);

            //count the rows to check whether the id is valid or not
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //get all the data
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

            }

            else
            {
                //redirect to manage category
                $_SESSION['no_category_found']="<div class='error'>Category not found</div>";

                //redirect to manage -category
                header('location:'.SITEURL.'admin/manage-category.php');


            }


        }
        else
        {
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        ?>

    
       <form action="" method="POST" enctype="multipart/form-data"> 
          <table width=35%>
             <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title?>">
                </td>

             </tr>
             <tr>
                 <td>Current Image:</td>
                 <td>
                    <?php
                      if($current_image!="")
                      {
                        //display the image
                    ?>
                        <img src="<?php echo SITEURL;?>image/category/<?php echo $current_image;?>" alt="" width="150px" >
                    <?php

                      }
                      else 
                      {
                        //display msg
                        echo "<div class='error'> Image not added</div>";

                      }
                    
                    ?>
                 </td>
              </tr>
             <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name='image'>
                </td>
             </tr>
             <tr>
                <td>Featured:</td>

            
                <td>
                 <input <?php if($featured=='Yes'){echo "checked";} ?> type="radio" name='featured' value="Yes">Yes
                 <input <?php if($featured=='No'){echo "checked";} ?> type="radio" name='featured' value="No">No
               </td>

             </tr>
             <tr>
                <td>Active:</td>

            
                <td>

                 <input <?php if($active=='Yes'){echo "checked";} ?> type="radio" name='active' value="Yes">Yes
                 <input <?php if($active=='No'){echo "checked";} ?> type="radio" name='active' value="No">No
                </td>

             </tr>
             <tr>
                <td>
                   <input type="hidden" name='current_image' value='<?php echo $current_image;?>'>
                   <input type="hidden" name="id" value="<?Php echo $id?>">
                   <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
                
               </tr>
           </table>
       </form>
       <?php
       //check if submit button is selected or not
       if(isset($_POST['submit']))
       {
        //echo "clicked";

        //1.get all the values from our form
        $id=$_POST['id'];
        $title=$_POST['title'];
        $current_image=$_POST['current_image'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];

        //2.update new image if selected
        //check whether the image is selected or not
        if(isset($_FILES['image']['name']))
        {
            //get the image details
            $image_name=$_FILES['image']['name'];

            //check whether the image is availabe or not
            if($image_name!="")
            {
                //image availabel

                //1.upload the new image 

                //auto rename our image
                //get the extension of our image(jpg,png,gif,ect),e.g product1.jpg
                $ext=end(explode('.',$image_name)); //it will break the image name into 2 part  this will give last value only so we use end so it show jpg
        
                //rename the image
                $image_name="Product_Category_".rand(000,999).'.'.$ext;  //product name eg..product_category_23.jpg


                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../image/category/".$image_name;

                #finaly upload the image
                $upload=move_uploaded_file($source_path,$destination_path);

                //check whether the image is uploaded or not
                //and if the image is not uploaded we will stop the process and redirect with error message
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload']='<div class="error">Failed to upload image.</div>';
                    //redirect to add category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                    //stop the process
                    die();
            

                }

                //remove the current image if available
                if($current_image!="")
                {
                    $remove_path="../image/category/".$current_image;
                   $remove=unlink($remove_path);
                   if($remove==false)
                   {
                     //failed to remove image
                        $_SESSION['failed_remove_img']="<div class='error'>Failed to remove image from folder.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        die();//stop the process
                   }

                }
                

                //check whether the image is remove or not
                //if failed to remove then display msg and stop the process
                
                

            }
            else
            {
                $image_name=$current_image;

            }
        }
        else
        {
            $image_name=$current_image;
        }

        //3.update in DB
        $sql2="UPDATE tbl_category
        set title='$title',
        featured='$featured',
        image_name='$image_name',
        active='$active'
        where category_id=$id
        ";

        //execute the query
        $result=mysqli_query($conn,$sql2);

        //check whether the query is executed or not
        if($result==true)
        {
            //category updated
            $_SESSION['update']="<div class='success'>Category updated successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        else
        {
            //failed to update in category
            $_SESSION['update']="<div class='error'>Failed to update category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        



       }
       
       ?>
    </div>
</div>

<?php include('partials/footer.php') ;?>