<?php
	include "../Auth/connection.php";
//Menu
if(isset($_POST["menu"])){
	$name = $_POST["name"];
	$price = $_POST["price"];
	$category = $_POST["category"];
	$description = $_POST["description"];
	$ID = $_POST["id"];
	if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK)
    {
		$fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
		
		// sanitize file-name
        $newFileName = $category . '_' . $name . '.' . $fileExtension ;
 
        // check if file has one of the following extensions
        $allowedfileExtensions = array('jpg', 'PNG', 'png');
		
		if (in_array($fileExtension, $allowedfileExtensions))
        {
            $uploadFileDir = '../MenuIMG/';
            $dest_path = $uploadFileDir . $newFileName;
 
            if(move_uploaded_file($fileTmpPath, $dest_path)) 
            {
				$queryInsert = "UPDATE menu SET
					name = '".$name."',
					price = '".$price."',
					image = '".$newFileName."',
					description = '".$description."',
					category = '".$category."'
					WHERE id = '$ID'";

				$resultInsert = mysqli_query($link,$queryInsert);
				if (!$resultInsert)
				{
					die ("Error: ".mysqli_error($link));
				}		
				else {
					echo '<script type="text/javascript">
						window.onload = function () 
						{ 
						alert("Food Menu been Updated...");
						open("Menu.php","_top");
						}
						</script>';
				}
			}
			else
				echo '<script type="text/javascript">
						window.onload = function () 
						{ 
						alert("File Uploaded Error...");
						open("Menu.php","_top");
						}
						</script>';
		}
		else
			echo '<script type="text/javascript">
					window.onload = function () 
					{ 
					alert("File Uploaded Wrong File type Error...");
					open("Menu.php","_top");
					}
					</script>';
	}
	else{
		$queryInsert = "UPDATE menu SET
					name = '".$name."',
					price = '".$price."',
					description = '".$description."',
					category = '".$category."'
					WHERE id = '$ID'";

		$resultInsert = mysqli_query($link,$queryInsert);
		if (!$resultInsert)
		{
			die ("Error: ".mysqli_error($link));
		}		
		else {
			echo '<script type="text/javascript">
				window.onload = function () 
				{ 
				alert("Food Menu been Updated...");
				open("Menu.php","_top");
				}
				</script>';
		}

	}
}
if(isset($_POST["menuStaff"])){
	$name = $_POST["name"];
	$price = $_POST["price"];
	$ID = $_POST["id"];
	$description = $_POST["description"];
	$category = $_POST["category"];
	if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK)
    {
		$fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
		
		// sanitize file-name
        $newFileName = $name  . '_' . $category . '.' . $fileExtension ;
 
        // check if file has one of the following extensions
        $allowedfileExtensions = array('jpg', 'PNG', 'png');
		
		if (in_array($fileExtension, $allowedfileExtensions))
        {
            $uploadFileDir = '../MenuIMG/';
            $dest_path = $uploadFileDir . $newFileName;
 
            if(move_uploaded_file($fileTmpPath, $dest_path)) 
            {
				$queryInsert = "UPDATE menu SET
					name = '".$name."',
					price = '".$price."',
					category = '".$category."',
					image = '".$newFileName."'
					WHERE id = '$ID'";

				$resultInsert = mysqli_query($link,$queryInsert);
				if (!$resultInsert)
				{
					die ("Error: ".mysqli_error($link));
				}		
				else {
					echo '<script type="text/javascript">
						window.onload = function () 
						{ 
						alert("Food Menu been Updated...");
						open("../Staff/Menu.php","_top");
						}
						</script>';
				}
			}
			else
				echo '<script type="text/javascript">
						window.onload = function () 
						{ 
						alert("File Uploaded Error...");
						open("../Staff/Menu.php","_top");
						}
						</script>';
		}
		else
			echo '<script type="text/javascript">
					window.onload = function () 
					{ 
					alert("File Uploaded Wrong File type Error...");
					open("../Staff/Menu.php","_top");
					}
					</script>';
	}
	else
	{
		$queryInsert = "UPDATE menu SET
					name = '".$name."',
					description = '".$description."',
					category = '".$category."',
					price = '".$price."'
					WHERE id = '$ID'";

		$resultInsert = mysqli_query($link,$queryInsert);
		if (!$resultInsert)
		{
			die ("Error: ".mysqli_error($link));
		}		
		else {
			echo '<script type="text/javascript">
				window.onload = function () 
				{ 
				alert("Food Menu been Updated...");
				open("../Staff/Menu.php","_top");
				}
				</script>';
		}
	}
}
//Users
if(isset($_POST["staffAdm"])){
	$email = $_POST["email"];
	$name =$_POST["name"];
	$Hp = $_POST["Hp"];
	$uID = $_POST["username"];
		
	$queryInsert = "UPDATE users SET
		name = '".$name."',
		email = '".$email."',
		Hp = '".$Hp."'
		WHERE username = '$uID'";

	$resultInsert = mysqli_query($link,$queryInsert);
	if (!$resultInsert)
	{
		die ("Error: ".mysqli_error($link));
	}		
	else {
		echo '<script type="text/javascript">
			window.onload = function () 
			{ 
			alert("Users Profile been Updated...");
			open("Users.php","_top");
			}
			</script>';

	}
}
//User
if(isset($_POST["user"])){
	$email = $_POST["email"];
	$name =$_POST["name"];
	$Hp = $_POST["Hp"];
	$uID = $_POST["username"];
	$password = $_POST["password"];
		
	$queryInsert = "UPDATE users SET
		name = '".$name."',
		email = '".$email."',
		password = '".$password."',
		Hp = '".$Hp."'
		WHERE username = '$uID'";

	$resultInsert = mysqli_query($link,$queryInsert);
	if (!$resultInsert)
	{
		die ("Error: ".mysqli_error($link));
	}		
	else {
		echo '<script type="text/javascript">
			window.onload = function () 
			{ 
			alert("Users Profile been Updated...");
			open("../Customer/Profile.php","_top");
			}
			</script>';

	}
}
//Staff
if(isset($_POST["staff"])){
	$email = $_POST["email"];
	$name =$_POST["name"];
	$password =$_POST["password"];
	$Hp = $_POST["Hp"];
	$uID = $_POST["username"];
		
	$queryInsert = "UPDATE users SET
		name = '".$name."',
		email = '".$email."',
		password = '".$password."',
		Hp = '".$Hp."'
		WHERE username = '$uID'";

	$resultInsert = mysqli_query($link,$queryInsert);
	if (!$resultInsert)
	{
		die ("Error: ".mysqli_error($link));
	}		
	else {
		echo '<script type="text/javascript">
			window.onload = function () 
			{ 
			alert("Staff Profile been Updated...");
			open("../Staff/home.php","_top");
			}
			</script>';

	}
}
?>