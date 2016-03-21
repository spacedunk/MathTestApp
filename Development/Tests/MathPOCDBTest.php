<?php

include "/home/ekeehn/Code Work/MathTestApp/POC/Source/Development/MathPOC_DB.php";

/**
* Class containing all the tests for the MathPOC_DB DAL
*/
class MathPOC_DB_Tests extends PHPUnit_Framework_TestCase
{

	public function testConnection()
	{
		$connInfo = simplexml_load_file("/home/ekeehn/Code Work/MathTestApp/POC/Source/Development/ConnectionInfo.xml");

		$db = new MathPOC_DB($connInfo->Servername,$connInfo->DBName,$connInfo->Username,$connInfo->Password);
		$results =  $db->ExecuteQuery("SELECT 1 from DUAL");

		$this->assertContains(1,$results[0]);
	}

	/**
	* @depends testConnection
	*/
	public function testGetUserNameFromMathDB()
	{
		$connInfo = simplexml_load_file("/home/ekeehn/Code Work/MathTestApp/POC/Source/Development/ConnectionInfo.xml");

        $MathPOC = new MathPOC_DB($connInfo->Servername,$connInfo->DBName,$connInfo->Username,$connInfo->Password);
		$MathPOC->getPDOConnection();

		$results = $MathPOC->ExecuteQuery("SELECT UserID, First,Last from TestTable");

		$this->assertEquals("Eric",$results[0]["First"]);
	}
};
?>