<!--
    This php script creates table "car" in database "my_rent_buddy"
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
                $sql = "CREATE TABLE car
                (
                    carID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    carPlateNo VARCHAR(30) NOT NULL,
                    carModel VARCHAR(30) NOT NULL,
                    carType VARCHAR(50) NOT NULL,
                    carStatusID INT NOT NULL,
                    carCostPerDay DECIMAL(5,2) NOT NULL,
                    FOREIGN KEY(carStatusID) REFERENCES car_status(statusID)
                )";

                if ($conn ->query($sql) === TRUE)
                {
                    echo "Table car created successfully!";
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
