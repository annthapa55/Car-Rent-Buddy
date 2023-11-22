<!--
    This php script creates table "user" in database "my_rent_buddy"
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
                //create table user
                $sql = "CREATE TABLE user 
                (
                    userID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    firstName VARCHAR(30) NOT NULL,
                    lastName VARCHAR(30) NOT NULL,
                    phone VARCHAR(50) NOT NULL,
                    email VARCHAR(50) NOT NULL,
                    userPassword VARCHAR(50) NOT NULL,
                    userTypeID INT NOT NULL,
                    FOREIGN KEY(userTypeID) REFERENCES user_type(userTypeID)
                )";

                if ($conn ->query($sql) === TRUE)
                {
                    echo "Table user created successfully!";
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
