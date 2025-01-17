<?php include('partials/menu.php'); ?>
        <!-------main content section start ------------------>
        <div class="main-content" >

            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br><br><br>

                <?php
                   if(isset($_SESSION['add']))
                   {
                    echo $_SESSION['add']; //displaying session messsage
                    unset($_SESSION['add']); // revoming session message
                   }

                   if(isset($_SESSION['delete']))
                   {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);

                   }
                   
                   if(isset($_SESSION['update']))
                   {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);

                   }
                   if(isset($_SESSION['user_not_found']))
                   {
                    echo $_SESSION['user_not_found'];
                    unset($_SESSION['user_not_found']);

                   }
                   
                   if(isset($_SESSION['pass_not_match']))
                   {
                    echo $_SESSION['pass_not_match'];
                    unset($_SESSION['pass_not_match']);

                   }
                   if(isset($_SESSION['change_pass']))
                   {
                    echo $_SESSION['change_pass'];
                    unset($_SESSION['change_pass']);

                   }
                   


                ?>
<br><br><br>


                <!----------Button to add admin----------------->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br><br>
                <table class="tbl_full">
                    <tr>
                        <th>Serial No</th>
                        <th>Full name</th>
                        <th>User Name</th>
                        <th>Actions</th>   <!-------------- update or delete option-------->
                    </tr>

                    <?php
                    //write sql code for get all the data from database
                    $sql="SELECT * from tbl_admin";
                    //execute the query
                    $res =mysqli_query($conn,$sql);

                    //check whether the query is executed or not
                    if($res==TRUE)
                    {
                        //count rows to check whether we have data in database
                        $count=mysqli_num_rows($res);   //function to get all the rows in database

                        $sn=1; //create a variable and assign the value

                        //check the number of rows

                        if($count>0){
                            //we have data in database
                            while($rows=mysqli_fetch_assoc($res))  //will get all the rows from database which are stored in res variable 
                            {
                                //using while loop to get all the data from data base
                                //and while loop will executed as long  as we have data in database 

                                //get individual data

                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username= $rows['username'];


                                //display the values in our table
                                ?>
                               
                                 <tr>
                                    <td><?php echo $sn++?></td>
                                    <td><?php echo $full_name?></td>
                                    <td><?php echo $username?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary"> Update admin</a>
                                        <a href="<?php echo SITEURL?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> Delete admin</a>
                                        
                                    </td>
                                 <tr>

                             <?php 

                                
                            }

                        }

                        else{

                            // we have no data in database
                        }

                    }
                    ?>
                    
                   
                    
                </table>
            </div>

        </div>
        
        <!-------main content section end ------------------>
        
 <?php include('partials/footer.php'); ?>