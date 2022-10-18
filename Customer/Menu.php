<?php
session_start();
//session_destroy();
if(isset ($_SESSION["username"])) //session userid gets value from text field named userid, shown in user.php
{	include "Header.php";
$size = 0;
if(isset($_POST['add'])){
	//$_SESSION['cart']=array(); // Makes the session an array
	$id=$_POST['id'];
	$_SESSION['cart'][] = $id;
	//array_push($_SESSION['cart'],$_POST['id']); 
	//print_r($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AK Catering</title>
	<style>
	.card {
	  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	  max-width: 300px;
	  margin: auto;
	  text-align: center;
	  font-family: arial;
	}

	.price {
	  color: grey;
	  font-size: 22px;
	}

	.card input {
	  border: none;
	  outline: 0;
	  padding: 12px;
	  color: white;
	  background-color: #000;
	  text-align: center;
	  cursor: pointer;
	  width: 100%;
	  font-size: 18px;
	}

	.card input:hover {
	  opacity: 0.7;
	}
	/* Remove extra left and right margins, due to padding */
	.row {
		width: 100%;
		padding-bottom: 20px;
	}

	/* Float four columns side by side */
	.column {
	  float: left;
	  width: 24%;
	  padding: 0 0.5%;
	}
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
	.mid{
		width: 100%;
		margin: auto;
	}
	.product{
		width: 80%;
		margin: auto;
	}
	.badge {
	  padding-left: 9px;
	  padding-right: 9px;
	  -webkit-border-radius: 9px;
	  -moz-border-radius: 9px;
	  border-radius: 9px;
	}

	.label-warning[href],
	.badge-warning[href] {
	  background-color: #c67605;
	}
	#lblCartCount {
		font-size: 15px;
		background: #ff0000;
		color: #fff;
		padding: 0 5px;
		vertical-align: top;
		margin-left: -10px; 
	}
	.cartBTN{
		float: right;
		width: 100%;
		box-sizing: border-box;
	}
	.sort{
	position: relative;
	float:right;
	display: inline;
    width: 100%;
    margin-top: 10px;
	margin-left: 10px;
	margin-bottom: 10px;
	font: black;
}
	</style>
</head>
<body>
<?php
	if(isset($_SESSION['cart']))
	{
		
		$size = sizeof($_SESSION['cart']);
	}
?>
	
	<div class="middle">
	<div class="container" style="border-radius: 20px;
	box-shadow: 0px 10px 20px #1687d933;
	margin: auto !important; width:90% !important;
	float:unset !important; background-color:#e7ecf9;">
	<div class="sort">
		<a href="Menu.php?category=1" style="background-color: #51e34e;" class="button button2">Rice</a>
		<a href="Menu.php?category=2" style="background-color: #f3d7ba;" class="button button2">Curry</a>
		<a href="Menu.php?category=3" style="background-color: #ebb142;" class="button button2">Meat</a>
		<a href="Menu.php?category=4" style="background-color: #9ca9eb;" class="button button2">Vegetables</a>
		<a href="Menu.php?category=5" style="background-color: #fbb1cd;" class="button button2">Sides</a>
		<a href="Menu.php?category=6" style="background-color: #cafbb1;" class="button button2">Drinks</a>
	</div>
	
	<div class="cartBTN">
	<?php
	if(isset($_GET['category']))
	{
		if($_GET['category']==1){
			$queryGet = "select * from menu WHERE category = 1";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center' style='color: black'>Rice Menu</h1>";
		}
		if($_GET['category']==2){
			$queryGet = "select * from menu WHERE category = 2";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center' style='color: black'>Curry Menu</h1>";
		}
		if($_GET['category']==3){
			$queryGet = "select * from menu WHERE category = 3";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center' style='color: black'>Meat Menu</h1>";
		}
		if($_GET['category']==4){
			$queryGet = "select * from menu WHERE category = 4";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center' style='color: black'>Vegetables Menu</h1>";
		}
		if($_GET['category']==5){
			$queryGet = "select * from menu WHERE category = 5";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center' style='color: black'>Sides Menu</h1>";
		}
		if($_GET['category']==6){
			$queryGet = "select * from menu WHERE category = 6";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center' style='color: black'>Drinks Menu</h1>";
		}
	}
	else{
		$queryGet = "select * from menu ORDER BY category ASC";	
		$resultGet = mysqli_query($link,$queryGet);
		echo "<h1 align='center;' style='color: black'>All Menu";
	}
	if(!$resultGet)
	{
		die ("Invalid Query - get Items List: ". mysqli_error($link));
	}
	else
	{?>
	<a id="myBtn" style="float:right" onMouseOver="this.style.color='#000'" onMouseOut="this.style.color='#00F'" href="ListCart.php">
	<i class="fa" style="font-size:30px">&#xf07a;</i>
	<span class='badge badge-warning' id='lblCartCount'> <?php echo $size;?>  </span>
	</a>
	</h1>
	</div>
	<div class="mid">
	<div class="product">
	<!--<div class="row">-->
	<?php	
		$count =1;
		$div1 = "<div class='row'>";
		$close = "</div>";
		$rowCount = mysqli_num_rows($resultGet);
		
		while($rows = mysqli_fetch_array($resultGet, MYSQLI_BOTH)) {
			if ($count == 1 || ($count % 4 == 0)) { 
				echo $div1;
			}?>
			<div class="column">
				<div class="card">
					<form method="post" action="Menu.php">
					  <img src="../MenuIMG/<?php echo $rows['image'];?>" alt="<?php echo $rows['image'];?>" style="width:100%;height:300px;">
					  <h4><?php echo $rows['name'];?></h4>
					  <p class="price">RM<?php echo $rows['price'];?></p>
					  <p><?php 
						if($rows['category']=="1")	echo "Rice";
						if($rows['category']=="2")	echo "Curry";
						if($rows['category']=="3")	echo "Meat";
						if($rows['category']=="4")	echo "Vegetables";
						if($rows['category']=="5")	echo "Sides";
						if($rows['category']=="6")	echo "Drinks";
?>					</p>
					<input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
					<p><input type="submit" value="Add to Cart" name="add"/></p>
					</form>
				</div>
			</div>
			
	<?php	if (($count % 4 == 0)) { 
				echo $close;
			}	 
			$count++;
		}?>
	</div>	
	</div>	
	</div>
	</div>
</body>
</html>
<?php
	}
}
else	{
	echo "No session exists or session has expired. Please log in again ";
	echo "Page will be redirect in 5 seconds";
	header('Refresh: 5; ../Auth/Login.php');
}
?>
