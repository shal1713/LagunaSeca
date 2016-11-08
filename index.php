<?php

session_start();

// to login
$host = "localhost";
$dbname = "laguna";
$username = "web_user";
$password = "s3cr3t";

// Creates a database connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Setting Errorhandling to Exception
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

function getSearch()
{
    global $dbConn;
    
    // get all records initially
    $sql = "SELECT * 
            FROM Make 
            NATURAL JOIN Model 
            NATURAL JOIN CarType
            WHERE 1" ;
            
    // search button pressed
    if (isset($_GET['filter'])){

        $namedParameters = array();
        
        // make has been specified
        if (!empty($_GET['make'])){
            //using Named Parameters to prevent SQL Injection
            $sql = $sql . " AND make LIKE :make "; 
            $namedParameters[':make'] = "%" . $_GET['make'] . "%";
        }
        
        // model has been specified
        if(!empty($_GET['model'])){
            $sql = $sql . " AND model LIKE :model";
            $namedParameters[':model'] = "%" . $_GET['model'] . "%";
        }
        
        // car type is selected
        if(isset($_GET['cartype'])){
            $sql = $sql . " AND cartype LIKE :cartype";
            $namedParameters[':cartype'] = "%" . $_GET['carType'] . "%";
        }
        
        $sql = $sql . " ORDER BY model";
        if($_GET['sort'] == "DESC")
            $sql = $sql . " DESC";
    }
            
    $statement= $dbConn->prepare($sql); 
    //Always pass the named parameters, if any
    $statement->execute($namedParameters); 
    $records = $statement->fetchALL(PDO::FETCH_ASSOC);  
    
    echo "<form action='shopping_cart.php' method=get>";
    echo "<table border=1 cellpadding=20 >"; ;
    echo "<tr><th cellpadding=20 cellspacing= 50 colspan=6>" . "Results". "</th></tr>";
      

    // column headers
    echo "<tr>";
    echo "<td>Select</td>";
    echo "<td>Description</td>";
    echo "<td>Year</td>";
    echo "<td>Make</td>";
    echo "<td>Model</td>";
    echo "<td>Type</td>";
    echo "</tr>";
    
    // table data
    foreach($records as $record) {
        echo "<tr><td><input type='checkbox' name=cars[]    value =" . $record['model'] . "></td>";
        echo "<td cellspacing=10 ><a target='DescriptioniFrame' href='description/".$record['modelId'].".html' > Description </a></td>";
        echo "<td cellspacing=10 >" . $record['year'] . "</td><td cellspacing=10>" . $record['make'] . "</td><td cellpadding=20>". $record['model'] .  "</td><td cellspacing=10>". $record['cartype'] . "</td><tr>";
    }
    echo "<br></form>";
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Laguna Seca </title>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
    </head>
    
    <body>
        <main>
            <form method="get">
                <h1>Laguna Seca Race Way Rentals</h1>
                Make: <input type="text" maxlength="13" placeholder="Enter Make" name="make">
                Model: <input type="text" maxlength="10" placeholder="Enter Model" name="model">
                Type:
                <select name="type">
                    <option value="Super Car">Super Car</option>
                    <option value="Luxury">Luxury</option>
                    <option value="Economic">Economic</option>
                    <option value="Off Road">Off Road</option>
                </select>
                List By Type In:
                <select name="sort">
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <input type="submit" name="filter" value="Search">
                
            </form>
            <br />
            <div style="float:right">
                <iframe name="DescriptioniFrame" align="none" src="getDescription.php" frameborder="0"> </iframe>
            </div>
            <form action="shopping_cart.php"> 
            <?php
            getSearch();
            ?>
            <input type="submit" name="reserve" value="Reserve">
            </form>
        </main>
    </body>
    
</html>