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
		<div class="col-lg-1"></div>
		<div class="col-lg-4 admin-page-status">
			<!-- 
				============================ 
				ADD OR EDIT CATEGORY FORM 
				============================
			-->
			<?php 
				if ( isset($_REQUEST['cid']) )
				{
					global $crud;
					$_SESSION['category_id'] = $_REQUEST['cid'];
					$categoryDetials = $crud -> select( 'category',['category_title', 'category_description'], ['category_id' =>$_REQUEST['cid']] );
					$title 		 = $categoryDetials[0]['category_title'];
					$description = $categoryDetials[0]['category_description'];?>
					<input type="hidden" name="category_id" value="<?= $_REQUEST['cid']?>">
				<?php }
				?>
					<h2 class="status-heading">
						<?= isset($_REQUEST['cid'])? "Edit Category" : "Add Category"?>
					</h2>
					<form method="POST" action="category-add.php" class="col-lg-12  row row-cols-lg-auto g-3 ">
						<label class="visually-hidden" for="inlineFormInputGroupUsername">
							<?= isset($_REQUEST['cid'])? "Edit Category" : "Add Category"?>
						</label>
						<div class="input-group">
							<div class="input-group-text">
								<?= isset($_REQUEST['cid'])? "Edit Category" : "Add Category"?>
							</div>
							<input type="text" 
							name="<?= isset($_REQUEST['cid'])? 'update_title' : 'category_title'?>" 
							class="form-control" id="inlineFormInputGroupUsername" placeholder="Add Category" value="<?= isset($_REQUEST['cid']) ? $title :''?>">
						</div>
						<div class="input-group">
							<div class="input-group-text">Description</div>
							<textarea 
							name="<?= isset($_REQUEST['cid'])? 'update_description' : 'category_description'?>" 
							maxlength="300" class="form-control" id="inlineFormInputGroupUsername" cols="30" rows="4"><?= isset($_REQUEST['cid']) ? $description :''?> </textarea>
						</div>
						<span style="color: red; font-size: 13px">*Max 300 words allowed</span>
						<div class="input-group">
							<input type="submit" onclick="addCategory()" class="text-center mb-3 red-form-btn" 
							value="<?= isset($_REQUEST['cid'])? "Update" : "Add"?>">
						</div>
					</form>
				<!-- </div> -->
		</div>
		<div class="col-lg-5 mx-4 admin-page-status">
			<!-- 
				============================ 
					 SHOW CATEGORIES 
				============================
			-->
			<h2 class="status-heading">Edit Category</h2>
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
		</div>
	</div>