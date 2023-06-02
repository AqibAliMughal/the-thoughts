	<div class="row mb-2 mt-2">
		<div class="col-lg-5"></div>
		<div class="col-lg-2">
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

	<!-- <><><><> ADD/EDIT CATEGORY ROW <><><><> -->
	<div class="row my-5">
		<div class="col-lg-2">	
			<?php $crud = new CRUD; 
			require '../assets/initial/sidebar.php'
			?>
		</div>
		<div class="col-lg-2"></div>
		<div class="col-lg-3 admin-page-status p-3" style="height: 400px">
			<!-- 
				============================ 
				ADD OR EDIT CATEGORY FORM 
				============================
			-->
		<center>
			<hr> <h3><strong style="color: #ab59fd"><?= isset($_REQUEST['s'])? 'UPDATE SETTING' : 'ADD SETTING'?></strong></h3> <hr>
			<h4 style="color:green"> <?= $msg?? '' ?></h4>
			<table cellspacing="5px" >
				<form action="setting.php" method="POST">
				<div class="mb-3 my-5 ">
					<tr>
						<th>
						<label for="exampleInputEmail1" class="form-label">Font Color</label>
						</th>
						<td>
						<input type="color" name="color" id=""   value="<?= isset($value[0])? $value[0] : '' ?>">
						</td>
					</tr>
				</div>

				<div class="mb-3 my-5">
					<tr>
						<th>
						<label for="exampleInputEmail1" class="form-label">Background Color</label>
						</th>
						<td>
						<input type="color" name="background-color" id="" value="<?= isset($value[1])? $value[1] : '' ?>">
						</td>
					</tr>
				</div>
				<div class="mb-3 my-5">
					<tr>
						<th>
						<label for="exampleInputEmail1" class="form-label">Font Size</label>
						</th>
						<td>
							<select name="font-size">
								<option value="<?= isset($value[2])? $value[2] : ''?>" selected>
								<?= isset($value[2])? $value[2] : 'Choose Font'?>
								</option>

								<option value="12">12</option>
								<option value="14">14</option>
								<option value="16">16</option>
								<option value="18">18</option>
								<option value="20">20</option>
								<option value="22">22</option>
							</select>
						</td>
					</tr>
				</div>
				<div class="mb-3 my-5">
					<tr>
						<th>
						<label for="exampleInputEmail1" class="form-label">Font Family</label>
						</th>
						<td>
							<select name="font-family">
								<option value="<?= isset($value[3])? $value[3] : ''?>" selected>
								<?= isset($value[3])? $value[3] : 'Select Family'?>
								</option>
								<option value="Roboto">Roboto</option>
								<option value="Cursive">Cursive</option>
								<option value="Arial">Arial</option>
								<option value="monospace">monospace</option>
								<option value="Times New Roman">Times New Roman</option>
							</select>
						</td>
					</tr>
				</div>
				<center>
					<tr>
						<td>
						<button style="padding: 15px 40px" type="submit" class="text-center mb-3 red-form-btn" name="add">
						<?= isset($_REQUEST['s'])? 'UPDATE' : 'ADD'?>
						</button>
						</td>
					</tr>
				</center>

				</form>
			</table>
		</center>
				<!-- </div> -->
		</div>

	<!-- 
		============================ 
			 SHOW CATEGORIES 
		============================
	-->
<!-- 		<div class="col-lg-5 mx-4 admin-page-status" style="height: 400px">
			<h2 class="status-heading">Allowed Settings</h2>
			<div class="scroll-div" style="height: 320px;">
				<table class="table table-hover ">
					<thead>
						<tr align="center">
							<th>SNo:</th>
							<th>Category</th>
							<th>Description</th>
							<th>Status</th>
							<th>Update</th>
						</tr>
					</thead>
					<tbody >
							<?php 
							$query = Database::query("SELECT * FROM category ORDER BY category_id DESC");
							$serialNumber = 1;
							foreach ($query as $key => $category) { ?>
							<tr align="center">
								<td><?= $serialNumber++ ?></td>
								<td style="text-align: left"><?= $category['category_title']?></td>
								<td style="text-align: left"><?= $category['category_description']?></td>
								<?php if($category['category_status'] == 'Active') { ?>
								<td>
									<a href="category-add.php?cat_status=<?= $category['category_id']?>" class="btn btn-success">Active</a>
								</td>
								<?php }
								else
								{ ?>
								<td>
									<a href="category-add.php?cat_status=<?= $category['category_id']?>" class="btn btn-secondary">Inactive</a>
								</span> 
								</td>
								<?php } ?>
								<td>
								<a href="category-add.php?cid=<?= $category['category_id']?>" class="read-blog-link">Edit</a>
								</td>
							</tr>
							<?php 
							$serialNumber++;
							} ?>
					</tbody>
				</table>
			</div>
		</div> -->
	</div>