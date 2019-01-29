<?php

/*
 * return boolean
 */
function my_in_array($needle, array $haystack,bool $strict= false) : bool {

        foreach ( $haystack as $value ) {
            if ($strict == false && $value == $needle || $value === $needle) {
                return true;
            }
        }
        return false;
}

/*

$haystack = [1,5,7,9,6,8];
$needle = "9";
$x = my_in_array($needle, $haystack, true);

var_dump($needle,$haystack, $x);
*/

$tabs = [
    [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17],
    ["1",2,"3",4,"5",6,"7",8,"9",10,"11",12,"13","14",15,"16",17],
    ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17"],
    ['a','b','c', 'd'],
    ['d']
];

$words = [1, '1', 10, '10', '17', 17, 'a' , 'd'];
foreach($words as $word) {

    foreach($tabs as $tab) {
        if(in_array($word,$tab) !== my_in_array($word,$tab) || in_array($word, $tab, true) !== my_in_array($word, $tab, true)) {
            exit('Votre fonction my_in_array ne fonctionne pas comme in_array');
        }
    }
}
echo 'Votre fonction est correcte !';