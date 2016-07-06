<?php

require_once "MathPOC_DB.php";

class MathDBConnTest extends PHPUnit_Framework_TestCase
{
	/**
	* @setup
	*/
	public function createConnection($server,$dbname,$userid,$pwrd)
	{
		return new MathPOC_DB()
	}
}
?>