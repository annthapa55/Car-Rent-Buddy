<!--
    This php script populates table "car_status" of database "my_rent_buddy"
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Populate Table</title>
    </head>
    <body>
        <?php
            //including script for the database connection.
            include 'inc_databaseConnect.php';

            //populate table car_status
            $status1 = 'Rented';
            $status2 = 'Available to rent';
            $status3 = 'Not available to rent';
            try 
            {
                //populate table car_status
                $sql = "INSERT INTO car_status(statusName) 
                    VALUES ( '$status1'),
                    ( '$status2'),
                    ( '$status3')
                    ";


                if ($conn ->query($sql) === TRUE)
                {
                    echo "Table car_status populated successfully!";
                }
            }   
            catch (mysqli_sql_exception $e) 
            {
                $ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
            }
            
            $conn->close();

        ?>
    </body>
</html>
