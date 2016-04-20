<?php

require_once "MathPOC_DB.php";

class Questions
{
	public static function GetQuestions($testid)
	{

		$results = $GLOBALS['MathDB']->ExecuteQuery("SELECT ID, Title,Description from Questions");

		foreach (new TableRows(new RecursiveArrayIterator($results)) as $key => $value) 
		{
			echo $value;
		}

	}

	public static function CreateQuestion()
	{
		//Add proper parameterization
		$type 			= $_REQUEST["Type"];
		$title 			= $_REQUEST["Title"];
		//$author 		= $_REQUEST["Author"];
		$author = 1;
		$description 	= $_REQUEST["Description"];
		$text 			= $_REQUEST["Text"];
		$answer			= $_REQUEST["Answer"];


		$results = $GLOBALS['MathDB']->ExecuteQuery("CALL Question_Insert('$type','$title','$author','$description','$text','$answer');");
	}
}
?>