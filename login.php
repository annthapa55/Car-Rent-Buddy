<!--
This php script creates the Login In page where the user inputs the email and password
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
        <title>Log In</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body >
      
        <div >
            <div class ="divRegister">
                <h2>Log In</h2>
                <!-- Log In Form-->
                <form method="post" action="verifyLogin.php" >
                <p>Enter Email: <input type="text" name="email" /></p>
                <p>Enter password: <input type="password" name="userPassword" /></p>
                <input type="reset" name="reset" value="Reset" />
                <input type="submit" name="login" value="Log In" />
                </form>
            </div>
        </div>
    </body>
</html>
