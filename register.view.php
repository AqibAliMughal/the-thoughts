<?php
ob_start(); 
session_start();
require_once 'functions.php';
requireFiles(
	[
		'classes/CRUD', 
		'classes/Database', 
		'classes/Redirect',
		'classes/PDF_Credentials',
		'classes/Validation',
		'classes/HTML',
		'classes/form',
	]
);
Database::getConnection();
$crud = new CRUD;
HTML::navbar();

if(isset($_REQUEST['signup']))
{
	extract($_REQUEST);
	extract($_FILES);
	$imageSize = $user_image['size'];
	$imageName = $user_image['name'];
	if($imageName === "")
	{
		$_SESSION['user_image'] = 'Please select an image.';
	}

	if( isset($_SESSION['user']) && $_SESSION['user']['role_id'] == '1' )
	{
		Email(
		'".$email."', 
		"sahmedrajput17@gmail.com",
		"Admin",
		"Account approval request", 
		"Dear user your account is created by an ADMIN please login to our website, thanks.
		");

		$randomNumber = rand(1000, 4000);
		$tmp = "Image_".$randomNumber.$_FILES['user_image']['tmp_name'];
		$name = "Image_".$randomNumber.$_FILES['user_image']['name'];
		$dest = 'assets/user_image';
		(move_uploaded_file($tmp, "$dest/$name"));
		$registrationFields = [
			"first_name" 	=> $first_name, 
			"last_name" 	=> $last_name, 
			"email" 		=> $email, 
			"password" 		=> $password,
			"gender" 		=> $gender,
			"date_of_birth" => $date_of_birth, 
			"user_image" 	=> $user_image['name'], 
			"address" 		=> $address,
			"is_approved"	=> 'Approved',
			"is_active"		=> 'Active',
		];
		$crud = new CRUD();
		$crud->insert('user', $registrationFields);
	}
	else
	{
		Validate::checkLength($first_name, "first_name", "First name must contains atleast 4 characters");
		Validate::checkLength($last_name, "last_name", "Last name must contains atleast 4 characters");
		Validate::email($email);
		Validate::isEmailMatched($email, $confirm_email, "Email is	 not matched");
		Validate::password($password);
		Validate::isPasswordMatched($password, $confirm_password, "Password is not matched");
		if($imageName !== "")
		{
			$arr = explode(".", $imageName);
			$extension = $arr[1];
			Validate::IsImageExtension($extension, $imageName);
			Validate::imageSize($imageSize);
		}
		if (Validate::$flag)
		{
			Email(
			 $email, 
			"sahmedrajput17@gmail.com",
			"Admin",
			"Account approval request", 
			"New user".$email."created an account, approve his/her request to allow him to navigate through your website.
			");
			$randomNumber = rand(1000, 4000);
			$tmp = "Image_".$randomNumber.$_FILES['user_image']['tmp_name'];
			$name = "Image_".$randomNumber.$_FILES['user_image']['name'];
			$dest = 'assets/user_image';
			(move_uploaded_file($tmp, "$dest/$name"));
			$registrationFields = [
			"first_name" 	=> $first_name, 
			"last_name" 	=> $last_name, 
			"email" 		=> $email, 
			"password" 		=> $password,
			"gender" 		=> $gender,
			"date_of_birth" => $date_of_birth, 
			"user_image" 	=> $user_image['name'], 
			"address" 		=> $address
			];
			$registeremail = $email;
			$registerpassword = $password;
			$_SESSION['email'] = $registeremail;
			$_SESSION['password'] = $registerpassword;
			$crud = new CRUD();
			$crud->insert('user', $registrationFields);
			Redirect::to('login', ['register' => "registeration successful."]); 
		}
	}
}
	?>
	<?php
	require 'clientSideValidation.php';
	form::register();
	HTML::footer();
	// require_once 'forms/registeration-form.php';
?>