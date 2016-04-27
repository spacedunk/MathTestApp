<?php

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
		$this->config 			= simplexml_load_file("ImageUploader.xml");
		$this->target_dir 		= $this->config->FileConfig->FileDirectory . "/";
		$this->target_file 		= $this->target_dir . $filename;
		$this->file 			= $fileObject;
		$this->imageFileType 	= pathinfo($target_dir . basename($file["name"]),PATHINFO_EXTENSION);
	}

	private function isFileActualImage()
	{
		// Check if image file is a actual image or fake image
	    $check = getimagesize($this->file["tmp_name"]);
	    if($check === false)  
	    {
	        echo "File is not an image.";
	        $OKToUpload = 0;
	    }
	}

	//If incrementOrFail is 1: if the file already exists then create a new file with an incremented number
	//If incrementOrFail is 0: if the file already exists return false with a message that the file already exists
	private function exists($incrementOrFail){
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

	private function isTooBig($sizeLimit)
	{
		//TODO: Check that its an int.
		// Check file size
		if ($this->file["size"] > $sizeLimit) {
		    echo "Sorry, your file is too large.";
		    $OKToUpload = 0;
		    return false;
		}
		return true;
	}

	private function isCorrectFileType()
	{
		if(!(in_array($this->imageFileType, $this->config->imageTypes->imageType)))
		{
    		echo "Sorry, " . $this->imageFileType . " is not a JPG, JPEG, PNG or GIF.";
    		$OKToUpload = 0;
    		return false;
		}
		return true;
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