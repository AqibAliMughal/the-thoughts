<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<?php
require '../functions.php';
requireFiles(['../Classes/HTML', '../Classes/CRUD', '../Classes/Database','../Classes/Redirect', '../Classes/Role']);
$crud = new CRUD;
Database::getConnection();
Role::admin();
/* 
   ==========================================================
   |			FOR ADDING CATEGORY INTO DATABASE 				   |
   ==========================================================
*/
if(isset($_REQUEST['category_title']))
{
	if ( ($_REQUEST['category_title'] !== "" && $_REQUEST['category_description'] !== "") )
	{
		$crud -> insert('category', $_REQUEST);
		Redirect::to("category-add", ['msg'=> 'Category Added']);
	}
	else
	{
		Redirect::to("category-add", ['errmsg'=> 'Please Fill the fields.']);
	}
}
/* 
   =======================================================
   |			FOR UPDATING CATEGORY 							   |
   =======================================================
*/
if( isset($_REQUEST['update_title']) )
{
		$id = $_SESSION['category_id'];
		$time = update();
	if( $_REQUEST['update_title'] !== "" &&  $_REQUEST['update_description'] !== "")
	{

		$update = $crud -> update('category',
			[
				'category_title' 		=> $_REQUEST['update_title'], 
				'category_description'  => $_REQUEST['update_description'],
				'updated_at'			=> $time,
			],
			(
				['category_id', $id])
			);
		Redirect::to("category-add", ['msg'=> 'Category Updated']);	
	}
	else
	{
		Redirect::to("category-add", ['errmsg'=> 'Fields cannot be empty, please fill.']);
	}
}
/* 
   =======================================================
   |			FOR CHANGING CATEGORY STATUS 					   |
   =======================================================
*/
   if(isset($_REQUEST['cat_status']))
   {
   	if( $_REQUEST['cat_status'] !== "")
   	{
   		$status = $crud -> select('category', ['category_status'], ['category_id' => $_REQUEST['cat_status']]);
   		if($status[0]['category_status'] === "Active")
   		{
   			$crud -> update('category', ['category_status' => 'InActive'], ['category_id', $_REQUEST['cat_status']]);
				Redirect::to("category-add", ['errmsg'=> 'Inactivated.']);
   		}
   		else
   		{
   			$crud -> update('category', ['category_status' => 'Active'], ['category_id', $_REQUEST['cat_status']]);
				Redirect::to("category-add", ['msg'=> 'Activated.']);
   		}
   	}
   	else
   	{
   		Redirect::to("category-add", ['errmsg' => "Please select Category."]);
   	}
   }

/* 
   =========================
   |		HTML - VIEW   		|
   =========================
*/
$title = "Add | Update Category";
require_once '../assets/initial/navbar.php';
requireFiles(['html/category-add']);
HTML::footer();
?>