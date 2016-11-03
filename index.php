<?php

$host = "localhost";
$dbname = "laguna";
$username = "web_user";
$password = "s3cr3t";

//Creates a database connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Setting Errorhandling to Exception
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


function getSearch()
{
    global $dbConn;
    $sql = "SELECT * 
            FROM Make 
            NATURAL JOIN Model 
            NATURAL JOIN CarType" ;  //Getting all records 
            
    if (isset($_GET['submit'])){
    //form has been submitted

        $namedParameters = array();
        
        
        
        if (!empty($_GET['make'])){
            //deviceName has some value
            
            // Following sql works but it doesn't prevent SQL INJECTION
           //  $sql = $sql . " AND deviceName LIKE  '%" . $_GET['deviceName'] . "%'";
           $sql = $sql . " AND make LIKE  :deviceName "; //using Named Parameters to prevent SQL Injection
           
           $namedParameters[':make'] = "%" . $_GET['make'] . "%";
           
        }
        
        if(!empty($_GET['model'])){
            //type has been selected
            
            $sql = $sql . " AND model = :model";
            
            $namedParameters[':model'] = $_GET['model'];
        }
        
        if(isset($_GET['cartype'])){
            $sql = $sql . " AND cartype = :cartype";
            $namedParameters[':cartype'] = "cartype";
        }
        

    
    }
            
      $statement= $dbConn->prepare($sql); 
      $statement->execute($namedParameters); //Always pass the named parameters, if any
      $records = $statement->fetchALL(PDO::FETCH_ASSOC);  
      
      //print_r($records);
      echo "<form action='shopping_cart.php' method=get>";
      echo "<table border=1 cellpadding=20 >"; ;
      echo "<tr><th cellpadding=20 cellspacing= 50 colspan=6>" . "Results". "</th></tr>";
      foreach($records as $record) {
          echo "<tr><td><input type='checkbox' name=cars[]    value =" . $record['model'] . "></td>";
          echo "<td cellspacing=10 ><a target='DescriptioniFrame' href='description/".$record['model'].".html' > Description </a></td>";
          echo "<td cellspacing=10 >" . $record['year'] . "</td><td cellspacing=10>" . $record['make'] . "</td><td cellpadding=20>". $record['model'] .  "</td><td cellspacing=10>". $record['cartype'] . "</td><tr>";
      }
      echo "<br></form>";
   
    
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Laguna Seca </title>
    </head>
    <style>
        body,h1 {
          text-align: center;  
          margin: 0 auto;
          background: url("mario.png");
         
        }
    table
    {
                  text-align: center;  
          margin: 0 auto;
        background: white;
    }
    </style>
    <body>
        <form method="get">
            <h1>Laguna Seca Race Way Rentals</h1>
            Make: <input type="text" maxlength="13" placeholder="Enter Make" name="make">
            Model: <input type="text" maxlength="10" placeholder="Enter Model" name="model">
            Type:
            <select>
                <option name="supercar" value="Super Car">Super Car</option>
                <option name="luxury" value="Luxury">Luxury</option>
                <option name="luxury" value="Economic">Economic</option>
                <option name="off road" value="Off Road">Off Road</option>
            </select>
            List By Type In:
            <select>
                <option name="asc" value="asc">Ascending</option>
                <option name="desc" value="desc">Descending</option>
            </select>
            <input type="submit" value="Search">
            
        </form>    
        <div style="float:right">
            <iframe name="DescriptioniFrame" align="none" src="getDescription.php" frameborder="0"> </iframe>
        </div>
        <form action="shopping_cart.php"> 
        <?php
        getSearch();
        ?>
        <input type="submit" value="continue">
        </form>
    </body>
    
    
</html>