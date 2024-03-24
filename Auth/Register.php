<?php include('DataBase.php') ?>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="../CSS/topNav.css">
</head>
<body>
	<div class="wrapper">
		<div class="middle">
			<div class="contentnew">
			<form class = "content" style="position:absolute;margin-bottom: 100px;" method = "post">
				<h1 class="header">Registration</h1>
					<div class="input-group">
						<?php include('Errors.php');?><br>
						<label>Username</label>
						<input type="text" name="username"><br><br>
						<label>Full Name</label>
						<input type="text" name="name"><br><br>
						<label>Email</label>
						<input type="email" name="email"><br><br>
						<label>Password</label>
						<input type="password" name="password"><br><br>
						<label>Contact Number</label>
						<input type="tel" name="Hp" placeholder="0123456789" pattern="[0-9]{3}[0-9]{3}[0-9]{4,5}" required><br><br>
						<input type="hidden" name="type_user" value="Customer">
						<br><br>
						<button type="submit" class="btn" name="reg_user">Register</button>
						<p>Already a member? <a href="Login.php">Sign in</a></p>
					</div> 
			</form>
			</div>
		</div>
	</div>
	<br><br><br><br>
</body>
</html>