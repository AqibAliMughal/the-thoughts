<script defer>

	function Follow(blogID)
	{
		var obj;
		if(window.XMLHttpRequest)
		{
			obj = new XMLHttpRequest();
		}
		else
		{
			obj = new ActiveXObject("Microsoft.HTTPXML");
		}
		obj.onreadystatechange = function()
		{
			console.log(obj.readyState);
			if(obj.readyState == 4 && obj.status == 200)
			{
				document.getElementById('follow').innerHTML = obj.responseText;
				document.getElementById('showMessage').innerHTML = 'Following :)';
			}
		}
		obj.open("GET", "ajax-process.php?blogID="+blogID+"&action=follow");
		obj.send();
	}

	function unFollow(blogID)
	{
		var obj;
		if(window.XMLHttpRequest)
		{
			obj = new XMLHttpRequest();
		}
		else
		{
			obj = new ActiveXObject("Microsoft.HTTPXML");
		}
		obj.onreadystatechange = function()
		{
			console.log(obj.readyState);
			if(obj.readyState == 4 && obj.status == 200)
			{
				document.getElementById('follow').innerHTML = obj.responseText;
				document.getElementById('showMessage').innerHTML = 'Unfollowed :(';

			}
		}
		obj.open("GET", "ajax-process.php?blogID="+blogID+"&action=unfollow");
		obj.send();
	}

	function followPage(blogID)
	{

		var obj;
		if(window.XMLHttpRequest)
		{
			obj = new XMLHttpRequest();
		}
		else
		{
			obj = new ActiveXObject("Microsoft.HTTPXML");
		}
		obj.onreadystatechange = function()
		{
			console.log(obj.readyState);
			if(obj.readyState == 4 && obj.status == 200)
			{
				document.getElementById('follow').innerHTML = obj.responseText;
				document.getElementById('showMessage').innerHTML = message ;

			}
		}
		obj.open("GET", "ajax-process.php?blogID="+blogID+"&action=followPage");
		obj.send();
	}
</script>
<?php
	session_start();
	require_once'functions.php';
	require_once'partials/navbar.php';
	requireFiles(['Classes/CRUD', 'Classes/Database', 'Classes/HTML']);
	Database::getConnection();
	$crud = new CRUD;
	$postID =  $_REQUEST['pid'];
	$_SESSION['pid']= $_REQUEST['pid'];

	$blogName = Database::query("
		SELECT blog. blog_id , blog. blog_title , post. created_At  
		FROM post INNER JOIN blog  
		ON post. blog_id  = blog. blog_id  
		WHERE post. post_id  = $_REQUEST[pid]");
	$postDetails = $crud->select('post', ['post_title', 'post_summary', 'post_description', 'featured_image', 'is_comment_allowed'], ['post_id' => $_REQUEST['pid'] ]);

	$postAttachment = $crud->select(
		'post_atachment', 
		[
			'post_attachment_title',
			'post_attachment_path',
		],
		[
			'post_id' => $_REQUEST['pid']
		]
		);
	if( isset($_SESSION['user']) )
	{
		$userID = $_SESSION['user']['user_id'];
		$blogID = $blogName[0]['blog_id'];
		$follow = Database::query("SELECT * FROM following_blog WHERE follower_id = $userID AND blog_following_id= $blogID");
	}

	/*
	===============================
	|		SHOW COMMENTS 	  	  |
	===============================
	*/
$comments = Database::query("
					SELECT  post.`post_id`, user.user_id, CONCAT(USER.first_name , ' ' ,USER.last_name ) 
					AS user_name, user.user_image ,  post_comment.comment , post_comment.created_at  
					FROM USER
					INNER JOIN post_comment
					ON post_comment.user_id  = user.user_id  
					INNER JOIN post
					ON 
					post.`post_id` = post_comment.`post_id`
					WHERE post.`post_id` = post_comment.`post_id` AND post_comment.`is_active` = 'Active'
					ORDER BY user.user_id DESC");
	
	/*
	=================================
	|		EDIT COMMENT -REMAINS	|
	=================================
	*/
	if(isset($_SESSION['user'])):
$editComment = Database::query("SELECT user.`user_id`, post_comment.`comment` FROM post_comment
				INNER JOIN USER 
				ON user.`user_id` = post_comment.`user_id`
				WHERE user.user_id = $userID");
endif;
	/*
	==========================
	|		CUSTOMIZATION	 |
	==========================
	*/
if( isset($_SESSION['user']) )
{
	$isUserSettingExist = $crud->select('setting' , ['user_id'], ['user_id' => $userID]);
	if ( $isUserSettingExist )
	{
		$settings = $crud -> select('setting', ['setting_key', 'setting_value'], ['user_id' => $userID]);
		foreach ($settings as $property => $value) 
		{
			$property =  explode(";", $value['setting_key']);
			$value =  explode(";", $value['setting_value']);
		}
			$length = sizeof($property);
			$preferences = '';
		for ($i=0; $i <$length ; $i++) 
		{ 
			$preferences .= "$property[$i]: $value[$i];";
		}
	}
	else
	{
		// THIS WILL RUN AS A DEFAULT.
		$settings = $crud -> select('setting', ['setting_key', 'setting_value'], ['user_id' => 44]);

		foreach ($settings as $property => $value) 
		{
			$property =  explode(";", $value['setting_key']);
			$value =  explode(";", $value['setting_value']);
		}
		$length = sizeof($property);
		$preferences = '';
		for ($i=0; $i <$length ; $i++) 
		{ 
			$preferences .= "$property[$i]: $value[$i];";
		}
	}

}
	if( isset($_SESSION['user']) )
	{

     $previousSetting = $crud->select('setting', ['setting_key', 'setting_value'], ['user_id' => $userID]);
     if ( !empty($previousSetting) )
     {
	     foreach ($previousSetting as $key => $value) 
	     {
	        $property = explode(";", $value['setting_key']);
	        $value    = explode(";", $value['setting_value']);
	     }
     }
/*     $preferences = '';
     $length = sizeof($property);*/

     // var_dump($_SESSION['user']);

     $isFollowed = $crud->select('following_blog', ['status'], ['follower_id' => $userID]);
	}
     
	HTML::navbar();
	HTML::post();
	HTML::footer();
?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>