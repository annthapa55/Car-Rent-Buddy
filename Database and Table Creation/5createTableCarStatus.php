<!--
    This php script creates table "user_type" in database "my_rent_buddy"
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Create Table</title>
    </head>
    <body>
        <?php
            //including script for the database connection.
            include 'inc_databaseConnect.php';
            
            try 
            {
                //create table user_type
                $sql = "CREATE TABLE car_status
                (
                    statusID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    statusName VARCHAR(30) NOT NULL
                )";

                if ($conn ->query($sql) === TRUE)
                {
                    echo "Table car_status created successfully!";
                }
            }   
            catch (mysqli_sql_exception $e) 
            {
	            $ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
            }

            $conn->close()
        ?>
    </body>
</html>
