<?php

include "MathPOC_DB.php";
include "Users.php";

$a = $_REQUEST["F"];

switch ($a)
{
	case 'GetUsers':
		Users::GetUsers();
		break;
	
	default:
		echo "Function Not Found";
		break;
}
?>