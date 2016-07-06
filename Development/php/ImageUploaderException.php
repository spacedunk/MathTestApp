<?php

abstract class ImageUploadExceptionBase extends Exception 
{
	protected $message = "";
	protected $caller = "";

	function __construct($message)
	{
		$this->message = $message;
	}

	protected function writeToSystemLog()
	{
		error_log($this->message);
	}

	protected function writeToOutput()
	{
		echo $this->message;
	}

	public function log()
	{
		$this->writeToSystemLog();
		//$this->writeToOutput();
	}

}

class NotAnImageException extends ImageUploadExceptionBase
{	
	function __construct()
	{
		parent::__construct("The file uploaded does not contain Image Data");
	}
}

class IncorrectImageTypeException extends ImageUploadExceptionBase
{
	protected $imageFileType;

	function __construct($imageType)
	{
		parent::__construct("Sorry, " . $imageType . " is not a JPG, JPEG, PNG or GIF.");
	}
}

class ImageSizeLimitException extends ImageUploadExceptionBase
{
	
	function __construct($imageSizeLimit)
	{
		parent::__construct("File size has exceeded the limit of " . $imageSizeLimit);
	}
}
?>