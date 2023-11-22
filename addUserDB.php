<!--
This php script validates the user input for adding a user to the system.
-->
<?php
if (session_status() === PHP_SESSION_NONE) 
{
    // Start the session if no session has been started
    session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class ="navigationAndContent">
        <div >
            <div class = "btnNavigation">
                <!-- Navigation with "Login" "Register" and "Home Page" navigation elements-->   
                <?php include ("homepageNavigation.html"); ?>
            </div>
            <div class ="dynamicContent">
                <?php 

                    if (isset($_POST['register'])) 
                    {
                        $error = 0;
                        $firstName = "";
                        $lastName ="";
                        $email ="";
                        $phone = "";
                        $password ="";
                        //getting selected role (Administrator or Renter)
                        $userType = $_POST['role'];

                        //global variable to store error  message
                        $GLOBALS['errorDisplayMessage'] = " ";

                        //Validating first name
                        if(empty($_POST['firstName']))
                        {
                            $error++;
                            $GLOBALS['errorDisplayMessage']  .= " First name can not be empty. ";
                        }
                        else
                        {
                            $firstName = stripslashes($_POST['firstName']);
                        }

                        //Validating last name
                        if(empty($_POST['lastName']))
                        {
                            $error++;
                            $GLOBALS['errorDisplayMessage']  .= " Last name can not be empty. ";
                        }
                        else
                        {
                            $lastName = stripslashes($_POST['lastName']);
                        }
                        
                        //Validating phone number
                        if (empty($_POST['phone'])) 
                        {
                            $error++;
                            $GLOBALS['errorDisplayMessage']  .= " Phone can not be empty. ";
                        }
                        else
                        {
                            $phone = stripslashes($_POST['phone']);
                            //validating if the entered telephone is an Australian number, with 10 digits starting from "04".
                            if (!preg_match("/04\d{8}/", $phone)) 
                            {
                                $GLOBALS['errorDisplayMessage']  .= " Invalid Phone format: 10 digits starting with '04' required. ";
                                $errorCount++;
                                
                                $phone = "";
                                    
                            }

                        }

                        //Validing email
                        if (empty($_POST['email'])) 
                        {
                            $error++;
                            $GLOBALS['errorDisplayMessage']  .= " Email can not be empty. ";
                        }
                        else 
                        {
                            $email = stripslashes($_POST['email']);
                            if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email) == 0) 
                            {
                                $error++;
                                $GLOBALS['errorDisplayMessage']  .= " You need to enter a valid email. ";
                                $email = "";
                            }
                        }
                        //Validating password
                        if(empty($_POST['registerPassword']))
                        {
                            $error++;
                            $GLOBALS['errorDisplayMessage']  .= " Password can not be empty. ";
                            
                        }

                        //Making connection to the database 
                        include ("inc_myRentBuddyDB.php");

                        //adding new new user to the database if all the inputs are valid
                        if($error == 0)
                        {
                            try 
                            {
                                //Adding new user to the database  table "user"
                                $sql = "INSERT INTO user (firstName,lastName,phone,email,userPassword,userTypeID)
                                    VALUES ( '$firstName', '$lastName', '$phone', '$email', " . "'" . md5(stripslashes($_POST['registerPassword'])) . "', $userType)";

                                if ($conn ->query($sql) === TRUE)
                                {
                                    echo "<p><b>User registered successfully!</b></p>";
                                }
                            }   
                            catch (mysqli_sql_exception $e) 
                            {
                                $ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
                            }
                            
                            $conn->close();
                        }
                        //displaying error message for invalid inputs
                        else
                        {
                            echo $GLOBALS['errorDisplayMessage'];

                        }

                    }           
                ?>
            </div>
        </div>   
    </body>
</html>



