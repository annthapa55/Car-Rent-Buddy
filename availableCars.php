<!--
    This script displays all the available cars for the renter to rent in the system.
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
        if (isset($_SESSION['user']))
        {
            $currentUser = unserialize($_SESSION['user']);
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
        <title>Available Cars</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "renterBackground">  
        <div  class ="divLogoutContent">
            <div class ="divLogout">
                <p><a href='myRentBuddyTemplate.php'> Logout </a></p>
            </div>
            <?php 
                //calling class function to show available cars to rent      
                $currentUser->availableCars();                               
            ?>
        </div>
    </body>
</html>
