<?php
Include 'include/database.php';
session_start();
$_COOKIE['cart'] = "";
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] === "OK") {
	if ($_POST['passwd'] !== $_POST['confpasswd']) {
		?>
		<html>
		<head>
			<meta charset="UTF-8" />
			<title>42Joke</title>
			<link rel="stylesheet" href="Style/index.css" />
			<script src='https://www.google.com/recaptcha/api.js'></script>
		</head>
		<body>
		<meta http-equiv="refresh" content="3; url=create.html">
		<div class="hr"></div>
		<div id="milieu">
			Les mots de passes ne sont pas identiques<br />
		</div>
		<div class="hr"></div>
	</body>
	</html>
<?php }
	else {
	$tmp['login'] = $_POST['login'];
	$tmp['passwd'] = hash("whirlpool", $_POST['passwd']);
	if (getUser($tmp['login'], NULL) === true)
		exit("ERROR\n");
	echo "OK\n";
	add_user($tmp['login'], $tmp['passwd']);
	header("Location: index.php");
	}
}
else {
	echo "ERROR\n";
}


?>
