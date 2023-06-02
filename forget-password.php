<?php
require 'functions.php';
$email = $_REQUEST['email'];
requireFiles(['Classes/CRUD', 'Classes/Redirect', 'Classes/Database']);
if(isset($_REQUEST['recover']))
{
  $crud = new CRUD;
  Database::getConnection();
  $isEmail = $crud -> select('user', ['first_name', 'email'], ['email' => "$email"]);
  if ( !($isEmail == ""))
  {
    $userName = $isEmail[0]['first_name'];
    $userEmail = $isEmail[0]['email'];
    $newPassword    = convert_uuencode(rand());
    $updatePassword = $crud -> update("user", ['password' => "$newPassword"], ['email', "$userEmail"]);
    Email("sahmedrajput17@gmail.com", $userEmail, "$userName",'.Blogging - New password', "Your password is updated, new credentials are: <br/>Email: {$email} <br/>Password: {$newPassword} . <br/><br/> <strong>Team .Blogging</strong>");
  ?>
  <script type="text/javascript">
    alert("Password is updated check your email inbox or spam");
  </script>
  <?php 
  Redirect::to("login", ['login-msg' => "Password Updated..."]);
  }
  else
  {
    ?>
   <script type="text/javascript">
     alert("Password is updated check your email inbox or spam");
   </script>
   <?php 
   Redirect::to("login", ['login-msg' => "Incorrect Email..."]);
 }
}
 ?>