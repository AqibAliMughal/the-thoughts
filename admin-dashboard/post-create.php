<?php 
require_once '../functions.php';
requireFiles(['../Classes/HTML', '../Classes/Redirect', '../Classes/CRUD', '../Classes/Database', '../Classes/Role']);
$crud = new CRUD;
Database::getConnection();
Role::admin();

if(isset($_REQUEST['post']))
{	
	extract($_REQUEST);
	extract($_FILES);
	$randomNumber   = rand(1000, 5000);	
	$tempName 		= $_FILES['featured_image']['tmp_name'];		
	$name 	  		= "Post_".$randomNumber.$_FILES['featured_image']['name'];
	$destination 	= "../assets/post/$name";
	move_uploaded_file($tempName, "$destination");
	$post = [
	"blog_id"				=> $page,
	"post_title"			=> $post_title,
	"post_summary"			=> $post_summary, 
	"post_description"		=> $post_description,
	"featured_image"		=> $name, 
	"is_comment_allowed"	=> $is_comment_allowed,
	];
	$insert = $crud->insert('post', $post);
	if($insert)
	{
		$postID =  mysqli_insert_id(Database::$connection) ;
		foreach ($category as $key => $value) 
		{
			Database::query("INSERT INTO post_category(post_id, category_id) VALUES($postID, $value)");
		}

		if($attachment['name'] !== '' AND $attachment['tmp_name'] !== '')
		{
			$randomNumber = rand();
			$fileName 		= "attachment_$randomNumber".$attachment['name'];
			$tempName 		= $attachment['tmp_name'];
			$destination 		= "../assets/attachments"; 
			(move_uploaded_file($tempName, "$destination/$fileName") );
			Database::query("INSERT INTO post_atachment(post_id, post_attachment_title, post_attachment_path) 
				VALUES ($postID, '".$attachment_title."', '".$attachment['name']."')");
		}
	}; 
	Redirect::to('index', ['msg' => 'Post Created.']);
}
if ( isset($_SESSION['user']) )
{
	if( $_SESSION['user']['role_id'] == '1')
	{
		$showCategoy = $crud->select('category', ['category_id', 'category_title']);
		$showBlogs = $crud->select('blog', ['blog_id', 'blog_title'], ['user_id' => $_SESSION['user']['user_id']]);
		$title = 'Create Post';
		require_once '../assets/initial/navbar.php'; 
		require 'html/post-create.php';
		HTML::footer();
	}
	else
	{
		Redirect::to('index');
	}
}
else
{
		Redirect::to('login', ['msg' => 'Please login to continue.']);
}
?>