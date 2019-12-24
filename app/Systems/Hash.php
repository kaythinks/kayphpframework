<?php

namespace App\Systems;

use App\Config\Env;

class Hash{

	public static function make( string $input)
	{
		// Store the cipher method 
		$ciphering = "AES-128-CTR"; 
		  
		// Use OpenSSl Encryption method 
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 
		  
		// Non-NULL Initialization Vector for encryption 
		$encryption_iv = '1234567891011121'; 
		  
		// Store the encryption key 
		$encryption_key = Env::APP_KEY; 
		  
		// Use openssl_encrypt() function to encrypt the data 
		$encryption = openssl_encrypt($input, $ciphering, 
        $encryption_key, $options, $encryption_iv); 

  		$output = base64_encode($encryption);

		return $output; 
	}

	public static function check( string $input)
	{
		$input = base64_decode($input);
		// Store the cipher method 
		$ciphering = "AES-128-CTR"; 
		  
		// Use OpenSSl Encryption method 
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 
  
		// Non-NULL Initialization Vector for decryption 
		$decryption_iv = '1234567891011121'; 
		  
		// Store the decryption key 
		$decryption_key = Env::APP_KEY; 
		  
		// Use openssl_decrypt() function to decrypt the data 
		$output = openssl_decrypt ($input, $ciphering,  
		        $decryption_key, $options, $decryption_iv); 
		
		return $output; 
	}
}