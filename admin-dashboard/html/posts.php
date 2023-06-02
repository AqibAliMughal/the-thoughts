<div class="row">
	<div class="col-lg-2 col-md-2 col-sm-12">
		<?php require_once '../assets/initial/sidebar.php'; ?>
	</div>

	<div class="col-lg-1 col-md-1 col-sm-12">
	</div>
	<div class="col-lg-5 col-md-5 col-sm-12 mx-3">
		<!-- < === SHOW ALL POSTS ==== > -->
		<h2><center class="my-4"><strong> POSTS </strong></center></h2>
		<!-- <div class="" style="height: 350px;"> -->
			<table class="table table-hover approval-section">
				<thead>
					<tr>
					<th>SNo:</th>
					<th>Title</th>
					<th>Summary</th>
					<th>Blog</th>
					<th>Category</th>
					<th>Edit</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				global $posts;
				global $numberOfPages;

					global $serialNumber;
					foreach ($posts as $key => $post):
						$postCategories = Database::query("
							SELECT category.`category_title` FROM post INNER JOIN post_category 
							ON post.`post_id` = post_category.`post_id` 
							INNER JOIN category
							ON category.`category_id` = post_category.`category_id`
							WHERE post_category.`post_id` = $post[post_id]");
				?>
						<tr>
						<td> <?= $serialNumber++ ?> </td>
						<td> <?= $post['post_title'] ?> </td>
						<td> <?= $post['post_summary'] ?> </td>
						<td> <?= $post['blog_title'] ?> </td>
						<td> 
							<?= $post['category_title']?>
						</td>
						<td><a href="post-edit.php?pid=<?= $post['post_id']?>" class="btn btn-primary">Edit</a></td>
						</tr>
						<?php
					endforeach;
				?>
				</tbody>
			</table>
			<center>
			</center>
			<?php 
				echo "<center>";
				pagination($numberOfPages, 'posts');
				echo "</center>";
			?>
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-12">
	</div>
</div>	