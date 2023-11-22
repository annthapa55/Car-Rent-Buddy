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
                $sql = "CREATE TABLE user_type
                (
                    userTypeID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    userType VARCHAR(30) NOT NULL
                )";

                if ($conn ->query($sql) === TRUE)
                {
                    echo "Table user_type created successfully!";
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
