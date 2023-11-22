<!--
php script creates the form for entering the search parameters for administrator.
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
    if (class_exists("User")) 
    {
        if (isset($_SESSION['currentUser']))
        {
            /**
            * unserializing the saved user object if it has been already set. Else creating new User Object
            * */
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
        <title>Search Car</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "administratorBackground">
       <div >
            <div class = "divFunctionActive">
                <h2>Search Car</h2>
                <!-- Form for entering search parameters -->
                <form method="post" action="searchCarDB.php" >
                    <p>Enter Plate No: <input type="text" name="plateNo" /></p>
                    <p>Enter Model: <input type="text" name="model" /></p>
                    <p>Enter Type: <input type="text" name="type" /></p>
                    <input type="submit" name="searchCar" value="Search" />
                </form>
                <?php
                
                ?>
            </div>
            
        </div>
        <?php
             //serialzing current logged in user 
             $_SESSION['currentUser'] = serialize($currentUser);
        ?>
    </body>
</html>

