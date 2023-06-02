<?php
require_once '../functions.php';
requireFiles(['../Classes/CRUD', '../Classes/Database','../Classes/Redirect', '../Classes/Role']);
	Role::admin();
	if( $_SESSION['user']['role_id'] === '1' )
	{
		$_SESSION['blogID'] = ($_REQUEST['bid']);
		$crud 		 		= new CRUD;
		Database::getConnection();
		$pageDetails = $crud->select('blog', 
			[
				'blog_title', 
				'blog_background_image', 
				'blog_status'
			],
			[ 'blog_id' => $_SESSION['blogID'] ]
		);
		$title = $pageDetails[0]['blog_title'];
		$name = $_SESSION['user']['NAME'];
		$posts = $crud->select('post', ['*'], ['blog_id' => $_REQUEST['bid']]);
		$totalPosts = $crud->select('post', ["COUNT(post_id) as TotalPost" ], ['blog_id' => $_REQUEST['bid']]);

		/*
		================== 
		|	HTML FILES 	 | 
		================== 
		*/
		require_once '../assets/initial/navbar.php';
		require_once 'html/blog-view.php';
	}
	else
	{
		Redirect::to('index');
	}
?>