<!--
This php script creates the landing page of the website where
navigation bar with Login, Register and Homepage is at the left panel,
and the corresponding dynamic page, as per user's selection, is displayed
at right.
-->

<!--
    Deleting any active sessions. 
-->
<?php
    session_start();
    $_SESSION = array();
    session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>HomePage</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    
    <body class ="navigationAndContent">
        <div >
            <div class = "btnNavigation">
                <!-- Navigation with "Login" "Register" and "Home Page" navigation elements-->   
                <?php include ("homepageNavigation.html"); ?>
            </div>
            <div class ="dynamicContent">
                <!-- Start of Dynamic Content section -->
                <?php
                    if (isset($_GET['content'])) 
                    {
                        switch ($_GET['content']) 
                        {
                            //when login button is clicked
                            case 'Login':
                                include('login.php');
                                break;
                            //when Register button is clicked
                            case 'Register':  
                                include('registerUser.php');
                                break;
                            //when Homepage button is clicked
                            case 'HomePage':  
                                    include('myRentBuddyHome.html');
                                    break;
                            //default case with website description
                            default:
                                include('myRentBuddyHome.html');
                                break;
                        }
                    }
                    else // No link has been selected, display website description
                        include('myRentBuddyHome.html');
                ?>
                <!-- End of Dynamic Content section -->

            </div>

        </div>
    </body>
    
</html>
