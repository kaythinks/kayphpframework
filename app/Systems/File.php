<?php

namespace App\Systems;

use Exception;

class File{
	
	public static function upload(array $file)
	{

		if (!file_exists("uploads")) {
			mkdir("uploads", 0777 ,true);
		}

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($file["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($file["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . "."; die();
		        $uploadOk = 1;
		    } else {

		    	throw new Exception("File is not an image.", 500);
		        
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {

			throw new Exception("Sorry, file already exists.", 500);
		    
		    $uploadOk = 0;
		}
		// Check file size
		if ($file["size"] > 5000000) {

			throw new Exception("Sorry, your file is too large.", 500);
		    
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {

			throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 500);
		    
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {

			throw new Exception("Sorry, your file was not uploaded.", 500);
		    
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($file["tmp_name"], $target_file)) {
		        echo "The file ". basename( $file["name"]). " has been uploaded.";
		        return $target_file;
		    } else {

		    	throw new Exception("Sorry, there was an error uploading your file.", 500);
		    }
		}
	}

}