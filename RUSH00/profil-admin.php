<?php
session_start();
include "include/header.php";

if ($_POST['article-name']) {
    $name = $_POST['article-name'];
    $qt = $_POST['article-qt'];
    $lnk = $_POST['article-link'];
    $price = preg_replace('/[^0-9]/', "", $_POST['Price']);
    $ete = 0;
    $hiver = 0;
    $hipster = 0;
    $new = 0;
    if ($_POST['cat'] == "Été")
        $ete = 1;
    if ($_POST['cat'] == "Hiver")
        $hiver = 1;
    if ($_POST['cat'] == "Hipster")
        $hipster = 1;
    if ($_POST['cat'] == "Nouveauté")
        $new = 1;
    $res = queryDB("SELECT * FROM stock WHERE name = '$name';");
    if (!$res) {
        queryDB("INSERT INTO stock VALUES (NULL, '$name', '$qt', '$lnk', '$ete', '$hiver', '$hipster', '$new', '$price');");
    }
    else {?>
        <meta http-equiv="refresh" content="3; url=profil-admin.php">
        <div class="hr"></div>
        <div id="milieu">
            Cet item existe déjà<br />
        </div>
        <div class="hr"></div>
    <?php }
    $_POST = NULL;
}
else if ($_POST['item']) {
    $name = $_POST['item'];
    $res = queryDB("SELECT id FROM stock WHERE name = '$name';");
    $id = $res[0]['id'];
    if ($res && $_POST['del']) {
        queryDB("DELETE FROM stock where id = '$id';");
    }
    else if ($res && $_POST['change']) {
        $stock = $_POST['stock'];
        queryDB("UPDATE stock SET quantity = '$stock' WHERE id = '$id';");
    }
    $_POST = NULL;
}
else if ($_POST['useradm']) {
    $useradm = $_POST['useradm'];
    $_SESSION['user_mod'] = $useradm;
    if ($_POST['mod']) {
        if ($_POST['adm'] == 0)
            queryDB("UPDATE users SET admin = 0 WHERE name = '$useradm';");
        else
            queryDB("UPDATE users SET admin = 1 WHERE name = '$useradm';");
    }
    else if ($_POST['del']) {
        queryDB("DELETE FROM users WHERE name = '$useradm';");
    }
}
if ($_SESSION['is_admin'] === 1) { ?>
	<h2><center>Hello Super User <?php echo $_SESSION['logged_on_user'];?></center></h2>
    <br/>
    <h2><center> command history </center></h2>
    <?PHP
        $login = queryDB("SELECT id FROM users WHERE name = '".$_SESSION['logged_on_user']."';");
        $uid = $login[0]['id'];
        $history = queryDB("SELECT * FROM cart WHERE valid = 1 AND user = '$uid';");
        foreach($history as $e)
        {
                $item = queryDB("SELECT name FROM stock WHERE id = '".$e['item_id']."';");
                echo "<center><div class='history'>";
                echo "product : ".$item[0]['name'];
                echo " quantity: ".$e['quantity'];
                echo " price : ".$e['quantity'] * $e['price']."e";
                echo "<br></div></center>";
        }
    ?>
    <hr />
    <center>
    <h2>Administration Utilisateurs</h2>
    <form action="#" method="post">
            <select name="useradm" required>
            <option name="" selected disabled>Select</option>
    <?php
    $res = queryDB("SELECT * FROM users;");
    foreach ($res as $tab) {
        if ($tab['name'] != $_SESSION['logged_on_user'])
            echo "<option name='user' selected>".$tab['name']."</option><br />";
        else
            echo "<option name='user'>".$tab['name']."</option><br />";
        }
    ?>
    <input type="number" style="min-width: 110px" name="adm" min="0" max="1" placeholder="admin:1   user:0"><br />
     <input type="submit" value="Modifier" name="mod">
     <input color: red type="submit" value="Delete", name="del">
    </select>
    </form>
    <hr />
    <h2>Ajouter un article</h2>
    <form action="#" method="post">
        Nom de l'article:<br>
        <input type="text" name="article-name" placeholder="Name" required>
        <br>
        Quantité disponible:<br>
        <input type="number" name="article-qt" placeholder="ex: 100" min="0" required>
         <br>
        lien de l'image:<br>
        <input type="text" name="article-link" placeholder="ex: img/AaBb.jpg" required>
         <br>
        Prix de vente:<br>
         <input type="number" name="Price" placeholder="ex: 5" min="0" required>€
        <br />Categorie:<br />
        <select name="cat" required>
            <option name="" selected disabled>Select</option>
            <option name="cat">Été</option>
            <option name="cat">Hiver</option>
            <option name="cat">Hipster</option>
            <option name="cat">Nouveauté</option>
        </select>
        <br><br>
        <div class="g-recaptcha" data-sitekey="6LeLP1AUAAAAAI2CiGGLnKIKQIsJdEksmjOvdnH3"></div>
        <input type="submit" value="Submit">
    </form>
    <hr />
        <h2>Modifier un article</h2>
        <form action="#" method="post">
            <select name="item" required>
            <option name="" selected disabled>Select</option>
            <?php
                $res = queryDB("SELECT * FROM stock;");
                foreach ($res as $tab) {
                    $name = $tab['name'];
                    echo "<option name='cat'>".$name."</option>";
                }
            ?>
        </select>
        <br>
        <div>Nouvelle quantité</div>
        <input type="number" style="min-width: 110px" name="stock" min="0" placeholder="En stock:"><br />
        <input type="submit" value="Modifier" name="change"/>
        <input type="submit" value="Supprimer" name="del">
        <hr />
        <h3><center>Features Incoming</center></h3>
        <div class="modprof"><a href="modif.php">Change Password</a></div>
        <div class="modprof"><a href="delete.php">Delete Account</a></div>
	</center>
	<hr />
	<a href="commande.php"><center><h2> Commande </h2></center></a>
	</body>
</html>
<?php } ?>
