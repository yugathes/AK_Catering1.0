<?php
include "../Auth/connection.php";
$users= $_GET['sid'];//Users
$menu = $_GET['MenuID']; //menu
$menuID = $_GET['sMenuID']; //menus
$feedback = $_GET['feedbackid'];
$event = $_GET['eventID'];
//$user = $_GET['usrID'];
//$prize = $_GET['przID'];

if(isset($menu)){
	$queryDelete = "DELETE FROM menu WHERE id = '".$menu."'";
	$resultDelete = mysqli_query($link,$queryDelete);
	if (!$resultDelete)
	{
		die ("Error: ".mysqli_error($link));
		}		
	else {
		header("Location: Menu.php");
	}
}
if(isset($menuID)){
	$queryDelete = "DELETE FROM menu WHERE id = '".$menuID."'";
	$resultDelete = mysqli_query($link,$queryDelete);
	if (!$resultDelete)
	{
		die ("Error: ".mysqli_error($link));
		}		
	else {
		header("Location: ../Staff/Menu.php");
	}
}
if(isset($users)){
	$queryDelete = "DELETE FROM users WHERE username = '".$users."'";
	$resultDelete = mysqli_query($link,$queryDelete);
	if (!$resultDelete)
	{
		die ("Error: ".mysqli_error($link));
		}		
	else {
		header("Location: Users.php");
	}
}
if(isset($feedback)){
	$queryDelete = "DELETE FROM feedback WHERE id = '".$feedback."'";
	$resultDelete = mysqli_query($link,$queryDelete);
	if (!$resultDelete)
	{
		die ("Error: ".mysqli_error($link));
		}		
	else {
		header("Location: Comments.php");
	}
}

?>