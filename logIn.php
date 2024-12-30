<?php include('config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Sign In Form</title>
       <link rel="stylesheet" href="SignInform.css">

    </head>
    <body>
        <div class="container">
            <h2>Login</h2>
            <?php
                   if(isset($_SESSION['userlogin']))
                   {
                    echo $_SESSION['userlogin']; //displaying session messsage
                    unset($_SESSION['userlogin']); // revoming session message
                   }
                   if(isset($_SESSION['no-login-msg']))
                   {
                    echo $_SESSION['no-login-msg']; //displaying session messsage
                    unset($_SESSION['no-login-msg']); // revoming session message
                   }
             ?>
            <form action="#" method="post">
                <label for="Username">Username</label>
                <input type="text" id="Username" name="username"  placeholder="User Name">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <br><br>
                <input type="submit" value="SIGN IN"  name="submit" class="btn-normal">
                
          
            </form>
            
            <P>Don't have any account yet?
                <a href="<?php echo SITEURL;?>registation.php">Create Account</a>
            </P>
            

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
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    //2.sql to check whether the user with username and password is exist or not
    $sql= "SELECT * from user where user_name='$username' and  user_email='$email' and password='$password'" ;

    //execute the sql
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    //count rows to check whether the user exist or not
    $count=mysqli_num_rows($res);
    echo $count;
    if($count==1)
    {
        //user exist

        //$_SESSION['userlogin']="<div class='success'>Login Successfull</div>";
        $_SESSION['userlogin']=$username;  //to check whether the user is loged in or not and logout will unset it
        $_SESSION['customerEmail']=$email; 
        $_SESSION['customerId']=$row['user_id']; 

        //redirect to manage .php
        header('location:'.SITEURL.'checkout.php');
    }
    else
    {
       //user does not exist
       $_SESSION['userlogin']="<div class='error'>Username or password or email didn't match .</div>";
       //redirect to manage .php
       header('location:'.SITEURL.'logIn.php');

    }
}

?>