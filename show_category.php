<?php 
	include('./connect_db.php');

	//db connect
	$conn = new mysqli($host_name, $db_user, $db_pw, $db_name);
	if($conn->connect_error){
		die('Connection failed: '. $conn->connect_error);
	}

	$sql = "select * from books where cateId ='".$_GET['cateId']."'";
	$result = $conn->query($sql);

	require_once("./header.php");
?>

	<table border="0" width="100%">
		<tr>
			<td colspan="7"><h3><?php echo $_GET['cateName']; ?></h3></td>
		</tr>
		<tr>
			<th>Item</th>
			<th>ISBN</th>
			<th>Author</th>
			<th>Title</th>		
			<th>Description</th>
			<th>Price</th>
			<th>Order</th>
		</tr>		
	<?php

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
	?>
		<tr align="center">
			
				<td><img onmouseover="bigImg(this)" onmouseout="normalImg(this)" 
					 src="<?php echo $row["img"]; ?>" width="120px" height="160px" />
				</td>
				<td><?php echo $row["isbn"]; ?></td>
				<td><?php echo $row["author"]; ?></td>
				<td><?php echo $row["title"]; ?></td>				
				<td><?php echo $row["description"]; ?></td>
				<td><?php echo "$ ".$row["price"]; ?></td>
				<td><a href='./show_cart.php?new=<?php echo $row["isbn"] ?>'><input type="button" value="Add to Cart"></a></td>
				
			
		</tr>
	<?php
		}
	}
	?>
	</table>

	<br>
	<div align="center">
		<input type="button" value="Continue to Order" onclick="location.href='./index.php'">
		
	</div>


	<script>
		function bigImg(x){
			x.style.height = "320px";
			x.style.width = "240px";
		}

		function normalImg(x){
			x.style.height = "160px";
			x.style.width = "120px";
		}

		

	</script>

	<?php
		require_once("./footer.php");
	?>
