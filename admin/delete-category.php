<?php
  //include constains file
  include('../config/constants.php');

   //check whether the id and image _name value is set or not
  if(isset($_GET['category_id']) && isset($_GET['image_name']))
   {
    //get the value and delete
    //echo "get value and delete";

    //get the id and image name
    $id=$_GET['category_id'];
    $image_name=$_GET['image_name'];

    //remove the physical image file is available
    if($image_name!="")
    {
      //image is avilable so remove it

      //path of the image
      $path ="../image/category/".$image_name;

      //remove the image from folder
      $remove=unlink($path); //unlink function will remove file from image/category.remove variable return true or false

      //if failed to remove image then add an error msg and stop the process
      if($remove==false)
      {
        //set the session message
        $_SESSION['remove']="<div class='error>Failed to Remove category Image.</div>";


        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');

        //stop the proccess
        die();


      }

    }


    //delete the data from database
    //sql query to delete data from database
    $sql="DELETE from tbl_category where category_id=$id";

    //execute the query
    $res=mysqli_query($conn,$sql);

    //check whether the data is deleted from database or not
    if($res==true)
    {
      //set success message and redirect
      $_SESSION['delete']="<div class='success'>Category deleted successfully.</div>";

      //redirect to manage -category
      header('location:'.SITEURL.'admin/manage-category.php');

    }
    else
    {
      //set fail msg and redirect
      //set failed message and redirect
      $_SESSION['delete']="<div class='error'>Failed to delete category.</div>";

      //redirect to manage -category
      header('location:'.SITEURL.'admin/manage-category.php');


    }

    //redirect to manage category page with message

  }
  else
  {
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');
  }

?>