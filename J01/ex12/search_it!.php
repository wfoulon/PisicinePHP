#!/usr/bin/php 
<?PHP 

$tab = array();
foreach($argv as $elem)
{
    if ($elem != $argv[0] && $elem != $argv[1])
    {
        $test = explode(":", $elem);
        $tab[$test[0]] = $test[1];
    }
}
if ($tab[$argv[1]])
    echo $tab[$argv[1]]."\n";

?>
