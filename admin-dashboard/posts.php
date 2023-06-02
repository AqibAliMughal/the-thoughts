<?php
require_once '../functions.php';
requireFIles(['../Classes/Redirect', '../Classes/Database', '../Classes/CRUD', '../Classes/HTML', '../Classes/Role']);
$crud = new CRUD;
Database::getConnection();
Role::admin();

$userID = $_SESSION['user']['user_id'];
$totalPosts = Database::query("	SELECT COUNT(post.`post_id`) AS 'post'  FROM post 
							INNER JOIN post_category 
							ON post.`post_id` =  post_category.`post_id`
							INNER JOIN category 
							ON category.`category_id` = post_category.`category_id`
							INNER JOIN blog
							ON blog.`blog_id` = post.`blog_id`");

if ( isset($_REQUEST['pageNumber']) ) { $id = $_REQUEST['pageNumber']; }
	else { $id = 1; }
	$startingRange = 0; 					
	$limit = 4;													
	$startingRange = ($id-1) * $limit;							
	$numberOfPages = (ceil($totalPosts[0]['post']/$limit) - 1);
	
	$posts = Database::query(
		"SELECT post.`post_id`, blog.`blog_title` ,post.`post_id` ,SUBSTRING(post.post_title, 1, 40) AS post_title , SUBSTRING(post.post_summary, 1, 40) AS post_summary, category.`category_title`
					FROM post 
					INNER JOIN post_category 
					ON post.`post_id` =  post_category.`post_id`
					INNER JOIN category 
					ON category.`category_id` = post_category.`category_id`
					INNER JOIN blog
					ON blog.`blog_id` = post.`blog_id`
					WHERE blog.`user_id` = $userID
					-- GROUP BY post.`post_id` 
					ORDER BY post.`post_id` DESC LIMIT $startingRange, $limit"
		);

$serialNumber = ( $startingRange + 1 );
requireFiles(['../assets/initial/navbar', 'html/posts',]);
HTML::footer();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>