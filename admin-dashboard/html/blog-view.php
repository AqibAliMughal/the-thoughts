<div class="container-fluid">
	<div class="row my-3 ">
		<div class="col-lg-2 col-md-2 col-sm-12 mx-3 p-2 left-side-navigation" style="height: 840px">
			<center >
 				<?php 
				foreach ($pageDetails as $key => $page) { ?>
					<img class="my-3" src="../assets/Blog_Background/<?= $page['blog_background_image']?>" style="width:100px; height: 100px; border-radius: 50%;">
					<h2 class="text-center"><?= $page['blog_title']?></h2>
				<hr/>
				<p class="text-start ">Lorem ipsum dolor, sit amet, consectetur adipisicing elit. Tenetur aliquid veniam ab qui neque!
				</p>
				<hr/>
				<?php } ?> 
				<table align="center">
					<tr>
						<td>
							<div class="row">
								<div class="text-center col-lg-12">
									<h5>Page Follower</h5>
									<hr/>
								</div>
								<div class="text-center col-lg-12">
									<span class="page-info">43 </span>
									<hr/>
								</div>

								<div class="text-center col-lg-12">
									<h5>Page Post</h5>
									<hr/>
								</div>
								<div class="text-center col-lg-12">
									<span class="page-info">
										<?= ($totalPosts[0]['TotalPost']); ?>
									</span>
								</div>
								<div class="" style="box-sizing: border-box;">
									<ul>
										<li><a href="">Twitter</a></li>
										<li><a href="">Facebook</a></li>
										<li><a href="">Whatsapp</a></li>
									</ul>
								</div>

							</div>
						</td>
					</tr>
				</table>
			</center>
		</div>

		<div class="col-lg-7 col-md-7 col-sm-12" style="height: 20%">
          <div class="row my-3">
          	<div class="col-lg-1"></div>

          	<div class="col-lg-1"></div>
          </div>
			<!-- 
				==================================================================
								...:: PAGE POST HERE ::... 
				================================================================== 
			-->
				<?php 
				$postNumber = 1;
				if( $posts !== '')
				{
					foreach ($posts as $key => $value): 
					?>
			<div class="right-side-navigation">
				<h3 class="page-info post-counter"> <span class="page-info"><?= $postNumber++?></span></h3>
				<img class="featured-post rounded mt-1" src="../assets/post/<?= $value['featured_image']?>" width="100%" height="310px">
				<div class="post-content my-3 mx-2" style="width:100%">
					<div>
						<h1 class="post-title mb-3">
							<u><?= $value['post_title']?></u>
						</h1>
						<p class="post-description" >
							<?= $value['post_description'] ?>
						</div>
						<span><a class="btn btn-success mb-2" href="post-edit.php?pid=<?= $value['post_id']?>">Edit</a></span>
						<?php 
							if($value['post_status'] == 'Active'):?>
						
<!-- 						<span><a class="btn btn-danger mb-2 status" href="javascript:void(0)" id="status<?= $value['post_id']?>" onclick="status(<?= $value['post_id']?>)">InActive</a></span> -->

						<span><a class="btn btn-danger mb-2 status" href="update-status.php?id=<?= $value['post_id']?>">InActive</a></span>
							<?php
							else:?>
						<span><a class="btn btn-warning mb-2 status" href="update-status.php?id=<?= $value['post_id']?>">Active</a></span>
						<?php	endif;
						?>
						<br/>
						<strong><span style="color: #847c7c">Published: <?= createdAt($value['created_at']) ?></span></strong>
					</div>
			</div>
				<?php 
						endforeach; 
				}
				else
				{
					echo "<h2 style='color:#4f2cd0'>No Post Found. Create new post <a href='post-create.php'>here</a></h2>";
				}
				?>
		</div>
	</div>
	<!-- PAGINATION -->
	<ul class="pagination justify-content-center">
		<li class="page-item disabled">
			<a class="page-link">Previous</a>
		</li>
		<li class="page-item"><a class="page-link" href="#">1</a></li>
		<li class="page-item"><a class="page-link" href="#">2</a></li>
		<li class="page-item"><a class="page-link" href="#">3</a></li>
		<li class="page-item">
			<a class="page-link" href="#">Next</a>
		</li>
	</ul>
</div>