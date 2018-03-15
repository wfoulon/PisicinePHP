#!/usr/bin/php 
<?PHP 

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

if ($argc != 2)
    echo "Incorrect Parameters\n";
else
{
    $tab = sscanf($argv[1], "%d %c %d %s");
    if ($tab[0] && $tab[1] && $tab[2] && !$tab[3])
    {
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
        else
            echo "Syntax Error\n";
    }
    else
        echo "Syntax Error\n";
}

?>
