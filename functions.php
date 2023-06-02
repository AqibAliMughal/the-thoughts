<?php
function requireFiles(array $page)
{
	foreach ($page as $key => $fileName) 
	{
		require_once "$fileName.php";
	}
}

function dd($value)
{
	echo "<pre>";
	var_dump($value);
	die();
}

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\EXCEPTION;
function Email($from, $to, $userName, $subject, $message)
{
	require 'Libraries/PHPMailer/src/Exception.php';
	require 'Libraries/PHPMailer/src/PHPMailer.php';
	require 'Libraries/PHPMailer/src/SMTP.php';
	$mail = new PHPMailer();

	$mail->isSMTP();

	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->SMTPAuth = true;
	$mail->Username = 'sahmedrajput17@gmail.com';
	$mail->Password = 'nmibrichphwgykgc';
	$mail->setFrom("$from");
	$mail->addAddress("$to", "$userName");
	$mail->Subject = "$subject";
	$mail->msgHTML("$message");
	if (!$mail->send()) {
	} else {
	}
}

function update()
{
	date_default_timezone_set("asia/karachi");
	return date('Y-m-d h:i:s');
}

function createdAt($createdAt)
{
	return date('j-n-Y', strtotime($createdAt));  
}


function pagination($numberOfPages, $in)
{
	global $id;
	global $limit;
	global $numberOfPages;
	
	if(isset($_REQUEST['pageNumber']) && $_REQUEST['pageNumber'] >= 2):
		$id = $_REQUEST['pageNumber']; ?>
		<a class="a-tag" style="" href="<?= $in?>.php?pageNumber=<?= --$id ?>">
			<span class="left-arrow" style="color: #939393; font-size: 32px;"><i class="bi bi-arrow-left left-arrow"></i> </span>
		</a>
		<?php
	else:?>
		<a class="a-tag" style="pointer-events: none;" href="<?= $in?>.php?pageNumber=<?= --$id ?>">
			<span class="left-arrow" style="color: #939393; font-size: 32px;"><i class="bi bi-arrow-left left-arrow"></i> </span></a>	
		<?php

	endif;
	if( !isset($_REQUEST['pageNumber']) )
	{
		echo "<span class='currentPage'>". ++$id .	"</span>";
	}

	if(isset($_REQUEST['pageNumber']) && $_REQUEST['pageNumber'] <= $numberOfPages):
		echo "<span class='currentPage'>" .$_REQUEST['pageNumber'] ."</span>" ;
		$id = $_REQUEST['pageNumber']++;
		?>
		<a class="a-tag" href="<?= $in?>.php?pageNumber=<?= ++$id ?>">
			<span class="right-arrow" style="color: #939393; font-size: 32px;"><i class="bi bi-arrow-right right-arrow"></i></span>
		</a>

		<?php
	else: ?>
		<a class="a-tag" style="" href="<?= $in?>.php?pageNumber=<?= ++$id ?>">
			<span class="right-arrow" style="color: #939393; font-size: 32px;"><i class="bi bi-arrow-right right-arrow"></i></span>
		</a>
		
		<?php
	endif;
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">