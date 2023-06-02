<?php 
require '../functions.php';
requireFiles(['../Classes/Database','../Classes/CRUD', '../Classes/Redirect', '../Classes/HTML', '../Classes/Role' ]);
Database::getConnection();
$crud = new CRUD;
Role::user();
$userID = $_SESSION['user']['user_id'];

if( isset($_SESSION['user']) )
{
	if( isset($_REQUEST['q']) )
	{
		if($_REQUEST['q'] == "")
		{
			require 'logic/dashboard.php';
		} 

		else if ($_REQUEST['q'] == is_numeric($_REQUEST['q']) )
		{
			require 'logic/blogs.php';
		} 
		else if ( $_REQUEST['q'] == "=")
		{
			require 'logic/edit-profile.php';
		}
	}
}
else
{
	Redirect::to('../login', ['msg' => 'Login first to continue.']);
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>