<!--
This php script registers displays the form with fields for registering the user. 
-->

<!--
    Deleting any active sessions.
-->
<?php
    session_start();
    $_SESSION = array();
    session_destroy();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body>
        <?php 
            /**
             * Function retrieves the roles stored in "user_type" database.
             * Making it dynamic rather than hardcoding.
             */
            function getAvailableRoles()
            {
                //including script for the database connection.
                include ("inc_myRentBuddyDB.php");

                //getting allowed roles from the database table "user_type:
                $sql = "SELECT userTypeID, userType FROM user_type";

                $qRes = $conn->query($sql);

                //creating select element with available roles in the database table
                echo " <select name ='role'>";
                while (($Row = $qRes->fetch_row())!== NULL)
                {
                    echo "<option value = '$Row[0]'> $Row[1] </option>";
                    
                }
                echo "</select><br/> <br/>";
            }  
                      
        ?>
        <div >
            <div class = "divRegister">
                <h2>Registration</h2>
                <!-- User registration Form-->
                <form method="post" action="addUserDB.php" >
                <p>Enter First Name: <input type="text" name="firstName" /></p>
                <p>Enter Last Name: <input type="text" name="lastName" /></p>
                <p>Enter Phone: <input type="text" name="phone" /></p>
                <p>Enter Email: <input type="text" name="email" /></p>
                <p>Enter Password: <input type="password" name="registerPassword" /></p>
                <p>Select Role: <?php getAvailableRoles();?></p>
                <input type="reset" name="reset" value="Reset" />
                <input type="submit" name="register" value="Register" />
                </form>
            </div>
        </div>
    </body>
</html>
