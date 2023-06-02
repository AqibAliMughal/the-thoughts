<?php
require_once 'Libraries/FPDF/fpdf.php';
class PDF_Credential
{
	public static function userCredential($email, $password)
	{
		$fpdf = new FPDF();
		$fpdf->setFont('Arial', 'B', '22');
		$fpdf->AddPage();
		$fpdf->SetTitle("Credentials");
		$fpdf->Text(52, 20, "Thank your for the registration", );
		$fpdf->Line(50, 22, 160, 22);
		$fpdf->setFont('Arial', '', '14');
		$fpdf->Text(10, 40, "Email: $email");
		$fpdf->Text(10, 50, "Password: $password");
		$fpdf->setFont('Arial', '', '10');
		$fpdf->SetTextColor(255,0,0);
		$fpdf->Text(10, 60, 'Note: Your request is being processed, soon you will be notified via an email. ');
		$fpdf->Output();
	}
}
?>