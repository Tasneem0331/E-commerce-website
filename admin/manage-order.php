<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Manage Order</h1>
    <br><br><br>
              
                <table class="tbl_full">
                    <tr>
                        <th>Serial No</th>
                        <th>User Name</th>
                    
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Receiver Name</th>
                        <th>Receiver Address</th>
                        <th>Receiver Contact</th>
                        <th>Payment Mode</th>
                        <th>Order Date</th>
                        <th>action</th>
                    </tr>

                    <?php
                    //get all the orders from the database
                    $sql="SELECT * from tbl_order ORDER BY order_id desc";
                    //execute query
                    $res=mysqli_query($conn,$sql);
                    //count the rows
                    $count=mysqli_num_rows($res);
                    if($count>0)
                    {
                        //order available
                        $SL_NO=1;
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get all the order details
                            $order_id=$row['order_id'];
                            $user_id=$row['user_id'];


                            $sql2="SELECT user_name from user where user_id=$user_id";
                            $res2=mysqli_query($conn,$sql2);
                            $row2=mysqli_fetch_assoc($res2);
                            $username=$row2['user_name'];

                            $total_price=$row['total_price'];
                            $Order_Status=$row['order_status'];
                            $receiver_name=$row['receiver_name'];
                            $receiver_address=$row['receiver_address'];
                            $receiver_phn=$row['receiver_phn'];
                            $payment_mode=$row['payment_mode'];
                            $order_date=$row['order_date'];
                            ?>
                              <tr>
                            <td><?php echo $SL_NO++;?></php></td>
                            <td><?php echo $username;?></td>
                            <td><?php echo $total_price;?></td>
                            <td><?php echo $Order_Status;?></td>
                            <td><?php echo $receiver_name;?></td>
                            <td><?php echo $receiver_address;?></td>
                            <td><?php echo $receiver_phn;?></td>
                            <td><?php echo $payment_mode;?></td>
                            <td><?php echo $order_date;?></td>
                            <td>
                              <!-- <a href="#" class="btn-secondary"> Update Order</a> -->
                              
                               <a href="<?php echo SITEURL;?>admin/order_details.php?id=<?php echo $order_id;?>" class="btn-secondary">Order Details</a>
                               
                            </td>
                        </tr>
                            <?php

                        }
                    }
                    else
                    {
                        //order not available
                        echo "<tr>
                        <td colspan='10'>Orders not Available.</td>
                        </tr>";
                    }
                    ?>
                   
                </table>
    </div>

</div>


<?php include('partials/footer.php'); ?>