<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
        //1.get the id of selected admin
        $id=$_GET['id'];

        //2.create sql query to get the details
        $sql="SELECT * from tbl_admin WHERE id=$id";
       //execute the query
       $res=mysqli_query($conn,$sql);
       //check whether the  query is executed or not
       if($res==TRUE)
       {
        //check whether tha data is available or not
        $count=mysqli_num_rows($res);
        //check whether we have admin data or not
        if($count==1){
            //we will get the details
           // echo "Admin Available";
           $row=mysqli_fetch_assoc($res);
           $full_name=$row['full_name'];
           $username=$row['username'];


        }
        else 
        {
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');

        }

       }


        
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="Full_name" value="<?php echo $full_name;?> ">
                    </td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
               
                <tr>
                    <td colspan="2">
                        <input type="hidden" name='id' value='<?php echo $id;?>'>
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
   //check whether the submit button is pressed or not
   if(isset($_POST['submit']))
   {
    //echo "button clicked";
    //get all the values from form to update
    $id= $_POST['id'];
    $full_name=$_POST['Full_name'];
    $username=$_POST['username'];


    //create sql query to update admin

    $sql= "UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    where id=$id
    ";
    //execute the query
    $res=mysqli_query($conn,$sql);

    //check whether the query is executed successfully or not
    if($res==TRUE){
       //query executed successfully 
       $_SESSION['update']="<div class='success'>Admin updated successfully.</div>";

       //redirect to manage admin page
       header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //fails to update
        //query executed not successfully 
       $_SESSION['update']="<div class='error'>Failed to updated admin.</div>";

       //redirect to manage admin page
       header('location:'.SITEURL.'admin/manage-admin.php');

    }
   }
?>
<?php include('partials/footer.php');?>
