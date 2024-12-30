<?php include('config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Ecommarce website</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/e38eb37d3c.js" crossorigin="anonymous"></script>

    </head>
    <body>
        <section id="header">
            <a href="<?php echo SITEURL;?>index.php"><img src="image/logo.jpeg" alt="" height="70px" width="60px"></a>
            <div id="search-bar">
                <form action="<?php echo SITEURL;?>product-search.php" method="post">
                    <input type="search" name="search" placeholder="Search in gifty" required >
                    <input type="submit" name="submit" value="Search"  class="button normal">
                </form>
            </div>
            <div>
                <ul id="navbar">
                    <li><a  href="<?php echo SITEURL;?>index.php">Home</a></li>
                    <li><a href="<?php echo SITEURL;?>category.php">Category</a></li>
                    <li><a href="<?php echo SITEURL;?>shop.php">Shop</a></li>
                    <li><a href="<?php echo SITEURL;?>about.php">About</a></li>
                    <li><a href="<?php echo SITEURL;?>contact.php">Contact</a></li>
                    <li><a href="<?php echo SITEURL;?>logIn.php">Log In</a></li>
                    <li><a href="<?php echo SITEURL;?>user-logout.php">Log Out</a></li>
                   

                    <li id="lg-bag"><a href="<?php echo SITEURL;?>cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                    <a href="#" id="close"><i class="fa-regular fa-circle-xmark"></i></a>
                </ul>
            </div>
        </section>
            <div id="mobile">
                <a href="<?php echo SITEURL;?>cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <i id="bar" class="fas fa-outdent"></i>
            </div>
        </section>