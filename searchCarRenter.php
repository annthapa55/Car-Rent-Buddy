<!--
php script creates the form for entering the search parameters.
-->
<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        /// Start the session if no session has been started
        session_start();
    }
?>
<?php
    require_once("class_user.php");
    if (class_exists("User")) 
    {
        if (isset($_SESSION['user']))
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

    } 

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Search Car</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "renterBackground">
       <div >
            <div class ="divLogout">
                <p><a href='myRentBuddyTemplate.php'> Logout </a></p>
            </div>
            <div class = "divFunctionActive">
                <h2>Search Car</h2>
                <!-- Form for entering search parameters -->
                <form method="post" action="searchCarRenterDB.php" >
                    <p>Enter Plate No: <input type="text" name="plateNo" /></p>
                    <p>Enter Model: <input type="text" name="model" /></p>
                    <p>Enter Type: <input type="text" name="type" /></p>
                    <input type="submit" name="searchCar" value="Search" />
                </form>
                <?php
                
                ?>
            </div>
            <p> <a href='renterFunctionalities.php?'> HomePage </a> </p>;
        </div>
        <?php
             //serialzing current logged in user 
             $_SESSION['user'] = serialize($currentUser);
        ?>
    </body>
</html>

