<?php

include "MathPOC_DB.php";
include "TableRows.php";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>UserID</th><th>Firstname</th><th>Lastname</th></tr>";

$connInfo = simplexml_load_file('ConnectionInfo.xml');

$MathPOC = new MathPOC_DB($connInfo->Servername,$connInfo->DBName,$connInfo->UserName,$connInfo->Password);

$results = $MathPOC->ExecuteQuery("SELECT UserID, First,Last from TestTable");

foreach (new TableRows(new RecursiveArrayIterator($results)) as $key => $value) 
{
	echo $value;
}

echo "</table>";


?>