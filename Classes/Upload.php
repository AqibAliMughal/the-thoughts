<?php

class Upload
{
	public static function file(string $tempName, string $name, string $destination)
	{
		$randomNumber   = rand(1000, 5000);	
		$tempName 		= $_FILES['featured_image']['tmp_name'];		
		$name 	  		= "UpdatedPost_".$randomNumber.$_FILES['featured_image']['name'];
		// $destination 	= "../assets/post/$name";
		move_uploaded_file($tempName, "$destination");
	}
}

?>