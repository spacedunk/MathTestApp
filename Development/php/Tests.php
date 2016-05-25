<?php

require_once "MathPOC_DB.php";

class Tests
{
	public static function GetTests()
	{

		$results = $GLOBALS['MathDB']->ExecuteQuery("SELECT ID, Title,Description from Tests");

		$json = '{ "tests":' . json_encode($results) . '}';

		return $json;
	}

	public static function CreateTest()
	{
		//Add proper parameterization
		$title 			= $_POST["Title"];
		//$author 		= $_POST["Author"];
		$author = 1;
		$class 			= $_POST["Class"];
		$description 	= $_POST["Description"];
		$date			= date("Y-m-d G:i:s");


		$results = $GLOBALS['MathDB']->ExecuteQuery("CALL Test_Insert('$title','$author','$class','$description','$date');");
	}
}
?>