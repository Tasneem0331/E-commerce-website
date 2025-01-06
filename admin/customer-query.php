<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
       <h1>customer Query</h1>
       <br><br>
         <?php
         
          
        
           if(isset($_SESSION['delete query'])) // checking whether the session set or not
              {
                echo $_SESSION['delete query']; //displaying session messsage
                unset($_SESSION['delete query']); // revoming session message
              }
        

          ?>
                <br> <br>
                <table class="tbl_full">
                    <tr>
                        <th>Serial No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Actions</th>   <!-------------- update or delete option-------->
                    </tr>
                    <?php
                      //Query to get all category from database
                      $sql="SELECT * from customer_query order by id desc";

                      //execute the query
                      $res=mysqli_query($conn,$sql);
                      
                      //count the rows
                      $count=mysqli_num_rows($res);

                      //create serial_no variable and assign value as 1
                      $sn=1;


                      //check whether we have data in the database or not
                      if($count>0)
                      {
                        //we have data in DB
                        //get the data and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $name=$row['name'];
                            $email=$row['email'];
                            $subject=$row['subject'];
                            $message=$row['message'];

                            //to write html inside php i will break the php and start the php again and between them i write html code
                            ?>


                            <tr>
                               <td><?php echo $sn++;?></td>
                               <td><?php echo $name;?></td>
                               <td><?php echo $email;?></td>

                               <td><?php echo $subject;?></td>

                               <td><?php echo $message;?></td>
                               <td>
                                
                                 <a href="<?php echo SITEURL;?>admin/delete-customer-query.php?id=<?php echo $id; ?>" class="btn-danger"> Delete Query</a>
                           
                                </td>
            
                            </tr>
                

                            <?php

                        }

                      }
                      else
                      {
                        //we dont have data in DB
                        //we'll display the message inside table
                        ?>

                        <tr>
                            <td colspan="2"><div class='error'>No customer Query Available</div></td>

                        </tr>

                        <?php

                      }
                    ?>

                </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>