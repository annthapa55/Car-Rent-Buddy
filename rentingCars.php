<!--
php script displays the table with all the cars that the user is currently renting. 
It also provides the functionality of returning these currently rented cars.
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
    if(isset($_SESSION['user']))
     /**
     * unserializing the saved user object if it has been already set. Else creating new User Object
     * */
    {
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
        <title>Previously Rented Car</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "renterBackground">
        <!--Log out section -->
        <div  class ="divLogoutContent">
            <div class ="divLogout">
                <p><a href='myRentBuddyTemplate.php'> Logout </a></p>
            </div>
            <?php         
                $currentUser->rentingCars();                                
            ?>
        </div>
    </body>
</html>
