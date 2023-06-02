 <?php
session_start();
if(isset($_SESSION['user']))
{
	require 'functions.php';
	requireFiles(['Classes/Redirect', 'Classes/Validation']);
	Validation::logout();
	die();
}
else
{
	Redirect::to('login', ['msg' => 'Please login first']);
}
?>

