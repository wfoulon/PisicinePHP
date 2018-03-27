#!/usr/bin/php
<?PHP 

$handle = fopen("php://stdin", 'r');
while ($handle && !feof($handle))
{
    echo "Entrez un nombre: ";
    $number = fgets($handle);
    if ($number)
    {
        $number = str_replace("\n", "", "$number");
        if (is_numeric($number))
        {
            if ($number % 2 == 0)
                echo "Le chiffre " .$number. " est Pair\n";
            else if ($number % 2 != 0)
                echo "Le chiffre " .$number . " est Impair\n";
        }
        else
                echo " '$number'  n'est pas un chiffre\n";
    }
}
fclose($handle);
echo"\n";
?>
