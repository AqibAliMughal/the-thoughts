<?php
if( isset($_SESSION['user']) )
{
	if( isset($_REQUEST['status']))
	{
		Redirect::to('blogs', ['q' => $_SESSION['blogID']]);
	}
	// if( $_SESSION['user']['role_id'] === '1' )
	// {
		$_SESSION['blogID'] = ($_REQUEST['q']);
		$crud 		 		= new CRUD;
		Database::getConnection();
		$pageDetails = $crud->select('blog', 
			[
				'blog_id',
				'blog_title', 
				'blog_background_image',
				'post_per_page',
				'blog_status'
			],
			[ 'blog_id' => $_SESSION['blogID'] ]
		);
		$title = $pageDetails[0]['blog_title'];
		$name = $_SESSION['user']['NAME'];
		$posts = $crud->select('post', ['*'], ['blog_id' => $_REQUEST['q']]);
		$totalPosts = $crud->select('post', ["COUNT(post_id) as TotalPost" ], ['blog_id' => $_REQUEST['q']]);
		$totalFollowers = $crud->select('following_blog', ["COUNT(blog_following_id) AS totalFollowers" ], ['blog_following_id' => $_REQUEST['q']]);
		/*
		================== 
		|	HTML FILES 	 | 
		================== 
		*/
		require_once '../assets/initial/navbar.php';
		require_once 'html/blog-view.php';
		HTML::footer();
}
else
{
	Redirect::to('login', ['msg' => "Please login first to continue."]);
}
?>