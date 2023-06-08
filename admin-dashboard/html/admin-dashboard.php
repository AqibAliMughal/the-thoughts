<div class="container-fluid">
<div class="row my-3 ">
	<div class="col-lg-2" style="height:100%">
		<?php require_once '../assets/initial/sidebar.php'; ?>
	</div>
  <!-- 
    =====================================
    |             MAIN SECTION          |
    =====================================
   -->
<div class="col-lg-7 col-md-7 col-sm-12 mx-3">
	<span style="color:green; font-weight:500;font-size: 22px;">
	<?= isset($_REQUEST['msg'])? $_REQUEST['msg'] : ''; ?></span>
	<div class="row mb-4" style="margin-top: 15px;">
		<div class="col-lg-3 mx-3 col-md-3 admin-page-status" >
			<h2 class="status-heading">Total Page</h2>
			<p class="page-info">
				<?php 
					$pages = $crud -> select('blog', ['user_id'], ['user_id' => $_SESSION['user']['user_id']]);
					if($pages == "") { echo "<p class='page-info'>0</p>"; }
					else
					{
						$totalPages = 0;
						foreach ($pages as $key => $value) 
						{
							++$totalPages;
						}
									echo "<p class='page-info'>$totalPages</p>";
					}
				?>
			</p>
			</div>
			<div class="col-lg-3 mx-3 col-md-3 admin-page-status">
				<h2 class="status-heading">Total Followers</h2>
				<p class="page-info">16</p>
			</div>
			&nbsp &nbsp &nbsp
			<div class="col-lg-3 col-md-3 admin-page-status">
				<h2 class="status-heading">Total Posts</h2>
				<p class="page-info">04</p>
			</div>
		</div>
	<!-- 
    =====================================
    |       ACTIVE/INACTIVE USER        |
    =====================================
   -->
		<h2>Allow User</h2>
		<div class="scroll-div">
			<table class="table table-hover approval-section">
				<thead>
					<tr>
						<th>SNo:</th>
						<th>Full Name</th>
						<th>Email</th>
						<th>Gender</th>
						<th>Created At</th>
						<th>Image</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if( empty($userinfo) ):?>
						<tr><td><h5><strong>No Record Found</strong> </h5></td></tr>
					<?php
				else:
						$serialNumber = 1;
						foreach ($userinfo as $key => $user): ?>
							<tr>
								<td><?= $serialNumber++ ?></td>
								<td><?= $user['NAME'] ?></td>
								<td><?= $user['email'] ?></td>
								<td><?= $user['gender'] ?></td>
								<td><?= createdAt($user['created_at']) ?></td>
								<td>
									<img src="../assets/user_image/<?= $user['user_image']?>" alt="User Profile Picture" width="50" height="50" style="border-radius:50%" >
								</td>
								<td>
									<a href="user-update.php?us=<?= $user['user_id']?>&request=InActive" class="btn btn-danger">InActive</a>
									<a href="user-update.php?uid=<?= $user['user_id'] ?>" class="btn btn-primary">Edit</a>
								</td>
								</tr>
								<?php
							endforeach;
						endif;
					?>
				</tbody>
			</table>
		</div>
				<?php 
				 if ( count($userinfo) === 5 ):
					echo 
					"<a href='users-all.php' style='text-decoration:none'>
					<p class='page-info fs-5'>View All</p>
					</a>";
				 endif;
				 ?>
	<!-- 
    =====================================
    |       APPROVE/REJECT USER         |
    =====================================
   -->	
		<h2 class="mt-3">New Registration</h2>
		<div class="scroll-div">
			<table class="table table-hover approval-section">
				<thead>
					<tr>
						<th>SNo:</th>
						<th>Full Name</th>
						<th>Email</th>
						<th>Gender</th>
						<th>Created At</th>
						<th>Image</th>
						<th>Request</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if( empty($pendingUsers) ):?>
						<tr><td><h5><strong>No Record Found</strong> </h5></td></tr>
					<?php
				else:
						$serialNumber = 1;
						foreach ($pendingUsers as $key => $user): ?>
							<tr>
								<td><?= $serialNumber++ ?></td>
								<td><?= $user['NAME'] ?></td>
								<td><?= $user['email'] ?></td>
								<td><?= $user['gender'] ?></td>
								<td><?= createdAt($user['created_at']) ?></td>
								<td><img src="../assets/user_image/<?= $user['user_image']?>" alt="User Profile Picture" width="50" height="50" style="border-radius:50%" ></td>
								<td>
									<a href="user-update.php?us=<?= $user['user_id']?>&request=approve" class="btn btn-success">Approve</a> 
									<a href="user-update.php?us=<?= $user['user_id']?>&request=reject" class="btn btn-danger">Reject</a>
								</td>
							</tr>
							<?php
						endforeach;
					endif;
					?>
				</tbody>
			</table>
		</div>	
	<!-- 
    =====================================
    |       COMMENT - Approve/Reject    |
    =====================================
    -->	
    <h2 class="mt-3">Comments</h2>
		<div class="scroll-div">
			<table class="table table-hover approval-section">
				<thead>
					<tr>
						<th>SNo:</th>
						<th>Full Name</th>
						<th>Comment</th>
						<th>Post</th>
						<th>Comment At</th>
						<th>Image</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
				
					if( empty($comments) )
					{ ?>
						<tr>
						<td><h5><strong>No Record Found</strong> </h5></td>
						</tr>
					<?php 
					}
					else
					{					
						$serialNumber = 1;
						foreach ($comments as $key => $user) { ?>
							<tr>
								<td><?= $serialNumber++ ?></td>
								<td><?= $user['user_name'] ?></td>
								<td><?= $user['comment'] ?></td>
								<td><?= $user['Post_Title'] ?></td>
								<td><?= createdAt($user['created_at']) ?></td>
								<td><img src="../assets/user_image/<?= $user['user_image']?>" alt="User Profile Picture" width="50" height="50" style="border-radius:50%" ></td>
								<td>
									<a href="comment.php?status=<?=$user['post_comment_id']?>" class="btn btn-danger">InActive</a>
								</td>
								<td>
									<a href="comment.php?cid=<?=$user['post_comment_id']?>" class="btn btn-primary">Edit</a>
								</td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>	
	</div>
	<!-- 
    =====================================
    |       RIGHT BAR - General Info    |
    =====================================
    -->	
	<div class="col-lg-2 col-md-2 col-sm-12 text-center right-side-navigation admin-page-status" style="height: 600px">
		<h5 class="my-2">REGISTERED USER INFO</h5>
		<hr/>
		<div class="mt-3">
			<p>Total User: 25 </p>
			<p>Active User: 15 </p>
			<p>Inactive User: 5 </p>
			<p>Rejected User: 4 </p>
		</div>
		<h5 class="my-2">POST INFO</h5>
		<hr/>
		<div class="mt-3 text-center">
			<p>Total Post: 25 </p>
		</div>
		<h5 class="my-2">COMMENT INFO</h5>
		<hr/>
		<div class="mt-3 text-center">
			<p>Total Comment: 11 </p>
			<p>Active Comment: 6 </p>
			<p>Pending Comment: 5 </p>
		</div>
	</div>
</div>
</div>