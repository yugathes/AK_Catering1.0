<head>
<?php 	include "../Auth/connection.php";
		$direct = dirname($_SERVER['PHP_SELF']); $newD = explode("/", $direct);?>
	<?php if (basename($_SERVER['PHP_SELF']) != "Menu.php") {?>
    <title><?php echo end($newD);?> System</title>
	<?php }?>
    <link rel="stylesheet" type="text/css" href="../CSS/topNav.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<div class="topnav">
        <a <?php if (basename($_SERVER['PHP_SELF']) == "Menu.php") echo "class='active'"?> href="Menu.php">
			<i class="fa fa-fw fa-home"></i>Food Menu
		</a>
		<a <?php if (basename($_SERVER['PHP_SELF']) == "List.php") echo "class='active'"?> href="List.php">
			<i class="fa fa-fw fa-shopping-cart"></i>Order List
		</a>
	</div>
	<div class="auth">
<?php if(isset ($_SESSION["username"])) //session userid gets value from text field named userid, shown in user.php
    {?>
	    <a style="background-color:#6f7378;" href="../Auth/Logout.php"> 
		<i class="fa fa-fw fa-sign-out"></i>Logout </a>
<?php	
	}
	else
	{
	?>
	    <a style="background-color:#6f7378;" href="../Auth/Login.php"> 
		<i class="fa fa-fw fa-sign-out"></i>Logout </a>
<?php
	}?>
	<a <?php if (basename($_SERVER['PHP_SELF']) == "Profile.php") echo "class='active'"?> href="Profile.php"> 
		<i class="fa fa-fw fa-user"></i>
		My Profile 
	</a>
		</div>
</head>
<h3 style="color:white;">Hi user, <?php echo $_SESSION["username"];?></h3>
<div class="left-sidebar">
<?php //include 'count.php';?>
</div>
