<?php

require_once "../ImageUploader.php";

class IsImageTest extends PHPUnit_Framework_TestCase
{
	protected $test_image;

	public function setup()
	{
		$this->test_images = simplexml_load_file("TestImages.xml");
	}


	public function testTestImageAttributes()
	{
		$this->assertEquals("BankStatement.jpg",$this->test_images->TestImage->name);
		$this->assertEquals(20000,(integer)$this->test_images->TestImage->size);
		$this->assertEquals('/home/ekeehn/Code Work/MathTestApp/POC/Source/Development/BankStatement.jpg',$this->test_images->TestImage->tmp_name);

	}

	/**
	* @depends testTestImageAttributes
	*/
	public function testFileIsAnImage()
	{

		$image_uploader = new ImageUploaderTestAdapter("test.jpg",$this->test_images);
		$this->assertTrue($image_uploader->IsFileUploadable());
		

	}
} 

class ImageUploaderTestAdapter extends ImageUploader
{
	public function __construct($filename,$file_object)
	{
		parent::__construct($filename,$file_object);
	}

	public function IsFileUploadable()
	{
		try
		{
			parent::isTooBig($this->config->FileSizeLimit);
			parent::isCorrectFileType();
			parent::isFileActualImage();
			parent::exists(1);
		}
		catch(Exception $e)
		{
			$e->log();
			return false;
		}

		return true;
	}
}

?>