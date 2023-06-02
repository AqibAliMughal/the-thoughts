<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> -->
 <?php
 session_start();
 require 'functions.php';
 requireFiles(['Classes/HTML', 'Classes/CRUD', 'Classes/Redirect', 'Classes/Validation', 'Classes/Database']);
Database::getConnection();
$crud = new CRUD;
if( isset($_SESSION['user']))
{
 	Redirect::to('_index', ['msg'=>'Already LoggedIn']);
    die();
}
else
{
  if(isset($_REQUEST['login']))
    {
     $email    = trim($_REQUEST['email']);
     $password = trim($_REQUEST['password']);

     Validation::login($email, $password);
    }
}

HTML::navbar();
require 'forms/login.php';
HTML::footer();
?>