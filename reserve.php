<!DOCTYPE html>
<html>

<head>
    <title> </title>
</head>
<style>
    body {
        text-align: center;
        margin: 0 auto;
        background: url("images/mario.png");
    }
</style>

<body>
    <h1 align="center">Thanks For Helping Pay Off This Cars!!!</h1>

    <?php
        session_start();
        $cart = $_GET['cars'];

        echo "<table border=1 cellspadding=20 align=center> ";
        echo "<tr><th>Cars Reserved</th></tr>";

        foreach($cart as $element ) {
            echo "<tr><td>" . $element . "</tr></td>";
        }
        echo "</table><br>"
        ?>

        <form action="index.php">
            <input type="submit" value="Return to Index" />
        </form>
</body>

</html>