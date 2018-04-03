<?php
if (!file_exists("settings/created") || strpos(file_get_contents("settings/created"), '1') === false) {
    header('Location: install.php');
	exit();
}
include "database.php";
session_start();
?>
<html>
<head>
	<meta charset="UTF-8" />
	<title>42Socks</title>
	<link rel="stylesheet" href="Style/index.css" />
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<?php if ($_GET['cat'] == 'ete') {?><body class="ete">
<?php } else if ($_GET['cat'] == 'hiver') {?><body class="hiverb">
<?php } else if ($_GET['cat'] == 'hipster') {?><body class="hipsterb">
<?php } else if ($_GET['cat'] == 'new') {?><body class="newb">
<?php } else {?><body><?php } ?>
	<header>
		<ul id="navigation">
			<li class="logo"><a href="index.php"><img class="logoimg" src="http://www.dragons-boutique.com/979-thickbox_default/chaussette-de-ville-homme.jpg">42Socks</a></li>
			<li class="menu"><a href="boutique.php">Boutique</a></li>
			<li class="basket"><a href="cart.php"><img src="img/shopping-cart.png"></a></li>
			<?php
			$userid = queryDB("SELECT id FROM users where name = '".$_SESSION['logged_on_user']."';");
			$tmp = queryDB("SELECT id FROM cart where user = '".$userid[0]['id']."' AND valid = 0;");
			$i = 0;
			foreach ($tmp as $v)
			{
				$i++;
			}
			echo $i;
			?>
		</ul>
		<div class="connexion">
			<?php
			if ($_SESSION['logged_on_user'] === NULL)
			{?>
				<a class="co" href="connexion.html">Sign in</a>
				<a class="co" href="create.html">Sign up</a>
			<?php
			}
			else
				{?>
				<ul id ="profil">
	            	<li class="test"><a href="#"><?php echo $_SESSION['logged_on_user'];?></a>
	                <ul class="test2">
	                    <li class="test1"><a href="profil.php">Profil</a></li>
	                    <li class="test1"><a href="logout.php">Log out</a></li>
	                </ul>
	           		</li>
				<?php 
			}?>
		</div>
	</header>
