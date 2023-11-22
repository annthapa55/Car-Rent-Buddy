
<?php
if (session_status() === PHP_SESSION_NONE) 
{
    // Start the session if no session has been started
    session_start();
}
//including Car class as some of the member functions of User class created objects from Car class
require_once("class_car.php");
class User 
{
	/**
	 * private properties
	 */
	private $conn = NULL;
	private $userID = "";
	private $firstName = "";
	private $lastName ="";
	private $phone ="";
	private $email = "";
	private $userType = "";

	//class constructor
	function __construct() 
    {
		include("inc_myRentBuddyDB.php");
		$this->conn = $conn;
	}
	
	/**
	 * setter functions
	 */
	public function setUserID($userID) 
	{
		$this->userID = $userID;
	}

	public function setFirstName($firstName) 
	{
		$this->firstName = $firstName;
	}

	public function setLastName($lastName) 
	{
		$this->lastName = $lastName;
	}

	public function setPhone($phone) 
	{
		$this->phone = $phone;
	}

	public function setEmail($email) 
	{
		$this->email = $email;
	}

	public function setUserType($userType) 
	{
		$this->userType = $userType;
	}
	/**
	 * getter functions
	 */
	public function getConn() 
	{
		return $this->conn;
	}

	public function getUserID() 
	{
		return $this->userID;
	}

	public function getFirstName() 
	{
		return $this->firstName;
	}

	public function getLastName() 
	{
		return $this->lastName;
	}

	public function getPhone() 
	{
		return $this->phone;
	}

	public function getEmail() 
	{
		return $this->email;
	}

	public function getUserType() 
	{
		return $this->userType;
	}

