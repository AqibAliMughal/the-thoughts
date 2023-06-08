	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-12" style="height:100%">
		<?php require_once '../assets/initial/sidebar.php'; ?>
		</div>
		<?= isset($_REQUEST['msg'])? $_REQUEST['msg'] : '' ?>
		<div class="col-lg-7 col-md-7 col-sm-12 mx-3">
			<!-- < === SHOW ALL USER INFO ==== > -->
			<h2><center class="my-4"><strong> All Users </strong></center></h2>
			<div class="scroll-div" style="height: 800px;">
				<table class="table table-hover approval-section">
					<thead>
						<tr>
							<th>SNo:</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Gender</th>
							<th>Image</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$serialNumber = 1;
						foreach ($users as $key => $user) {
							?>
							<tr>
							<td> <?= $serialNumber++ ?> </td>
							<td> <?= $user['NAME'] ?> </td>
							<td> <?= $user['email'] ?> </td>
							<td> <?= $user['gender'] ?> </td>
							<td><img src="../assets/user_image/<?= $user['user_image']?>" alt="User Profile Picture" width="50" height="50" style="border-radius:50%" ></td>
								<td>
								<?php if($user['is_active'] == 'Active'):?>
									<a href="user-update.php?us=<?= $user['user_id']?>&request=Active" class="btn btn-success">Active</a> 
								<?php endif;?> 
								</td>
								</tr>
							<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-12"></div>
	</div>	