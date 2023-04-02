<?php
include("../Auth/connection.php");
		$id = $_POST["id"];
		$appr = $_POST["approve"];
		$user = $_POST["user"];
		$approveBy = $_POST["approveBy"];
		
		$queryInsert = "UPDATE orders SET
		status = '$appr',
		approvedBy = '$approveBy'
		WHERE id = '$id'";

	$resultInsert = mysqli_query($link,$queryInsert);
	if (!$resultInsert)
	{
		die ("Error: ".mysqli_error($link));
	}		
	else {
		echo '<script type="text/javascript">
			window.onload = function () 
			{ 
			alert("Status been Updated...");
			open("Orders.php","_top");
			}
			</script>';
	}
?>