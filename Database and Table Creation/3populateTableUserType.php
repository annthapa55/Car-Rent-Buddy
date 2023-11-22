<!--
    This php script populates table "user_type" of database "my_rent_buddy"
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

            //populate table user_type
            $userType1 = 'Administrator';
            $userType2 = 'Renter';
            try 
            {
                //populate table user_type
                $sql = "INSERT INTO user_type  (userType) 
                    VALUES ( '$userType1'),
                    ( '$userType2')
                    ";


                if ($conn ->query($sql) === TRUE)
                {
                    echo "Table user_type populated successfully!";
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
