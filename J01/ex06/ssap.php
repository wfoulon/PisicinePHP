#!/usr/bin/php 
<?PHP 

function ft_split($str)
{
    $tab = explode(' ', $str);
    $tab = array_filter($tab);
    sort($tab);
    return ($tab);
}
$tab = array();
foreach($argv as $arg)
{
    if ($arg != $argv[0])
    {
        $new = ft_split($arg);
        $tab = array_merge($tab, $new);
    }
}
sort($tab);
foreach($tab as $elem)
{
    echo $elem."\n";
}



?>
