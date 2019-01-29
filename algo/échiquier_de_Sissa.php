<?php
/**
 * https://www.math93.com/index.php/112-actualites-mathematiques/304-le-probleme-de-l-echiquier-de-sissa
 */

echo "<h2>Le problème de l’échiquier de Sissa</h2>";
/*
$case = 64;
$centime = 0.1;

for($i=1; $i<=$case; $i++){
    echo $i."_case : ". $centime ."</br>";
    $centime*=2;
}
*/
//Correction

for($i=1;$i<=64;$i++) echo $i.': '.number_format($v=(empty($v)?1:$v*2))."\n";
