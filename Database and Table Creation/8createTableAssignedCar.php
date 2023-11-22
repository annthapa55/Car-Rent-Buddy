<!--
    This php script creates table "assigned_car" in database "my_rent_buddy"
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
                //create table car
                $sql = "CREATE TABLE assigned_car
                (
                    assignID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    userID INT NOT NULL,
                    carID INT NOT NULL,
                    rentDate DATE, 
                    toBeReturnedDate DATE,
                    returnDate DATE,
                    totalCost DECIMAL(10,2),
                    FOREIGN KEY(userID) REFERENCES user(userID),
                    FOREIGN KEY(carID) REFERENCES car(carID)
                )";

                if ($conn ->query($sql) === TRUE)
                {
                    echo "Table 'assigned_car' created successfully!";
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
