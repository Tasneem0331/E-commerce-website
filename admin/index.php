<?php include('partials/menu.php'); ?>
        <!-------main content section start ------------------>
        <div class="main-content" >

            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <?php
                   if(isset($_SESSION['login']))
                   {
                    echo $_SESSION['login']; //displaying session messsage
                    unset($_SESSION['login']); // revoming session message
                   }
                ?>
                <br><br>
           
               <div class="col-4 text-center">
                <h1>5</h1>
                categories
               </div>
              <div class="col-4 text-center">
                <h1>5</h1>
                categories
              </div>
              <div class="col-4 text-center">
                <h1>5</h1>
                categories
              </div>
      
              <div class="col-4 text-center">
                <h1>5</h1>
                categories
              </div>
              <div class="clearfix"></div>
            </div>

        </div>
        
        <!-------main content section end ------------------>
        
      <?php include('partials/footer.php'); ?>