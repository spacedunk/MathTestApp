<?php

require_once "MathPOC_DB.php";
require_once "Users.php";
require_once "Questions.php";
require_once 'ImageUploader.php';

$a = $_POST['F'];

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
	default:
		echo "Function Not Found";
		break;
}
?>