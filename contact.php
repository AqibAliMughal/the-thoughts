<?php session_start(); 

require 'functions.php';
requireFiles(
	[
		'Classes/HTML', 
		'Classes/CRUD', 
		'Classes/Redirect', 
		'Classes/Database',
		'Classes/form'
	]);
$crud = new CRUD;
Database::getConnection();

/* 
==============================
				Validate form 
==============================
*/
if( isset($_REQUEST['send']) ):
	if($_REQUEST['name'] === '') { $_REQUEST['contactName'] = 'Please provide full name'; }
	else { $_SESSION['name'] = $_REQUEST['name']; }

	if($_REQUEST['email'] === '') { $_REQUEST['contactEmail'] = 'Please provide email address'; }
	else { $_SESSION['email'] = $_REQUEST['email']; }
	
	if($_REQUEST['feedback'] === '') { $_REQUEST['contactFeedback'] = 'Feedback cannot be empty.';}
	else { $_SESSION['feedback'] = $_REQUEST['feedback']; }
endif;

/* 
==============================
SHOW FORM as per user status
==============================
*/
 if(isset($_REQUEST['send']))
{
	if( isset($_SESSION['user']) )
	{
		$userInfo = 
		[
			"user_id" 		=> $_SESSION['user']['user_id'],
			"user_email" 	=> $_SESSION['user']['email'],
			"feedback"		=> $_REQUEST['feedback'],
		];
		$name 		= $_SESSION['user']['NAME'];
		$email 		= $userInfo['user_email'];
		$feedback 	= $userInfo['feedback'];
		$crud -> insert('user_feedback', $userInfo);
		Email($email, 'sahmedrajput17@gmail.com', $name ,'Feedback', $feedback);
		$_SESSION['msg'] = "Feedback send successfully, soon you'll be contacted.";
	}
	else
	{
		if( ($_REQUEST['name'] !== '' && $_REQUEST['email'] !== '' && $_REQUEST['feedback'] !== '') )
		{

			$userInfo = 
			[
				"user_name" 	=> $_REQUEST['name'],
				"user_email"	=> $_REQUEST['email'],
				"feedback"		=> $_REQUEST['feedback'],
			];
			$name 		= $userInfo['user_name'];
			$email 		= $userInfo['user_email'];
			$feedback 	= $userInfo['feedback'];
			$crud -> insert('user_feedback', $userInfo);
			Email($email, 'sahmedrajput17@gmail.com', $name ,'Feedback', $feedback);
			$_SESSION['msg'] = "Feedback send successfully, soon you'll be contacted.";
		}		
	}

} 
$title = "Contact Us";
HTML::navbar();
form::contact();
HTML::footer();
?>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> -->