<?php

include "MathPOC_DB.php";
include "TableRows.php";


class Users
{
	public static function GetUsers()
	{
		echo "<table class='table'>";
		echo "<tr><th>UserID</th><th>Firstname</th><th>Lastname</th></tr>";

		$results = $GLOBALS['MathDB']->ExecuteQuery("SELECT UserID, First,Last from TestTable");

		foreach (new TableRows(new RecursiveArrayIterator($results)) as $key => $value) 
		{
			echo $value;
		}

		echo "</table>";
	}
}


?>