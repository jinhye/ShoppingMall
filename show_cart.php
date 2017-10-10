<?php
	require_once("./header.php");
	
	session_start(); 

	include('./connect_db.php');

	//db connect
	$conn = new mysqli($host_name, $db_user, $db_pw, $db_name);
	if($conn->connect_error){
		die('Connection failed: '. $conn->connect_error);
	}

	//if has product - when Add to Cart clicked
	if(isset($_GET['new'])){
		$new = $_GET['new'];
		if($new){
			if(!isset($_SESSION['cart'])){
				//register session variable if not
				$_SESSION['cart'] = array();
				//the number of products
				$_SESSION['items'] = 0;
				//total price
				$_SESSION['total_price'] = 0;
			}

			//same product added
			if(isset($_SESSION['cart'][$new])){
				$_SESSION['cart'][$new]++;
			//new product added
			}else{
				$_SESSION['cart'][$new] = 1;
			}

			//the number of products
			if(is_array($_SESSION['cart'])){
				//initiate session and register new value
				$_SESSION['items'] = 0;
				foreach($_SESSION['cart'] as $isbn => $qty){
					$_SESSION['items'] += $qty;
				}
			}

			//Sum of Total price
			if(is_array($_SESSION['cart'])){
				$_SESSION['total_price'] =0;
				foreach($_SESSION['cart'] as $isbn => $qty){
					$sql = "select price from books where isbn='".$isbn."'";
					$result = $conn->query($sql);
					if($result){
						$item = $result->fetch_object();
						$item_price = $item -> price;
						$_SESSION['total_price'] += $item_price*$qty;
					}
				}
			}
		}
	}


	//Cart Title
	echo "<h3>Your Cart Status</h3>";

	//session_unset();

	//When Go to Cart clicked
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		echo "<table border='0' width='80%' align='center'>"
			."<tr bgcolor='#f1c40f'><th>Product</th>"
				."<th>Title</th>"
				."<th>Price</th>"
				."<th>Quantity</th>"
				."<th>Amount</th>"
				."<th>Modify</th>"
			."</tr>";
		foreach($_SESSION['cart'] as $isbn => $qty){
			if((!$isbn) || ($isbn == "")){
			?>

				<script>
					alert("You are on the incorrect root");
					history.back();
				</script>

			<?php
				exit;
			}

			

			$sql = "select * from books where isbn ='".$isbn."'";
			$result = $conn->query($sql);

			if($result){
				$row=$result->fetch_array();
			}
		?>
			<tr align="center">
				<td><img src='<?php echo $row["img"]; ?>' style='border:1px; solid black' width='60px' height='80px'/></td>
				<td><?php echo $row["title"]; ?></td>
				<td>$<?php echo $row["price"]; ?></td>
				<td id="m"><input type="text" name="<?php echo $row['isbn']; ?>" value="<?php echo $qty; ?>" size="2" ></td>
				<td><?php echo '$'.$row["price"]*$qty; ?></td>
				
				<td><button onclick="update()">Update</button>&nbsp;<button onclick="delete()">Delete</button></td>
			</tr>
		

		<?php
		}//End of Foreach

		?>

			<tr>
				<th></th>
				<th></th>
				<th bgcolor="#f1c40f" align="center">Total: &nbsp;&nbsp;</th>
				<th bgcolor="#f1c40f" align="center">&nbsp;<?php echo $_SESSION['items']; ?></th>
				<th bgcolor="#f1c40f" align="center">&nbsp;$<?php echo $_SESSION['total_price']; ?></th>
			</tr>

		<?php

		echo "</table>";
	
	}else{
		echo"<p>Nothing in Cart</p>";
	}
	
?>

	<table border="0" align="center">
		<tr>
			<td><input type="button" style="background-color:yellow" value="Continue to Order" onclick="location.href='./index.php'"><td>
			<td><input type="button" style="background-color:red" value="Place to Order" onclick="location.href='./checkout.php?number=<?php echo $_SESSION["items"]; ?>&total=<?php echo $_SESSION["total_price"]; ?>'"></td>
			<td><input type="button" style="background-color:purple" value="All Reset" onclick="reset();"></td>
		</tr>
	</table>
<?php
	require_once("./footer.php");
?>

<script>
	//modify quantity---------------------------------------------------
	function delete(){
		document.getElementById("m").value=0;
	}

	function update(){
		document.getElementById("m").value=document.getElementById("m");
	}
</script>


