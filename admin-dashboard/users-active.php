<?php
require_once '../functions.php';
requireFIles(['../Classes/Redirect', '../Classes/Database', '../Classes/CRUD', '../Classes/Role', '../Classes/HTML']);
$crud = new CRUD;
Database::getConnection();
Role::admin();

if(isset($_REQUEST['uid']))
{
	$crud -> update('user', ['role_id' => '1'], ['user_id', $_REQUEST['uid']]);
	Redirect::to('users-active', ['msg'=> 'New admin created']);
}
	/* ===== PAGINATION ===== */
	$totalPosts = $crud->select('user', ["COUNT(user_id) as user"], ['is_active' => 'Active', 'role_id' => 2]);
	if ( isset($_REQUEST['pageNumber']) ) { $id = $_REQUEST['pageNumber']; }
	else { $id = 1; }
	$startingRange = 0;
	$limit = 4;
	$startingRange = ($id-1) * $limit;
	$numberOfPages = (ceil($totalPosts[0]['user']/$limit)) - 1;
	$users  = Database::query("SELECT user_id, CONCAT(first_name,' ', last_name) NAME, email, gender, user_image FROM user WHERE role_id = '2' AND is_active = 'Active' LIMIT $startingRange, $limit");
$serialNumber = ($startingRange + 1);
require_once '../assets/initial/navbar.php'; 
require_once 'html/users-active.php';
HTML::footer();
?>