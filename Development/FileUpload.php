<?php
$target_dir = "Images/";
$target_file = $target_dir . $_POST["Title"];
$uploadOk = 1;
$counter = 0;
$imageFileType = pathinfo($target_dir . basename($_FILES["fileImage"]["name"]),PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileImage"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
while (file_exists($target_file)) {
	++$counter;
	$target_file = $target_file."-".$counter;
}
// Check file size
if ($_FILES["fileImage"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileImage"]["tmp_name"], $target_file)) {
        echo "The file ". $_POST["Title"]. " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>