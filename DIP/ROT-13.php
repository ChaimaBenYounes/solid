<?php
/**
 * Created by PhpStorm.
 * User: wap58
 * Date: 19/12/18
 * Time: 16:17
 */

/*
 * rot13 / CÉSAR
 * ROT18
 * ROT47
 * TABLE ascii 128 caractères
 */
function rot($rot, $chaine){
    $alpha_array = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k' , 'l', 'm',
                    'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
                     ' ', '0', '1', '2', '3', '4', '5', '6', '7','8', '9'];

    $chaine = strtolower($chaine); // renvoie une chaine en minuscules
    $alpha_array_2 = array_slice($alpha_array, $rot); // Extrait une portion de tableau
    $array_chaine =  str_split ($chaine , 1 ); // MAJ
    $key_chaine_array = [];

    /*if(!$rot){

    }*/

   foreach ($array_chaine as $char ){

       $key_chaine_array [] += array_search($char, $alpha_array);
    }

   foreach ($key_chaine_array as $val){

       foreach ($alpha_array_2 as $key=>$value){

           if($val == $key){
               echo $value;
           }

       }

   }
    var_dump($key_chaine_array,$alpha_array, $alpha_array_2, $array_chaine);


}
rot(13, 'ABCD'); // 320

// Correction code ASCII

function rot_correction($nb, $message, $decrypt = false) {

    $sText = '';
    $letters = str_split($message);
    foreach($letters as $letter) {
        $current = ord($letter);
        if($decrypt)
            $sText .= ($current == 32 ?  ' ' : chr((($current-(12+$nb))%26)+97)  );
        else
            $sText .= ($current == 32 ?  ' ' : chr((($current+$nb)%26)+97)  );
    }
    return $sText;
}
/*
echo rot_correction(15, 'hello world');
echo "\n";
echo rot_correction(15, 'pmttw ewztl', true);
echo "\n";
echo rot_correction(14, 'olssv dvysk', true);
echo "\n";
echo rot_correction(13, 'nkrru cuxrj', true);
*/