<?php

require_once "MathPOC_DB.php";

class TestQuestions
{
	public static function GetTestQuestions($tid)
	{

		$results = $GLOBALS['MathDB']->ExecuteQuery("CALL Get_Test_Questions('$tid');");

		$json = '{ "test_questions":' . json_encode($results) . '}';

		return $json;
	}

	public static function AddQuestionToTest($tid, $qid, $qnum)
	{
		$results = $GLOBALS['MathDB']->ExecuteQuery("CALL Add_Question_To_Test('$tid', '$qid', '$qnum');");
	}
	
	public static function UpdateQuestionNumber($tid, $qid, $qnum)
	{
		$results = $GLOBALS['MathDB']->ExecuteQuery("CALL Update_Question_Number('$tid', '$qid', '$qnum');");
	}

	public static function Remove_Question_from_Test($tid, $qid)
	{
		$results = $GLOBALS['MathDB']->ExecuteQuery("CALL Remove_Question_from_Test('$tid', '$qid');");
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