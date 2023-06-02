<?php

class Redirect
{
	public static function home()
	{
		if(isset($_SESSION['user']))
		{
			header("../index.php");
		}
	}

	public static function to($page = null, array $msg = null)
	{	
		$queryString = '?';
		foreach ($msg as $key => $value) {
			$queryString .= $key ."=". $value."&";
		}
		header("location:$page.php$queryString");
	}	
}
?>