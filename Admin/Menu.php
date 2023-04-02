<?php
//call this function to check if session exists or not
session_start();
//if session exists
if(isset ($_SESSION["username"])) //session userid gets value from text field named userid, shown in user.php
{	include "Header.php";?>
<!DOCTYPE html>
<html>
<head>
<style>
.sort{
	position: relative;
	float:right;
	display: inline;
    width: 100%;
    margin-top: -25px;
	margin-bottom: 25px;
	font: black;
	
}
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
	<div class="main">
	<div class="sort">
		<a href="MenuAdd.php" style="background-color: #1D96D1;float: right;color: aliceblue;border-radius: 12px;" class="button button2">Add</a>
		<a href="Menu.php?category=1" style="background-color: #51e34e;" class="button button2">Rice</a>
		<a href="Menu.php?category=2" style="background-color: #f3d7ba;" class="button button2">Curry</a>
		<a href="Menu.php?category=3" style="background-color: #ebb142;" class="button button2">Meat</a>
		<a href="Menu.php?category=4" style="background-color: #9ca9eb;" class="button button2">Vegetables</a>
		<a href="Menu.php?category=5" style="background-color: #fbb1cd;" class="button button2">Sides</a>
		<a href="Menu.php?category=6" style="background-color: #cafbb1;" class="button button2">Drinks</a>
	</div>
<?php
	if(isset($_GET['category']))
	{
		if($_GET['category']==1){
			$queryGet = "select * from menu WHERE category = 1";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center'>Rice Menu</h1>";
		}
		if($_GET['category']==2){
			$queryGet = "select * from menu WHERE category = 2";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center'>Curry Menu</h1>";
		}
		if($_GET['category']==3){
			$queryGet = "select * from menu WHERE category = 3";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center'>Meat Menu</h1>";
		}
		if($_GET['category']==4){
			$queryGet = "select * from menu WHERE category = 4";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center'>Vegetables Menu</h1>";
		}
		if($_GET['category']==5){
			$queryGet = "select * from menu WHERE category = 5";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center'>Sides Menu</h1>";
		}
		if($_GET['category']==6){
			$queryGet = "select * from menu WHERE category = 6";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center'>Drinks Menu</h1>";
		}
	}
	else{
		$queryGet = "select * from menu ORDER BY category ASC";	
		$resultGet = mysqli_query($link,$queryGet);
		echo "<h1 align='center'>All Menu</h1>";
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
			<th>Name</th>
			<th>Description</th>
			<th>Price</th>
			<th>Image</th>
			<th>Category</th>
			<th>Action</th>

		</tr>	
<?php	$no=1;
		while($row= mysqli_fetch_array($resultGet, MYSQLI_BOTH))
		{	
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['price'];?></td>
			<td><textarea rows="3" col="2"><?php echo $row['description'];?></textarea></td>
			<td>
			<?php	
				if($row['image'] == NULL){
					echo $row['image'];	
				}
				else{?>						
					<div class="tooltip"><a href="../MenuIMG/<?php echo $row['image'];?>" target=”_blank”>
						<img border="0" alt="editB" src="../MenuIMG/<?php echo $row['image'];?>" width="25" height="25">
							<span class="tooltiptext">
								<img border="0" alt="editB" src="../MenuIMG/<?php echo $row['image'];?>" width="50" height="50">
							</span>
						</a>	
					</div><?php	}?>
			</td>
			<td><?php 
				if($row['category']=="1")	echo "Rice";
				if($row['category']=="2")	echo "Curry";
				if($row['category']=="3")	echo "Meat";
				if($row['category']=="4")	echo "Vegetables";
				if($row['category']=="5")	echo "Sides";
				if($row['category']=="6")	echo "Drinks";
			?></td>
			<td>
				<a href="MenuEdit.php?id=<?php echo $row['id'];?>">
				<img border="0" alt="editB" src="../CSS/btn/editB.png" width="25" height="25"></a>
				<a href="../Admin/Delete.php?MenuID=<?php echo $row['id'];?>" onclick="return confirm('Are you sure?')">
				<img border="0" alt="editB" src="../CSS/btn/delB.png" width="25" height="25"></a>
			</td>
		</tr>
			<?php	$no++;	}?>
	</table>
<?php
		
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
