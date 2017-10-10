<?php 
	include('./connect_db.php');
	// $host_name = "localhost:3306";
	// $db_user = "root";
	// $db_pw = "123456";
	// $db_name = "shop";

	//db connect
	$conn = new mysqli($host_name, $db_user, $db_pw, $db_name);
	if($conn->connect_error){
		die('Connection failed: '. $conn->connect_error);
	}
	
	$sql = "select * from categories";
	$result = $conn->query($sql);

	require_once("./header.php");
?>



	<h3>Welcom to Book Shopping Mall</h3>

	<p>Select a category</p>
	
	<ul>
	<?php

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
	?>
			<li><a href=show_category.php?cateId=<?php echo $row['cateId']?>&cateName=<?php echo $row['cateName']?>><?php echo $row["cateName"] ?></a></li>
	<?php
		}
	}else{
		echo "0 results";
	}
	?>
	</ul>
	

<?php
require_once("./footer.php");
?>