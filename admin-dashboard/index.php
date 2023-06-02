<?php 
require_once '../functions.php';
requireFiles(['../Classes/Redirect','../Classes/HTML', '../Classes/CRUD', '../Classes/Database', '../Classes/Role']);
Database::getConnection();
$crud = new CRUD;
Role::admin();

	$name = $_SESSION['user']['NAME'];
	$html = 
	[
		"title" => "Dashboard | $name",
	];
	extract($html);

// Active/Inactive Users Information.
$userinfo = $crud -> select(
	'user', 
	[
		'user_id',
		"CONCAT(first_name, ' ', last_name)AS NAME",
		'email',
		'gender',
		'created_at',
		'user_image',
		'is_active',
	]
);

// Pending User Information.
$pendingUsers = $crud -> select(
	'user', 
	[
		'user_id',
		"CONCAT(first_name, ' ', last_name)AS NAME",
		'email',
		'gender',
		'created_at',
		'user_image',
		'is_approved',
	],
	['is_approved' => 'Pending']
);

// Showing Comments.
$comments = Database::query("
				SELECT  post_comment.post_comment_id, CONCAT(USER.first_name , ' ' ,USER.last_name ) 
				AS user_name, user.user_image ,  post_comment.comment , post_comment.created_at , post_comment.is_active 
				FROM USER
				INNER JOIN post_comment
				ON post_comment.user_id  = user.user_id  
				INNER JOIN post
				ON post.post_id  = post_comment.post_comment_id 
				ORDER BY user.user_id DESC");

	/* ADMIN - HTML*/
	require_once '../assets/initial/navbar.php';
	require_once 'html/admin-dashboard.php';
	HTML::footer();
	// require_once '../partials/footer.php';

 ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>