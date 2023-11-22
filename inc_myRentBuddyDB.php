<!--
    This scripts connects to the database "my_rent_buddy"
-->
<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "my_rent_buddy";
    $ErrorMsgs = array();

    // Create connection to the database "my_rent_buddy"
    try 
    {
        $conn = new mysqli( $serverName,  $userName, $password,  $databaseName );
    }
    catch (mysqli_sql_exception $e) 
    {
        $ErrorMsgs[] = "The database server is not available. Error: " . $e->getCode() . "." . $e->getMessage();
    }
?>


