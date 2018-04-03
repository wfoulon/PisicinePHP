<?php
Include "include/header.php";
Include "include/database.php";
session_start();
if ($_SESSION['logged_on_user']) {
    $username = $_SESSION['logged_on_user'];
    queryDB("DELETE FROM users WHERE name = '$username'");
    $_SESSION['logged_on_user'] = NULL;
}
?>
<meta http-equiv="refresh" content="3; url=index.php">
		<div class="hr"></div>
		<div id="milieu">
			Compte supprimé<br />
		</div>
        <div class="hr"></div>
</body>
</html>
