<?php

include "MathPOC_DB.php";

class Questions
{
	public static function GetQuestions($testid)
	{

		$results = $GLOBALS['MathDB']->ExecuteQuery("SELECT UserID, First,Last from TestTable");

		foreach (new TableRows(new RecursiveArrayIterator($results)) as $key => $value) 
		{
			echo $value;
		}

		echo "</table>";
	}
}
?>