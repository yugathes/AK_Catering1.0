<?php
//call this function to check if session exists or not
session_start();

//if session exists
if(isset ($_SESSION["username"])) //session userid gets value from text field named userid, shown in user.php
{	include "Header.php";
	$errors = array(); 
	?>
<!DOCTYPE html>
<html>
<head>
<style>
.mid{
	margin: auto;
	width: 50%;
	padding: 10px;
	
}
.content2 {
	margin: auto;
	width: 100%;
	padding: 20px;
	border: 1px solid #483235;
	background: white;
	border-radius: 10px 10px 10px 10px;
}
.input-group2 {
  margin: 10px 0px 10px 0px;
}
.input-group2 label {
	display: inline-flex;  
    margin-bottom: 10px;
	text-align: left;
	margin: 3px;
}
.input-group2 input {
	display: inline;
	float: right;
	height: 30px;
	width: 50%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
.input-group2 select {
	display: inline;
	float: right;
	width: 50%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
.content button{
	display: block;
	float: right;
	
}
.sort{
	position: relative;
	float:right;
	display: inline;
    width: 100%;
    margin-top: -25px;
	font: black;
}
</style>
</head>
<body>
	<div class="main">
	<div class="sort">
		<a href="Users.php?sort=Staff" style="background-color: darkturquoise;" class="button button2">Staff</a>
		<a href="Users.php?sort=Manager" style="background-color: palevioletred;" class="button button2">Manager</a>
		<a href="Users.php?sort=User" style="background-color: #cafbb1;" class="button button2">Customer</a>
	</div>

	
<?php
	if(isset($_GET['sort']))
	{
		if($_GET['sort']=="User"){
			$queryGet = "select * from users WHERE type_user = 'Customer'";	
			$resultGet = mysqli_query($link,$queryGet);
			echo '<h1 align="center">Customer List </h1>';
		}
		if($_GET['sort']=="Manager"){
			$queryGet = "select * from users WHERE type_user = 'Manager'";	
			$resultGet = mysqli_query($link,$queryGet);
			echo '<h1 align="center">Manager List </h1>';
		}
		if($_GET['sort']=="Staff"){
			$queryGet = "select * from users WHERE type_user = 'Staff'";	
			$resultGet = mysqli_query($link,$queryGet);
			echo '<h1 align="center">Staff List </h1>';
			?>
			<div class="mid">
			<form class="content2" action="Users.php" method="POST">
				<h1 class="header">Staff Registration</h1>
					<div class="input-group2">
						<?php include('Errors.php');?><br>
						<label>Username</label>
<<<<<<< HEAD
						<input type="text" name="username"required><br><br>
						<label>Full Name</label>
						<input type="text" name="name"required><br><br>
						<label>Email</label>
						<input type="email" name="email"required><br><br>
						<label>Password</label>
						<input type="password" name="password"required><br><br>
						<label>Contact Number</label>
						<input type="tel" name="Hp" placeholder="0123456789" pattern="[0-9]{3}[0-9]{3}[0-9]{4,5}" required><br><br>
						<label>Type User</label>
						<select name="type_user" required>
							<option value="">Choose One</option>
=======
						<input type="text" name="username"><br><br>
						<label>Full Name</label>
						<input type="text" name="name"><br><br>
						<label>Email</label>
						<input type="email" name="email"><br><br>
						<label>Password</label>
						<input type="password" name="password"><br><br>
						<label>Contact Number</label>
						<input type="text" name="Hp" placeholder="0123456789"><br><br>
						<label>Type User</label>
						<select name="type_user" required>
							<option value="0">Choose One</option>
>>>>>>> refs/remotes/origin/main
							<option value="Manager">Manager</option>
							<option value="Staff">Staff</option>
						<select>
					</div> 	
					<br><br>
					<button type="submit" class="btn" style="margin-top: 25px;" name="register">Register</button>	
			</form>
	</div>
	<br><br><br><br>
			<?php
		}
	}
	else{
		$queryGet = "select * from users ORDER BY type_user DESC";	
		$resultGet = mysqli_query($link,$queryGet);
		echo '<h1 align="center">All Users List </h1>';
	}
	if(!$resultGet)
	{
		die ("Invalid Query - get Items List: ". mysqli_error($link));
	}
	else
	{?>
	<table id="table" border="1" align="center">
		<tr>
			<th>No</th>
			<th>Username</th>
			<th>Name</th>
			<th>Email</th>
			<th>Contact Number</th>
			<th>Type User</th>
			<th>Action</th>
		</tr>	 
		<form>
<?php	$no=1;
		while($row= mysqli_fetch_array($resultGet, MYSQLI_BOTH))
		{
			
			?>
			<tr>
				<td><?php echo $no;?></td>
				<td><?php echo $row['username']?></td>
				<td><?php echo $row['name']?></td>
				<td><?php echo $row['email'];?></td>
				<td><?php echo $row['Hp']; ?></td>
				<td><?php echo $row['type_user']; ?></td>
				<td><a href="UsersEdit.php?id=<?php echo $row['username'];?>">
					<img border="0" alt="editB" src="../CSS/btn/editB.png" width="25" height="25"></a>
					<a href="Delete.php?sid=<?php echo $row['username'];?>" onclick="return confirm('Are you sure?')">
					<img border="0" alt="editB" src="../CSS/btn/delB.png" width="25" height="25"></a></a>
				</td>
			</tr>
<?php	$no++;}?>
		</form>	
	</table>
<?php	}?>	
	
<?php
	
	if(isset($_POST["register"])){
		$username = mysqli_real_escape_string($link, $_POST['username']);
		$email = mysqli_real_escape_string($link, $_POST['email']);
		$password = mysqli_real_escape_string($link, $_POST['password']);
		$type_user = $_POST['type_user'];
		$Hp = $_POST['Hp'];
		$name = $_POST['name'];
		
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }
		if (empty($Hp)) { array_push($errors, "Contact Number is required"); }
		
		$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query($link, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $username) {
			  array_push($errors, "Username already exists");
			}

			if ($user['email'] === $email) {
			  array_push($errors, "email already exists");
			}
		}
		if (count($errors) == 0) {
			//encrypt the password before saving in the database$password = md5($password)
			$query = "INSERT INTO users (username, password, name, email,  Hp, type_user) 
				  VALUES('$username', '$password', '$name', '$email', '$Hp', '$type_user')";
			$resultInsert = mysqli_query($link, $query);
			if (!$resultInsert)
			{
				die ("Error: ".mysqli_error($link));
			}		
			else {
				echo '<script type="text/javascript">
					window.onload = function () 
					{ 
					alert("Owner Profile been Registered...");
					open("Users.php","_top");
					}
					</script>';
			}	
		}
	}
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
