<br />
<style>
    body {
        text-align: center;
        margin: 0 auto;
        background: url("images/mario.png");
    }
</style>

<body>
    <h1 align="center">Laguna Seca Race Way Rentals</h1>
    <form action="index.php">
        <input type="submit" value="Return to Index" />
    </form>
    <form align="center" action="reserve.php">
        <?php
        session_start(); 
        $cart = $_GET['cars'];



        echo "<table border=1 cellspadding=20 align=center> ";
        echo "<tr><th>Cars to Reserve</th></tr>";

        foreach($cart as $element ) {
            echo "<tr><td>" . $element . "</tr></td>";
        }
        echo "</table><br>"
        ?>
            <input type="submit" value="Reserve" />
    </form>
</body>