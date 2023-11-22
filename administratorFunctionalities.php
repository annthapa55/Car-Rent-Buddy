<!--
This php script displays the available functionalities for the administrator at the left panel
and the dynamic content displayed at the right panel as per the selected function 
-->
<?php
if (session_status() === PHP_SESSION_NONE) 
{
    // Start the session if no session has been started
    session_start();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administrator</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    
    <body class = "administratorBackground">
        <div  class ="divLogoutContent">
            <!-- Div for Loging out of the system -->
            <div class ="divLogout">
                <p><a href='myRentBuddyTemplate.php'> Logout </a></p>
            </div>

            <div>
                <div class = "btnNavigation">
                    <!-- Navigation with "Add Car", "View Cars", "Search Car" and "Log out" navigation elements-->   
                    <?php include ("administratorNavigation.php"); ?>
                </div>
                <div class ="dynamicContent">
                    <!-- Start of Dynamic Content section -->
                    <?php
                        if (isset($_GET['content'])) 
                        {
                            switch ($_GET['content']) 
                            {
                                //dynamic content for adding car in the system
                                case 'Add Car':
                                    include('addCar.php');
                                    break;
                                //dynamic content for viewing all the car in the system along with changing status functionality
                                case 'View Cars':  
                                    include('viewCar.php');
                                    break;
                                //dynamic content for searching car with the combination of entered car plate no, car model and car type. 
                                case 'Search Car': 
                                        include('searchCar.php');
                                        break;
                                //dynamic content for getting the information about the available services/functionalities of an administrator. 
                                case 'Information':  
                                    include('administratorHomepage.html');
                                    break;
                                //displaying information page by default
                                default:
                                    include('administratorHomepage.html');
                                    break;
                            }
                        }
                        else // when NO dynamic link has been selected
                            include('administratorHomepage.html');
                    ?>
                
                </div>
                
            </div>
            
        </div>
    </body>
    
</html>
