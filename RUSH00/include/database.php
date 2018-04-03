<?php
function initDB()
{
    global $db;
    if (!empty($db))
        return $db;
    $config['database']['host'] = "localhost";
    $config['database']['user'] = "root";
    $config['database']['password'] = "root42";
    $config['database']['database'] = "rush00";
    if (!file_exists("settings/created")) {
        $db = "rush00";
        $conn = mysqli_connect($config['database']['host'], $config['database']['user'], $config['database']['password']);
        if (!$conn)
            exit("Connection failed: ". mysqli_connect_error());
        $sql = "CREATE DATABASE $db";
        if (!mysqli_query($conn, $sql))
            echo "Error creating database: ".mysqli_error($conn);
        mysqli_close($conn);
    }
    $db = @mysqli_connect($config['database']['host'], $config['database']['user'], $config['database']['password'], $config['database']['database']);
    // Check if failed
    if (mysqli_connect_errno()) {
        printf("Échec de la connexion à la base de données : %s\n", mysqli_connect_error());
        exit();
    }
    mysqli_set_charset($db, "utf8");
}

function refValues($arr){
    $refs = array();
    foreach($arr as $key => $value)
        $refs[$key] = &$arr[$key];
    return $refs;
}

function queryDB($queryString, array $params = [], $close = false)
{
    global $db;
    initDB();
    // Prepare
    if (!($query = mysqli_prepare($db, $queryString)))
        exit('MYSQL ERROR CODE: ' . mysqli_errno($db));
    if (!empty($params)) {
        $params = array_merge([$query], $params);
        call_user_func_array('mysqli_stmt_bind_param', refValues($params));
    }
    // Execute and get result
    if (!mysqli_stmt_execute($query))
        exit('MYSQL ERROR CODE: ' . mysqli_errno($db));
    $result = mysqli_stmt_get_result($query);
    $results = [];
    if ($result)
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$results[] = $row;
		}
    // Close
    mysqli_stmt_close($query);
    if ($close)
        closeDB();
    return $results;
}

function add_user($username, $password) {
    date_default_timezone_set("Europe/Paris");
    $date = date('Y-m-j H:i:s');
    queryDB("INSERT INTO users (name, created_at, Passwd, admin) VALUES (?, '$date', '$password', '0');", ['s', $username]);
}

function setPwd($username, $newpw) {
    $result = queryDB("UPDATE users SET Passwd = '$newpw' WHERE name = ?;", ['s', $username]);
}

function getUser($username, $password) {
    if ($password)
        $result = queryDB("SELECT * FROM users WHERE name = ? AND Passwd = '$password' LIMIT 1;", ['s', $username]);
    else
		$result = queryDB("SELECT * FROM users WHERE name = ? LIMIT 1;", ['s', $username]);
    if (!$result)
		return false;
	else
	    return true;
}

?>
