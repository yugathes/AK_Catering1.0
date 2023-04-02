<?php
//call this function to check if session exists or not
session_start();

//if session exists
if(isset ($_SESSION["username"])) //session userid gets value from text field named userid, shown in user.php
{	include "Header.php";?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	* {
	  box-sizing: border-box;
	}

	/* Float four columns side by side */
	.column {
	  float: left;
	  width: 25%;
	  padding: 0 10px;
	}

	/* Remove extra left and right margins, due to padding */
	.row {margin: 0 20px;color: black;}

	/* Clear floats after the columns */
	.row:after {
	  content: "";
	  display: table;
	  clear: both;
	}

	/* Responsive columns */
	@media screen and (max-width: 600px) {
	  .column {
		width: 100%;
		display: block;
		margin-bottom: 20px;
	  }
	}

	/* Style the counter cards */
	.card {
	  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	  padding: 16px;
	  text-align: center;
	  background-color: #9ab6c385;
	  color: white;
	  box-shadow: 4px 5px 11px;
	}
	.card p {
		font-size: 25;
		font-weight: bold;
	}
	
</style>
</head>
<body>
<div class="main">
<?php
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$date = date('Y-m-d', time());
	$date = $date.'%';
	
<<<<<<< HEAD
	$managerQ = "select * from users where type_user='Manager'";	
	$managerR = mysqli_query($link,$managerQ);
	$manager = mysqli_num_rows($managerR);
	
=======
>>>>>>> refs/remotes/origin/main
	$ownerQ = "select * from users where type_user='Staff'";	
	$ownerR = mysqli_query($link,$ownerQ);
	$owner = mysqli_num_rows($ownerR);
	
	$customerQ = "select * from users where type_user='Customer'";	
	$customerR = mysqli_query($link,$customerQ);
	$customers = mysqli_num_rows($customerR);

	$OrdersQ = "select * from orders";	
	$OrdersR = mysqli_query($link,$OrdersQ);
	$Orders = mysqli_num_rows($OrdersR);
	
<<<<<<< HEAD
	$AOrdersQ = "select * from orders WHERE status = 2";	
	$AOrdersR = mysqli_query($link,$AOrdersQ);
	$AOrders = mysqli_num_rows($AOrdersR);
	
	$POrdersQ = "select * from orders WHERE status = 1";	
	$POrdersR = mysqli_query($link,$POrdersQ);
	$POrders = mysqli_num_rows($POrdersR);
	
	$DOrdersQ = "select * from orders  WHERE status = 3";	
	$DOrdersR = mysqli_query($link,$DOrdersQ);
	$DOrders = mysqli_num_rows($DOrdersR);
	
	$salesQ = "select SUM(total) from orders WHERE status = 2 ";	
=======
	$salesQ = "select SUM(total) from orders";	
>>>>>>> refs/remotes/origin/main
	$salesR = mysqli_query($link,$salesQ);
	$Crow= mysqli_fetch_array($salesR, MYSQLI_BOTH);
	$sales = $Crow[0];
	
	?>
	<h1 align="center"> Statistics </h1>
	<div class="row">
		<div class="column">
			<div class="card">
				<h3>Total Staff</h3>
				<p><?php echo $owner;?></p>
			</div>
		</div>
		<div class="column">
			<div class="card">
				<h3>Total Customer</h3>
				<p><?php echo $customers;?></p>
			</div>
		</div>
  
		<div class="column">
			<div class="card">
<<<<<<< HEAD
				<h3>Total Manager</h3>
				<p><?php echo $manager;?></p>
			</div>
		</div>
		
		<div class="column">
			<div class="card">
=======
>>>>>>> refs/remotes/origin/main
				<h3>Total Orders</h3>
				<p><?php echo $Orders;?></p>
			</div>
		</div>
<<<<<<< HEAD
	</div>
	<br>
	<br>
	<div class="row">
		
		<div class="column">
			<div class="card">
				<h3>Total Approved</h3>
				<p><?php echo $AOrders;?></p>
			</div>
		</div>
  
		<div class="column">
			<div class="card">
				<h3>Total Decline</h3>
				<p><?php echo $DOrders;?></p>
			</div>
		</div>
		<div class="column">
			<div class="card">
				<h3>Total Pending</h3>
				<p><?php echo $POrders;?></p>
			</div>
		</div>
=======
>>>>>>> refs/remotes/origin/main
  
		<div class="column">
			<div class="card">
				<h3>Overall Sales</h3>
				<p>RM<?php echo $sales;?></p>
			</div>
		</div>
	</div>
	<br>
	<br>
<?php
}	
else	{
	echo "No session exists or session has expired. Please log in again ";
	echo "Page will be redirect in 5 seconds";
	header('Refresh: 5; ../Auth/Login.php');
}
?>
</div>
</body>
</html>
