#!/usr/bin/php 
<?PHP 

function ft_split($str)
{
    $tab = explode(' ', $str);
    $tab = array_filter($tab);
    return ($tab);
}

function ft_remove_space($argv)
{
    $tab = array();
    foreach($argv as $e)
    {
        $tab[] = trim($e);
    }
    return ($tab);
}

function ft_add($n1, $n2)
{
    $e = $n1 + $n2;
    echo $e."\n";
}

function ft_sub($n1, $n2)
{
    $e = $n1 - $n2;
    echo $e."\n";
}

function ft_mult($n1, $n2)
{
    $e = $n1 * $n2;
    echo $e."\n";
}

function ft_div($n1, $n2)
{
    $e = $n1 / $n2;
    echo $e."\n";
}

function ft_modul($n1, $n2)
{
    $e = $n1 % $n2;
    echo $e."\n";
}

if ($argc != 4)
    echo "Incorrect Parameters\n";
else
    {
        unset($argv[0]);
        $tab = ft_remove_space($argv);
        if ($tab[1] == "+")
            ft_add($tab[0], $tab[2]);
        else if ($tab[1] == "-")
            ft_sub($tab[0], $tab[2]);
        else if ($tab[1] == "/")
            ft_div($tab[0], $tab[2]);
        else if ($tab[1] == "*")
            ft_mult($tab[0], $tab[2]);
        else if($tab[1] == "%")
            ft_modul($tab[0], $tab[2]);
    }
?>
