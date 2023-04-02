<?php
include "../Auth/connection.php";
$user = $_GET['id'];//Users
<<<<<<< HEAD
$password = "12345678";
=======
$password = "123";
>>>>>>> refs/remotes/origin/main

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
<<<<<<< HEAD
		header("Location: Users.php");
=======
		header("Location: Bus.php");
>>>>>>> refs/remotes/origin/main
	}
}

?>