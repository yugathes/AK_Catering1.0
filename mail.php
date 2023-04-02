<?php
require 'PHPMailerAutoload.php';
include "Auth/connection.php";
if($_GET['status']==1){
	$username = $_GET['user'];
	$orderID = $_GET['id'];
	$queryGet = "select * from users where username='".$username."'";
	$resultGet = mysqli_query($link,$queryGet);

	if(!$resultGet)
	{
		die ("Invalid Query - get Register List: ". mysqli_error($link));
	}
	else 
	{
		$baris= mysqli_fetch_array($resultGet, MYSQLI_BOTH);
		$email = $baris['email'];
		$user = $baris['name'];
	}
	
	$subject = "Waiting for payment";
	$redirect = "Customer/List.php";
	$body = '<div class="container" style="border-radius: 20px;
	box-shadow: 0px 10px 20px #1687d933;
	margin: auto !important; width:90% !important;
	float:unset !important; background-color:#e7ecf9;margin-bottom:10px;">
	<div class="desc">
	<div id="line2" class="col-lg-12">
		<h3>Hi, Mr/Mrs '.$user.'</h3>
		<h4>Your order ID : '.$orderID.'</h4>
		<h3>Status : <b>Waiting For Payment</b></h3>
		<p>Please make payment and upload the receipt. Please attach jpg,png</p>
		<hr style="width: 100%;">
		<h3>Please do transfer to below account</h3>
		<div class="cofounder-ceo-image">
			<img border="0" alt="editB" src="https://cdn.freebiesupply.com/logos/large/2x/maybank-logo-png-transparent.png" width="150px" height="50" style="margin-bottom: 20px;margin-right:20px; float:left;">
			<p>Account No &nbsp;&nbsp;&nbsp;&nbsp;  : <b>101582892873</b></p>
			<p>Account Name : <b>APU Cafeteria</b></p>
		</div>
	</div>
</div></div>';
	
}

if($_GET['status']==2){
	$username = $_GET['user'];
	$orderID = $_GET['id'];
	$queryGet = "select * from users where username='".$username."'";
	$resultGet = mysqli_query($link,$queryGet);

	if(!$resultGet)
	{
		die ("Invalid Query - get Register List: ". mysqli_error($link));
	}
	else 
	{
		$baris= mysqli_fetch_array($resultGet, MYSQLI_BOTH);
		$email = $baris['email'];
		$user = $baris['name'];
	}
	$subject = "Waiting for Approval";
	$redirect = "Customer/List.php";
	$body = '<div class="container" style="border-radius: 20px;
	box-shadow: 0px 10px 20px #1687d933;
	margin: auto !important; width:90% !important;
	float:unset !important; background-color:#e7ecf9;margin-bottom:10px;">
	<div class="desc">
	<div id="line2" class="col-lg-12">
		<h3>Hi, Mr/Mrs '.$user.'</h3>
		<h4>Your order ID : '.$orderID.'</h4>
		<h3>Status : <b>Waiting for Approval</b></h3>
		<p>Admin will be the verify the receipt you upload. Please wait for 1-5 minutes</p>
		<hr style="width: 100%;">
		<h3>Thank You for your kind cooperation</h3>
		
	</div>
</div></div>';
}

if($_GET['status']==3){
	$username = $_GET['user'];
	$orderID = $_GET['id'];
	$queryGet = "select * from users where username='".$username."'";
	$resultGet = mysqli_query($link,$queryGet);

	if(!$resultGet)
	{
		die ("Invalid Query - get Register List: ". mysqli_error($link));
	}
	else 
	{
		$baris= mysqli_fetch_array($resultGet, MYSQLI_BOTH);
		$email = $baris['email'];
		$user = $baris['name'];
	}
	$subject = "Waiting for Approval";
	$redirect = "Admin/Orders.php";
	$body = '<div class="container" style="border-radius: 20px;
	box-shadow: 0px 10px 20px #1687d933;
	margin: auto !important; width:90% !important;
	float:unset !important; background-color:#e7ecf9;margin-bottom:10px;">
	<div class="desc">
	<div id="line2" class="col-lg-12">
		<h3>Hi, Mr/Mrs '.$user.'</h3>
		<h4>Your order ID : '.$orderID.'</h4>
		<h3>Status : <b>Approved & Ready to collect</b></h3>
		<p>Token No: 10'.$orderID.'</p>
		<p>Please collect food in 5 minutes</p>
		<hr style="width: 100%;">
		<h3>Thank You for your kind cooperation</h3>
		
	</div>
</div>
</div>';
}
if($_GET['status']==4){
	$username = $_GET['user'];
	$orderID = $_GET['id'];
	$queryGet = "select * from users where username='".$username."'";
	$resultGet = mysqli_query($link,$queryGet);

	if(!$resultGet)
	{
		die ("Invalid Query - get Register List: ". mysqli_error($link));
	}
	else 
	{
		$baris= mysqli_fetch_array($resultGet, MYSQLI_BOTH);
		$email = $baris['email'];
		$user = $baris['name'];
	}
	$subject = "Order Declined";
	$redirect = "Admin/Orders.php";
	$body = '<div class="container" style="border-radius: 20px;
	box-shadow: 0px 10px 20px #1687d933;
	margin: auto !important; width:90% !important;
	float:unset !important; background-color:#e7ecf9;margin-bottom:10px;">
	<div class="desc">
	<div id="line2" class="col-lg-12">
		<h3>Hi, Mr/Mrs '.$user.'</h3>
		<h4>Your order ID : '.$orderID.'</h4>
		<h3>Status : <b>Order Declined</b></h3>
		<p>Admin rejected due to wrong receipt or didnt receive payment</p>
		<hr style="width: 100%;">
		<h3>Thank You for your kind cooperation</h3>
		
	</div>
</div>
</div>';
}


$mail = new PHPMailer;

//$mail->SMTPDebug = 4;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'apucafeteria222@gmail.com';                 // SMTP username
$mail->Password = 'APU123456@';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('apucafeteria222@gmail.com', 'APUCafeteria');
$mail->addAddress($email, $user);     // Add a recipient

$mail->addReplyTo('apucafeteria222@gmail.com', 'APUCafeteria');


//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $body;


if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	
	echo '<script type="text/javascript">
		window.onload = function () 
		{ 
		alert("Email Sent...");
		open("'.$redirect.'","_top");
		}
		</script>';
    echo 'Message has been sent';
}
?>