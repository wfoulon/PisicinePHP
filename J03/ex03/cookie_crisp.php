<?PHP

$action = $_GET['action'];
$name = $_GET['name'];
$value = $_GET['value'];
if ($name && $action)
{
    if ($action == "set" && $value)
    {
        setcookie($name, $value);
    }
    else if (!$value)
    {
        if ($action == "get" && $_COOKIE[$name])
            echo $_COOKIE[$name]."\n";
        else if ($action = "del")
            setcookie($name, "", time() - 3600);
    }
}
?>
