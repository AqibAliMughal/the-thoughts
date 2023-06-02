<?php 
session_start();
require_once 'functions.php';
requireFiles(['Classes/CRUD', 'Classes/Database', 'Classes/HTML']);
$crud = new CRUD;
Database::getConnection();
HTML::navbar();
HTML::search();
HTML::carousel();
require_once 'section.php';
HTML::footer();
?>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> -->