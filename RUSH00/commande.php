<?PHP
include "include/header.php";
$cart = queryDB("SELECT * FROM cart WHERE valid = 1");
echo "<center>";
$tmpuser = 0;
foreach ($cart as $e)
{
	$user = queryDB("SELECT name from users WHERE id = '".$e['user']."';");
	if ($tmpuser === 0)
		$tmpuser = $user;
	else if ($tmpuser != $user){
		echo "<hr />";
		$tmpuser = $user;
	}
	$produit = queryDB("SELECT name FROM stock WHERE id ='".$e['item_id']."';");
	echo "Command :";
	echo " product : ".$produit[0]['name'];
	echo " quantity : ".$e['quantity'];
	echo " user : ".$user[0]['name']."</br>";
}
?>
