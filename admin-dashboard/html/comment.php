<!-- <div class="row mb-2 mt-2">
<div class="col-lg-5"></div>
<div class="col-lg-2"> -->
	<?php
	if( isset($_REQUEST['msg']))
		{?>
			<span style="color: green; font-weight: 600; font-size: 22px;"><?= isset($_REQUEST['msg'])? $_REQUEST['msg'] : "" ?></span>
		<?php }
		else
			{ ?>
				<span style="color: tomato; font-weight: 600; font-size: 22px;"><?= isset($_REQUEST['errmsg'])? $_REQUEST['errmsg'] : "" ?></span>
			<?php }
			?>
	</div>
	<div class="col-lg-5"></div>
</div>

	<!-- <><><><> ADD/EDIT COMMENT ROW <><><><> -->
	<div class="row my-5">
		<div class="col-lg-2 col-md-2 col-sm-12">
			<?php require_once '../assets/initial/sidebar.php'; ?>
		</div>
		<!-- 
			========================== 
			 ADD OR EDIT COMMENT FORM 
			==========================
		-->
		<div class="col-lg-4 col-md-4 col-sm-12 admin-page-status" style="height: 300px">
			<?php 
				if ( isset($_REQUEST['cid']) )
				{
					$_SESSION['comment_id'] = $_REQUEST['cid'];
					$commentDetail = $crud -> select( 'post_comment',['comment'], ['post_comment_id' =>$_REQUEST['cid']] );
					$comment = $commentDetail[0]['comment']; ?>
				<?php }
				?>
					<h2 class="status-heading"> Edit Comment </h2>
					<form method="POST" action="comment.php" class="col-lg-12  row row-cols-lg-auto g-3 ">
						</label>
						<div class="input-group">
						</div>
						<div class="input-group">
							<div class="input-group-text">Comment</div>
							<textarea 
							name="update_comment" 
							maxlength="300" class="form-control" id="inlineFormInputGroupUsername" cols="30" rows="4"><?= isset($_REQUEST['cid']) ? $comment :''?> </textarea>
						</div>
						<span style="color: red; font-size: 13px">*Max 350 words allowed</span>
						<div class="input-group">
							<input type="submit" class="text-center mb-3 red-form-btn" 
							value="Update">
						</div>
					</form>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-12 mx-4 admin-page-status" style="height: 800px">
			<h2 class="status-heading">Edit Comment</h2>
			<div class="scroll-div" style="height: 800px;">
				<table class="table table-hover ">
					<thead>
						<tr align="left">
							<th>SNo:</th>
							<th>Author</th>
							<th>Comment</th>
							<th>Post</th>
							<th>Status</th>
							<th>Update</th>
						</tr>
					</thead>
					<tbody >
							<?php 
							$serialNumber = 1;
							foreach ($showComments as $key => $comment) { ?>
							<tr align="center">
								<td><?= $serialNumber++ ?></td>
								<td style="text-align: left"><?= $comment['user_name']?></td>
								<td style="text-align: left"><?= $comment['comment']?></td>
								<td style="text-align: left"><?= $comment['Post_Title']?></td>
								<?php if($comment['is_active'] == 'Active') { ?>
								<td>
									<a href="comment.php?c_status=<?= $comment['post_comment_id']?>" class="btn btn-success">Active</a>
								</td>
								<?php }
								else
								{ ?>
								<td>
									<a href="comment.php?c_status=<?= $comment['post_comment_id']?>" class="btn btn-secondary">Inactive</a>
								</span> 
								</td>
								<?php } ?>
								<td>
								<a href="comment.php?cid=<?= $comment['post_comment_id']?>" class="read-blog-link">Edit</a>
								</td>
							</tr>
							<?php 
							} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>