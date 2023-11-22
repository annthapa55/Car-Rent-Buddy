<!--
php script creates a new object of class "Car" based on the carID of the requested car for return. 
It does so by calling a function of class "User", performing
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
        <title>Return Car</title>
        <link rel ="stylesheet" type = "text/css" href="myRentBuddyStyle.css"/>
    </head>
    <body class = "renterBackground">  
        <?php 
            //variable for counting the errors
            $errors =0;
            $errorMsg ="";
            //getting ID of the selected car for rent request
            $carID = $_GET['carID'];

            //getting the selected return date  and converting it into Year-Month-Day format
            $returnDate = $_POST['returnDate'];
            $returnDate = new DateTime($returnDate);
            $returnDate = $returnDate->format('Y-m-d');

            /**
             * creating the object of class "Car" via function calls,
             * setting relevant properties of created car object and 
             * unserializing the object 
             */
            $currentUser->setCarObject($carID);
            $currentUser->setCarObjReturnProperties();
            $currentCar = unserialize($_SESSION['car']);
            
            //getting the rent date from the created car object and converting it into Year-Month-Day format
            $rentDate = $currentCar->getRentDate();
            $rentDate = new DateTime($rentDate);
            $rentDate = $rentDate->format('Y-m-d');

            //getting the toBeReturned date from the created car object and converting it into Year-Month-Day format
            $toBeReturnedDate = $currentCar->getToBeReturnedDate();
            $toBeReturnedDate = new DateTime($toBeReturnedDate);
            $toBeReturnedDate = $toBeReturnedDate->format('Y-m-d');

            //getting stored normal total cost for the rent transaction
            $totalCostNormal = (float) $currentCar->getTotalCostNormal();

            //calculating total actual rented days
            $diff = abs(strtotime($returnDate) - strtotime($rentDate));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $totalRentedDays = $days + $months*30 + $years *365;

            if( $returnDate > $rentDate)//If the selected return date is greater than stored rent date, the total rent days does not change
            {
                $totalRentedDays  = $totalRentedDays ;
            }

            else if ( $returnDate == $rentDate)//If the selected return date is equal to the stored rent date, the total rent days should be counted as 1
            {
                $totalRentedDays = 1;
            }
            else//If the selected return date is less to the rent date, the total rent days should be negative to indicate error.
            {
                $totalRentedDays  = - $totalRentedDays ;
            }
            /**
             * calculating penalty interval, which indicates the number of days the late fee
             * cost has to be applied.
             * late fee is $100 more than the normal cost per day.
             */
            $diff1 = abs(strtotime($returnDate) - strtotime($toBeReturnedDate));
            $years1 = floor($diff1 / (365*60*60*24));
            $months1 = floor(($diff1 - $years1 * 365*60*60*24) / (30*60*60*24));
            $penaltyInterval = floor(($diff1 - $years1 * 365*60*60*24 - $months1*30*60*60*24)/ (60*60*24));
            
            //if the return date is >= toBeReturned date, do not change the calculated penalty days else make it negative to indicate error
            if( $returnDate >= $toBeReturnedDate)
            {
                $penaltyInterval  = $penaltyInterval ;
            }
            else
            {
                $penaltyInterval  = - $penaltyInterval ;
            }
           
            //getting cost per day of the rental car from the current car object
            $costPerDay = (float) $currentCar->getCarCostPerDay();

            $totalCharge = 0;
            $penaltyAmount = 0;
            $penaltyRatePerDay = 0;
             /**
              * Checking for Invalid Inputs. 
              */

            // No of rented days can not be negative
            if($totalRentedDays < 0)
            {
                $errorMsg =  $errorMsg . " Return date can not be less than rent date. ";
                $errors++;
            }

             //No of rented days can not be more than 30 days as car can be rented for maximum of 30 days.
            else if($totalRentedDays > 30 )
            {
                $errorMsg =  $errorMsg . " Return date can not be more than 30 days. ";
                $errors++;
            }

            //for valid return date
            else
            {
                /**
                 * if the penalty interval is 0, total charge should be the stored normal charge as
                 * no late fee is applied 
                 * */
                if($penaltyInterval === 0)
                {
                    $totalCharge =  $totalCostNormal;
                }
                /**
                 * if the penalty interval is greater than 0, late fee is applied.
                 */
                elseif($penaltyInterval > 0)
                {
                    $penaltyRatePerDay = $costPerDay + 100;
                    $penaltyAmount = $penaltyInterval * $penaltyRatePerDay;
                    $totalCharge = $totalCostNormal + $penaltyAmount;
                }
                /**
                 * if the penalty interval is less than 0, late fee is NOT applied.
                 */
                else
                {
                    $totalCharge = $costPerDay * $totalRentedDays;
                }

            }

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
                $currentCar->setPenaltyInterval($penaltyInterval);
                $currentCar->setReturnDate($returnDate);
                $currentCar->setTotalDaysRent($totalRentedDays);
                $currentCar->setTotalCostNormal($totalCharge);
                $_SESSION['car'] = serialize($currentCar); 
                $currentUser->returnCarRequest();
            }          
        ?>
    </body>
</html>
