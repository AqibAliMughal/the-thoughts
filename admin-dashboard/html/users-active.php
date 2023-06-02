	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-12">
		<?php require_once '../assets/initial/sidebar.php'; ?>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-12">
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 mx-3" style="margin-top: 40px;">
			<!-- < === SHOW ALL USER INFO ==== > -->
	<span  style='color:green; font-weight:700; font-size: 22px;'>
				<?= isset($_REQUEST['msg'])? $_REQUEST['msg'] : ''; ?>
	</span>
			<h2><center class="my-4"><strong> Active Users </strong></center></h2>
			<div class="scroll-div" style="height: 500px;">
				<table class="table table-hover approval-section">
					<thead>
						<tr>
							<th>SNo:</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Gender</th>
							<th>Image</th>
							<th>Role</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						global $serialNumber;
						foreach ($users as $key => $user) {
							?>
							<tr>
							<td> <?= $serialNumber++ ?> </td>
							<td> <?= $user['NAME'] ?> </td>
							<td> <?= $user['email'] ?> </td>
							<td> <?= $user['gender'] ?> </td>
							<td><img src="../assets/user_image/<?= $user['user_image']?>" alt="User Profile Picture" width="50" height="50" style="border-radius:50%" ></td>
								<td>
									<a href="users-active.php?uid=<?= $user['user_id']; ?>" class="btn btn-warning">Make Admin</a>
								</td>
								</tr>
							<?php
					}
					?>
					</tbody>
				</table>
			</div>
				<?php echo "<center>" ; pagination($numberOfPages, 'users-active');  echo "</center>"?>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-12"> </div>
	</div>	