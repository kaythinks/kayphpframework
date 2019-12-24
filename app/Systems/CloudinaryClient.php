<?php

namespace App\Systems;

use Cloudinary;
use Cloudinary\Uploader;

class CloudinaryClient{

	public function __construct()
	{
		Cloudinary::config([
		    "cloud_name" => \App\Config\Env::CLOUDINARY_CLOUD_NAME,
		    "api_key" => \App\Config\Env::CLOUDINARY_API_KEY,
		    "api_secret" => \App\Config\Env::CLOUDINARY_API_SECRET
		]);
	}

	public function uploadFile(string $file)
	{
		$response = Uploader::upload($file);

		if ($response) return $response['secure_url'];

		return false;
	}	
}