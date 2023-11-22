<!--
php script validates the input search parameters and
queries the database with validated search parameters.
Either all, or any combination of search parameters can 
be entered. However, AT LEAST one parameter should be entered. 
-->
<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        // Start the session if no session is ON
        session_start();
    }
?>
<?php
    require_once("class_user.php");
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
        <title>Search Car</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "renterBackground">
        <div >
            
            <div class ="dynamicContent">                
                <?php 
                    $plateNo = stripslashes($_POST['plateNo']);
                    $model = stripslashes($_POST['model']);
                    $type = stripslashes($_POST['type']);

                    //displaying error message if all the search parameter is empty
                    if(empty($plateNo) and empty($model) and empty($type))
                    {
                        echo "<div class ='divNotificationSearch'>";
					    echo "<p><b> Please enter data at least in one search parameter.</b></p>";
					    echo "</div>";
                        include ("searchCar.php");
                    }
                    else
                    {
                        $currentUser->SearchCarRenter($plateNo,$model,$type); 
                    }
                                      
                    //serialzing current logged in user 
                    $_SESSION['user'] = serialize($currentUser); 
                ?>
            </div>
        
       
        </div>
    </body>
</html>
