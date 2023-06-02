<?php

class Validate
{
	protected static $error_message 	 = '';
	public static $flag 						   = false;
	protected static $name_pattern     = "/^[A-Z]{1}[a-z]{2,30}$/";
	protected static $password_pattern = "/[A-Z a-z]{4,20}[0-9]{4,10}/";
	protected static $email_pattern 	 = "/^[a-z]{2,15}[0-9]{1,5}[@][a-z]{5,8}[.][a-z]{2,6}$/";
	
	public static function login($email, $password)
	{
		if($email == "" || $password == "")
		{
			$_SESSION['login-msg'] = "Please enter an Email/Password.";
		}
		else
		{
			$crud = new CRUD;
			$userIs = $crud -> select("user", ["user_id", "role_id", "CONCAT(first_name,' ' ,last_name) NAME", "email", "PASSWORD", 'is_active', 'is_approved'], ["email" => $email, "password" => $password]);
			if ( !empty($userIs) )
			{
				$status  = $userIs[0]['is_active'];
				$request = $userIs[0]['is_approved'];
				if( $userIs[0]['role_id'] == 1 || $userIs[0]['role_id'] == 2 ):

                // If Role type is ADMIN then redirect to admin dashboard...
				if ( $userIs > 1 )
				{
					Redirect::to("login");
					if($userIs[0]['role_id'] == 1)
					{
						$_SESSION['user'] = $userIs[0];
						Redirect::to("admin-dashboard/index", ['action'=>'aid']);
					}
                // Check user STATUS / REQUEST then redirect according to that...
					else
					{
						if($userIs[0]['is_approved'] !== 'Approved'):
							switch ( $request ) 
							{
								case 'Pending':
								$_SESSION['login-msg'] = "Your request is being processed, please check your email after a while .";
								break;
								case 'Rejected':
								$_SESSION['login-msg'] = "Your request was rejected,<a href='forms/contact.php'>@Contact</a> admin for more.";
								break;
							}
						else:
							switch ($status) 
							{
								case 'InActive':
								$_SESSION['login-msg'] = "You have been Deactivated<a href='forms/contact.php'>@Contact</a> admin for more.";
								break;
								case 'Active':
								$_SESSION['user'] = $userIs[0];
								Redirect::to("user-dashboard/index", ['q'=>'']);
								break;
							}
						endif;
					}
				}
				endif;
			}
			else
			{
				$_SESSION['login-msg'] = "Invalid Credentials.";
			}
		}
	}

	public static function logout()
	{
		if(isset($_SESSION['user']))
		{
			session_unset();
			session_destroy();
			Redirect::to("login", ['msg'=>'Logout Successfully']);
		}
		else
		{
			Redirect::to("login", ['msg'=>'Please login first']);
		}
	}

	/* 
	========================================================================
	|				METHODS FOR REGISTER FORM CREDENTIALS													 |
	========================================================================
	*/
	public static function checkLength($input, $key, string $message=null)
	{
		if ( strlen($input) < 4)
		{
			self::$flag = false;
			$_SESSION["$key"] = ("Field must be atleast 4 characters.");
		}
		else
		{
			if ( !preg_match(self::$name_pattern, $input) )
			{	
				self::$flag = false;
				if($key === 'last_name')
					$_SESSION["$key"] = ("First letter must be capital (Ahmed)");
				else
				$_SESSION["$key"] = ("First letter must be capital (Muzamil)");
			}
			else
			{
				if($key === 'first_name')
				$_SESSION['f_name'] = $input;
				else
				$_SESSION['l_name'] = $input;
				self::$flag = true;
				self::$error_message .= "";
			}
		}
	} 

	public static function email($email)
	{
		if( $email == "")
		{
			self::$flag = false;
			$_SESSION["isEmail"] ="Please enter an email address";
		}
		else 
		{
			if( !preg_match (self::$email_pattern, $email) )
			{
				self::$flag = false;
				$_SESSION["isEmail"] ="Email must like: sahmedrajput17@gmail.com";
			}
			else
			{	
				self::$flag = true;
				$_SESSION['email'] = $email; 

			}
		}
	}
	public static function isEmailMatched($inputOne, $inputTwo, $message = Null)
	{
		if($inputTwo === '')
		{
			$_SESSION['confirm_email'] = 'Please enter confirm email address';
		}
		elseif( !preg_match(self::$email_pattern, $inputTwo) )
		$_SESSION['confirm_email'] = 'Email must like: sahmedrajput17@gmail.com';
		else
		$_SESSION['confirmEmail'] = $inputTwo;
		
		if( $inputOne !== $inputTwo )
		{	
			$_SESSION["confirm_email"] ="$message";
		}
	}
	public static function password($password)
	{
		if( $password == "")
		{	
			self::$flag = false;
			$_SESSION["password"] ="Please enter password";
		}
		else
		{
			if( !preg_match(self::$password_pattern, $password))
			{
				self::$flag = false;
				$_SESSION["password"] = "Password must be atleast 8 character containing [a-z][0-9]";
			}
			else
			{
				self::$flag = true;
			}
		}
	}
	public static function isPasswordMatched($inputOne, $inputTwo, $message = Null)
	{
		if($inputTwo === '')
		{
			self::$flag = false;
			$_SESSION["confirm_password"] ="Please enter confirm password";
		}
		elseif( !preg_match(self::$password_pattern, $inputTwo) )
		{
			self::$flag = false;
			$_SESSION["confirm_password"] = "Password must be atleast 8 character containing [a-z][0-9]";
		}
		else
		$_SESSION['confirmPassword'] = $inputTwo; // For setting value in form
		
		if( $inputOne !=='' &&  $inputTwo !=='' && $inputOne === $inputTwo )
		{	
			self::$flag = true;
		}
		elseif( $inputOne !== $inputTwo )
		{
			self::$flag = false;
			$_SESSION["confirm_password"] ="$message";
		}	
	}

	public static function IsImageExtension($extension, $imageName)
	{
		if($imageName == "")
		{
			self::$flag = false;
			$_SESSION["user_image"] ="Please select an image";
		}
		else
		{
			$validExtension = ['jpeg', 'png', 'jpg'];
			if ( !(in_array($extension, $validExtension)) )
			{
				self::$flag = false;
				$_SESSION["user_image"] ="Invalid Image Format";
			}
			else 
			{
				self::$flag = true;
				self::$error_message .= "";
			}
		}
	}

	public static function imageSize($size)
	{
		define('mb', 1048576); //Image size less than a mb.
		if($size == 0)
		{
			self::$flag = false;
			$_SESSION["user_image"] ="Please select an Image.";			
		}
		else if($size < mb)
		{	
			self::$flag = false;
			$_SESSION["user_image"] ="File size must be less than 1 mb.";
		}
	}

	public static function showError()
	{
		if( self::$flag == false)
		{
			Redirect::to("register.view", ['msg' => 'Error Occured']);
		}
		else
		{
			session_destroy();
		}
		return self::$flag;
	}
}
?>