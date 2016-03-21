<?php
function test_func() { return 'Hi';}

class TableRows extends RecursiveIteratorIterator { 
     function __construct($it) { 
         parent::__construct($it, self::LEAVES_ONLY); 
     }

     function current() {
         return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
     }

     function beginChildren() { 
         echo "<tr>"; 
     } 

     function endChildren() { 
         echo "</tr>" . "\n";
     } 
}

class MathPOC_DB
{
	protected $conn_string = "";
	protected $servername  = "";
	protected $username    = "";
	protected $password    = "";

	public function __construct($server,$userid,$pwrd)
	{
		$this->servername = $server;
		$this->username   = $userid;
		$this->password   = $pwrd;
		$this->conn_string = "mysql:host=$server;dbname=MathPOC";
	}

	function getConnectionString()
	{
		return conn_string;
	}

	function getPDOConnection()
	{
		try
		{
			$conn = new PDO($this->conn_string,$this->username,$this->password);
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			return $conn;

			$conn = null;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		return null;
	} 

	public function ExecuteQuery($query)
	{
		try
		{
			$conn = self::getPDOConnection();
			$statement = $conn->prepare($query);
			$statement->execute();

			$result = $statement->setFetchMode(PDO::FETCH_ASSOC);

			return $statement->fetchAll();

			$conn = null;
	    }
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}

		return null;
	}
};

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>UserID</th><th>Firstname</th><th>Lastname</th></tr>";

$MathPOC = new MathPOC_DB('localhost','ekeehn','Homer200');
$MathPOC->getPDOConnection();

$results = $MathPOC->ExecuteQuery("SELECT UserID, First,Last from TestTable");

foreach (new TableRows(new RecursiveArrayIterator($results)) as $key => $value) 
{
	echo $value;
}


?>