<!--
php script displays the form for adding new car for administrator
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
            <div class = "divFunctionActive">
                <h2>Add Car</h2>
                <!-- Form for getting the car information -->
                <form method="post" action="addCarDB.php" >
                    <p>Enter Plate No: <input type="text" name="plateNo" /></p>
                    <p>Enter Model: <input type="text" name="model" /></p>
                    <p>Enter Type: <input type="text" name="type" /></p>
                    <p>Enter CostPerDay: <input type="text" name="costPerDay" /></p>
                     <!-- Calling User class function to populate "select" element with database values. -->
                    <p>Select Status: <?php $currentUser->getAvailableStatus();?></p>
                    <input type="reset" name="reset" value="Reset" />
                    <input type="submit" name="addCar" value="Add Car" />
                </form>
                <?php
                
                ?>
            </div>
        </div>
    </body>
</html>
