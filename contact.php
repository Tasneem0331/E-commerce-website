<?php include('header.php');?>
<?php
 if(isset($_POST['submit']))
 {
 
     $username=$_POST['name'];
     $email=$_POST['email'];
     $subject=$_POST['subject'];
     $message=$_POST['message'];

     //write sql
    
    $sql= "INSERT INTO customer_query (name,email,subject,message)
    VALUES ( '$username', '$email','$subject','$message')";

    //execute the query
    $res=mysqli_query($conn,$sql);
    
    //if send message successfully then send a session message
    if($res){
        $_SESSION['send message']="<div class='success'>send message successfully.</div>";
        header('location:'.SITEURL.'contact.php');
    }
    else{

        $_SESSION['send message']="<div class='error'>Failed to send message.</div>";
        header('location:'.SITEURL.'contact.php');
    }

}
?>

        <section id="page-header" class="about-header">
        
            <h2>#Let's_talk</h2>
         
            <p>LEAVE A MESSAGE, we love to hear from you!</p>
          
        </section>

        <section id="contact_details" class="section-p1">
            <div class="details">
                <span>GET IN TOUCH</span>
                <h2>Visit one of our agency location or contact us today</h2>
                <h3>Head Office</h3>
                <div>
                    <li>
                        <i class="fa-sharp fa-solid fa-map-location"></i>
                        <p>Rajshahi Saheb Bazar Zero Point</p>
                    </li>
                    <li>
                        <i class="fa-regular fa-envelope"></i>
                        <p>contact @example.com</p>
                    </li>

                    <li>
                        <i class="fa-solid fa-phone"></i>
                        <p>contact@example</p>
                    </li>
                    <li>
                        <i class="fa-regular fa-clock"></i>
                        <p>Everyday: 8.00 am to 11.00 pm</p>
                    </li>
                </div>

            </div>

            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3634.4547244365694!2d88.59989999999999!3d24.3654799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fbef959df5df87%3A0xfc4cc04b1eff3bab!2sSaheb%20Bazar%20Zero%20Point!5e0!3m2!1sen!2sbd!4v1728205288400!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>



        </section>

        <section id="form-details">
            <?php
            
            if (isset($_SESSION['send message'])) // checking whether the session set or not
                {
                    echo "<br>";
                    echo $_SESSION['send message']; //displaying session messsage
                    unset($_SESSION['send message']); // revoming session message
                   
                } 
        ?>
            <form action="" method="post">
                <span>LEAVE A MESSAGE</span>
                <h2>We love to hear from you</h2>
                <input type="text" name="name" placeholder="Your name" required>
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="text" name="subject" placeholder="Subject" >
                <textarea name="message" id="" placeholder="Your Message" cols="30" rows="10"></textarea>
                <input type="submit"  name="submit" value="Submit" class="btn-normal " >
            </form>

        </section>

 
        <section id="newsletter" class="section-p1 section-m1">
            <div class="news">
                <h4>Sign Up For Newsletter</h4>
                <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>

            </div>
            <div class="form">
                <input type="text" placeholder="Your email address">
                <button class="normal">Sign Up</button>

            </div>

        </section>


          <?php include('footer.php')?>

        <script src="script.js"></script>
    </body>
</html>