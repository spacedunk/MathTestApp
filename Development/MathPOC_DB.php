<?php

class MathPOC_DB
{
	protected $conn_string = "";
	protected $username    = "";
	protected $password    = "";

	public function __construct($server,$dbname,$userid,$pwrd)
	{
		$this->username   = $userid;
		$this->password   = $pwrd;
		$this->conn_string = "mysql:host=$server;dbname=$dbname";
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

	
$connInfo = simplexml_load_file('ConnectionInfo.xml');

$GLOBALS['MathDB'] = new MathPOC_DB($connInfo->Servername,$connInfo->DBName,$connInfo->UserName,$connInfo->Password);

?>