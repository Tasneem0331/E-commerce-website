<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin </h1>
        <br>
        <?php
                   if(isset($_SESSION['add'])) // checking whether the session set or not
                   {
                    echo $_SESSION['add']; //displaying session messsage
                    unset($_SESSION['add']); // revoming session message
                   }
                ?>
                <br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="Full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your UserName">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
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
 $full_name=$_POST['Full_name'];
   $userName=$_POST['username'];
   $password=md5($_POST['password']);//md5 is a encryption function
   if ($userName==null)
   {
   // Title is empty or null
   $_SESSION['add'] = '<div class="error">UserName cannot be empty. Please enter a valid username.</div>';
   // Redirect to add category page
   header("location:" . SITEURL . "admin/add-admin.php");
   exit(); // Ensure script stops execution after redirect
   } 

  //2.sql query to save the data into the database
  $sql="INSERT INTO tbl_admin set
  full_name='$full_name',
  username='$userName',
  password='$password'
  ";
  //3. Executing query and saving data in database
  $res= mysqli_query($conn,$sql) or die(mysqli_error($conn)); //resove this will hold true or false value is the query is executed sccessfully then the res value will be true and vice versa
  
  //4.Check whether the (query is executed )data is inserted or not and display appropriate message

  if($res==TRUE)
  {
    //data inserted
    //echo "Data inserted";
    //create a session variable to display the message
    $_SESSION['add']='<div class="success">Admin added Successfully</div>';  // variable name add
    // Redirect page to manage admin
    header("location:".SITEURL."admin/manage-admin.php");

  }
  else 
  {
    // failed to insert data
    //echo "failed to insert data";

    //create a session variable to display the message
    $_SESSION['add']='<div class="error">Failed to add Admin</div>';  // variable name add
    // Redirect page to add admin
    header("location:".SITEURL."admin/add-admin.php");

  }


}

/*else
{
    //button not cliked
    echo "Button not clicked";
}*/
?>