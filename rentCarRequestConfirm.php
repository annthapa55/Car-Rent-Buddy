<!--
php script displays the relevant information about the renting transaction and 
adds a record to "assigned_car" table when the user confirms the rent request
-->
<?php
if (session_status() === PHP_SESSION_NONE) 
{
    // Start the session if no session has been started
    session_start();
}
?>
<?php
    //including classes "User" and "Car"
    require_once("class_user.php");
    require_once("class_car.php");
    if(isset($_SESSION['user']))
    {
        /**
         * unserializing the saved user object if it has been already set. Else creating new User Object
         * */
        $currentUser = unserialize($_SESSION['user']);
    }
    else
    {
        $currentUser = new User();
    }

  
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rent Car Confirm</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "renterBackground">  
        <?php
            $currentUser->rentCarRequestConfirm();           
        ?>
    </body>
</html>
