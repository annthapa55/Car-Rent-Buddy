<!--
php script creates a new object of class "Car" based on the carID of the requested car for rent. 
It does so by calling the function of class "User", performing
necessary calculations and setting the relevant properties of the car object. 
-->
<?php
if (session_status() === PHP_SESSION_NONE) 
{
    // Start the session if no session has been started
    session_start();
}
?>
<?php
    //including classes "User" and "Car".
    require_once("class_user.php");
    require_once("class_car.php");
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
        <title>Rent Car</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "renterBackground">  
        <?php 
            //variable for counting the errors
            $errors = 0;
            $errorMsg = "";
            //getting ID of the selected car for rent request.
            $carID = $_GET['carID'];
            
            //creating the object of class "Car" via function call and unserializing the car object
            $currentUser->setCarObject($carID);
            $currentCar = unserialize($_SESSION['car']);

            //getting the selected rent date  and converting it into Year-Month-Day format.
            $rentDate = $_POST ['rentDate'];
            $rentDate = new DateTime($rentDate);
            $rentDate = $rentDate->format('Y-m-d');

            //getting the selected return date  and converting it into Year-Month-Day format.
            $toBeReturnedDate = $_POST ['returnDate'];
            $toBeReturnedDate = new DateTime($toBeReturnedDate);
            $toBeReturnedDate = $toBeReturnedDate->format('Y-m-d');

            /**
             * finding the difference between the selected return date and rent date. The rent date
             * will be stored as toBeReturnedDate in the database.
             **/
            $diff = abs(strtotime($toBeReturnedDate) - strtotime($rentDate));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            //total rent days calculated from entered rent date and return date
            $totalRentDays = $days + $months*30 + $years *365;

            
            if( $toBeReturnedDate > $rentDate)//If the selected return date is greater than rent date, the total rent days does not change
            {
                $totalRentDays  = $totalRentDays ;
            }
            else if ( $toBeReturnedDate ===  $rentDate)//If the selected return date is equal to the rent date, the total rent days should be counted as 1
            {
                $totalRentDays = 1;
            }
            else//If the selected return date is less to the rent date, the total rent days should be negative to indicate error.
            {
                $totalRentDays  = - $totalRentDays ;
            }


            // No of rented days can not be negative
            if($totalRentDays < 0)
            {
                $errorMsg =  $errorMsg . " Return date can not be less than rent date. ";
                $errors++;
            }

            //No of rented days can not be more than 30 days as car can be rented for maximum of 30 days.
            else if($totalRentDays > 30 )
            {
                $errorMsg =  $errorMsg . " Car can be rented for maximum of 30 days. ";
                $errors++;
            }
            
            //calculating total cost 
            $costPerDay = $currentCar->getCarCostPerDay();
            $totalCost =  (float)$costPerDay * (float)$totalRentDays ;
           
            //displaying error message for invalid inputs
            if($errors > 0)
            {
                echo "<div class = 'divNotification'>";
                echo "<p><b>".$errorMsg."</b></p>";
                echo "</div>";
                //hyper link for "Available Functionalities" page
		        echo"<p> <a href='renterFunctionalities.php?". SID . "'> HomePage </a> </p>\n";
            }
             
            //setting relevant properties of Car object and serializing it under session variable 'car'
            else
            {
                $currentCar->setTotalDaysRent($totalRentDays);
                $currentCar->setRentDate($rentDate);
                $currentCar->setToBeReturnedDate($toBeReturnedDate);
                $currentCar->setTotalCostNormal($totalCost);
                $_SESSION['car'] = serialize($currentCar);  
                $currentUser->rentCarRequest();   
            }
                   
        ?>
    </body>
</html>


