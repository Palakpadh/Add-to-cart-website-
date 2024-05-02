<?php 
    session_start();

    // Function to remove item from cart
    function removeFromCart($index) {
        if(isset($_SESSION['cart'][$index])) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array
        }
    }

    // Check if item removal requested
    if(isset($_POST['remove']) && is_numeric($_POST['remove'])) {
        removeFromCart($_POST['remove']);
        header('Location: ' . $_SERVER['PHP_SELF']); // Reload the page
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="cart.css">
    <style>
        
    </style>
</head>
<body>
    <h1><pre> &hearts; GALLERY: &hearts;</pre></h1>
    <?php 
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION["cart"];
        $total = 0; 
        echo "<form method=\"post\">";
        echo "<table>";
        echo "<tr>";
        echo "<th>Product</th>";
        echo "<th>Price</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        foreach($cart as $index => $items){
            $productName = $items['productname'];
            $productPrice = $items['price'];
            $total = $total + $productPrice;
            echo "<tr>";
            echo "<td>$productName</td>";
            echo "<td>$productPrice $</td>";
            echo "<td><button type=\"submit\" name=\"remove\" value=\"$index\">Remove</button></td>"; // Button to remove item
            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";
        echo "<h3>Total : $total $</h3>";
    } else {
        echo "Your cart is empty.";
    }
    ?>
</body>
</html>
