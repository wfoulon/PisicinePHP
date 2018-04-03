<?PHP
include 'include/database.php';
session_start();

if (!$_SESSION["logged_on_user"])
	header("Location: connexion.html");
else
{
	$login = queryDB("SELECT id FROM users WHERE name = '".$_SESSION['logged_on_user']."';");
	$uid = $login[0]['id'];
	queryDB("UPDATE cart SET valid = '1' WHERE user = '$uid';");
	header("Location: index.php");
}
?>
