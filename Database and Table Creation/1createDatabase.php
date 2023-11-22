<!--
    This php script creates database "my_rent_buddy"
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Create Database</title>
    </head>
    <body>
        <?php

            $ErrorMsgs = array();
            $servername = "localhost";
            $username = "root";
            $password = "";

            try 
            {
                $conn = new mysqli($servername, $username, $password);

                $sql = "CREATE DATABASE my_rent_buddy";

                if ($conn ->query($sql) === TRUE)
                {
                    echo "Database created successfully!";
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
