
<br />
<style>
    body {
      text-align: center;  
      margin: 0 auto;
      background: url("mario.png");
     
    }
</style>
<body>
     <h1 align="center">Laguna Seca Race Way Rentals</h1>
<form align="center" action="reserve.html">
    <?php
session_start(); //You must always use this line to start or resume a session
//session_destroy();
//print_r($_GET['cars']);

//  if (!isset($_SESSION['cars'])) {
 //    $_SESSION['cars'] = array();  //initializing session variable
 // }

$cart = $_GET['cars'];


//foreach($cart as $element)
//{   
//    if (!in_array($element, $SESSION['cars'])) { //avoid duplicate device Ids
//       $_SESSION['cars'][] = $element;
 //   }
 //   echo $element . "<br/>";/
//}
echo "<table border=1 cellspadding=20 align=center> ";
echo "<tr><th>Cars to reserve</th></tr>";

foreach($cart as $element ) {
    echo "<tr><td>" . $element . "</tr></td>";
}
echo "</table><br>"
?>
<input type="submit" value="Reserve" />
</form>
</body>