<?php

require_once("./header.php");

include('./connect_db.php');

	//db connect
	$conn = new mysqli($host_name, $db_user, $db_pw, $db_name);
	if($conn->connect_error){
		die('Connection failed: '. $conn->connect_error);
	}


?>

<h3>Order Information</h3>

<div align="center"><h4>Total Items: <?php echo $_GET['number']; ?></h4></div>
<div align="center"><h4>Total Amount: <?php echo $_GET['total']; ?></h4></div>
<br>
<table border="0" width="40%" cellspacing="0" align="center">
	<form action="#" method="post">
		<tr align="center"><th colspan="2" bgcolor="#ffedcc">Buyer information</th></tr>
		<tr align="center">
			<td>Last Name:</td>
			<td align="left"><input type="text" name="last_name" value="" maxlength="30" size="30" /></td>
		</tr>
		<tr align="center">
			<td>First Name:</td>
			<td align="left"><input type="text" name="first_name" value="" maxlength="30" size="30" /></td>
		</tr>
		<tr align="center">
			<td>Address:</td>
			<td align="left"><input type="text" name="address" value="" maxlength="50" size="50" /></td>
		</tr>
		<tr align="center">
			<td>Postal Code:</td>
			<td align="left"><input type="text" name="postal" value="" maxlength="10" size="10" /></td>
		</tr>
		<tr align="center">
			<td>Phone:</td>
			<td align="left"><input type="text" name="phone" value="" maxlength="20" size="20" /></td>
		</tr>
		<tr align="center">
			<td>Email:</td>
			<td align="left"><input type="text" name="email" value="" maxlength="40" size="40" /></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr align="center"><th colspan="2" bgcolor="#ffedcc">Delivery Information</th></tr>
		<tr align="center">
			<td>Full Name:</td>
			<td align="left"><input type="text" name="first_name" value="" maxlength="30" size="30" /></td>
		</tr>
		<tr align="center">
			<td>Address:</td>
			<td align="left"><input type="text" name="address" value="" maxlength="50" size="50" /></td>
		</tr>
		<tr align="center">
			<td>Contact point:</td>
			<td align="left"><input type="text" name="postal" value="" maxlength="10" size="10" /></td>
		</tr>
	</form>
</table>


<?php
	require_once("./footer.php");
?>