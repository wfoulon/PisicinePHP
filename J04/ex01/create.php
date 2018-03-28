<?PHP

if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] === 'OK')
{
    $content = unserialize(file_get_contents("../private/passwd"));
    if ($content)
    {
        foreach ($content as $k => $v)
        {
            if ($v['login'] === $_POST['login'])
                exit("ERROR\n");
        }
    }
    $tmp['login'] = $_POST['login'];
    $tmp['passwd'] = hash("whirpool", $_POST['passwd']);
    $account[] = $tmp;
    file_put_contents("../private/passwd", serialize($account));
    echo "OK\n";
}
else
{
    echo "ERROr\n";
}

?>
