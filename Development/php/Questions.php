<?php

require_once "MathPOC_DB.php";

class Questions
{

	public static function GetQuestions($testid)
	{
		$results = $GLOBALS['MathDB']->ExecuteQuery("SELECT ID, Title,Description from Questions");

		$json = '{ "questions":' . json_encode($results) . '}';

		echo $json;
	}



	public static function CreateQuestion()
	{
		//Add proper parameterization
		$type 			= $_POST["Type"];
		$title 			= $_POST["Title"];
		//$author 		= $_POST["Author"];
		$author = 1;
		$description 	= $_POST["Description"];
		$text 			= $_POST["Text"];
		$answer			= $_POST["Answer"];


		$results = $GLOBALS['MathDB']->ExecuteQuery("CALL Question_Insert('$type','$title','$author','$description','$text','$answer');");
	}
}
?>