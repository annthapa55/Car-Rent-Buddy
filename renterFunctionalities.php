<!--
php script displays available functionalities/services as submit buttons for renter.
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
        <title>Renter</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    
    <body class = "renterBackground">
        <div  class ="divLogoutContent">
            <div class ="divLogout">
                <p><a href='myRentBuddyTemplate.php'> Logout </a></p>
            </div>

            <div>
                <div class ="renterHome">
                
                    <?php
                        echo " <div class = 'divWelcome'>";
                        echo '<div class = "welcomeBtn">';
                            echo '<table>';
                                echo "<tr>";
                                    //Submit button for viewing available cars to rent
                                    echo "<td> ";
                                    echo "<form method='post' action='availableCars.php'> \n";
                                    echo "<input type='submit' class ='btnNavigate' value='Available Cars'/> ";
                                    echo "</form>";
                                    echo "</td>" ;     
                                    //Submit button for viewing previously rented and returned cars
                                    echo "<td> ";
                                    echo "<form method='post' action='rentedCars.php'> \n";
                                    echo "<input type='submit' class ='btnNavigate' value='Rented Cars'/> ";
                                    echo "</form>";
                                    echo "</td>";      
                                    //Submit button for viewing currently renting cars
                                    echo "<td> ";
                                    echo "<form method='post' action='rentingCars.php'> \n";
                                    echo "<input type='submit' class ='btnNavigate' value='Renting Cars'/> ";
                                    echo "</form>";
                                    echo "</td>";     
                                    //Submit button for searching car 
                                    echo "<td> ";
                                    echo "<form method='post' action='searchCarRenter.php'> \n";
                                    echo "<input type='submit' class ='btnNavigate' value='Search Car'/> ";
                                    echo "</form>";
                                    echo "</td>";    
                                echo "</tr>";
        
                            echo '</table>';
                        echo '</div>';
        
                    echo " </div>";
                    ?>
                
                </div>
                
            </div>
            
        </div>
    </body>
    
</html>
