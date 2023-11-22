<!--
This php script changes the status of the car as per administrator's selection of status. 
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
        /**
         * unserializing the saved user object if it has been already set. Else creating new User Object
         * */
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
        <title>Change Car Status</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "administratorBackground">
        <div >
            <div class = "btnNavigation">
                <!-- Navigation with "Add Car", "View Cars", "Search Car" and "Log out" navigation elements-->   
                <?php include ("administratorNavigation.php"); ?>
            </div>

            <div class ="dynamicContent">                
                <?php 
                    $carID = 0;
                    if (isset($_GET['carID']))
                    {
                        $carID = $_GET['carID'];
                    }
                    $changedStatus = $_POST['carStatus'];
                    //calling the function from user class to change the status of the selected car. 
                    $currentUser->changeCarStatus($carID,$changedStatus);

                ?>
            </div>
        
       
        </div>
    </body>
</html>
