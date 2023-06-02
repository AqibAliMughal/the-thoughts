<?php 
session_start();
require 'Classes/PDF_Credentials.php';
PDF_Credential::userCredential($_SESSION['email'], $_SESSION['password']);
?>