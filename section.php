<?php 
/* =========== DISPLAYING CATEGORY WISE POSTS =========== */
if( isset($_REQUEST['cat_id']) )
{
$category = $_REQUEST['cat_id'];
$posts = Database::query("
				SELECT post.`post_id` ,SUBSTRING(post.post_title, 1, 40) AS post_title , SUBSTRING(post.post_summary, 1, 72) AS post_summary, post.`featured_image`, post.`created_at`, category.`category_title`
					FROM post 
					INNER JOIN post_category 
					ON post.`post_id` =  post_category.`post_id`
					INNER JOIN category 
					ON category.`category_id` = post_category.`category_id`
					WHERE post.`post_status` = 'Active' AND category.`category_id` = $category
					GROUP BY post.`post_id` 
					ORDER BY post.`post_description` DESC 
				");
}
/* ========== DISPLAYING SEARCHED POSTS =========== */
else if( isset($_REQUEST['query']) && !empty($_REQUEST['query']) )
{
	$query = $_REQUEST['query'];
$posts 	 =  Database::query("
				SELECT post.`post_id` ,SUBSTRING(post.post_title, 1, 40) AS post_title , SUBSTRING(post.post_summary, 1, 72) 
				AS post_summary, post.`featured_image`, post.`created_at`, category.`category_title`
				FROM post 
				INNER JOIN post_category 
				ON post.`post_id` =  post_category.`post_id`
				INNER JOIN category 
				ON category.`category_id` = post_category.`category_id`
				WHERE post.`post_status` = 'Active' 
				AND (post.`post_title` LIKE '%$query%' OR post.`post_summary` LIKE '%$query%' OR post.`post_description` LIKE '%$query%') 
				GROUP BY post.`post_id` 
				ORDER BY post.`post_description` DESC 
				");
}

else if( isset($_REQUEST['date']) && !empty($_REQUEST['date']) )
{
	$date = $_REQUEST['date'];
	$posts 	 =  Database::query("
				SELECT post.`post_id` ,SUBSTRING(post.post_title, 1, 40) AS post_title , SUBSTRING(post.post_summary, 1, 72) 
				AS post_summary, post.`featured_image`, post.`created_at`, category.`category_title`
				FROM post 
				INNER JOIN post_category 
				ON post.`post_id` =  post_category.`post_id`
				INNER JOIN category 
				ON category.`category_id` = post_category.`category_id`
				WHERE post.`post_status` = 'Active' 
				AND (post.`created_at` LIKE '%$date%') 
				GROUP BY post.`post_id` 
				ORDER BY post.`post_description` DESC 
				");
}

/* =========== DISPLAYING GENERAL(recent) POSTS =========== */
else
{
	/* ===== PAGINATION ===== */
	$totalPosts = $crud->select('post', ["COUNT(post.`post_id`) as post"], ['post.post_status' => 'Active']);
	if ( isset($_REQUEST['pageNumber']) ) { $id = $_REQUEST['pageNumber']; }
	else { $id = 1; }
	$startingRange = 0;
	$limit = 9;
	$startingRange = ($id-1) * $limit;
	$numberOfPages = (ceil($totalPosts[0]['post']/$limit) - 1);

$posts 	 =  Database::query("
				SELECT post.`post_id` ,SUBSTRING(post.post_title, 1, 44) AS post_title , SUBSTRING(post.post_summary, 1, 70) 
				AS post_summary, post.`featured_image`, post.`created_at`, category.`category_title`
				FROM post 
				INNER JOIN post_category 
				ON post.`post_id` =  post_category.`post_id`
				INNER JOIN category 
				ON category.`category_id` = post_category.`category_id`
				WHERE post.`post_status` = 'Active'
				GROUP BY post.`post_id` 
				ORDER BY post.`post_description` DESC 
				LIMIT $startingRange,9
				");

$serialNumber = ($startingRange + 1);
}
global $numberOfPages;
$recentPosts = Database::query("SELECT post_id, blog_id ,post_title, featured_image FROM post order by post_id DESC LIMIT 5");
$blogName 	 = $crud->select('blog', ['blog_title'], ['blog_id' => $recentPosts[0]['blog_id']]);
HTML::section();
HTML::aside();
echo "<center>";
pagination($numberOfPages, 'index');
echo "</center>";
?>