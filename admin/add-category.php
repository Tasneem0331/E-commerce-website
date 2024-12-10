<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category </h1>
        <br><br>
                <?php
                   if(isset($_SESSION['add-category'])) // checking whether the session set or not
                   {
                    echo $_SESSION['add-category']; //displaying session messsage
                    unset($_SESSION['add-category']); // revoming session message
                   }

                   if(isset($_SESSION['upload'])) // checking whether the session set or not
                   {
                    echo $_SESSION['upload']; //displaying session messsage
                    unset($_SESSION['upload']); // revoming session message
                   }
                ?>
                <!-----------Add category form------->
        <form action="" method="post" enctype="multipart/form-data">
            <table width=40%>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="catergory title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No

                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>




<?php include('partials/footer.php'); ?>

<?php
//process the value from and save it in database
//check weather submit the button is clicked or not
 if(isset($_POST['submit']))
 {
    //button cliked
    //echo "Button clicked";
    
    //1.get the data from form
   $title=$_POST['title'];
   if ($title == '' || $title == null)
    {
    // Title is empty or null
    $_SESSION['add-category'] = '<div class="error">Title cannot be empty. Please enter a valid title.</div>';
    // Redirect to add category page
    header("location:" . SITEURL . "admin/add-category.php");
    exit(); // Ensure script stops execution after redirect
    } 
 //for radio input type we need to check whether the button is selected or not
   if(isset($_POST['featured']))
    {
     //we need to get the value from  form
     $featured=$_POST['featured'];
    }
   else
    {
      //set the default value
      $featured='No';  

    }

    if(isset($_POST['active']))
    {
     //we need to get the value from  form
     $active=$_POST['active'];
    }
   else
    {
      //set the default value
      $active='No';  

    }
    //check whether the images is selected or not and set the value for image name accordingly
   // print_r($_FILES['image']); //print the value of array
    //die();//break the code here
    if(isset($_FILES['image']['name']))
    {

        //uploads the image
        //to upload image we need image name and source path and destination path
        $image_name=$_FILES['image']['name'];

        //upload the image only image is selected
        if($image_name!='')
        {

        

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
            header('location:'.SITEURL.'admin/add-category.php');
            //stop the process
            die();
            

        }
      }
    }
    else
    {
        //dont upload image and set the image value as blank
        $image_name=" ";
    }



   
    //create sql query to insert category in database
    $sql="INSERT INTO tbl_category set
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active'
    ";

  //3. Executing query and saving data in database
  $res=mysqli_query($conn, $sql);
  
  //4.Check whether the (query is executed )data is inserted or not and display appropriate message

  if($res==TRUE)
  {

    
    //query executed and category added
    //create a session variable to display the message
    $_SESSION['add-category']='<div class="success">Category added Successfully</div>';  // variable name add
    // Redirect page to manage category
    header("location:".SITEURL."admin/manage-category.php");

  }
  else 
  {
    // failed to insert data
    //echo "failed to insert data";

    //create a session variable to display the message
    $_SESSION['add-category']='<div class="error">Failed to add category</div>';  // variable name add
    // Redirect page to add category
    header("location:".SITEURL."admin/add-category.php");

  }


}


?>