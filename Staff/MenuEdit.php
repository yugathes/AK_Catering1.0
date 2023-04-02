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
	<style>
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
	top: -70px;
    left: 150px;
    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}
.tooltip .tooltiptext img{
	width: 120px;
	height:120px;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}

</style>
</head>

<body>

<?php
	$id = $_GET["id"];
	$queryGet = "select * from menu WHERE id = $id";

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
			<form class = "content" style="position:absolute;width: 40%;" action="../Admin/Update.php" name="EditForm" method="POST" enctype="multipart/form-data">
				<h1 class="header">Menu Update</h1>
				<?php	while($baris= mysqli_fetch_array($resultGet, MYSQLI_BOTH))	{?>
					<div class="input-group">
						<label>Name</label>
						<input type="text" name="name" value="<?php echo $baris['name']; ?>" required><br><br>
						<label>Price</label>
						<input type="number" name="price" step="0.01" value="<?php echo $baris['price'] ?>" required><br><br>
						<label>Description</label>
						<textarea rows="5" cols="45" name="description" value="<?php echo $baris['description'] ;?>" required><?php echo $baris['description'] ;?></textarea><br><br>
						<label>Image</label>
						<?php	
					if($baris['image'] == NULL){	?>
						<input id="file-input" type="file" name="image" accept="image/png, image/jpeg" required>
		<?php	}		else{	?>
							
						<div class="tooltip"><a href="../MenuIMG/<?php echo $baris['image'];?>" target=”_blank”>
							<img border="0" alt="editB" src="../MenuIMG/<?php echo $baris['image'];?>" width="25" height="25">
								<span class="tooltiptext">
									<img border="0" alt="editB" src="../MenuIMG/<?php echo $baris['image'];?>" width="50" height="50">
								</span>
							</a>	
						</div><?php	}?><br><br>
						<label>Category</label>
						<select id="service" name="category" required>
							<?php 
								if($baris['category']=="1")	echo "<option value='1' selected >Rice</option>";
								else	echo "<option value='1'>Rice</option>";
								if($baris['category']=="2")	echo "<option value='2' selected >Curry</option>";
								else	echo "<option value='2'>Curry</option>";
								if($baris['category']=="3")	echo "<option value='3' selected >Meat</option>";
								else	echo "<option value='3'>Meat</option>";
								if($baris['category']=="4")	echo "<option value='4' selected >Vegetables</option>";
								else	echo "<option value='4'>Vegetables</option>";
								if($baris['category']=="5")	echo "<option value='5' selected >Sides</option>";
								else	echo "<option value='5'>Sides</option>";
								if($baris['category']=="6")	echo "<option value='6' selected >Drinks</option>";
								else	echo "<option value='6'>Drinks</option>";
							?>
						</select><br><br>
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<button style="position: relative;left: 80%"; type="submit" class="btn" name="menuStaff">Update</button>
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