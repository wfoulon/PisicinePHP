<?PHP
include 'include/database.php';
queryDB("DELETE FROM cart WHERE id = '".$_GET['cart']."' AND valid = 0 ;");
$quantity = queryDB("SELECT quantity FROM stock WHERE id = '".$_GET['product']."';");
$newstock = $quantity[0]['quantity'] + $_GET['quantity'];
queryDB("UPDATE stock SET quantity = '$newstock' WHERE id = '".$_GET['product']."';");
header("Location: cart.php");

?>
