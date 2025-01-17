<<<<<<< HEAD
<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="SignInform.css">

</head>

<body>
    <div class="container">
        <h2>Registration Form</h2>
        <br>
        <?php
       
        if (isset($_SESSION['duplicate-email'])) // checking whether the session set or not
        {
            echo $_SESSION['duplicate-email']; //displaying session messsage
            unset($_SESSION['duplicate-email']); // revoming session message
        }
        ?>
        <form action="" method="post">
            <label for="Full Name">Full Name</label>
            <input type="text" id="full" name="full_name" required>

            <label for="user_name">User Name</label>
            <input type="text" id="user_name" name="user_name">



            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="Password">Password</label>
            <input type="password" id="password" name="password">

            <label type="address">Address</label>
            <input type="text" id="address" name="address">

            <label for="Phn no">Phone Number</label>
            <input type="tel" id="phn no" name="phn_no">
            <br><br>

            <input type="submit" value="Submit" name="submit" class="btn-normal">
            <p>Already have a account?

                <a href="<?php echo SITEURL;?>logIn.php">Sign In</a>
            </p>


        </form>
    </div>
    <?php
    if (isset($_POST['submit']))
     {
        //button is clicked
       // echo "button clicked";

        //1.get the data from the form
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']); //md5 is encrypted function
        $address = $_POST['address'];
        $phone = $_POST['phn_no'];


        if ($user_name == null)
         {
            // Title is empty or null
            $_SESSION['add'] = '<div class="error">UserName cannot be empty. Please enter a valid username.</div>';
            // Redirect to add category page
            header("location:" . SITEURL . "registation.php");
            exit(); // Ensure script stops execution after redirect
        }
        //check if the email is already exist
        $sql = "SELECT * from user where user_email='$email'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        $count = mysqli_num_rows($res);

        if ($count > 0) 
        {
            $_SESSION['duplicate-email'] = '<div class="error">Email is already exist.</div>';
            // Redirect to add category page
            header("location:" . SITEURL . "registation.php");
            exit(); // Ensure script stops execution after redirect
        }

        //2.sql query to save data into the database
        $sql2 = "INSERT INTO user
        set 
       	full_name='$full_name',
        user_name='$user_name',
        user_email='$email',
        password='$password',
        user_address='$address',
        phone_number=$phone

        ";

        //execute the query
        $result = mysqli_query($conn, $sql2) or die(mysqli_error($conn));


        //4.Check whether the (query is executed )data is inserted or not and display appropriate message

        if ($result == TRUE)
         {
            //data inserted
            //echo "Data inserted";
            //create a session variable to display the message
            $_SESSION['userlogin'] =$user_name;  // variable name add
            $_SESSION['customerEmail']=$email; 
            $_SESSION['customerId']=mysqli_insert_id($conn); 

            // Redirect page to manage admin
            header('location:'.SITEURL.'checkout.php');
            
        } else 
        {
            // failed to insert data
            //echo "failed to insert data";

            //create a session variable to display the message
            $_SESSION['userlogin'] = '<div class="error">Failed to add Admin</div>';  // variable name add
            // Redirect page to add admin
            header("location:" . SITEURL . "registation.php");
        }
    }
    {
        //button not cliked
       // echo "Button not clicked";
    }

    ?>
</body>

=======
<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="SignInform.css">

</head>

<body>
    <div class="container">
        <h2>Registration Form</h2>
        <br>
        <?php
       
        if (isset($_SESSION['duplicate-email'])) // checking whether the session set or not
        {
            echo $_SESSION['duplicate-email']; //displaying session messsage
            unset($_SESSION['duplicate-email']); // revoming session message
        }
        ?>
        <form action="" method="post">
            <label for="Full Name">Full Name</label>
            <input type="text" id="full" name="full_name" required>

            <label for="user_name">User Name</label>
            <input type="text" id="user_name" name="user_name">



            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="Password">Password</label>
            <input type="password" id="password" name="password">

            <label type="address">Address</label>
            <input type="text" id="address" name="address">

            <label for="Phn no">Phone Number</label>
            <input type="tel" id="phn no" name="phn_no">
            <br><br>

            <input type="submit" value="Submit" name="submit" class="btn-normal">
            <p>Already have a account?

                <a href="<?php echo SITEURL;?>logIn.php">Sign In</a>
            </p>


        </form>
    </div>
    <?php
    if (isset($_POST['submit']))
     {
        //button is clicked
       // echo "button clicked";

        //1.get the data from the form
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']); //md5 is encrypted function
        $address = $_POST['address'];
        $phone = $_POST['phn_no'];


        if ($user_name == null)
         {
            // Title is empty or null
            $_SESSION['add'] = '<div class="error">UserName cannot be empty. Please enter a valid username.</div>';
            // Redirect to add category page
            header("location:" . SITEURL . "registation.php");
            exit(); // Ensure script stops execution after redirect
        }
        //check if the email is already exist
        $sql = "SELECT * from user where user_email='$email'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        $count = mysqli_num_rows($res);

        if ($count > 0) 
        {
            $_SESSION['duplicate-email'] = '<div class="error">Email is already exist.</div>';
            // Redirect to add category page
            header("location:" . SITEURL . "registation.php");
            exit(); // Ensure script stops execution after redirect
        }

        //2.sql query to save data into the database
        $sql2 = "INSERT INTO user
        set 
       	full_name='$full_name',
        user_name='$user_name',
        user_email='$email',
        password='$password',
        user_address='$address',
        phone_number=$phone

        ";

        //execute the query
        $result = mysqli_query($conn, $sql2) or die(mysqli_error($conn));


        //4.Check whether the (query is executed )data is inserted or not and display appropriate message

        if ($result == TRUE)
         {
            //data inserted
            //echo "Data inserted";
            //create a session variable to display the message
            $_SESSION['userlogin'] =$user_name;  // variable name add
            $_SESSION['customerEmail']=$email; 
            $_SESSION['customerId']=mysqli_insert_id($conn); 

            // Redirect page to manage admin
            header('location:'.SITEURL.'checkout.php');
            
        } else 
        {
            // failed to insert data
            //echo "failed to insert data";

            //create a session variable to display the message
            $_SESSION['userlogin'] = '<div class="error">Failed to add Admin</div>';  // variable name add
            // Redirect page to add admin
            header("location:" . SITEURL . "registation.php");
        }
    }
    {
        //button not cliked
       // echo "Button not clicked";
    }

    ?>
</body>

>>>>>>> d4ddf238279708925d35d94052317b6051982ed6
</html>