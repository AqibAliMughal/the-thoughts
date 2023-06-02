<?php 

$activePages = $crud->select(
	'blog', 
	[
		'blog_id', 
		'blog_title', 
	], 
	[
		'blog_status' => 'Active'
	]);

$followedBlogs = Database::query("
				SELECT COUNT(following_blog.`follow_id`)AS totalBlogFollowing, blog.`blog_id`, blog.`blog_title` AS blogTitle 
				FROM following_blog INNER JOIN blog 
				ON blog.`blog_id` = following_blog.`blog_following_id`
				WHERE following_blog.`status` = 'Followed'  
				AND following_blog.`follower_id` = $userID
				");


$categories = $crud->select(
	'category', 
	[
		'category_id', 
		'category_title'
	], 
	[
		'category_status' => 'Active'
	]);

$title = "Dashboard | ".$_SESSION['user']['NAME'];
require_once '../assets/initial/navbar.php';
require_once 'html/dashboard.php';
HTML::footer();
?>