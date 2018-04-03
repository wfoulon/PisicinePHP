<?php
include "function.php";

function auth($login, $passwd) {
	$res = getUser($login, hash("whirlpool", $passwd));
	if (getUser($login, hash("whirlpool", $passwd)) === FALSE)
		return false;
	else
		return true;
}

$login = $_POST['login'];
$passwd = $_POST['passwd'];
session_start();
if (!($login && $passwd && auth($login, $passwd))) {
	$_SESSION['logged_on_user'] = NULL;
	header('Location: index.php');
	echo "ERROR\n";
}
else {
	$res = queryDB("SELECT admin FROM users WHERE name = ?;", ['s', $login]);
	$_SESSION['is_admin'] = $res[0]['admin'];
	$_SESSION['logged_on_user'] = $login;;
	$cart = explode(';', $_COOKIE["cart"]);
	$i = 0;
	foreach ($cart as $e)
	{
		if (!$e)
			break;
		$name = queryDB("SELECT name from stock WHERE id = $e ;");
		if ($i % 3 == 0)
		{
			addToCart($name[0]['name'], $cart[$i + 2]);
		}
		$i++;
	}
	setcookie('cart', "");
	header('Location: index.php');
}
?>
