<?php
include "include/database.php";
if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] === "OK") {
			if (getUser($_POST['login'], hash("whirlpool", $_POST['oldpw']))) {
				$login = $_POST['login'];
				$pwd = hash("whirlpool", $_POST['newpw']);
				setPwd($login, $pwd);
				echo "OK\n";
				header("Location: index.php");
			}
	else
		echo "ERROR\n";
}
?>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Création</title>
	<style>
		body {
			background: linear-gradient(to right, rgb(16, 133, 223), rgb(128, 113, 0));
			padding-top: 200px;
		}
	
		.center {
			background-color: rgb(100, 100, 100);
			padding-top: 15px;
			padding-bottom: 15px;
			margin: auto;
			width: 50%;
			border: 3px solid black;
			text-align: center;
			-webkit-box-shadow: 9px 10px 33px 3px rgba(48, 51, 39, 1);
			-moz-box-shadow: 9px 10px 33px 3px rgba(48, 51, 39, 1);
			box-shadow: 9px 10px 33px 3px rgba(48, 51, 39, 1);
		}
	
		h1 {
			color: rgb(0, 204, 0);
		}
	
		input {
			margin-top: 10px;
			width: 50%;
		}
	
		a {
			decoration: none;
		}
	
		.button {
			width: 25%;
		}
	
		.button:hover {
			background-color: rgba(125, 189, 147, 1);
		}
	
		a:visited {
			color: rgb(0, 204, 102);
		}
	
		a:link {
			color: rgb(0, 204, 102);
		}
	
		a:hover {
			color: red;
		}
	
		input:focus {
			background-color: rgb(215, 215, 215);
			border: 3px solid #555;
		}
	</style>
</head>
<body>
	<div class="center">
	<h1>Password modif</h1>
	<form action="modif.php" method="POST">
		<input type="text" name="login" placeholder="Identifiant"/>
		<br />
		<input type="password" name="oldpw" placeholder="<?php if ($_SESSION['logued_on_user']){ echo $_SESSION['logued_on_user'];} else {echo "Mot de passe actuel";}?>" />
		<br /><input type="password" name="newpw" placeholder="Nouveau mot de passe" />
		<br />
		<input class="button" type="submit" name="submit" value="OK"/>
	</form>
	<hr />
	<a href="index.php">Back</a>
	</div>
</body>
</html>
