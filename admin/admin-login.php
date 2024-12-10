
 <?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Login</title>
       <link rel="stylesheet" href="../css/admin_login.css">

    </head>
    <body>
        <div class="container">
            <h2>Login</h2>
             <?php
                   if(isset($_SESSION['login']))
                   {
                    echo $_SESSION['login']; //displaying session messsage
                    unset($_SESSION['login']); // revoming session message
                   }
                   if(isset($_SESSION['no-login-msg']))
                   {
                    echo $_SESSION['no-login-msg']; //displaying session messsage
                    unset($_SESSION['no-login-msg']); // revoming session message
                   }
             ?>
             

             <br><br>
            <form action="#" method="post">
                <label for="Username">Username</label>
                <input type="text"  name="username" placeholder="User Name" >

                <br>
                <label for="password">Password</label>
                <input type="password"  name="password" placeholder="Password">
               <br><br>
                <input type="submit" name= 'submit' value="login" class="btn-secondary  ">
                
          
            </form>

        </div>
    </body>

</html>

<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //get the data from login form

    $username=$_POST['username'];
    $password=md5($_POST['password']);

    //2.sql to check whether the user with username and password is exist or not
    $sql= "SELECT * from tbl_admin where username='$username' and password='$password'";

    //execute the sql
    $res=mysqli_query($conn,$sql);
    //count rows to check whether the user exist or not
    $count=mysqli_num_rows($res);
    echo $count;
    if($count==1)
    {
        //user exist
        $_SESSION['login']="<div class='success'>Login Successfull</div>";
        $_SESSION['user']=$username;  //to check whether the user is loged in or not and logout will unset it
        //redirect to manage .php
        header('location:'.SITEURL.'admin/');
    }
    else
    {
       //user does not exist
       $_SESSION['login']="<div class='error'>Username or password didn't match.</div>";
       //redirect to manage .php
       header('location:'.SITEURL.'admin/admin-login.php');

    }




}

?>