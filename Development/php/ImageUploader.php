<?php

require_once "ImageUploaderException.php";

class ImageUploader
{
	protected $target_dir;
	protected $target_file;
	protected $file;
	protected $OKToUpload 		= 1;
	protected $imageFileType;
	protected $config;

	public function __construct($filename,$fileObject)
	{
		$this->config 			= simplexml_load_file(dirname(__DIR__)."/config/ImageUploader.xml");
		$this->target_dir 		= dirname(__DIR__) . "/" . $this->config->FileConfig->FileDirectory . "/";
		$this->target_file 		= $this->target_dir . $filename;
		$this->file 			= $fileObject;
		$this->imageFileType 	= pathinfo($this->target_dir . basename($this->file->name),PATHINFO_EXTENSION);

		$variableThatsNotInitialized = $this->checkInitialized();

		if($variableThatsNotInitialized != "") throw new InitializationFailureException($variableThatsNotInitialized);
	}

	private function checkInitialized()
	{
		if($this->config->asXML() == "")
		{
			return "config";
		}
		else if ($this->target_dir == "")
		{
			return "target_dir";
		}
		else if($this->target_file == "")
		{
			return "target_file";
		}
		else if($this->file == "")
		{
			return "file";
		}
		else if($this->imageFileType == "")
		{
			return "imageFileType";
		}
		else
		{
			return "";
		}
	}

	protected function isFileActualImage()
	{
	    $check = getimagesize($this->file["tmp_name"]);
	    if($check === false)  
	    {
	        throw new NotAnImageException();
	        $OKToUpload = 0;
	    }
	}

	//If incrementOrFail is 1: if the file already exists then create a new file with an incremented number
	//If incrementOrFail is 0: if the file already exists return false with a message that the file already exists
	protected function exists($incrementOrFail){
		if($incrementOrFail === 1)
		{
			$counter = 0;
			// Check if file already exists
			while (file_exists($this->target_file)) 
			{
				++$counter;
				$this->target_file = $this->target_file."-".$counter;
			}
			return true;
		}
		elseif ($incrementOrFail === 0) 
		{
			if(file_exists($this->target_file)){
				echo $this->target_file . " already exists. Please select a new filename and try again.";
				$this->OKToUpload = 0;
				return false;
			}
			return true;
		}
		else
		{
			echo $incrementOrFail . " is not a valid choice for FileUploader->exists.";
			$this->OKToUpload = 0;
			
		}
		return false;
	}

	protected function isTooBig($sizeLimit)
	{
		//TODO: Check that its an int.
		// Check file size
		if ($this->file["size"] > $sizeLimit)
		{
			throw new ImageSizeLimitException($sizeLimit);
			$OKToUpload = 0;
		}
	}

	protected function isCorrectFileType()
	{
		if(!(in_array($this->imageFileType, (array)$this->config->ImageTypes->ImageType)))
		{
    		throw new IncorrectImageTypeException($this->imageFileType); 
    		$OKToUpload = 0;
		}
	}

	public function UploadImage($incrementOrFail = 1)
	{
		if(!($this->isTooBig($this->config->FileSizeLimit) || $this->isCorrectFileType() || $this->isFileActualImage() || $this->exists($incrementOrFail)))
		{
			echo "The file upload has failed.";
			return;
		}

	    if (move_uploaded_file($this->file["tmp_name"], $this->target_file)) 
	    {
	        echo "The file has been uploaded.";
	    }
	    else 
	    {
	        echo "Sorry, there was an error uploading your file." . $this->file['tmp_name'] . $this->target_file;
	    }
	}

};

?>