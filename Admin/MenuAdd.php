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
	<div class="wrapper">
		<div class="middle">
			<div class="contentnew">
			<form class = "content" style="position:absolute;width: 40%;" action="MenuAdd.php" name="Add" method="POST" enctype="multipart/form-data">
				<h1 class="header">Menu Add</h1>
					<div class="input-group">
						<label>Name</label>
<<<<<<< HEAD
						<input type="text" name="name" required><br><br>
						<label>Description</label>
						<textarea rows="5" cols="45" name="description" required></textarea><br><br>
						<label>Price</label>
						<input type="number" name="price" step="0.01" required><br><br>
						<label>Image</label>
						<input id="file-input" type="file" name="receipt" accept="image/png, image/jpeg" required><br><br>
						<label>Category</label>
						<select id="service" name="category" required>
							<option value=''>Choose one</option>
=======
						<input type="text" name="name" ><br><br>
						<label>Description</label>
						<textarea rows="5" cols="45" name="description"></textarea><br><br>
						<label>Price</label>
						<input type="number" name="price" step="0.01"><br><br>
						<label>Image</label>
						<input id="file-input" type="file" name="receipt" accept="image/png, image/jpeg" required><br><br>
						<label>Category</label>
						<select id="service" name="category">
							<option value='0'>Choose one</option>
>>>>>>> refs/remotes/origin/main
							<option value='1'>Rice</option>
							<option value='2'>Curry</option>
							<option value='3'>Meat</option>
							<option value='4'>Vegetables</option>
							<option value='5'>Sides</option>
<<<<<<< HEAD
							<option value='6'>Drinks</option>
=======
							<option value='5'>Drinks</option>
>>>>>>> refs/remotes/origin/main
						</select>
						<br><br>
						
						<button style="position: relative;left: 80%"; type="submit" class="btn" name="menuStaff">Add</button>
					</div> 
			</form>
			</div>
		</div>
	</div>
	<?php
}
else {
	echo "No session exists or session has expired. Please log in again ";
	echo "Page will be redirect in 5 seconds";
	header('Location: ../Auth/Login.php');
}?>

</body>
</html>
<?php
if (isset($_POST['menuStaff'])) {
  // receive all input values from the form
	$name = mysqli_real_escape_string($link, $_POST['name']);
	$price = $_POST['price'];
	$description = $_POST['description'];
	$category = $_POST['category'];
	echo $category;
    
    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK)
    {
		$fileTmpPath = $_FILES['receipt']['tmp_name'];
        $fileName = $_FILES['receipt']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
		
		// sanitize file-name
        $newFileName = $name  . '.' . $fileExtension ;
 
        // check if file has one of the following extensions
        $allowedfileExtensions = array('jpg', 'PNG', 'png');
		
		if (in_array($fileExtension, $allowedfileExtensions))
        {
            $uploadFileDir = '../MenuIMG/';
            $dest_path = $uploadFileDir . $newFileName;
 
            if(move_uploaded_file($fileTmpPath, $dest_path)) 
            {
				$queryInsert = "INSERT INTO menu(id, name, description, price, image, category) 
				VALUES(NULL, '$name', '$description', '$price', '$newFileName', $category )";

				$resultInsert = mysqli_query($link,$queryInsert);
				if (!$resultInsert)
				{
					die ("Error: ".mysqli_error($link));
				}		
				else {
					echo '<script type="text/javascript">
						window.onload = function () 
						{ 
						alert("File been Uploaded...");
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
	else
		echo '<script type="text/javascript">
				window.onload = function () 
				{ 
				alert("Error: File not choosed...");
				open("Menu.php","_top");
				}
				</script>';
}
?>