	/**
	 * function creates the "select" html element with 
	 * the available roles from the database table user_type
	 */
	public function getAvailableRoles()
	{
		try 
		{
			//getting allowed roles from the database table "user_type:
			$sql = "SELECT userTypeID, userType FROM user_type";

			$qRes = $this->conn->query($sql);

			echo " <select name ='role'>";
			while (($Row = $qRes->fetch_row())!== NULL)
			{
				echo "<option value = '$Row[0]'> $Row[1] </option>";
				
			}
			echo "</select><br/> <br/>";
		}   
		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
		}

	}


	/**
	 * function creates the "select" html element with 
	 * the available car status from the database table car_status
	 */
	function getAvailableStatus()
	{
		try
		{
			//getting allowed roles from the database table "user_type:
			$sql = "SELECT statusID, statusName FROM car_status";

			$qRes = $this->conn->query($sql);

			if ($qRes->num_rows > 0)
			{
				echo " <select name ='carStatus'>";
			while (($Row = $qRes->fetch_row())!== NULL)
			{
				echo "<option value = '$Row[0]'> $Row[1] </option>";
				
			}
			echo "</select><br/> <br/>";
			}

		}

		//catching exception
		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "$ErrorMsgs";
		}
	}  


	/**
	 * function creates the "select" html element with 
	 * the available car status (without "rented" status) from the database table car_status
	 */
	function getStatusExceptRented()
	{
		try
		{
			//getting allowed roles from the database table "user_type:
			$sql = "SELECT statusID, statusName FROM car_status";

			$qRes = $this->conn->query($sql);

			if ($qRes->num_rows > 0)
			{
				echo " <select name ='carStatus'>";
			while (($Row = $qRes->fetch_row())!== NULL)
			{
				if($Row[0] != 1)
				{
					echo "<option value = '$Row[0]'> $Row[1] </option>";
				}
				
				
			}
			echo "</select><br/> <br/>";
			}

		}

		//catching exception
		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "$ErrorMsgs";
		}
	} 
	
	
	/**
	 * function creates the "select" html element with 
	 * the available car status (without "Available to rent" status) from the database table car_status
	 */
	function getStatusExceptAvailable()
	{
		try
		{
			//getting allowed roles from the database table "user_type:
			$sql = "SELECT statusID, statusName FROM car_status";

			$qRes = $this->conn->query($sql);

			if ($qRes->num_rows > 0)
			{
				echo " <select name ='carStatus'>";
			while (($Row = $qRes->fetch_row())!== NULL)
			{
				if($Row[0] != 2)
				{
					echo "<option value = '$Row[0]'> $Row[1] </option>";
				}
				
				
			}
			echo "</select><br/> <br/>";
			}

		}

		//catching exception
		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "$ErrorMsgs";
		}
	}  


	/**
	 * function creates the "select" html element with 
	 * the available car status (without "Not available to rent" status) from the database table car_status
	 */
	function getStatusExceptNotAvailable()
	{
		try
		{
			//getting allowed roles from the database table "user_type:
			$sql = "SELECT statusID, statusName FROM car_status";

			$qRes = $this->conn->query($sql);

			if ($qRes->num_rows > 0)
			{
				echo " <select name ='carStatus'>";
			while (($Row = $qRes->fetch_row())!== NULL)
			{
				if($Row[0] != 3)
				{
					echo "<option value = '$Row[0]'> $Row[1] </option>";
				}
				
				
			}
			echo "</select><br/> <br/>";
			}

		}

		//catching exception
		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "$ErrorMsgs";
		}
	}  


	/**
	 * function for displaying all the available cars in the system to the administrator.
	 */
	public function viewCars()
	{
		try
		{
			
			echo "<div class = 'divViewCar' >";
				//obtaining cars that are rented
				$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay FROM car WHERE carStatusID = 1";

				$qRes = $this->conn->query($sql);

				//table for displaying rented cars in the system
				echo "<div>";
				echo"<h2> Rented cars:</h2>";
				echo "<table border='1' width='80%' >\n";
				echo "<tr>\n";
				echo " <th class = 'thViewCar'>ID </th>\n";
				echo " <th class = 'thViewCar'>Plate No</th>\n";
				echo " <th class = 'thViewCar'>Model</th>\n";
				echo " <th class = 'thViewCar'>Type</th>\n";
				echo " <th class = 'thViewCar'>Cost Per Day</th>\n";
				echo " <th class = 'thViewCar'>Change Status</th>\n";
				echo "</tr>\n";
				if ($qRes->num_rows > 0)
				{
					while (($Row = $qRes->fetch_row())!== NULL)
					{
						echo "<tr>";
						echo " <td>" . htmlentities($Row[0]) . "</td>\n";
						echo " <td>" . htmlentities($Row[1]) . "</td>\n";
						echo " <td>" . htmlentities($Row[2]) . "</td>\n";
						echo " <td>" . htmlentities($Row[3]) . "</td>\n";
						echo " <td>" . htmlentities($Row[4]) . "</td>\n";
						echo " <td>";
                            /**
                             * form that contains change status button to change the status of the
							 * corresponding car
                             * */
                            echo "<form method='post'". "action='changeStatusRequest.php?&carID=" .$Row[0]. "'> \n";
							$this->getStatusExceptRented();
                            echo "<input type='submit', name='changeStatus', value='confirm'/> ";
                            echo "</form>";
                        echo"</td>\n";
						echo "</tr>";
					}
					
				}
				echo "</table>\n";
				echo "</div>";
				//obtaining cars that are available to rent
				$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay FROM car WHERE carStatusID = 2";

				$qRes = $this->conn->query($sql);

				echo "<div>";
				//table for displaying cars that are available to rent
				echo"<h2> Cars available to rent:</h2>";
				echo "<table border='1' width='80%' >\n";
				echo "<tr>\n";
				echo " <th class = 'thViewCar'>ID </th>\n";
				echo " <th class = 'thViewCar'>Plate No</th>\n";
				echo " <th class = 'thViewCar'>Model</th>\n";
				echo " <th class = 'thViewCar'>Type</th>\n";
				echo " <th class = 'thViewCar'>Cost Per Day</th>\n";
				echo " <th class = 'thViewCar'>Change Status</th>\n";
				echo "</tr>\n";
				if ($qRes->num_rows > 0)
				{
					while (($Row = $qRes->fetch_row())!== NULL)
					{
						echo "<tr>";
						echo " <td>" . htmlentities($Row[0]) . "</td>\n";
						echo " <td>" . htmlentities($Row[1]) . "</td>\n";
						echo " <td>" . htmlentities($Row[2]) . "</td>\n";
						echo " <td>" . htmlentities($Row[3]) . "</td>\n";
						echo " <td>" . htmlentities($Row[4]) . "</td>\n";
						echo " <td>";
                            /**
                             * form that contains change status button to change the status of the
							 * corresponding car
                             * */
                            echo "<form method='post'". "action='changeStatusRequest.php?&carID=" .$Row[0]. "'> \n";
							$this->getStatusExceptAvailable();
                            echo "<input type='submit', name='changeStatus', value='confirm'/> ";
                            echo "</form>";
                        echo"</td>\n";
						echo "</tr>";
					}
					
				}
				echo "</table>\n";
				echo "</div>";

				//obtaining cars that are NOT available to rent
				$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay FROM car WHERE carStatusID = 3";

				$qRes = $this->conn->query($sql);

				echo "<div>";
				//table for displaying cars that are NOT available to rent
				echo"<h2> Cars not available to rent:</h2>";
				echo "<table border='1' width='80%' >\n";
				echo "<tr>\n";
				echo " <th class = 'thViewCar'>ID </th>\n";
				echo " <th class = 'thViewCar'>Plate No</th>\n";
				echo " <th class = 'thViewCar'>Model</th>\n";
				echo " <th class = 'thViewCar'>Type</th>\n";
				echo " <th class = 'thViewCar'>Cost Per Day</th>\n";
				echo " <th class = 'thViewCar'>Change Status</th>\n";
				echo "</tr>\n";
				if ($qRes->num_rows > 0)
				{
					while (($Row = $qRes->fetch_row())!== NULL)
					{
						echo "<tr>";
						echo " <td>" . htmlentities($Row[0]) . "</td>\n";
						echo " <td>" . htmlentities($Row[1]) . "</td>\n";
						echo " <td>" . htmlentities($Row[2]) . "</td>\n";
						echo " <td>" . htmlentities($Row[3]) . "</td>\n";
						echo " <td>" . htmlentities($Row[4]) . "</td>\n";
						echo " <td>";
                            /**
                             * form that contains change status button to change the status of the
							 * corresponding car
                             * */
                            echo "<form method='post'". "action='changeStatusRequest.php?&carID=" .$Row[0]. "'> \n";
							$this->getStatusExceptNotAvailable();
                            echo "<input type='submit', name='changeStatus', value='confirm'/> ";
                            echo "</form>";
                        echo"</td>\n";
						echo "</tr>";
					}
					
				}
				echo "</table>\n";
				echo "</div>";


			echo "</div>";
		}  
		
		 
		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}
	}
	
	/**
	 * function for creating the Car object and setting its properties from the database table "car" values
	 */
	public function setCarObject($carID)
	{
		try 
		{
			//Removing car object if it is already in session variable so that new object can be created and saved
			if(isset($_SESSION['car']))
			{
				$_SESSION['car'] = "";
			}
			//SQL query to get car data with given carID
			$sql = "SELECT carID, carPlateNo, carModel, carType, carStatusID, carCostPerDay 
			FROM car WHERE carID=".$carID;
			$qRes = $this->conn->query($sql);
						
			if ($qRes !== FALSE) 
			{
				if($qRes->num_rows > 0)
				{
					$Row = $qRes->fetch_row();
					
				
					//creating the object of class Car and setting its properties from the database table values
					$currentCar = new Car();
					$currentCar->setCarID($Row[0]);
					$currentCar->setCarPlateNo($Row[1]);
					$currentCar->setCarModel($Row[2]);
					$currentCar->setCarType($Row[3]);
					$currentCar->setCarStatusID($Row[4]);
					$currentCar->setCarCostPerDay($Row[5]);
					$_SESSION['car'] = serialize($currentCar);						

				}
			}
		}
		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}
	}

	/**
	 * function that unserializes the car object stored in session variable 'car' 
	 * and sets its properties from "assigned_car" database table
	 */
	public function setCarObjReturnProperties()
	{
		try 
		{
			$currentUser = unserialize($_SESSION ['user']);
			$userID = $currentUser->getUserID();

			$currentCar = unserialize($_SESSION ['car']);
			$carID = $currentCar->getCarID();

			//SQL query to get properties of the car in "assigned_car" table
			$sql = "SELECT rentDate, toBeReturnedDate, totalCost 
			FROM assigned_car WHERE carID=".$carID. " AND userID =".$userID;

			$qRes = $this->conn->query($sql);
						
			if ($qRes !== FALSE) 
			{
				if($qRes->num_rows > 0)
				{
					$Row = $qRes->fetch_row();
					
					//Setting additional properties relevant to rental
					$currentCar->setRentDate($Row[0]);
					$currentCar->setToBeReturnedDate($Row[1]);
					$currentCar->setTotalCostNormal($Row[2]);
					
					$_SESSION['car'] = serialize($currentCar);						

				}
			}
		}
		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}
	}

	/**
	 * function that performs search based on any combination of the car's plate number, model or type.
	 * It also allows the administrator to change the status of the resultant cars.
	 */
	public function searchCar($plateNo,$model,$type)
	{
		try
		{
			
			echo "<div class = 'divViewCar' >";
				
				//Search function when plateNo, model and type fields are obtained from the user
				if(!empty($plateNo) and !empty($model) and !empty($type))
				{
					$plateNo = "'%".$plateNo."%'";
					$model = "'%".$model."%'";
					$type = "'%".$type."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carPlateNo LIKE ".$plateNo."AND 
					carModel LIKE ".$model." AND 
					carType LIKE ".$type;
				}

				//Search function when plateNo and model are obtained from the user but type is not supplied 
				if(!empty($plateNo) and !empty($model) and empty($type))
				{
					$plateNo = "'%".$plateNo."%'";
					$model = "'%".$model."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carPlateNo LIKE ".$plateNo."AND 
					carModel LIKE ".$model;
				}

				//Search function when plateNo and type are obtained from the user but model is not supplied 
				if(!empty($plateNo) and empty($model) and !empty($type))
				{
					$plateNo = "'%".$plateNo."%'";
					$type = "'%".$type."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carPlateNo LIKE ".$plateNo."AND 
					carType LIKE ".$type;
				}

				//Search function when model and type are obtained from the user but plateNo is not supplied 
				if(empty($plateNo) and !empty($model) and !empty($type))
				{
					$model = "'%".$model."%'";
					$type = "'%".$type."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carModel LIKE ".$model."AND 
					carType LIKE ".$type;
				}
				
				//Search function when only plateNo is supplied
				if(!empty($plateNo) and empty($model) and empty($type))
				{
					$plateNo = "'%".$plateNo."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carPlateNo LIKE ".$plateNo;
				}

				
				//Search function when only model is supplied
				if(empty($plateNo) and !empty($model) and empty($type))
				{
					$model = "'%".$model."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carModel LIKE ".$model;
				}

				//Search function when only model is supplied
				if(empty($plateNo) and empty($model) and !empty($type))
				{
					$type = "'%".$type."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carType LIKE ".$type;
				}


				$qRes = $this->conn->query($sql);

				//table for displaying resultant searched cars obtained from search
				echo "<div>";
				echo"<h2> Searched Car:</h2>";
				echo "<table border='1' width='80%' >\n";
				echo "<tr>\n";
				echo " <th class = 'thViewCar'>ID </th>\n";
				echo " <th class = 'thViewCar'>Plate No</th>\n";
				echo " <th class = 'thViewCar'>Model</th>\n";
				echo " <th class = 'thViewCar'>Type</th>\n";
				echo " <th class = 'thViewCar'>Cost Per Day</th>\n";
				echo " <th class = 'thViewCar'>Status</th>\n";
				echo " <th class = 'thViewCar'>Change Status</th>\n";
				echo "</tr>\n";
				if ($qRes->num_rows > 0)
				{
					while (($Row = $qRes->fetch_row())!== NULL)
					{
						echo "<tr>";
						echo " <td>" . htmlentities($Row[0]) . "</td>\n";
						echo " <td>" . htmlentities($Row[1]) . "</td>\n";
						echo " <td>" . htmlentities($Row[2]) . "</td>\n";
						echo " <td>" . htmlentities($Row[3]) . "</td>\n";
						echo " <td>" . htmlentities($Row[4]) . "</td>\n";
						echo " <td>" . htmlentities($Row[5]) . "</td>\n";
						echo " <td>";
                            /**
                             * form that contains change status button to change the status of the
							 * searched car
                             * */
                            echo "<form method='post'". "action='changeStatusRequest.php?&carID=" .$Row[0]. "'> \n";
							$this->getAvailableStatus();
                            echo "<input type='submit', name='changeStatus', value='confirm'/> ";
                            echo "</form>";
                        echo"</td>\n";
						echo "</tr>";
					}
					
				}
				echo "</table>\n";
				echo "</div>";
			echo "</div>";
				
			echo "</div>";
			
		}  

		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}
	
	}

	/**
	 * function changes the status of the selected car as per the administrator's selected new status
	 */
	public function changeCarStatus($carID,$changedStatus)
	{		
		try
		{
			
			echo "<div class = 'divViewCar' >";

				//updating the car status in database table 'car'
				$sql = "UPDATE car SET carStatusID = $changedStatus
					 		WHERE carID= ".$carID;

				if ($this->conn ->query($sql) === TRUE)
                {
					echo "<div class = 'divNotification'>";
					echo "<p><b> Status of the car is changed Successfully!</b></p>";
					echo "</div>";
                }
			echo "</div>";
		}  

		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}	
	}

	/**
	 * function displays all the available cars to rent in the system to renters.
	 * Renter can rent the any cars from the displayed cars.
	 */
	public function availableCars()
	{
		try
		{
			echo "<div class = 'divViewCar' >";
				//obtaining cars that are available to rent
				$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay FROM car WHERE carStatusID = 2";
				$qRes = $this->conn->query($sql);
				$userID = $this->getUserID();
				//table for displaying cars that are available to rent
				echo "<div>";
				echo"<h2> Available cars:</h2>";
				echo "<table border='1' width='95%' >\n";
				echo "<tr>\n";
				echo " <th class = 'thViewCar'>ID </th>\n";
				echo " <th class = 'thViewCar'>Plate No</th>\n";
				echo " <th class = 'thViewCar'>Model</th>\n";
				echo " <th class = 'thViewCar'>Type</th>\n";
				echo " <th class = 'thViewCar'>Cost Per Day</th>\n";
				echo " <th class = 'thViewCar'>Rent Car</th>\n";
				echo "</tr>\n";
				if ($qRes->num_rows > 0)
				{
					while (($Row = $qRes->fetch_row())!== NULL)
					{
						echo "<tr>";
						echo " <td>" . htmlentities($Row[0]) . "</td>\n";
						echo " <td>" . htmlentities($Row[1]) . "</td>\n";
						echo " <td>" . htmlentities($Row[2]) . "</td>\n";
						echo " <td>" . htmlentities($Row[3]) . "</td>\n";
						echo " <td>" . htmlentities($Row[4]) . "</td>\n";
						echo " <td>";
                            /**
                             * form that contains rent button to rent the corresponding car
                             * */
                            echo "<form method='post'action='rentCarRequest.php?&carID=" .$Row[0]."'> \n";
                            echo "<p> Select Rent Date: <input type='date' name='rentDate' /></p> ";
							echo "<p> Select Return Date: <input type='date' name='returnDate' /></p> ";
							echo "<input type='submit', name='rentCar', value='rent'/> ";
                            echo "</form>";
                        echo"</td>\n";
						echo "</tr>";
					}
					
				}
				echo "</table>\n";
				echo "</div>";
			echo "</div>";
			//hyper link for "Available Functionalities" page
			echo"<p> <a href='renterFunctionalities.php?". SID . "'> HomePage </a> </p>\n";
		}  
		
		 
		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}
	}

	/**
	 * function  displays the summary of rent request with "confirm" and "cancel" buttons
	 */
	public function rentCarRequest()
	{		
		try
		{
			//unserializing the car object and getting relevant properties 
			$currentCar = unserialize($_SESSION ['car']);
			$carID = $currentCar->getCarID();
			$costPerDay =$currentCar->getCarCostPerDay();
			$totalDays =$currentCar->getTotalDaysRent();
			$rentDate = $currentCar->getRentDate();
			$toBeReturnedDate = $currentCar->getToBeReturnedDate();
			$totalCost = $currentCar->getTotalCostNormal();
			$lateFeeCost = (float)$costPerDay +100;

			//displaying car object's properties as the summary of renting car request
			echo"<div class ='divLogout'>";
            echo"  <p><a href='myRentBuddyTemplate.php'> Logout </a></p>";
            echo "</div>";
			echo "<div class = 'divViewCar' >";
			echo "<table class ='rentCarRequest'>";
				echo "<tr>";
					echo "<td>";
					echo "<p> Car ID :".$carID. "</p>";
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>";
					echo "<p> cost per day :$".$costPerDay. "</p>"; 
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>";
					echo "<p> Total days :".$totalDays. "</p>"; 
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>";
					echo "<p> Rent date:".$rentDate. "</p>"; ;
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>";
					echo "<p> To be returned date:".$toBeReturnedDate. "</p>"; ;
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>";
					echo "<p> Total Cost:$".$totalCost. "</p>"; 
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>";
					echo "<p><b>Disclaimer:</b></p>"; 
					echo "<p><b>Late fee of $".$lateFeeCost." will be applied per day if the car is not returned within specified return date.</b></p>"; 
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td class ='info'>";
						echo "<form method='post' action='rentCarRequestConfirm.php'> \n";
						echo "<input type='submit', name='rentCarConfirm', value='confirm'/> ";
						echo "</form>";
					echo "</td>";
					echo "<td class ='info'>";
						echo "<form method='post' action='availableCars.php'> \n";
						echo "<input type='submit', name='rentCarCancel', value='cancel'/> ";
						echo "</form>";
					echo "</td>";
				echo "</tr>";
			echo "</table>";
			echo "</div>";
		}  

		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}	

		echo "</div>";
		//hyper link for "Available Cars" page
		echo"<p> <a href='availableCars.php?". SID . "'> Available Cars </a> </p>\n";
		//hyper link for "Available Functionalities" page
		echo"<p> <a href='renterFunctionalities.php?". SID . "'> HomePage </a> </p>\n";
	}

	/**
	 * function that inserts the record in "assigned_car" and "car" database tables after getting 
	 * the confirmation on renting a car from the user
	 */
	public function rentCarRequestConfirm()
	{		
		try
		{

			echo"<div class ='divLogout'>";
            echo"  <p><a href='myRentBuddyTemplate.php'> Logout </a></p>";
            echo "</div>";
			echo "<div class = 'divViewCar' >";
				$currentUser = unserialize($_SESSION ['user']);
				$userID = $currentUser->getUserID();

				$currentCar = unserialize($_SESSION ['car']);
				$carID = $currentCar->getCarID();

				$rentDate = $currentCar->getRentDate();
				$rentDate = date("Y-m-d", strtotime($rentDate));

				$toBeReturnedDate = $currentCar->getToBeReturnedDate();
				$toBeReturnedDate = date("Y-m-d", strtotime($toBeReturnedDate));

				$totalCost = $currentCar->getTotalCostNormal();

				$sql = "INSERT INTO assigned_car (userID, carID, rentDate, toBeReturnedDate,returnDate, totalCost)
				VALUES ( $userID,$carID,'$rentDate','$toBeReturnedDate',NULL,$totalCost)";
				
				if ($this->conn ->query($sql) === TRUE) 
				{
					$sql = "UPDATE car SET carStatusID = 1
					 		WHERE carID= ".$carID;
					if ($this->conn ->query($sql) === TRUE)
                	{
						echo "<div class = 'divNotification'>";
						echo "<p><b> Car is rented Successfully!</b></p>";
						echo "</div>";
                	}
				}
              
				
			echo "</div>";
			//hyper link for "Available Cars" page
			echo"<p> <a href='availableCars.php?". SID . "'> Available Cars </a> </p>\n";
			//hyper link for "Available Functionalities" page
			echo"<p> <a href='renterFunctionalities.php?". SID . "'> HomePage </a> </p>\n";

		}  

		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}	
	}

	/**
	 * function that displays the cars that have been previously rented and returned by the user of type renter
	 */
	public function rentedCars()
	{
		try
		{
			$currentUser = unserialize($_SESSION ['user']);
			$userID = $currentUser->getUserID();

			echo "<div class = 'divViewCar' >";
				//obtaining cars that the user has rented and returned before
				$sql = "SELECT car.carID,car.carPlateNo,car.carModel,car.carType, car.carCostPerDay, assigned_car.totalCost, assigned_car.rentDate, 
				assigned_car.toBeReturnedDate, assigned_car.returnDate, car_status.statusName 
				FROM assigned_car 
				LEFT JOIN car ON car.carID =assigned_car.carID 
				LEFT JOIN car_status ON car_status.statusID = car.carStatusID 
				WHERE assigned_car.userID = $userID AND assigned_car.returnDate IS NOT NULL; ";
				$qRes = $this->conn->query($sql);

				//table for displaying cars that the user has rented and returned before
				echo "<div>";
				echo"<h2> Previously Rented and Returned Cars:</h2>";
				echo "<table border='1' width='80%' >\n";
				echo "<tr>\n";
				echo " <th class = 'thViewCar'>ID </th>\n";
				echo " <th class = 'thViewCar'>Plate No</th>\n";
				echo " <th class = 'thViewCar'>Model</th>\n";
				echo " <th class = 'thViewCar'>Type</th>\n";
				echo " <th class = 'thViewCar'>Cost Per Day</th>\n";
				echo " <th class = 'thViewCar'>Total Rent Cost</th>\n";
				echo " <th class = 'thViewCar'>Rented Date</th>\n";
				echo " <th class = 'thViewCar'>To Be Returned Date</th>\n";
				echo " <th class = 'thViewCar'>Returned Date</th>\n";
				echo " <th class = 'thViewCar'>Current Status</th>\n";
				echo "</tr>\n";
				if ($qRes->num_rows > 0)
				{
					while (($Row = $qRes->fetch_row())!== NULL)
					{
						echo "<tr>";
						echo " <td>" . htmlentities($Row[0]) . "</td>\n";
						echo " <td>" . htmlentities($Row[1]) . "</td>\n";
						echo " <td>" . htmlentities($Row[2]) . "</td>\n";
						echo " <td>" . htmlentities($Row[3]) . "</td>\n";
						echo " <td>" . htmlentities($Row[4]) . "</td>\n";
						echo " <td>" . htmlentities($Row[5]) . "</td>\n";
						echo " <td>" . htmlentities($Row[6]) . "</td>\n";
						echo " <td>" . htmlentities($Row[7]) . "</td>\n";
						echo " <td>" . htmlentities($Row[8]) . "</td>\n";
						echo " <td>" . htmlentities($Row[9]) . "</td>\n";
						echo "</tr>";
					}
					
				}
				echo "</table>\n";
				echo "</div>";
			echo "</div>";
			
			//hyper link for "Available Functionalities" page
			echo"<p> <a href='renterFunctionalities.php?". SID . "'> HomePage </a> </p>\n";

		}  
		
		
		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}
	}


	/**
	 * funciton that displays all the cars that the user( of type renter) has been currently renting
	 */
	public function rentingCars()
	{
		try
		{
			$currentUser = unserialize($_SESSION ['user']);
			$userID = $currentUser->getUserID();

			echo "<div class = 'divViewCar' >";
				//obtaining cars that the user is currently renting
				$sql = "SELECT car.carID,car.carPlateNo,car.carModel,car.carType, car.carCostPerDay, assigned_car.totalCost, assigned_car.rentDate, 
				assigned_car.toBeReturnedDate
				FROM assigned_car 
				LEFT JOIN car ON car.carID =assigned_car.carID 
				LEFT JOIN car_status ON car_status.statusID = car.carStatusID 
				WHERE assigned_car.userID = $userID AND assigned_car.returnDate IS  NULL";

				$qRes = $this->conn->query($sql);
				//table for displaying cars that are user is currently renting
				echo "<div>";
				echo"<h2> Currently Renting Cars:</h2>";
				echo "<table border='1' width='80%' >\n";
				echo "<tr>\n";
				echo " <th class = 'thViewCar'>Car ID </th>\n";
				echo " <th class = 'thViewCar'>Plate No</th>\n";
				echo " <th class = 'thViewCar'>Model</th>\n";
				echo " <th class = 'thViewCar'>Type</th>\n";
				echo " <th class = 'thViewCar'>Cost Per Day</th>\n";
				echo " <th class = 'thViewCar'>Normal Total Rent Cost</th>\n";
				echo " <th class = 'thViewCar'>Rent Date</th>\n";
				echo " <th class = 'thViewCar'>To Be Returned Date</th>\n";
				echo " <th class = 'thViewCar'>Return Car</th>\n";
				echo "</tr>\n";
				if ($qRes->num_rows > 0)
				{
					while (($Row = $qRes->fetch_row())!== NULL)
					{
						echo "<tr>";
						echo " <td>" . htmlentities($Row[0]) . "</td>\n";
						echo " <td>" . htmlentities($Row[1]) . "</td>\n";
						echo " <td>" . htmlentities($Row[2]) . "</td>\n";
						echo " <td>" . htmlentities($Row[3]) . "</td>\n";
						echo " <td>" . htmlentities($Row[4]) . "</td>\n";
						echo " <td>" . htmlentities($Row[5]) . "</td>\n";
						echo " <td>" . htmlentities($Row[6]) . "</td>\n";
						echo " <td>" . htmlentities($Row[7]) . "</td>\n";

						echo " <td>";
						/**
						 * form that contains return button to return the corresponding car
						 * */
						echo "<form method='post'action='returnCarRequest.php?&carID=" .$Row[0]."'> \n";
						echo "<p> Return Date: <input type='date' name='returnDate' /></p> ";
						echo "<input type='submit', name='returnCar', value='return'/> ";
						echo "</form>";
						echo"</td>\n";

						echo "</tr>";
					}
					
				}
				echo "</table>\n";
				echo "</div>";
			echo "</div>";
			
			//hyper link for "Available Functionalities" page
			echo"<p> <a href='renterFunctionalities.php?". SID . "'> HomePage </a> </p>\n";

		}  

		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}

	}
	/**
	 * function  displays the summary of return request with "confirm" and "cancel" buttons
	 */
	public function returnCarRequest()
	{		
		try
		{
			//unserializing the car object and getting relevant properties 
			$currentCar = unserialize($_SESSION ['car']);
			$carID = $currentCar->getCarID();
			
			$costPerDay =$currentCar->getCarCostPerDay();
			$rentDate = $currentCar->getRentDate();
			$toBeReturnedDate = $currentCar->getToBeReturnedDate();
			$returnDate = $currentCar->getReturnDate();
			$getTotalDaysRent = $currentCar->getTotalDaysRent();
			$totalCost = $currentCar->getTotalCostNormal();
			$lateFeeCost = (float)$costPerDay +100;
			$penaltyDays = $currentCar->getPenaltyInterval();

			//displaying car object's properties as the summary of rental transaction
			echo"<div class ='divLogout'>";
            echo"  <p><a href='myRentBuddyTemplate.php'> Logout </a></p>";
            echo "</div>";
			echo "<div class = 'divViewCar' >";
			echo "<table class ='rentCarRequest'>";
				echo "<tr>";
					echo "<td>";
					echo "<p> Car ID :".$carID. "</p>";
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>";
					echo "<p> cost per day :$".$costPerDay. "</p>"; 
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>";
					echo "<p> Rent date:".$rentDate. "</p>"; ;
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>";
					echo "<p> To be returned date:".$toBeReturnedDate. "</p>"; ;
					echo "</td>";

				echo "</tr>";
				echo "<tr>";
					echo "<td>";
					echo "<p> Returned date:".$returnDate. "</p>"; ;
					echo "</td>";
				echo "</tr>";

				if( $penaltyDays > 0)
				{
					echo "<tr>";
						echo "<td>";
						echo "<p> Late fee incured days:".$penaltyDays. "</p>"; ;
						echo "</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>";
						echo "<p> Late fee Rate: $".$lateFeeCost. "</p>"; ;
						echo "</td>";
					echo "</tr>";
				}
				
				
				echo "<tr>";
					echo "<td>";
					echo "<p> Total days:".$getTotalDaysRent. "</p>"; ;
					echo "</td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>";
					echo "<p> Total Cost:$".$totalCost. "</p>"; 
					echo "</td>";
				echo "</tr>";
			
				echo "<tr>";
					echo "<td class ='info'>";
						echo "<form method='post' action='returnCarRequestConfirm.php'> \n";
						echo "<input type='submit', name='rentCarConfirm', value='confirm'/> ";
						echo "</form>";
					echo "</td>";
					echo "<td class ='info'>";
						echo "<form method='post' action='rentingCars.php'> \n";
						echo "<input type='submit', name='rentCarCancel', value='cancel'/> ";
						echo "</form>";
					echo "</td>";
				echo "</tr>";
			echo "</table>";
			echo "</div>";
			//hyper link for "Renting Cars" page
			echo"<p> <a href='rentingCars.php?". SID . "'> Available Cars </a> </p>\n";
			//hyper link for "Available Functionalities" page
			echo"<p> <a href='renterFunctionalities.php?". SID . "'> HomePage </a> </p>\n";
		}  

		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}	
	}

	
	/**
	 * function that updates the record in "assigned_car" and "car" database tables after getting 
	 * the confirmation on returning a car from the user
	 */
	public function returnCarRequestConfirm()
	{		
		try
		{
			echo"<div class ='divLogout'>";
            echo"  <p><a href='myRentBuddyTemplate.php'> Logout </a></p>";
            echo "</div>";
			echo "<div class = 'divViewCar' >";
				$currentUser = unserialize($_SESSION ['user']);
				$userID = $currentUser->getUserID();

				$currentCar = unserialize($_SESSION ['car']);
				$carID = $currentCar->getCarID();


				$returnDate = $currentCar->getReturnDate();
				
				$returnDate = date("Y-m-d", strtotime($returnDate));


				$totalCost = $currentCar->getTotalCostNormal();

				$sql = "UPDATE assigned_car SET returnDate = '$returnDate'
						WHERE carID = $carID AND userID = $userID"; 
					
				
				if ($this->conn ->query($sql) === TRUE) 
				{
					echo "REached inside";
					$sql = "UPDATE car SET carStatusID = 2
					 		WHERE carID= ".$carID;
					if ($this->conn ->query($sql) === TRUE)
                	{
						echo "<div class = 'divNotification'>";
						echo "<p><b> Car is returned Successfully!</b></p>";
						echo "</div>";
                	}
				}
              
				
			echo "</div>";
			//hyper link for "Available Cars" page
			echo"<p> <a href='rentingCars.php?". SID . "'> Renting Cars </a> </p>\n";
			//hyper link for "Available Functionalities" page
			echo"<p> <a href='renterFunctionalities.php?". SID . "'> HomePage </a> </p>\n";

		}  

		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}	
	}

	/**
	 * function that performs search based on any combination of the car's plate number, model or type.
	 * It also allows the renter to rent the resultant car if the car is available to rent
	 */
	public function searchCarRenter($plateNo,$model,$type)
	{
		try
		{
			$currentUserID = 0; 
			if(isset($_SESSION['user']))
			{
				$currentUser = unserialize($_SESSION['user']);
				$currentUserID = $currentUser->getUserID();
			}
			
			echo "<div class = 'divViewCar' >";
				
				//Search function when plateNo, model and type fields are obtained from the user
				if(!empty($plateNo) and !empty($model) and !empty($type))
				{
					$plateNo = "'%".$plateNo."%'";
					$model = "'%".$model."%'";
					$type = "'%".$type."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName,carStatusID 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carPlateNo LIKE ".$plateNo."AND 
					carModel LIKE ".$model." AND 
					carType LIKE ".$type;

					
				}

				//Search function when plateNo and model are obtained from the user but type is not supplied 
				if(!empty($plateNo) and !empty($model) and empty($type))
				{
					$plateNo = "'%".$plateNo."%'";
					$model = "'%".$model."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName,carStatusID 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carPlateNo LIKE ".$plateNo."AND 
					carModel LIKE ".$model;
				}

				//Search function when plateNo and type are obtained from the user but model is not supplied 
				if(!empty($plateNo) and empty($model) and !empty($type))
				{
					$plateNo = "'%".$plateNo."%'";
					$type = "'%".$type."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName,carStatusID 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carPlateNo LIKE ".$plateNo."AND 
					carType LIKE ".$type;
				}

				//Search function when model and type are obtained from the user but plateNo is not supplied 
				if(empty($plateNo) and !empty($model) and !empty($type))
				{
					$model = "'%".$model."%'";
					$type = "'%".$type."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName,carStatusID  
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carModel LIKE ".$model."AND 
					carType LIKE ".$type;
				}
				
				//Search function when only plateNo is supplied
				if(!empty($plateNo) and empty($model) and empty($type))
				{
					$plateNo = "'%".$plateNo."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName,carStatusID  
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carPlateNo LIKE ".$plateNo;
				}

				
				//Search function when only model is supplied
				if(empty($plateNo) and !empty($model) and empty($type))
				{
					$model = "'%".$model."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName,carStatusID  
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carModel LIKE ".$model;
				}

				//Search function when only model is supplied
				if(empty($plateNo) and empty($model) and !empty($type))
				{
					$type = "'%".$type."%'";
					$sql = "SELECT carID, carPlateNo, carModel, carType, carCostPerDay, car_status.statusName,carStatusID 
					FROM car 
					LEFT JOIN car_status 
						ON car.carStatusID =car_status.statusID
					WHERE
					carType LIKE ".$type;
				}


				$qRes = $this->conn->query($sql);

				//table for displaying resultant searched cars in the system
				echo "<div>";
				echo"<h2> Searched Car:</h2>";
				echo "<table border='1' width='80%' >\n";
				echo "<tr>\n";
				echo " <th class = 'thViewCar'>ID </th>\n";
				echo " <th class = 'thViewCar'>Plate No</th>\n";
				echo " <th class = 'thViewCar'>Model</th>\n";
				echo " <th class = 'thViewCar'>Type</th>\n";
				echo " <th class = 'thViewCar'>Cost Per Day</th>\n";
				echo " <th class = 'thViewCar'>Status</th>\n";
				echo " <th class = 'thViewCar'>Rent</th>\n";
				echo "</tr>\n";
				if ($qRes->num_rows > 0)
				{
					while (($Row = $qRes->fetch_row())!== NULL)
					{
						echo "<tr>";
						echo " <td>" . htmlentities($Row[0]) . "</td>\n";
						echo " <td>" . htmlentities($Row[1]) . "</td>\n";
						echo " <td>" . htmlentities($Row[2]) . "</td>\n";
						echo " <td>" . htmlentities($Row[3]) . "</td>\n";
						echo " <td>" . htmlentities($Row[4]) . "</td>\n";
						echo " <td>" . htmlentities($Row[5]) . "</td>\n";
						echo " <td>";

						if($Row[6] == 2)
						{
							/**
							 * form that contains rent button to rent the corresponding car
							 * */
							echo "<form method='post'". "action='rentCarRequest.php?&carID=" .$Row[0]."'> \n";
							echo "<p> Select Rent Date: <input type='date' name='rentDate' /></p> ";
							echo "<p> Select Return Date: <input type='date' name='returnDate' /></p> ";
							echo "<input type='submit', name='rentCar', value='rent'/> ";
							echo "</form>";
						}

						else
						{
		
							echo "<p> Not available to rent </p> \n";
							
						}
						
						echo"</td>\n";
						echo "</tr>";
					}
					
				}
				echo "</table>\n";
				echo "</div>";
			echo "</div>";
			echo"<p> <a href='searchCarRenter.php?". SID . "'> Search Car </a> </p>\n";
			//hyper link for "Available Functionalities" page
			echo"<p> <a href='renterFunctionalities.php?". SID . "'> HomePage </a> </p>\n";
			echo "</div>";
			
			
		}  

		catch (mysqli_sql_exception $e) 
		{
			$ErrorMsgs[] = "Error: " . $e->getCode() . "." . $e->getMessage();
			echo "<div class = 'divNotification'>";
			echo "<p><b>". $ErrorMsgs."</b></p>";
			echo "</div>";
		}
	
	}
	
	//wake up function of the class
	function __wakeup() 
	{
		include("inc_myRentBuddyDB.php");
		$this->conn = $conn;
	}

	//class destructor
	function __destruct() 
	{
			$this->conn->close();
	}
}
?>
