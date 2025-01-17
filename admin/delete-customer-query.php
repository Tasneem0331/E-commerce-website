<<<<<<< HEAD
<?php
//include constaints.php file

include("../config/constants.php");
 // 1.get the id of the admin to be deleted 
   $id=$_GET['id'];

 //2.create sql query to delete admin
   $sql = "DELETE from customer_query WHERE id=$id";

   //execute the query
   $res= mysqli_query($conn,$sql);

   //check whether the query executed successfully or not

   if($res==TRUE){
    //query executed successfully and successfully delete the admin

    //echo "delete admin Successfully";
    //create session variable to display the message 
    $_SESSION['delete query']="<div class='success'>Query deleted suceessfully</div>";
    //redirect to manage admin page

    header('location:'.SITEURL.'admin/customer-query.php');



   }

   else{

    //fails to delete admin
   // echo "fail to delete admin";
   $_SESSION['delete query']='<div class="error">Failed to delete Admin.try again Later.</div>';
   header('location:'.SITEURL.'admin/customer-query.php');

   }
 //3.redirect to manage admin page with message(success/error)



=======
<?php
//include constaints.php file

include("../config/constants.php");
 // 1.get the id of the admin to be deleted 
   $id=$_GET['id'];

 //2.create sql query to delete admin
   $sql = "DELETE from customer_query WHERE id=$id";

   //execute the query
   $res= mysqli_query($conn,$sql);

   //check whether the query executed successfully or not

   if($res==TRUE){
    //query executed successfully and successfully delete the admin

    //echo "delete admin Successfully";
    //create session variable to display the message 
    $_SESSION['delete query']="<div class='success'>Query deleted suceessfully</div>";
    //redirect to manage admin page

    header('location:'.SITEURL.'admin/customer-query.php');



   }

   else{

    //fails to delete admin
   // echo "fail to delete admin";
   $_SESSION['delete query']='<div class="error">Failed to delete Admin.try again Later.</div>';
   header('location:'.SITEURL.'admin/customer-query.php');

   }
 //3.redirect to manage admin page with message(success/error)



>>>>>>> d4ddf238279708925d35d94052317b6051982ed6
?>