<?php

require_once "MathPOC_DB.php";
require_once "Users.php";
require_once "Questions.php";

$a = $_REQUEST["F"];

switch ($a)
{
	case 'GetUsers':
		Users::GetUsers();
		break;
	case 'CreateQuestion':
		Questions::CreateQuestion();
		break;
	default:
		echo "Function Not Found";
		break;
}
?>