<?php
//date_default_timezone_set('Europe/Paris');
Include "include/header.php";
session_start();
if (!file_exists("settings/created") || strpos(file_get_contents("settings/created"), '1') === false) {
	header('Location: install.php');
	exit();
}
function addToCart($name, $num) {
	$res = queryDB("SELECT * FROM stock WHERE name = '$name';");
	if ($res[0]['quantity'] >= $num) {
		$id = $res[0]['id'];
		$price = $res[0]['price'];
		if ($_SESSION['logged_on_user']) {
			if ($res) {
				$nameu = $_SESSION['logged_on_user'];
				$login = queryDB("SELECT id FROM users WHERE name = '$nameu';");
				$uid = $login[0]['id'];
				$cart = queryDB("SELECT id, quantity FROM cart WHERE item_id ='".$res[0]['id']."' AND user='$uid'
					AND valid = 0 ;");
				if ($cart[0]['id'])
				{
					$newquantity = $cart[0]['quantity']+$num;
					queryDB("UPDATE cart SET quantity = '$newquantity' WHERE id = '".$cart[0]['id']."' AND valid = 0 ;");
				}
				else
					queryDB("INSERT INTO cart (item_id, quantity, user, price, valid) VALUES ('$id', '$num', '$uid', '$price', 0);");
				$newstock = $res[0]['quantity'] - $num;
				queryDB("UPDATE stock SET quantity = '$newstock' WHERE id = '$id';");
			}
		}
		else {
			if ($_COOKIE['cart']) {
				$tmp = explode(';',$_COOKIE['cart']);
				$i = 0;
				$found = 0;
				foreach($tmp as $e)
				{
					if ($i % 3 == 0)
					{
						if ($e == $id)
							$tmp[$i + 2] += $num;
						$found = 1;
						break;
					}
					$i++;
				}
				if ($found == 1)
				{
					$tab = implode(';', $tmp);
				}
				else
					$tab = $_COOKIE['cart'].";".$id.";".$price.";".$num;
			}
			else
				$tab = $id.";".$price.";".$num;
			setcookie('cart', $tab);
		}
	}
	else {
		echo "Not enough product in stock\n";
	}
}
?>
