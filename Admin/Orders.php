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
		<a href="Orders.php?status=0" style="background-color: #ebb142;" class="button button2">Waiting For Payment</a>
		<a href="Orders.php?status=1" style="background-color: #f3d7ba;" class="button button2">Waiting For Approval</a>
		<a href="Orders.php?status=2" style="background-color: #51e34e;" class="button button2">Approved</a>
		<a href="Orders.php?status=3" style="background-color: red;" class="button button2">Declined</a>
	</div>
<?php
	if(isset($_GET['status']))
	{
		if($_GET['status']==0){
			$queryGet = "select * from orders WHERE status = 0";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center'>Waiting For Payment Orders</h1>";
		}
		if($_GET['status']==1){
			$queryGet = "select * from orders WHERE status = 1";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center'>Waiting For Approval Orders</h1>";
		}
		if($_GET['status']==2){
			$queryGet = "select * from orders WHERE status = 2";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center'>Approved Orders</h1>";
		}
		if($_GET['status']==3){
			$queryGet = "select * from orders WHERE status = 3";	
			$resultGet = mysqli_query($link,$queryGet);
			echo "<h1 align='center'>Declined Orders</h1>";
		}
	}
	else{
		$queryGet = "select * from orders ORDER BY  datetime DESC";	
		$resultGet = mysqli_query($link,$queryGet);
		echo "<h1 align='center'>All Orders</h1>";
	}
	if(!$resultGet)
	{
		die ("Invalid Query - get Items List: ". mysqli_error($link));
	}
	else
	{	
		$menuarr = array();
?>
	<table id="table" border="1" align="center">
		<tr>
			<th>No</th>
			<th style="width:auto" colspan="2">Menu & Quantity</th>
			<th>Total</th>
			<th>Username</th>
			<th>Date</th>
			<th>Time</th>
			<th>Status</th>
			<th>Receipt</th>
			<th>Approved By</th>
			<th>Collection</th>
			<th colspan="2">Collection Time Date</th>
			<th>Action</th>
		</tr>	
<?php	$no=1;
		while($row= mysqli_fetch_array($resultGet, MYSQLI_BOTH))
		{	
			$tmp = $row['datetime'];
			$tmp1 = $row['collectiontime'];
            $Dtime = new DateTime($tmp);
            $Dtime1 = new DateTime($tmp1);
			$date = $Dtime->format('d/m/Y');
			$date1 = $Dtime1->format('d/m/Y');
			$time = $Dtime->format('g:i A');
			$time1 = $Dtime1->format('g:i A');
		?>
		<tr>
		<form action="Approve.php" method="POST">
			<td><?php echo $no;?></td>
			<td style="text-align:right;"><?php 
			$quantityarr = explode("|",$row['quantity']);
			foreach ($quantityarr as $quan){
				echo $quan;
				echo "<br>";
			}?></td>
			<td><?php 
				$menuarr = explode("|",$row['menuID']);
				foreach ($menuarr as $item){
					$resultGetMenu = mysqli_query($link,"SELECT name FROM menu WHERE id = '".$item."'");
					$rowMenu = mysqli_fetch_array($resultGetMenu, MYSQLI_BOTH);
					echo $rowMenu['name'];
					echo "<br>";
				}?>
			</td>
			<td><?php echo $row['total'];?></td>
			<td><?php echo $row['username'];?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $time;?></td>
			<td><?php	
			if($row['status']=="0")	echo "<p style='color: #ff8d00;'>Waiting For Payment</p>"; 
			if($row['status']=="1")	echo "<p style='color: #b7b72c;'>Waiting For Approval</p>"; 
			if($row['status']=="2")	echo "<p style='color: green;'>Approved</p>"; 
			if($row['status']=="3")	echo "<p style='color: red;'>Declined</p>"; 
			?>
			</td>
			<td>
				<?php
				if($row['receipt'] == NULL){
					echo "-";	
				}
				else{?>						
					<div class="tooltip"><a href="../Customer/Upload/<?php echo $row['receipt'];?>" target=”_blank”>
						<img border="0" alt="editB" src="../Customer/Upload/<?php echo $row['receipt'];?>" width="25" height="25">
							<span class="tooltiptext">
								<img border="0" alt="editB" src="../Customer/Upload/<?php echo $row['receipt'];?>" width="50" height="50">
							</span>
						</a>	
					</div><?php	}?>
			</td>	
			<td><?php if($row['approvedBy']==NULL)	echo "No approval";	echo $row['approvedBy'];?></td>
			<input type="hidden" name="id" value="<?php echo $row['id'];?>">
			<input type="hidden" name="user" value="<?php echo $row['username'];?>">
			<input type="hidden" name="approveBy" value="<?php echo $_SESSION['username'];?>">
			<td><?php echo $row['collection'];?></td>
			<td><?php echo $date1;?></td>
			<td><?php echo $time1;?></td>
			<td><?php	
			if($row['status']=="0")	echo "-"; 
			if($row['status']=="1") {?>
			<button type="submit" name="approve" value="2"<?php	
			if($row['status']=="1"){  
				echo "style='background:green;color:white;margin-right: 5px;'><span>&#10004;</span></button>";
				echo "<button type='submit' name='approve' value='3' style='background:red;color:white;'><span>&#10006;</span></button>";
			}
			else	echo "disabled>-</button>"?>
			<?php }
			if($row['status']=="2")	echo "<p style='color: green;'>Approved</p>"; 
			if($row['status']=="3")	echo "<p style='color: red;'>Declined</p>"; 
			?></td>
			</form>	
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
