<!--
This php script validates the user input for adding the car to the system.
-->
<?php
if (session_status() === PHP_SESSION_NONE) 
{
    // Start the session if no session has been started
    session_start();
}
?>
<?php
    require_once("class_user.php");
    /**
     * unserializing the saved user object if it has been already set. Else creating new User Object
     * */
    if (class_exists("User")) 
    {
        if (isset($_SESSION['currentUser']))
        {
            $currentUser = unserialize($_SESSION['currentUser']);
        }      
        else 
        {
            $currentUser = new User();
        }    

    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Car</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "administratorBackground">
        <div >
            <div class = "btnNavigation">
                <!-- Navigation bar with "Add Car", "View Cars", "Search Car" and "Information" elements-->   
                <?php include ("administratorNavigation.php"); ?>
            </div>
        <?php              
            $error = 0;
            $plateNo = "";
            $model ="";
            $type ="";
            $costPerDay = "";
            //getting car status to change
            $status = $_POST['carStatus'];

            //global variable to store error 
            $GLOBALS['errorDisplayMessage'] = " ";

            //Validating plateNo input
            if(empty($_POST['plateNo']))
            {
                $error++;
                $GLOBALS['errorDisplayMessage']  .= " Plate number can not be empty. ";
            }
            else
            {
                $plateNo = stripslashes($_POST['plateNo']);
            }

            //Validating model input
            if(empty($_POST['model']))
            {
                $error++;
                $GLOBALS['errorDisplayMessage']  .= " Model can not be empty. ";
            }
            else
            {
                $model = stripslashes($_POST['model']);
            }

            //Validationg type input
            if(empty($_POST['type']))
            {
                $error++;
                $GLOBALS['errorDisplayMessage']  .= " Type can not be empty. ";
            }
            else
            {
                $type = stripslashes($_POST['type']);
            }

            //Validationg costPerDay input
            if(empty($_POST['costPerDay']))
            {
                $error++;
                $GLOBALS['errorDisplayMessage']  .= " Cost/Day can not be empty. ";
            }
            else
            {
                $costPerDay = stripslashes($_POST['costPerDay']);
            }

            //Adding car to the database table "car". 
            if($error == 0)
            {
                try 
                {
                    //Adding new car to the database  table "car"
                    $sql = "INSERT INTO car (carPlateNo, carModel, carType, carStatusID,carCostPerDay)
                        VALUES ( '$plateNo', '$model', '$type',$status, $costPerDay)";

                    $conn = $currentUser->getConn();

                    //displaying success message
                    if ($conn->query($sql) === TRUE)
                    {
                        echo "<div class = 'divNotification'>";
                        echo "<p><b>Car added successfully!</b></p>";
                        echo "</div>";
                    }
                }   
                //catching exceptions
                catch (mysqli_sql_exception $e) 
                {
                    $ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
                    echo "<div class = 'divNotification'>";
                    echo "<p><b>". $ErrorMsgs."</b></p>";
                    echo "</div>";
                }
                
                
            }

            //Displaying error message for invalid inputs
            else
            {
                echo "<div class = 'divNotification'>";
                echo "<p><b>".$GLOBALS['errorDisplayMessage']."</b></p>";
                echo "</div>";
            }
        ?>
        </div>
    </body>
</html>
