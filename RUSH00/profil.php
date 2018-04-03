<?php
include "include/header.php";
session_start();
if ($_SESSION['is_admin'] === 1) {
	header('Location: profil-admin.php');
}
else {?>
	<center>
	<h2>Hello <?php echo $_SESSION['logged_on_user'];?></h2>
	<br/>
	<hr />
	<h2> command history </h2>
	<?PHP
		$login = queryDB("SELECT id FROM users WHERE name = '".$_SESSION['logged_on_user']."';");
		$uid = $login[0]['id'];
		$history = queryDB("SELECT * FROM cart WHERE valid = 1 AND user = '$uid';");
		foreach($history as $e)
		{
				$item = queryDB("SELECT name FROM stock WHERE id = '".$e['item_id']."';");
				echo "<div class='history'>";
				echo "product : ".$item[0]['name'];
				echo " quantity: ".$e['quantity'];
				echo " price : ".$e['quantity'] * $e['price']."e";
				echo "<br></div>";
		}
	?>
	<hr />
	<h3>Features Incoming</h3>
	<div class="modprof"><a href="modif.php">Change Password</a></div>
	<div class="modprof"><a href="delete.php">Delete Account</a></div>
	
</center>
</body>
</html>
<?php } ?>
