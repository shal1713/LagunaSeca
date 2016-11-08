<?php

session_start();
$cart = $_SESSION['cart'];

function printCars(){
    global $cart;
    
    if(empty($cart))
        echo "<tr><td>Cart is empty!</tr></td>";
    else
        foreach($cart as $element ) 
            echo "<tr><td>" . $element . "</tr></td>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Confirmation Page</title>
        <link rel="stylesheet" href="css/reserve.css" type="text/css" />
    </head>
    
    <body>
        <main>
            <h1>Thanks For Helping Pay Off These Cars!!!</h1>
            
            <table>
                <th>Cars Reserved</th>
                <?=printCars()?>
            </table>
            <br />
            
            <form action="index.php">
                <input type="submit" value="Return to Index" />
            </form>
        </main>
    </body>
</html>