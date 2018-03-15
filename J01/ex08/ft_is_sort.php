#!/usr/bin/php 
<?PHP 

function ft_is_sort($array)
{
    $array2 = $array;
    sort($array2);
    if ($array2 == $array)
        return true;
    return false;
}

?>
