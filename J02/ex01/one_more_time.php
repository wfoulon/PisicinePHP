#!/usr/bin/php
<?PHP 

if ($argc < 2)
    exit();
date_default_timezone_set("Europe/Paris");
$preg = preg_match('/^([Ll]undi|[Mm]ardi|[Mm]ercredi|[jJ]eudi|[vV]endredi|[sS]amedi|[dD]imanche) ([0-9]|1[0-9]|2[0-9]|3[0-1]) ([jJ]anvier|[fF]evrier|[mM]ars|[aA]vril|[mM]ai|[jJ]uin|[jJ]uillet|[aA]out|[sS]eptembre|[oO]ctobre|[nN]ovembre|[dD]ecembre) ([0-9]{4}) (([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))$/', $argv[1], $matches);
if (!$preg)
    exit("Wrong Format\n");
$months = ['janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre'];
$months = ($months = array_search(strtolower($matches[3]), $months)) !== FALSE ? $months + 1 : false;
if (!$months)
    exit("Wrong Format\n");
$time = $matches[4] . '-' . $months . '-' . $matches[2] . ' ' . $matches[5];
$time = strtotime($time);
if (!$time)
    echo "wrong Format\n";
else
    echo "$time\n";

?>
