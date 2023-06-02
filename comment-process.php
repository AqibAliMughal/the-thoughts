<?php
session_start();
require_once 'functions.php';
requireFiles(['Classes/CRUD', 'Classes/Database', 'Classes/Redirect']);
$crud = new CRUD;
Database::getConnection();

$userID  = $_SESSION['user']['user_id'];
$postID  = $_REQUEST['postID'];
$comment = ($_REQUEST['add_comment']);

$comment = 
[
	'post_id'	=> $postID,
	'user_id' 	=> $userID,
	'comment'	=> $comment,
];
$crud->insert('post_comment', $comment);
Redirect::to('post', ['pid' => $postID]);
?>