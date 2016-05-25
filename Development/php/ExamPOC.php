<?php

require_once "MathPOC_DB.php";
require_once "Users.php";
require_once "Questions.php";
require_once "TestQuestions.php";
require_once "Tests.php";
require_once 'ImageUploader.php';


//Since Angular defaults to application/json
if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
    $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
}

$a = $_POST['F'];
//$a ="GetAllQuestions"; 
switch ($a)
{
	case 'GetUsers':
		Users::GetUsers();
		break;
	case 'CreateQuestion':
		Questions::CreateQuestion();
		break;
	case 'UploadImage':
		$image = new ImageUploader($_POST["Title"], $_FILES["fileImage"]);
		$image->UploadImage();
		break;
	case 'CreateTest':
		Tests::CreateTest();
		break;
	case 'GetAllQuestions':
		echo Questions::GetAllQuestions();
		break;
	case 'GetTestQuestions':
		echo TestQuestions::GetTestQuestions($_POST["TID"]);
		break;
	default:
		echo "Function Not Found";
		break;
}
?>