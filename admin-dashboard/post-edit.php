<?php 
require_once '../functions.php';
requireFiles(
	[
	'../Classes/Redirect', 
	'../Classes/CRUD', 
	'../Classes/Database', 
	'../Classes/Upload',
	'../Classes/HTML',
	'../Classes/Role'
]);
$crud = new CRUD;
Database::getConnection();
Role::admin();

if( isset($_REQUEST['update']) )
{
	extract($_REQUEST);
	extract($_FILES);
	$randomNumber   = rand(1000, 5000);
	if($featured_image['name'] == '')
	{
		$crud->update
		(
			'post',
			[
				"post_title" 		 => $post_title,
				"post_summary" 		 => $post_summary,
				"post_description"   => $post_description,
				"is_comment_allowed" => $is_comment_allowed,
				"updated_at" 		 => update(),
			],
			[
				'post_id', $_SESSION['update_post_id']
			]
		);
//Remains
/*		$crud->update
		(
			'post_category',
			[
				"category_id" => $category[0],
				"updated_at" => update(),
			],
			[
				'post_id', $_SESSION['update_post_id']
			]
		);*/
	}

	elseif ($featured_image['name'] !== '') 
	{
		$tempName 		= $_FILES['featured_image']['tmp_name'];		
		$name 	  		= "UpdatedPost_".$randomNumber.$_FILES['featured_image']['name'];
		$destination 	= "../assets/post/$name";
		move_uploaded_file($tempName, "$destination");
		$crud->update
		(
			'post',
			[
				"post_title" 		 => $post_title,
				"post_summary" 		 => $post_summary,
				"post_description"   => $post_description,
				"featured_image"	 => $featured_image['name'],
				"is_comment_allowed" => $is_comment_allowed,
				"updated_at" 		 => update(),
			],
			[
				'post_id', $_SESSION['update_post_id']
			]
		);
	}

		if ($attachment['name'] !== '') 
	{
		$tempName 		= $_FILES['featured_image']['tmp_name'];		
		$name 	  		= "UpdatedAttachment_".$randomNumber.$_FILES['featured_image']['name'];
		$destination 	= "../assets/attachments/$name";
		move_uploaded_file($tempName, "$destination");
		$crud->update
		(
			'post_atachment',
			[
				"post_attachment_title" => "attachment_".$attachment['name'],
				"post_attachment_path"	=> "attachment_".$attachment['name'],
				"updated_at" 		 => update(),
			],
			[
				'post_id', $_SESSION['update_post_id']
			]
		);
	}
	Redirect::to('index', ['msg' => 'Updated.']); //INDEX MEANS ADMIN-DASHBOARD
	die();
}

if ( isset($_SESSION['user']) )
{
	if( $_SESSION['user']['role_id'] == '1')
	{
		$post = $crud->select('post', ['*'], ['post_id' => $_REQUEST['pid']]);
		$postID = $post[0]['post_id'];
		$_SESSION['update_post_id'] = $postID;
		$postCategory = Database::query("
			SELECT category_title FROM post 
			INNER JOIN post_category 
			ON post.`post_id` = post_category.`post_id` 
			INNER JOIN category 
			ON post_category.`category_id` = category.`category_id` 
			WHERE post.`post_id` = $postID");
		
		$postBlog = Database::query("
			SELECT blog_title FROM post 
			INNER JOIN blog 
			ON post.`blog_id` = blog.`blog_id` 
			WHERE post_id = $postID");

		$showCategoy = $crud->select('category', ['category_id', 'category_title']);
		$showBlogs = $crud->select('blog', ['blog_id', 'blog_title'], ['user_id' => $_SESSION['user']['user_id']]);
		require_once '../assets/initial/navbar.php'; 
		require 'html/post-edit.php';
		HTML::footer();
	}
	else
	{
		Redirect::to('index');
	}
}
else
{
		Redirect::to('login.view', ['msg' => 'Please login to continue.']);
}
?>