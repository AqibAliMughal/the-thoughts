<?php
require_once '../functions.php';
requireFIles(
	[
		'../Classes/HTML', 
		'../Classes/Redirect', 
		'../Classes/Database', 
		'../Classes/CRUD',
		'../Classes/Role'
	]);
$crud = new CRUD;
Database::getConnection();
Role::admin();
$users = Database::query("
	SELECT user_id, CONCAT(first_name,' ', last_name) NAME,
	email, gender, user_image, is_active, is_approved 
	FROM USER WHERE role_id = 2 AND is_active = 'Active' ORDER BY user_id DESC
");

require_once '../assets/initial/navbar.php'; 
require_once 'html/users-all.php';
HTML::footer();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>