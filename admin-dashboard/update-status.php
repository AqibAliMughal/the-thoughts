<?php
require_once '../functions.php';
requireFiles(['../Classes/CRUD', '../Classes/Database','../Classes/Redirect', '../Classes/Role']);
$crud = new CRUD;
Database::getConnection();
Role::admin();
if( isset($_REQUEST['id']) )
{
	$post = $crud->select("post", ['post_id', 'post_status'], ['post_id' => $_REQUEST['id']] );
	if($post[0]['post_status'] == 'Active')
	{
		$status = $crud->update('post', 
				[
					'post_status' => "InActive",
					'updated_at'  => update()
				], 
				[
					'post_id', $post[0]['post_id']
				]);
		if($status) 
		{
			Redirect::to('blogs', ['bid' => $_SESSION ['blogID']]);
		} 
	}
	else
	{
		$status = $crud->update('post', 
			[
				'post_status' => "Active",
				'updated_at'  => update()
			], 
			[
				'post_id', $post[0]['post_id']
			]);
		if($status)
		{
			Redirect::to('blogs', ['bid' => $_SESSION ['blogID']]);
		}
	} 
}
?>