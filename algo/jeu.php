<?php
/**
 * Created by PhpStorm.
 * User: wap58
 * Date: 20/12/18
 * Time: 16:28
 */

function lancerDes(){
    //GO
    $lancer = [];
    for ($i=0; $i<3; $i++){
        $lancer[] = rand(1,6);
    }
    return $lancer;
}

function valeurCombinaisons(){
    $combinaisons_421 = ['4','2','1'];

    $resultat = [];
    $resultat_lancer = [];
    $lancer_des = lancerDes();
    $resultat [] = $lancer_des;
    foreach ($lancer_des as $des){
        if( in_array($des,$combinaisons_421)){
            $resultat [] = $des;

        }

        $resultat_lancer [] = $lancer_des;


    }

    var_dump($resultat_lancer, $resultat);

}


echo "<h2>___jouer au 421___</h2>";

//valeurCombinaisons();

//var_dump(lancerDes());

// Correction


$aCorrectsDes = [];
$l = 0;
while(count($aCorrectsDes) !=3) {
    $l++;
    $currentCorrects = $aCorrectsDes;
    echo '</br>Lancé '.$l.' -> ';
    for($i = 0; $i <= 3-count($aCorrectsDes); $i++) {
        $current = rand(1,6);

        if(in_array($current, [4,2,1]) && !in_array($current, $aCorrectsDes))
            array_push($aCorrectsDes, $current);

        echo ' '.$current;
    }
    echo (count($currentCorrects)?' - ('.join(',',$currentCorrects).")\n":"\n");
}
echo 'En '.$l.' lancés vous avez fait le 421';