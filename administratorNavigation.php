<!--
    This script contains the submit buttons which serve as various functionalities/services for administrator.
-->
<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        // Start the session if no session is ON
        session_start();
    }
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form action="administratorFunctionalities.php" method="get">
            <input type="submit" class ="btnNavigate" name="content" value="Add Car" /><br /><br />
            <input type="submit" class ="btnNavigate" name="content" value="View Cars" /><br /><br />
            <input type="submit" class ="btnNavigate" name="content" value="Search Car" /><br /><br />
            <input type="submit" class ="btnNavigate" name="content" value="Information" /><br /><br />
        </form>
    </body>
</html>

