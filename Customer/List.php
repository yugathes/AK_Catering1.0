<?php
//call this function to check if session exists or not
session_start();

//if session exists
if(isset ($_SESSION["username"])) //session userid gets value from text field named userid, shown in user.php
{	include "Header.php";
$user = $_SESSION["username"];?>
<!DOCTYPE html>
<html>
<head>
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
.desc{
	margin-left: 20px;
}
.image-upload>input {
  display: none;
  cursor: pointer;
}
</style>
</head>
<body>
	<h2 style="text-align:center;">Welcome To AK Catering Ordering Website</h2>
<?php

	$queryGet = "select * from orders where username='".$_SESSION["username"]."'";	
	$resultGet = mysqli_query($link,$queryGet);
	$count = mysqli_num_rows($resultGet);
	if(!$resultGet)
	{
		die ("Invalid Query - get Items List: ". mysqli_error($link));
	}
	else
	{?>
	<table id="table" border="1" align="center">
		<tr>
			<th>No</th>
			<th colspan="2">Ordered On</th>
			<th style="width:25%" colspan="2">Menu & Quantity</th>
			<th>Total</th>
			<th>Status</th>
			<th style="width:10%">Payment</th>
			<th>Delivery Address</th>
			<th>Collection</th>
			<th colspan="2">Collection Date Time</th>
			<th>Action</th>
		</tr>	 
		
<?php	
		if($count >0)
		{
		$no=1;
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
			<form action="List.php" method="POST" enctype="multipart/form-data">
			<td><?php echo $no;?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $time;?></td>
			<td style="text-align:right;"><?php 
			$quantityarr = explode("|",$row['quantity']);
			foreach ($quantityarr as $quan){
				echo $quan;
				echo "<br>";
			}?></td>
			<td style="text-align:left;"><?php 
				$menuarr = explode("|",$row['menuID']);
				$quantityarr = explode("|",$row['quantity']);
				foreach ($menuarr as $item){
					$resultGetMenu = mysqli_query($link,"SELECT name FROM menu WHERE id = '".$item."'");
					$rowMenu = mysqli_fetch_array($resultGetMenu, MYSQLI_BOTH);
					echo $rowMenu['name'];
					echo "<br>";
				}?></td>
			
			<td>RM<?php echo $row['total']; ?></td>
			<td><?php	
			if($row['status']=="0")	echo "<p style='color: #ff8d00;'>Waiting For Payment</p>"; 
			if($row['status']=="1")	echo "<p style='color: #b7b72c;'>Waiting For Approval</p>"; 
			if($row['status']=="2")	echo "<p style='color: green;'>Approved & Ready to Collect</p>"; 
			if($row['status']=="3")	echo "<p style='color: red;'>Declined</p>"; 
			?></td>
			<input name="id" type="hidden" value="<?php echo $row['id'];?>">
			<td style="text-align: center">
				<center>
				<?php	
			if($row['receipt'] == NULL){	?>
					<input type="file" name="receipt" accept="image/png, image/jpeg">
<?php	}		else{	?>
					<div class="tooltip"><a href="Upload/<?php echo $row['receipt'];?>" target=”_blank”>
					<img border="0" alt="editB" src="Upload/<?php echo $row['receipt'];?>" width="25" height="25">
						<span class="tooltiptext">
							<img border="0" alt="editB" src="Upload/<?php echo $row['receipt'];?>" width="50" height="50">
						</span>
					</a>	
					</div> 
					
<?php
}?>
				</center>
			<!--<input type="file" name="receipt" accept="image/png, image/jpeg, application/pdf">
				<img border="0" alt="editB" src="../CSS/btn/uploadB.png" width="25" height="25"></input>--></td>
			<td><?php echo $row['devaddress'];?></td>
			<td><?php echo $row['collection'];?></td>
			<td><?php echo $date1;?></td>
			<td><?php echo $time1;?></td>
			<td>
			<?php	
			if($row['status']=="0")	echo "<input type='submit' name='upload' Value='Upload'>"; 
			else	echo "-"; 
			?></td>
			
			</form>	
		</tr>
<?php	$no++;
}
		}
		else {?>
		<tr><td colspan="13">No Orders Yet</td></tr><?php	}?>
	</table>
		<div class="middle">
	<div class="container" style="border-radius: 20px;
	box-shadow: 0px 10px 20px #1687d933;
	margin: auto !important; width:90% !important;
	float:unset !important; background-color:#e7ecf9;margin-bottom:10px;">
	<div class="desc">
	<div id="line2" class="col-lg-12">
		<h3>Please attach jpg,png</h3>
		<h3>Please do transfer to below account</h3>
		<div class="cofounder-ceo-image">
			<img border="0" alt="editB" src="../CSS/btn/Maybank.png" width="150px" height="50" style="margin-bottom: 20px;margin-right:20px; float:left;">
			<p>Account No &nbsp;&nbsp;&nbsp;&nbsp;  : <b>101582892873</b></p>
			<p>Account Name : <b>AK Catering</b></p>
		</div>
		<hr style="width: 100%;">
		<h3>Status</h3>
		<p><b>Waiting For Payment</b> : Please make payment and upload the receipt</p>
		<p><b>Waiting For Approval</b> : Admin will be the approve receipt</p>
		<p><b>Order Approved</b> : Order Has been approved. Show order ID to shop staff</p>
		<p><b>Order Declined</b> : Admin rejected due to wrong receipt or didn't receive payment</p>
	</div>
	</div>
	</div>
	</div>
	
	
<?php
	}
if(isset($_POST["upload"])){
	$id = $_POST["id"];
	//$receipt = "Upload/".$_POST["receipt"];
	if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK)
    {
		$fileTmpPath = $_FILES['receipt']['tmp_name'];
        $fileName = $_FILES['receipt']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
		
		// sanitize file-name
        $newFileName = $id  . '_' . $_SESSION['username'] . '.' . $fileExtension ;
 
        // check if file has one of the following extensions
        $allowedfileExtensions = array('jpg', 'PNG', 'png');
		
		if (in_array($fileExtension, $allowedfileExtensions))
        {
            $uploadFileDir = 'Upload/';
            $dest_path = $uploadFileDir . $newFileName;
 
            if(move_uploaded_file($fileTmpPath, $dest_path)) 
            {
				$queryInsert = "UPDATE orders SET
					receipt = '".$newFileName."',
					status = 1
					WHERE id = '$id'";

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
						open("List.php","_top");
						}
						</script>';
				}
			}
			else
				echo '<script type="text/javascript">
						window.onload = function () 
						{ 
						alert("File Uploaded Error...");
						open("List.php","_top");
						}
						</script>';
		}
		else
			echo '<script type="text/javascript">
					window.onload = function () 
					{ 
					alert("File Uploaded Wrong File type Error...");
					open("List.php","_top");
					}
					</script>';
	}
	else
		echo '<script type="text/javascript">
				window.onload = function () 
				{ 
				alert("Error: File not choosed...");
				open("List.php","_top");
				}
				</script>';
}
}		
else	{
	echo "No session exists or session has expired. Please log in again ";
	echo "Page will be redirect in 5 seconds";
	header('Refresh: 5; ../Auth/Login.php');
}
?>
</body>
</html>
