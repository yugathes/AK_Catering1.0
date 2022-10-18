<?php
include "../Auth/connection.php";
session_start();
$id = "";
$customer = "";
$user = $_SESSION['username'];
$status = 0;
$total = "";
$menuarr = array();
$errors = array(); 
$newArr = array();
$quantityStr = "";
    
if (isset($_POST['checkout'])) {
// receive all input values from the form
	$customer = mysqli_real_escape_string($link, $_POST['username']);
	$total = $_POST['total'];
	$menu = $_SESSION['cart'];
	$quantity = $_POST['quantity'];
	$collection = $_POST['collection'];
	$collectiontime = $_POST['collectiontime'];
	$quantityStr = implode('|',$quantity);
	echo $quantityStr;
	$menuStr = implode('|',$menu);
	$menuarr = explode("|",$menuStr);

	if (count($errors) == 0) 
	{
		$Cquery = "INSERT INTO orders (id, username, menuID, quantity, total, status, collection, collectiontime) 
		VALUES (NULL, '$customer', '$menuStr', '$quantityStr', '$total', '$status', '$collection', '$collectiontime')";
		$result= mysqli_query($link, $Cquery);
		if (!$result)
		{
			die("Error:".mysqli_error($link));
			$fail = "Please Check Booking Detail.";
			echo "<script type='text/javascript'>alert('$fail');
			document.location='Menu.php';
			</script>"; 
		}
		else
		{
			$sucess = "Checkout Added Sucessful.";
			//echo $sucess;
			unset($_SESSION['cart']);
			
			echo "<script type='text/javascript'>alert('$sucess');
			document.location='List.php';
			</script>"; 
		}
    }  
	else
	{   
		$fail = "Please Check Cuti Detaile.";
		echo "<script type='text/javascript'>alert('$fail');
		document.location='status.php';
		</script>"; 
	}
}
?>
