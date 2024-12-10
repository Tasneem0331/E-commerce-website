<?php 
ob_start(); 
include('partials/menu.php') ;?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Product</h1>
        <br><br>

        <?php
        //check whether the id is set or not
        if(isset($_GET['product_id']))
        {
            //get the is and all other details
            //echo "getting the data";
            $id=$_GET['product_id'];

            //create sql query to get all other details
            $sql2="SELECT * from tbl_product where product_id=$id";

            //execute the query
            $res2=mysqli_query($conn,$sql2);

            //count the rows to check whether the id is valid or not
            $count=mysqli_num_rows($res2);

            if($count==1)
            {
                //get all the data
                $row=mysqli_fetch_assoc($res2);
                $title=$row['product_title'];
                $description=$row['description'];
                $price=$row['price'];


                $current_image=$row['image_name'];
                $current_category=$row['category_id'];
                $featured=$row['featured'];
                $new_arrival=$row['new_arrival'];
                $active=$row['active'];

            }

            else
            {
                //redirect to manage category
                $_SESSION['no_product_found']="<div class='error'>Product not found</div>";

                //redirect to manage -category
                header('location:'.SITEURL.'admin/manage-product.php');


            }


        }
        else
        {
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-product.php');

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
                <td>Description:</td>
                <td>
                    <textarea name="description" col="50" rows="5" ><?php echo $description;?></textarea>
                </td>
             </tr>
             <tr>
                <td>Price</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price?>">
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
                        <img src="<?php echo SITEURL;?>image/products/<?php echo $current_image;?>" alt="" width="150px" >
                    <?php

                      }
                      else 
                      {
                        //display msg
                        echo "<div class='error'> Image not Available.</div>";

                      }
                    
                    ?>
                 </td>
              </tr>
              <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image" id="">

                </td>
                
              </tr>
             <tr>

                 <td>Category:</td>
                 <td>
                     <select name="category" >
                         <?php
                                //create php code to display categories from database

                                //1.create sql to get all active categories from database
                                $sql="SELECT * from tbl_category where active='Yes'";
                                
                                //execure the query
                                $res=mysqli_query($conn,$sql);

                                //count rows to check whether we have categories or not
                                $count=mysqli_num_rows($res);

                                //if count>0 we have categories else we dont have any categories

                                if($count>0)
                                {
                                    //we have category
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of category
                                       
                                        $title= $row['title'];
                                        $category_id= $row['category_id'];
                                        ?>

                                         <option <?php if($current_category == $category_id){echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $title;?></option>


                                        <?php
                                    }


                                }
                                else
                                {
                                    //we dont have category
                                    ?>
                                    <option value="0">Category is Not Availabe.</option>

                                    <?php
                                    
                                    
                                }
                                //Display on dropdown

                        
                            ?>
                        </select>
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
                <td>New Arrival:</td>

            
                <td>
                 <input <?php if($new_arrival=='Yes'){echo "checked";} ?> type="radio" name='new_arrival' value="Yes">Yes
                 <input <?php if($new_arrival=='No'){echo "checked";} ?> type="radio" name='new_arrival' value="No">No
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
                   <input type="hidden" name="id" value="<?Php echo $id;?>">
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
        $description=$_POST['description'];
        $price=$_POST['price'];
        $current_image=$_POST['current_image'];
        $category_id=$_POST['category'];
        $featured=$_POST['featured'];
        $new_arrival=$_POST['new_arrival'];
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
                $temp = explode('.', $image_name);
                $ext = end($temp); //it will break the image name into 2 part  this will give last value only so we use end so it show jpg
        
                //rename the image
                $image_name="Product_Name_".rand(00000,99999).'.'.$ext;  //product name eg..product_category_23.jpg


                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../image/products/".$image_name;

                #finaly upload the image
                $upload=move_uploaded_file($source_path,$destination_path);

                //check whether the image is uploaded or not
                //and if the image is not uploaded we will stop the process and redirect with error message
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload-image']='<div class="error">Failed to upload image.</div>';
                    //redirect to add category page
                    header('location:'.SITEURL.'admin/manage-product.php');
                    //stop the process
                    die();
            

                }

                //remove the current image if available
                if($current_image!="")
                {
                    $remove_path="../image/products/".$current_image;
                    $remove=unlink($remove_path);
                   if($remove==false)
                   {
                     //failed to remove image
                        $_SESSION['failed_remove_img']="<div class='error'>Failed to remove image from folder.</div>";
                        header('location:'.SITEURL.'admin/manage-product.php');
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
        $sql3="UPDATE tbl_product
        set product_title='$title',
        featured='$featured',
        new_arrival='$new_arrival',
        description='$description',
        category_id=$category_id,
        price=$price,
        image_name='$image_name',
        category_id= $category_id ,
        active='$active'
        where product_id=$id ";

        //execute the query
        $result3=mysqli_query($conn,$sql3);

        //check whether the query is executed or not
        if($result3==true)
        {
            //category updated
            $_SESSION['update']="<div class='success'> Product updated successfully.</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        

        }
        else
        {
            //failed to update in category
            $_SESSION['update']="<div class='error'>Failed to update category.</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
           

        }
        



       }
       
       ?>
    </div>
</div>

<?php include('partials/footer.php') ;
ob_end_flush();
?>