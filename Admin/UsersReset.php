<?php
include "../Auth/connection.php";
$user = $_GET['id'];//Users
$password = "123";

if(isset($user)){
	$queryUpd = "UPDATE users SET
		password = '".$password."'
		WHERE username = '$user'";
	$resultUpd = mysqli_query($link,$queryUpd);
	if (!$resultUpd)
	{
		die ("Error: ".mysqli_error($link));
	}		
	else {
		header("Location: Bus.php");
	}
}

?>