#!/usr/bin/php 
<?PHP 

if ($argc > 1)
    echo trim(preg_replace("/ +/", ' ', preg_replace('/\t/', ' ', $argv[1])))."\n";

?>