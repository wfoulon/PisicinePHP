#!/usr/bin/php 
<?PHP 
if ($argc == 2)
{
    $tab = explode (' ', $argv[1]);
    $tab = array_filter($tab);
    $line = implode(" ", $tab);
    echo "$line\n"; 
}
?>
