<?php
    include "include/database.php";
    date_default_timezone_set('Europe/Paris');
    if (file_exists("settings/created") && strpos(file_get_contents("settings/created"), '1') !== false) {
        header('Location: index.php');
        exit();
    }
    if (!file_exists("settings/created"))
    {
        // Install database
        mkdir("settings");
        session_destroy();
        session_start();
        $_SESSION = array();
        $_COOKIE = NULL;
        $_POST = NULL;
        $_GET = NULL;
        $_SERVER = NULL;
        initDB();
        if (!mysqli_multi_query($db, file_get_contents("rush00.sql")))
            exit("Impossible d'installer la base de donneés, avez-vous bien configuré le fichier config/app.php ? (CODE: " . mysqli_errno($db) . ")");
        file_put_contents("settings/created", '0');
    }
    if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] === "OK") {
        $login = $_POST['login'];
        $pwd = hash("whirlpool", $_POST['passwd']);
        if (getUser($login, NULL) === true)
            exit("ERROR\n");
        echo "OK\n";
        $date = date('Y-m-j H:i:s');
        queryDB("INSERT INTO users (name, created_at, Passwd, admin) VALUES (?, '$date', '$pwd', '1');", ['s', $login]);
        file_put_contents("settings/created", '1');
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Installation</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        div.input-group {
            display: block;
            margin: 5px;
        }
        input {
            display: inline-block;
            width: 20%;
            height: 20px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input:focus {
            outline: 0;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        button {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border-radius: 4px;
            color: #333;
            background-color: #fff;
            border: 1px solid #ccc;
        }
        button:focus {
            outline: 0;
        }
        div.alert {
            padding: 10px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            width: 20%;
            margin-left: auto;
            margin-right: auto;
        }
        div.alert.alert-error {
            background-color: #e74c3c;
            color: #5c060b;
            border: solid #c0392b 1px;
        }
    </style>
</head>
<body>
<h1>Création du compte administrateur</h1>
<form action="" method="post">

    <div class="input-group">
        <label for="name">Nom :</label>
        <input type="text" name="login" placeholder="Identifiant" autofocus />
    </div>

    <div class="input-group">
        <label for="password">Mot de passe :</label>
        <input type="password" name="passwd" placeholder="Mot de passe" />
    </div>
   <input class="button" type="submit" name="submit" value="OK" />
</form>
</body>
</html>
