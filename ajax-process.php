<?php 
session_start();
require_once 'functions.php';
requireFiles(['Classes/CRUD', 'Classes/Database', 'Classes/HTML']);
$crud = new CRUD;
Database::getConnection();

if( isset($_REQUEST['blogID']) && $_REQUEST['action'] == "follow")
{

	$unfollowed = $crud->update(
				"following_blog", 
				[
					'status' => 'Followed'
				], 
				[ 'follower_id', $_SESSION['user']['user_id'] ] 
			);
}

if( isset($_REQUEST['blogID']) && $_REQUEST['action'] == "unfollow")
{
	$follow = $crud->update(
				"following_blog", 
				[
					'status' => 'UnFollowed'
				], 
				[ 'follower_id', $_SESSION['user']['user_id'] ] 
			);
}

if( isset($_REQUEST['blogID']) && $_REQUEST['action'] == "followPage")
{
	$userID = $_SESSION['user']['user_id'];
	$blogID = $_REQUEST['blogID'];
	Database::query("INSERT INTO following_blog(follower_id, blog_following_id) VALUES($userID,  $blogID)");
}

?>