<?php 
class HTML
{
	public static function search()
	{	?>
		<form action="index.php" method="POST" class="d-flex my-5 position-absolute top-20 start-50 translate-middle" style="width: 550px; ">
        <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
        <input  type="date" name="date">
        <button class="mx-2 btn btn-outline-success" type="submit" name="search">Search</button>
      </form>
      <br><br>
		<?php
	}
	public static function navbar()
	{ 
		global $crud;
		global $title;
		$categories = $crud->select('category', ['category_id', 'category_title'], ['category_status' => 'Active']);
		?>
		<!DOCTYPE html>
		  <html>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <title><?= isset($title) ? $title : "The Thoughts | Tech & Freelancing Updates" ?> </title>
		   <link rel=  "stylesheet" href="bootstrap/css/bootstrap.min.css">
		  <link rel="stylesheet" type="text/css" href="style.css">
		  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
		</head>
		<body>
		  <nav class="navbar navbar-expand-lg ">
		    <div class="container-fluid">
		      <a class="navbar-brand nav-text" href="javascript:void(0)">
						<strong>{ The Thoughts }</strong>
					</a>
		      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		      </button>
		      <div class="collapse navbar-collapse" id="navbarSupportedContent">
		        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		          <li class="nav-item">
		            <a class="nav-link nav-text" aria-current="page" href="index.php">Home</a>
		          </li>
		          <?php 
		            if(isset($_SESSION['user']))
		            {
		                if($_SESSION['user']['role_id'] == '2'):
		              ?>
		          		<li class="nav-item dropdown mt-2">
		            	<a class="nav-text dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
		            <ul class="dropdown-menu">
		            <?php 
		              foreach ($categories as $key => $value):  ?>
		              <li><a class="dropdown-item" href="index.php?id=<?= $value['category_id']?>"><?= $value['category_title']?></a></li>
		            <?php
		            endforeach;
		            ?>
		            </ul>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link nav-text" aria-current="page" href=<?= isset($contactURL)? $contactURL : "contact.php"?>>Contact Us
		        </a>
		          </li>
		        <?php 
		                endif;
		            }
		          else
		            {?>
		          <li class="nav-item dropdown mt-2">
		            <a class="nav-text dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		              Categories
		            </a>
		            <ul class="dropdown-menu">
		            <?php 
		              foreach ($categories as $key => $value):  ?>
		              <li><a class="dropdown-item" href="index.php?cat_id=<?= $value['category_id']?>"><?= $value['category_title']?></a></li>
		            <?php
		            endforeach;
		            ?>
		            </ul>
		          </li>
		          <li class="nav-item"><a class="nav-link nav-text" aria-current="page" href="contact.php">Contact Us</a>
		          </li>
		        <?php
		        }
		        ?>
		        </ul>
		        <form class="d-flex">
		          <?php 
		          if( isset($_SESSION['user']) )
		          {

		            $profilePicture = $crud->select('user', ['user_image', 'role_id'], ['user_id' => $_SESSION['user']['user_id'] ]);
		           ?>
		           <div class="dropdown">
		            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
		              <img src="assets/user_image/<?= $profilePicture[0]['user_image']?>" alt="Profile Picture" width="32" height="32" class="rounded-circle me-2">
		              <strong>Welcome, <?=$_SESSION['user']['NAME'] ?></strong>
		            </a>
		            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
		              <li><a class="dropdown-item" href="#">New project...</a></li>
		              <li><a class="dropdown-item" 
		              	href="<?= ($_SESSION['user']['role_id'] == '1')? "admin-dashboard/index.php" : "user-dashboard/index.php?q="?>">
		              Profile</a></li>
		              <li><hr class="dropdown-divider"></li>
		              <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
		            </ul>
		          </div>
		          <?php 
		            if( isset($_REQUEST['action']) && ($_REQUEST['action'] == 'aid' || $_REQUEST['action'] == 'uid') )
		            {
		          ?>
		          <a href="../logout.php" name="logout" class="btn btn-primary"> Logout </a>            
		          <?php 
		            }
		        }
		        else
		        {
		          ?>
		          <a href="#" class="form-button" data-bs-toggle="modal" data-bs-target="#login-form"> Sign in </a>            
		          <a href="register.view.php" class="btn form-button-link">Sign up</a>
		          <?php 
		        } 
		        ?>
		      </form>
		    </div>
		  </div>
		</nav>
		<?php 
		  if( !isset($_SESSION['user']) )
		  {
		?>
		<?php } ?>

		<div class="modal fade " id="login-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"     aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h1 class="modal-title fs-5" id="staticBackdropLabel">Login</h1>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <center>
		        <form action="login.php" method="POST" class="mb-5">
		          <table class="mt-4">
		            <td colspan="2">
		              <tr>
		                <span class="login-msg" style="">  
		                  <?=isset($_SESSION['login-msg']) ? $_SESSION['login-msg'] : ""?>
		                </span>
		              </tr>
		            </td>
		            <tr class="my-5">
		              <th>Email: </th>
		              <td>
		                <input class="form-control" type="email" name="email" id="" placeholder="Email Here...">
		              </td>
		            </tr>
		            <tr>
		              <th>Password: </th>
		              <td>
		                <input class="form-control" type="password" name="password" id="" placeholder="Password Here...">
		              </td>
		            </tr>
		            <tr>
		              <td></td>
		              <td colspan="2">
		                <a href="javascript:void(0)" class="form-links" data-bs-toggle="modal" data-bs-target="#forget-form">Forget Password?</a> 
		              </td>
		            </tr>
		            <tr>
		              <td></td>
		              <td colspan="2">
		                <input type="submit" class="btn mb-3 btn-block login-up-btn" name="login" value="Login">
		              </td>
		            </tr>   
		          </table>
		        </form>
		      </center>
		    </div>
		  </div>
		</div>

		<div class="modal fade " id="forget-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"     aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h1 class="modal-title fs-5" id="staticBackdropLabel">Recover Password</h1>
		        <span class="forget-msg"><?= isset($_SESSION['forget-msg']) ? $_SESSION['forget-msg'] : "" ?></span>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <center>
		        <h5 class="mt-2">Enter your email to get your password</h5>
		        <form action="forget-password.php" method="POST">
		          <table class="mt-4">
		            <tr class="my-5">
		              <td>
		                Email
		                <input class="form-control" type="email" name="email" id="" placeholder="Enter your email">
		              </td>
		            </tr>
		          </table>
		          <br/>
		          <input type="submit" class="btn mb-3 btn-block login-up-btn" name="recover" value="Recover">
		        </form>
		      </center>
		    </div>
		  </div>
		</div>
	<?php 
	}

