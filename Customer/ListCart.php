<?php
session_start();
//session_destroy();

if(isset($_GET['remove'])){
	$key=array_search($_GET['remove'],$_SESSION['cart']);
	if($key!==false)
		unset($_SESSION['cart'][$key]);
	$_SESSION["cart"] = array_values($_SESSION["cart"]);
}
if(isset($_GET['removeAll'])){
	
	unset($_SESSION['cart']);
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,900" rel="stylesheet">
</head>
<body style="background-image: url('../css/bc.jpg');background-position: center;background-size: cover;background-attachment: fixed;">
   <div class="CartContainer">
		<div class="Header">
			<h3 class="Heading">Food Cart</h3>
			<h5 class="Action"><a href="ListCart.php?removeAll">Remove all</a></h5>
		</div>
		<form action="CheckOut.php" method="POST">
<?php
	$subtotal = 0.00;
	$no	= 0;
	if(isset($_SESSION['cart'])){
		foreach ($_SESSION["cart"] as $item){
			include "../Auth/connection.php";
			$queryGetQ = "select * from menu WHERE id='".$item."'";	
			$resultGetQ = mysqli_query($link,$queryGetQ);
			if(!$resultGetQ)
			{
				die ("Invalid Query - get Items List: ". mysqli_error($link));
			}
			else
			{
				while($rows = mysqli_fetch_array($resultGetQ, MYSQLI_BOTH)) {
				$no++;
				$subtotal += $rows['price'];
				?>
				
				<div class="Cart-Items">
					<div class="image-box">
						<img src="../MenuIMG/<?php echo $rows['image'];?>" alt="<?php echo $rows['image'];?>;?>" width="120px" style={{ height="120px" }} />
					</div>
					<div class="about">
						<h1 class="title"><?php echo $rows['name'];?></h1>
						<h3 class="subtitle"><?php 
						if($rows['category']=="1")	echo "Rice";
						if($rows['category']=="2")	echo "Curry";
						if($rows['category']=="3")	echo "Meat";
						if($rows['category']=="4")	echo "Vegetables";
						if($rows['category']=="5")	echo "Sides";
						if($rows['category']=="6")	echo "Drinks";
?>						
						<br><br>Price per item RM<span id="item_price<?php echo $no;?>"><?php echo $rows['price'];?></span>
						</h3>
					</div>
					<div class="counter">
						<input style="width: 50%;" type="number" min="0" id="num<?php echo $no;?>" oninput="calc<?php echo $no;?>()" name="quantity[]" value="1" step="1">
					</div>
					<div class="prices">
						<div class="amount" id=""><p>RM<span id="total<?php echo $no;?>" ><?php echo $rows['price'];?></span></p></div>
						<div class="remove"><a href="ListCart.php?remove=<?php echo $item;?>"><u>Remove</u></a></div>
					</div>
				</div>
	<?php		}
			}
		}
	}
	else{?>
   	   <div class="Cart-Items">
			<h1 style="width: 100%;text-align: center;">Empty cart</h1>
	   </div>
	<?php	}?>
   	   
   	 <hr> 
   	<div class="checkout">
		<div class="total">
			<div>
				<div class="Subtotal">Sub-Total</div>
				<div class="items"><?php echo $no;?> items</div>
			</div>
			<div class="total-amount">RM<span id="subtotal"></span></div>
			<input type="hidden" name="total" id="subBE" value="<?php echo $subtotal;?>">
			
			<input type="hidden" name="username" value="<?php echo $_SESSION["username"]?>">
		</div>
		<div class="total">
			<div style="margin-top: 30px;margin-bottom: 20px;font-size:15px">
				<div class="Subtotal" style="margin-bottom: 10px">Delivery Or Pick-Up</div>
				<input type="radio" name="collection" value="Delivery">
			  	<label for="Delivery">Delivery</label><br>
<<<<<<< HEAD
				<label>Delivery address</label><br>
				<textarea rows="3" cols="30" name="devaddress"></textarea><br>
=======
>>>>>>> refs/remotes/origin/main
				<input type="radio" name="collection" value="Pick-Up">
			  	<label for="Pick-Up">Pick-Up</label><br>
			</div>
			<div style="margin-top: 30px;margin-bottom: 20px">
				<div class="Subtotal" style="margin-bottom: 10px">Time and Date</div>
				<input type="datetime-local" name="collectiontime" required>
			</div>
			
		</div>
		
		<input type="submit" value="Checkout" name="checkout" class="button" style="float:right;"></i>
		<button class="button"><a class="button" href="Menu.php">Continue Shopping</a></button>
	</div>
	</form>
   </div>
	
<script>

let sumv = 0;
const reducer = (accumulator, curr) => accumulator + curr;
var tot;
<?php for ($x = 1; $x <= $no; $x++) {?>
function calc<?php echo $x;?>() 
{
	var item = "item_price" + <?php echo $x;?>;
	var quantity = "num" + <?php echo $x;?>;
	var t = "total" + <?php echo $x;?>;
	
  var price = document.getElementById(item).innerHTML;
  var noTickets = document.getElementById(quantity).value;
  var total = parseFloat(price) * noTickets;
  if (!isNaN(total))
    document.getElementById(t).innerHTML = total.toFixed(2);
	tot<?php echo $x-1;?> = document.getElementById(t).innerHTML; 
	calcsub();


}
<?php	}?>

 function calcsub(){
	 var subtotal = 0.0;
<?php for ($y = 1; $y <= $no; $y++) {?>
	var t = "total" + <?php echo $y;?>;
	subtotal += parseFloat(document.getElementById(t).innerHTML);
		

<?php	}?>	
document.getElementById("subtotal").innerHTML = subtotal.toFixed(2);
document.getElementById("subBE").value = subtotal.toFixed(2);
console.log(subtotal);
} 


</script>
</body>
</html>
