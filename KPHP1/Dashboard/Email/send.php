<?php
//Include required PHPMailer files
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "masterlist";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
	die("Connection failed: " . $conn->connect_error);
}


$fname = "";
$lname = "";

$id=$_GET['id'];

$Email = "";

$email_sql = "SELECT * FROM records WHERE ID = $id";

$result = $conn->query($email_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Email = $row['email'];
        $fname = $row['Firstname'];
        $lname = $row['Lastname'];
    }

}

$Subject = "Karlaville Parkhomes Phase1 Monthly Dues Payment records";
$Body = nl2br("Account Credentials\r\nUsername: ".$fname."\r\nPassword: ".$lname."\r\nhttp://localhost/KPHP1/dashboard/mobileview/login1.php" );

//Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "tls";
//Port to connect smtp
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "karlvilleparkhomeshoa@gmail.com";
//Set gmail password
	$mail->Password = "nsuoezncruggxnrj";
//Email subject
	$mail->Subject = $Subject;
//Set sender email
	$mail->setFrom('karlvilleparkhomeshoa@gmail.com');
//Enable HTML
	$mail->isHTML(true);
//Email body
	$mail->Body = $Body;
//Add recipient
	$mail->addAddress($Email);
//Finally send email
	if ( $mail->send() ) {
		echo '<script language="javascript">';
		echo 'alert("Email Sent Successfully")
		window.location.replace("../dashboard.php");';
		echo '</script>';
	}else{
		echo '<script language="javascript">';
		echo 'alert("Failed to Send Please Try Again")
		window.location.replace("../dashboard.php");';
		echo '</script>';
	}
//Closing smtp connection
	$mail->smtpClose();