	public static function carousel()
	{?>
		<div class="container mt-5">
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8 col-md-12 col-sm-12 mb-5">
					<!-- SLIDER / CAROUSEL - HOME PAGE -->
					<div id="carouselExampleDark" class="carousel carousel-dark slide">
						<div class="carousel-indicators">
							<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
							<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
							<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
						</div>
						<div class="carousel-inner">
							<div class="carousel-item active" data-bs-interval="10000">
								<img src="assets/slider.png" class="d-block rounded" alt="...">
								<div class="carousel-caption d-none d-md-block">
									<h5>Mechanical Keyboards are game changer</h5>
								</div>
							</div>
							<div class="carousel-item" data-bs-interval="2000">
								<img src="assets/slider1.jpg" class="d-block rounded" alt="...">
								<div class="carousel-caption d-none d-md-block">
									<h5>Gaming chip for which you are looking for.</h5>
								</div>
							</div>
							<div class="carousel-item">
								<img src="assets/slider3.jpg" class="d-block rounded" alt="...">
								<div class="carousel-caption d-none d-md-block">
									<h5>Keyboards that gives you feel of each click. </h5>
								</div>
							</div>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
				</div>
				<div class="col-lg-2"></div>
			</div>
	<?php
	}
	public static function section()
	{
		global $posts;
		?>
		<main>	
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12">
					<div class="row">
						<?php
						if( !empty($posts) )
						{
							foreach ($posts as $key => $post):
								$postCategories = Database::query("
								SELECT category.`category_title` FROM post INNER JOIN post_category 
									ON post.`post_id` = post_category.`post_id` 
									INNER JOIN category
									ON category.`category_id` = post_category.`category_id`
									WHERE post_category.`post_id` = $post[post_id]
								");
								?> 
								<div class="col-lg-4 my-2">
									<div class="card card-post">
										<img src="assets/post/<?= $post['featured_image']?>" class="card-img-top" alt="Blog Post 1" height="190px">
										<div class="card-body">
											<span> Published: <?= createdAt($post['created_at']) ?></span>
											<h5 class="card-title"><b> <?= $post['post_title'] ?> </b></h5>
											<p class="card-text"><?= $post['post_summary'] ?> </p>
											<hr/>
											<?php
											foreach ($postCategories as $key => $category): ?>
											<span class="categoryTags"> <?= $category['category_title'] ?></span>
											<?php
										endforeach;
											?>
												<center><a target="post" href="post.php?pid=<?= $post['post_id']?>" class="read-blog-link">Read</a></center>
											</div>
										</div>
								</div>	
						<?php	
						endforeach;
						}
						else
						{
							echo "<h2 style='color:#4f2cd0'>No Post Found</h2>";
						}
						?>
					</div>
				</div>
		<?php 
	}

	public static function aside()
	{  
		// global $crud;
		global $recentPosts; 
		?>
		<div class="col-lg-3 col-md-3 col-sm-12 recent-post-section" style="height: 750px;">
						<aside> 
							<h2 class="text-center mt-2 mb-4 recent-post-text">Recent Post</h2>
							<?php
							if(isset($recentPosts) || $recentPosts !== '')
							{
							foreach ($recentPosts as $key => $post): ?>
								<div class="row my-3"> 
									<div class="col-lg-4 col-md-12 col-sm-12">
										<img src="assets/post/<?= $post['featured_image']?>" style="border-radius: 3px; width: 80px; height: 80px;" >
									</div>
									<div class="col-lg-8 col-md-12 col-sm-12">
										<h5>
											<a class="right-side-links" style="color: blue; font-size: 18px" href="post.php?pid=<?= $post['post_id']?>">
											<?= $post['post_title']?>
											</a>
										</h5>
									</div>
								</div>
								<?php 
							endforeach;
							}
							else
							{
								echo "<h3>No Post Found.</h3>";
							} ?>
						</aside>
					</div>
				</div>
			</div>
		</main>
		<?php
	}

	public static function post()
	{	
		global $postDetails;
		global $blogName;
		global $postAttachment;
		global $follow;
		global $blogID;
		global $postID;
		global $comments;
		global $editComment;
		global $preferences;
		global $isFollowed;
		?>
		<!DOCTYPE html>
		  	<html>
			  <head>
			  <meta charset="utf-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1">
			  <title><?= isset($title) ? $title : ".Blogger | Tech & Freelancing Updates" ?> </title>
			   <link rel=  "stylesheet" href="bootstrap/css/bootstrap.min.css">
			  <link rel="stylesheet" type="text/css" href="style.css">
			 </head>
			 <style type="text/css">
			 	body
			 	{
			 		<?= $preferences;?>
				}
			 </style>
			<body>
				<div class="container">
					<div class="row">
						<div class="col-lg-1 col-md-1 col-sm-12 "></div>
						<div class="col-lg-9 col-md-9 col-sm-12">
							<h1 class="post-title mb-4"> <strong><?= $postDetails[0]['post_title']?></strong> </h1>
					<div class="post-by">
						<div class="publisher-info">
							By: <span class="publisher-name" style="color: #ab59fd"> 
							<strong><?= strtoupper($blogName[0]['blog_title'])?></strong></span>
							<span>| Published: <?= createdAt($blogName[0]['created_At'])?></span>
							</span>
						</div>
						<div>
							<ul>
								<li><a href="">Twitter</a></li>
								<li><a href="">Facebook</a></li>
								<li><a href="">Whatsapp</a></li>
							</ul>
						</div>
					</div>
					<img class="featured-post" src="assets/post/<?= $postDetails[0]['featured_image']?>" width="96.6%" height="30%">
					<div class="post-content my-5 mx-2" style= width="96.6%">
						<div>
							<p style="color: gray; font-size: 16px"> <b>&#34;</b> <i> <?= $postDetails[0]['post_summary']?> </i> <b>&#34;</b>
							<p class="post-description"> <?= $postDetails[0]['post_description']?> </p>
							<?php 
							if ( !($postAttachment == "") ):?>
								<h5> <strong style="color: #4F2CD0">Attachment:</strong> </h5>
								<span> <?= $postAttachment[0]['post_attachment_title']?></span>
								<span style="color:blue"> [ <?= $postAttachment[0]['post_attachment_path']; ?> ]</span>
							<?php 
						endif;
							
							/* ========== ADD COMMENT ============*/
							if(isset($_SESSION['user'])):
							if( $postDetails[0]['is_comment_allowed'] == '1' ): ?>
								<form action="comment-process.php?postID=<?=$postID?>" method="POST">
									<textarea name="add_comment" cols="100" rows="3" placeholder="Add Comment..."></textarea>
									<br/>
									<input type="submit" value="Comment" class="my-2 add-comment">
								</form>
								<?php 
							endif;
								?>
							<!-- FOLLOW || THEME CUSTOMIZATION -->
							<div  style="display:flex; justify-content: space-between;">
								<form action="javascript:void(0)" method="POST">
									<?php 
									if( !empty($isFollowed))
									{
										
										if( $isFollowed[0]['status'] === 'Followed' )
										{ ?>
										
											<button class="follow-blog-btn" id="follow" name="follow" onclick="unFollow(<?= $blogID?>)">UNFOLLOW</button>

										<?php 
										}

										else
										{  ?>
											<button class="follow-blog-btn" id="follow" name="follow" onclick="Follow(<?= $blogID?>)">FOLLOW</button>

										<?php
										}

									}
									else
									{  ?>
										<button class="follow-blog-btn" id="follow" name="follow" onclick="followPage(<?= $blogID?>)">FOLLOW</button>

									<?php 
									}
									?>
									<span style="color: green; font-size: 18px; font-weight: 700" id="showMessage"></span>
								</form>

								<?php require_once 'partials/theme-customization.php' ?>
							</sdiv>
						<?php endif;?>
							<!-- FOLLOW || THEME CUSTOMIZATION END-->
						</div>

				<?php	foreach ($comments as $key => $user): 
						if( $user['post_id'] == $postID)
						{ ?>
							<div class="scroll-div" style="margin-top: 20px; height: 400px" id="showComments">
							<img src="assets/user_image/<?=$user['user_image']?>" alt="User Image" style="width:30px; height: 30px; border-radius: 50%;">
							<span> <b><?=$user['user_name']?></b> </span>
							<p> <?=$user['comment']?> </p>
							<span style="color: #ab59fd"> <?= createdAt($user['created_at']) ?> </span>
							<?php 
							/* Will work on EDIT COMMENT USING AJAX... (if) */	
							if ( !empty($editComment) && $user['user_id'] == $editComment[0]['user_id']): ?>
							<span>
								<a href="javascript:void(0)" style="text-decoration: none">Edit</a>
								</form>
							</span>
							<?php endif;?>
					<?php 
						}
						endforeach;
			?>
			</div>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-12 "></div>
				</div>
		</div>
		<?php
	}

	public static function footer()
	{	?>
		<footer>
		<div>
			<div class="container p-5">
				<div class="row">
					<div class="col contact-us-text">
						<h1 class="footer-text">.Blogger</h1>
					</div>
					<div class="col contact-us-text">
						<h1 class="footer-text">About Us</h1>
						<p class="footer-text about-us"> Most trustworthy resource for all happenings in technology, telecom, business, sports, auto, education, real estate and entertainment news in Pakistan.
						Whether it's the top trending news, inside scoops or features, interviews, market trends and analysis, product reviews, How to's or tutorials – we cover it all.</p>
					</div>
					<div class="col contact-us-text">
						<h2 class="text-center footer-text">Let's Connect</h2>
						<hr/>
						<div class="text-center">
							<ul>
								<li><a class="" href="">Twitter</a></li>
								<li><a class="" href="">Facebook</a></li>
								<li><a class="" href="">Whatsapp</a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
		</footer>
		<script type="text/javascript" src="../assets/initial/bootstrap/js/bootstrap.bundle.min.js"></script>
		</body>
		</html>
		<?php
	}
}
?>