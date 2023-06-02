<link rel="stylesheet" type="text/css" href="user.css">
		<div class="row my-3 ">
			<div class="col-lg-2 col-md-2 col-sm-12 mx-3 p-2">
			<?php require_once '../assets/initial/sidebar.php'; ?>
			</div>
			<div class="col-lg-7 col-md-7 col-sm-12 mx-3">
				<div class="row mb-4">
					<div class="col right-side-navigation user-page-status">
						<h2>Page Followed</h2>
						<p class="page-info">
							<?php 
						if( !empty($followedBlogs[0]['totalBlogFollowing']) ):
							echo ($followedBlogs[0]['totalBlogFollowing']); 
						else: 
							echo "0";
						endif;
							?>
							</p>
					</div>
					&nbsp &nbsp &nbsp
<!-- 					<div class="col right-side-navigation user-page-status">
						<h2>Page Followed</h2>
						<p class="page-info">03</p>
					</div> -->
					&nbsp &nbsp &nbsp
					<div class="col right-side-navigation user-page-status">
						<h2>Total Comment</h2>
						<p class="page-info">32</p>
					</div>
				</div>
			</div>
			<div class="col-lg-2 text-center right-side-navigation">
				<h5 class="my-2">COMMENT STATUS</h5>
				<hr/>
				<div class="mt-3">
					<p>Total Comments: 6 </p>
					<p>Approved Comment: 4 </p>
					<p>Pending Comment: 1 </p>
				</div>

			</div>
