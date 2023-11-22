<!--
This php script verifies user Login and shows available functionalities upon successful login
else displays Error message for invalid login.
-->

<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        // Start the session if no session is ON
        session_start();
        require_once("class_User.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>verify login</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "administratorBackground">
        <?php
            // Including php file for database connection
            include ('inc_myRentBuddyDB.php');
            echo " <div>";
            $errors = 0;
            try 
            {
                //SQL query to get user data from the database with the entered email and password
                $TableName = "user";
                $sql = "SELECT userID, firstName, lastName, phone, email, userTypeID FROM $TableName" . 
                " where email='" . stripslashes($_POST['email']) ."' 
                and userPassword='" . md5(stripslashes($_POST['userPassword'])) . "'";
                $qRes = $conn->query($sql);
             
                //Displaying welcome message and creating the object of class User
                if ($qRes !== FALSE) 
                {
                    if($qRes->num_rows > 0)
                    {
                        $Row = $qRes->fetch_row();
                        //Welcome message
                        $userName = $Row[1] . " " . $Row[2];
                        echo '<div >';
                        echo "<h2><b>Welcome back, $userName!</b></h2>\n";
                        echo "</div>";
    
                        //creating the object of Class User and setting its properties from the database row values
                        $currentUser = new User();
                        $currentUser->setUserID($Row[0]);
                        $currentUser->setFirstName($Row[1]);
                        $currentUser->setLastName($Row[2]);
                        $currentUser->setPhone($Row[3]);
                        $currentUser->setEmail($Row[4]);
                        $currentUser->setUserType($Row[5]);
                        $_SESSION['user'] = serialize($currentUser);
                       
                    }
                    else
                    {
                        echo "<p>The username/password " . " combination entered is not valid. </p>\n";
                        $errors++;
                    }
                

                }


            }

            //catching exception
            catch (mysqli_sql_exception $e) 
            {
                $ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
                echo "$ErrorMsgs";
                $errors++;
            }
            
            //Displaying message if the invalid username/password is entered or the database connection is not successful
            if ($errors > 0) 
            {
                echo "<p>Please use your browser's BACK button to return to LogIn page.</p>\n";
            }

            //Displaying available functionalities/services based on user type (administrator, renter)
            if ($errors == 0) 
            {                
                if($currentUser->getUserType() == 1)
                {
                    
                    include ("administratorFunctionalities.php");
                }
                else
                {
                   include ("renterFunctionalities.php");
                }                
            }
            echo " </div>";
        ?>
    </body>
</html>
