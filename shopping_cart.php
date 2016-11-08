<?php

session_start(); 
$_SESSION['cart'] = $_GET['cars'];
$cart = $_SESSION['cart'];

function printCars(){
    global $cart;
    
    if(empty($cart)){
        echo "<tr><td>Cart is empty!</tr></td>";
        echo "</table>";
    }
    else{
        foreach($cart as $element ) 
            echo "<tr><td>" . $element . "</tr></td>";
        echo "</table>
            <form action='reserve.php'>
            <input type='submit' value='Reserve' />
            </form>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" href="css/shopping_cart.css" type="text/css" />
    </head>
    
    <body>
        <main>
            
            <h1>Laguna Seca Race Way Rentals</h1>
            
            <!-- print cart -->
            <table align="center">
                <th>Cars to Reserve</th>
                <?=printCars()?>
                
            <!-- return home -->
            <form action="index.php">
                <input type="submit" value="Return to Index" />
            </form>
            
        </main>
    </body>
</html>
