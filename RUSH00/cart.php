<?PHP
//include 'include/database.php';
include 'include/header.php';
session_start();
if ($_GET['del'])
{
	$cart = explode(';', $_COOKIE['cart']);
	unset($cart[$_GET['del']-1]);
	unset($cart[$_GET['del']]);
	unset($cart[$_GET['del']+1]);
	$cart = implode(';', $cart);
	setcookie('cart', $cart);
	header("Location: cart.php");
}
if (!$_SESSION["logged_on_user"])
{
	$cart = explode(';',$_COOKIE['cart']);
	$i = 0;
	foreach ($cart as $e)
	{
		if (!$e)
			break;
		if ($i % 3 == 0)
		{
			$j = $cart[$i];
			$item = queryDB("SELECT name FROM stock WHERE id = '$j';");
			$j = $i+1;
			echo "<div>";
			echo "product : ".$item[0]['name'];
			echo " quantity: ".$cart[$i+2];
			echo " price : ".$cart[$i+1] * $cart[$i+2]."e";
			$link = "  <a href='cart.php?del=$j'>";
			echo $link."<img style='width:20px' src='img/cross.jpg'></a><div></br>";
		}
		$i++;
	}
}
else
{
	$user_id = queryDB("SELECT id FROM users WHERE name = '".$_SESSION["logged_on_user"]."';");
	$cart = queryDB("SELECT * FROM cart WHERE user = '".$user_id[0]['id']."'
		AND valid = 0;");
		$total = 0;
		?>
		<center>
			<?php
	foreach ($cart as $e)
	{
			$item = queryDB("SELECT name FROM stock WHERE id = '".$e['item_id']."';");
			echo "<div class='item'>";
			echo "<br /><br />";
			echo "product : ".$item[0]['name'];
			echo " quantity: ".$e['quantity'];
			echo " price : ".$e['quantity'] * $e['price']."e";
			echo "  <a href='delete_cart.php?cart=".$e['id']."&product=".$e['item_id']."&quantity=".$e['quantity']."'>
				<img style='width:20px' src='img/cross.jpg'></a><div></br>";
			$total += $e['quantity'] * $e['price'];
	}
	echo "<br /><br /><br /><br />";
	echo "<div>Total: ".$total."</div>";
	echo "<br /><br /><br /><br />";
}
?>
</br>
	<a style="padding:20px;background-color:green;border:solid 3px black;border-radius:10px;" href="validate.php">
	<strong style="margin-top: 20px">Valider<strong></a>
</center>
</body>
</html>
