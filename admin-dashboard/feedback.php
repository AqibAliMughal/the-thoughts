<?php 
require_once '../functions.php';
requireFIles(['../Classes/HTML', '../Classes/Redirect', '../Classes/Database', '../Classes/CRUD', '../Classes/Role']);
$crud = new CRUD;
Database::getConnection();
Role::admin();
  	$name = $_SESSION['user']['NAME'];
  	$title = "Feedback";
 	require_once '../assets/initial/navbar.php';
	require_once 'html/feedback.php';
	HTML::footer();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>