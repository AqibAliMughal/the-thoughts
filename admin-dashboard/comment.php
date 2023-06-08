<?php
require '../functions.php';
requireFiles(
	[
	'../Classes/HTML', 
	'../Classes/CRUD', 
	'../Classes/Database',
	'../Classes/Redirect', 
	'../Classes/Role'
]);
$crud = new CRUD;
Database::getConnection();
Role::admin();

if( isset($_REQUEST['status']) ):
	$is = $crud -> update('post_comment', ['is_active' => 'Active'], ['post_comment_id', $_REQUEST['status']]);
	Redirect::to("index", ['msg'=> 'Activated.']);
endif;
/*
   =========================================
   |		FOR ADDING COMMENT INTO DATABASE   |
   =========================================
*/
if(isset($_REQUEST['add_comment'])):
	echo $comment = $_REQUEST['add_comment'];
	$comment = [ "comment" => $_REQUEST['add_comment'] ];
	 $crud -> insert('post_comment', $comment);
	 Redirect::to("comment", ['msg'=> 'Comment Added']);
endif;
/* 
	=============================
	|		FOR UPDATING CATEGORY	  |
	=============================
*/
if( isset($_REQUEST['cid']) ) $_SESSION['id'] = $_REQUEST['cid'];
	if( isset($_REQUEST['update_comment']) ):
	$time = update();
	if( $_REQUEST['update_comment'] !== ""):
		$update = $crud -> update('post_comment',
			['comment' => $_REQUEST['update_comment'],],
			([ 'post_comment_id', $_SESSION['id'] ]));
		Redirect::to("comment", ['msg'=> 'Comment Updated']);	
	else:
		Redirect::to("comment", ['errmsg'=> 'Fields cannot be empty, please fill.']);
	endif;
endif;
/* 
	================================
	|	 FOR CHANGING COMMENT STATUS |
	================================
*/
	if(isset($_REQUEST['c_status']) && $_REQUEST['c_status'] !== ""):
			$status = $crud -> select('post_comment', ['is_active'], ['post_comment_id' => $_REQUEST['c_status']]);
			if($status[0]['is_active'] === "Active")
			{
				$crud -> update('post_comment', ['is_active' => 'InActive'], ['post_comment_id', $_REQUEST['c_status']]);
			 Redirect::to("comment", ['errmsg'=> 'Inactivated.']);
			}
			else
			{
				$crud -> update('post_comment', ['is_active' => 'Active'], ['post_comment_id', $_REQUEST['c_status']]);
			 Redirect::to("comment", ['msg'=> 'Activated.']);
			}
	 endif;
//Displaying all time comments
$showComments = Database::query(
               "SELECT  
							 post_comment.post_comment_id, CONCAT(USER.first_name , ' ' ,USER.last_name ) AS user_name, SUBSTRING(post_comment.`comment`, 1, 20) AS comment,
							 SUBSTRING(post.`post_title`, 1, 30) AS Post_Title, post_comment.is_active
							 FROM USER
							 INNER JOIN post_comment
							 ON post_comment.user_id = user.user_id  
							 INNER JOIN post
							 ON post.post_id  = post_comment.`post_id`
							 WHERE post_comment.`is_active` = 'Active' 
							 ORDER BY post_comment.`post_comment_id` DESC"
							 );
/* 
   ========================
   |		HTML - VIEW   		|
   ========================
*/
$title = "Update Comment";
require_once '../assets/initial/navbar.php';
require_once 'html/comment.php';
HTML::footer();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>