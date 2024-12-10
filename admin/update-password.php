<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }

        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
               
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name='id' value='<?php echo $id;?>'>
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
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
    //echo "cliked"
    //1. get the data from the form
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);
    //2. check whether the user with current Id and current password will exist or not
    $sql="SELECT * from tbl_admin where id=$id and password='$current_password'";
    //execute the query
    $result=mysqli_query($conn,$sql);
    if($result==true)
    {
        //check whether is available or not
        $count=mysqli_num_rows($result);
        if($count==1)
        {
            //password can be changed
           // echo "user found";
           //check whether the new password and confirm password match or not
           if($new_password==$confirm_password)
           {
           //echo "Match";
           //update the password
           $sql2="UPDATE tbl_admin 
           set password='$new_password'
            where id=$id";

            //execute the query
            $res=mysqli_query($conn,$sql2);
            //check whether the query is executed or not
            if($res==true)
            {
                //display message
                $_SESSION['change_pass']="<div class='success'>Password Changed Successfully. </div> ";
                header("location:".SITEURL."admin/manage-admin.php");
            }
            else{
                //display error message
                $_SESSION['change_pass']="<div class='error'>Failed to Change Password. </div> ";
                header("location:".SITEURL."admin/manage-admin.php");
            }

           }
           else
           {
            //we will redirect to manage admin will error message
            $_SESSION['pass_not_match']="<div class='error'>Password did not Match. </div> ";
            header("location:".SITEURL."admin/manage-admin.php");

           }


        }
        else
        {

            //user does not exist set message and redirect
            $_SESSION['user_not_found']="<div class='error'>User Not Found</div> ";
            //redirect the user
            header("location:".SITEURL."admin/manage-admin.php");

        }
    }

    //3.whether the new pass and confrim password are match or not
    //4. change password if all avobe are true
   }
?>
<?php include('partials/footer.php');?>
