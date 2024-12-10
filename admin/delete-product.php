<?php
    //echo "Delete product";
    include('../config/constants.php');


    //1.check whether the id and image are passed or not
    if(isset($_GET['product_id']) && isset($_GET['image_name'])) //either use && or AND 
    {
        //process to delete
        //echo "Process to delete";

        //1.get id and image name
        $id=$_GET['product_id'];
        $image_name=$_GET['image_name'];


        //2. remove the image if available
        //check whether the image is available or not and delete only when image is available
        if($image_name!="")
        {
            //it has image and need to remove from folder
            //get the image path
            $path="../image/products/".$image_name;

            //remove image file from folder
            $remove=unlink($path);

            //check whether the image is removed or not
            if($remove==false)
            {
                //failed to remove image
                $_SESSION['upload']="<div class='error'>Failed to remove image file</div>";
                //redirect to manage product
                header('location:'.SITEURL.'admin/manage-product.php');
                //stop the process of deleting product
                die();

            }
        }



        //3.delete product from database
        $sql="DELETE from tbl_product where product_id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether the query is executed or not and set the session msg respective
        if($res==true)
        {
            //Product deleted
            $_SESSION['delete']="<div class='success'>Product deleted Successfully.</div>";

            //redirect it to manage product
            header('location:'.SITEURL.'admin/manage-product.php');

        }

        else
        {
            //failed to delete food
            
            $_SESSION['delete']="<div class='error'>Failed to product delete.</div>";

            //redirect it to manage product
            header('location:'.SITEURL.'admin/manage-product.php');

        }


        //redirect to manage product with msg
    }
    else
    {
        //redirect to manage product page
        //echo "Redirect";
        $_SESSION['unauthorize']="<div class=error>Unauthorize access.</div>";
        header('location:'.SITEURL.'admin/manage-product.php');

    }


?>