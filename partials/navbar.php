<?php 
require_once 'functions.php';
requireFiles(['Classes/CRUD', 'Classes/Database']);
$crud = new CRUD;
Database::getConnection();
$categories = $crud->select('category', ['category_id', 'category_title'], ['category_status' => 'Active']);
?>
 
<!-- FORGET FORM MODAL END-->