<?php
session_start();

//if session exists
if(isset ($_SESSION["username"])) //session userid gets value from text field named userid, shown in user.php
{
	include "Header.php";
	
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../CSS/topNav.css">
</head>

<body>

<?php
	$name = $_GET["id"];
	$queryGet = "select * from users where username='".$name."'";

	$resultGet = mysqli_query($link,$queryGet);

	if(!$resultGet)
	{
		die ("Invalid Query - get Register List: ". mysqli_error($link));
	}
	else 
	{?>
	<div class="wrapper">
		<div class="middle">
			<div class="contentnew">
			<form class = "content" style="position:absolute;width: 40%;" action="Update.php" name="EditForm" method="POST">
				<h1 class="header">Users Profile</h1>
				<?php	while($baris= mysqli_fetch_array($resultGet, MYSQLI_BOTH))	{?>
					<div class="input-group">
						<label>Username</label>
						<input type="text" name="username" value="<?php echo $baris['username']; ?>" disabled><br><br>
						<label>Name</label>
						<input type="text" name="name" value="<?php echo $baris['name']; ?>"><br><br>
						<label>Email</label>
						<input type="email" name="email" value="<?php echo $baris['email'] ?>"><br><br>
						<label>Contact Number</label>
						<input type="text" name="Hp" value="<?php echo $baris['Hp']; ?>"><br><br>
						<input type="hidden" name="username" value="<?php echo $name;?>">
						<button style="position: relative;" type="submit" class="btn" name="staffAdm">Update</button>
						<a style="position: relative;float:right;" href="UsersReset.php?id=<?php echo $baris['username'];?>" class="btn"> Reset Password</a>
					</div> <?php	}?>
			</form>
			</div>
		</div>
	</div>
	<?php
		}
	
}
else {
	echo "No session exists or session has expired. Please log in again ";
	echo "Page will be redirect in 5 seconds";
	header('Location: ../Auth/Login.php');
}?>

</body>
</html>