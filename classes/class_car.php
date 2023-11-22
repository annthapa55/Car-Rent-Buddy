
<?php
if (session_status() === PHP_SESSION_NONE) 
{
    // Start the session
    session_start();
}
//defining Car class
class Car 
{
	//private properties of the class
	private $conn = NULL;
	private $carID = "";
    private $carPlateNo = "";
	private $carModel = "";
	private $carType ="";
	private $carStatusID ="";
	private $carCostPerDay = "";
    private $totalDaysRent ="";
    private $rentDate ="";
    private $toBeReturnedDate ="";
    private $totalCostNormal = "";
	private $returnDate ="";
	private $penaltyInterval ="";

	//class constructor 
	function __construct() 
    {
		include("inc_myRentBuddyDB.php");
		$this->conn = $conn;
	}
	
	/**
	 * setter functions
	 */
	public function setCarID($carID) 
	{
		$this->carID = $carID;
	}

	public function setcarPlateNo($carPlateNo) 
	{
		$this->carPlateNo = $carPlateNo;
	}

	public function setCarModel($carModel) 
	{
		$this->carModel = $carModel;
	}

	public function setCarType($carType) 
	{
		$this->carType = $carType;
	}

	public function setCarStatusID($carStatusID) 
	{
		$this->carStatusID = $carStatusID;
	}

	public function setCarCostPerDay($carCostPerDay) 
	{
		$this->carCostPerDay = $carCostPerDay;
	}

    public function setTotalDaysRent($totalDaysRent) 
	{
		$this->totalDaysRent = $totalDaysRent;
	}

    public function setRentDate($rentDate) 
	{
		$this->rentDate = $rentDate;
	}

    public function setToBeReturnedDate($toBeReturnedDate) 
	{
		$this->toBeReturnedDate = $toBeReturnedDate;
	}
  
    public function setTotalCostNormal($totalCostNormal) 
	{
		$this->totalCostNormal = $totalCostNormal;
	}

	public function setReturnDate($returnDate) 
	{
		$this->returnDate = $returnDate;
	}

	public function setPenaltyInterval($penaltyInterval) 
	{
		$this->penaltyInterval = $penaltyInterval;
	}
	
	/**
	 * getter functions
	 */
	public function getConn() 
	{
		return $this->conn;
	}

	public function getCarID() 
	{
		return $this->carID;
	}

	public function getCarPlateNo() 
	{
		return $this->carPlateNo;
	}

	public function getCarModel() 
	{
		return $this->carModel;
	}

	public function getCarType() 
	{
		return $this->carType;
	}

	public function getCarStatusID() 
	{
		return $this->carStatusID;
	}

	public function getCarCostPerDay() 
	{
		return $this->carCostPerDay;
	}

    public function getTotalDaysRent() 
	{
		return $this->totalDaysRent;
	}

    public function getRentDate() 
	{
		return $this->rentDate;
	}

    public function getToBeReturnedDate() 
	{
		return $this->toBeReturnedDate;
	}

    public function getTotalCostNormal() 
	{
		return $this->totalCostNormal;
	}
	public function getReturnDate() 
	{
		return $this->returnDate;
	}
	
	public function getPenaltyInterval() 
	{
		return $this->penaltyInterval;
	}
	
	//wake up function 
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
