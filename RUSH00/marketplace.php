<?php
	include "function.php";
    if ($_POST) {
        foreach($_POST as $k => $v){
            if ($k != "cat" && $v > 0)
                addToCart($k, $v);
        }
    }?>
<div id=container>
	<?php
		$value = $_GET['cat'];
		$new = queryDB("SELECT * FROM stock WHERE $value = '1';");
		if ($new) {
			foreach ($new as $tab) {
				$name = $tab['name'];
				$lnk = $tab['img_link'];
				echo "<div class='chaussette2'>";
				echo "<p style='color: white'>".$name."</p>";
				echo "<img class='imageindex' src=".$lnk.">";
				echo "<form action='#' method='post'>";
				echo "<input style='border: 2px solid black' id='number' type='number' name=".$name." value='0' min='0'>";
				echo "<input type='submit' value='add' submit='OK'>";
				$left = queryDB("SELECT quantity FROM stock WHERE name = '$name';");
				$left2 = $left[0]['quantity'];
				echo "<div class='item-left'>".$left2." left</div>";
				echo "<p></p>";
				echo "</form>";
				echo "<center>";
                echo "<div class='infoimg'>";
                echo "$name";
                echo "\n\rprix: ".$tab['price']."€";
                echo "</div>";
                echo "</center>";
				echo "</div>";
			}
		}?>
</body>
</html>
