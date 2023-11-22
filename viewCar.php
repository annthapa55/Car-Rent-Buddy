<!--
This php script displays all the available cars in the system to the administrator.
The status of the corresponding car can also be changed. 
-->

<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        // Start the session if no session is ON
        session_start();
        require_once("class_User.php");
    }
?>
<?php
    require_once("class_user.php");
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
        <title>View Car</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body >  
        <?php 
            $currentUser->viewCars();                     
            //serialzing current logged in user 
            $_SESSION['currentUser'] = serialize($currentUser); 
        ?>
    </body>
</html>
