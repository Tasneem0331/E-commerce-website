<?php
session_start();
echo "here";

if (isset($_GET['product_id'])) {
    // Get the product ID and size
    $product_id = $_GET['product_id'];
    $size = $_GET['size'];

    // Check if quantity is set, otherwise set it to 1
    if (isset($_GET['quantity'])) {
        $quantity = $_GET['quantity'];
    } else {
        $quantity = 1;
    }

    // Check if the cart is already set in the session
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    } else {
        $cart = array();
    }

    // Check if the product already exists in the cart
    if (isset($cart[$product_id])) {
        // If the product exists, update the quantity and size
        $cart[$product_id]['quantity'] = $quantity;
        $cart[$product_id]['size'] = $size; // Update the size if needed
    } else {
        // If the product does not exist, add it to the cart
        $cart[$product_id] = array('quantity' => $quantity, 'size' => $size);
    }

    // Update the session cart
    $_SESSION['cart'] = $cart;

    // Optional: Print the cart for debugging purposes
    echo '<pre>';
    print_r($_SESSION['cart']);
    echo '</pre>';

    // Redirect to the cart page if needed
     header('Location: cart.php');
}
?>
