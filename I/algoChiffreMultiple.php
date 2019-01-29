<?php
/*
 * L'algorithme procède en trois étapes.

   1)  L'algorithme multiplie par deux un chiffre sur deux, en commençant par l'avant dernier
   		et en se déplaçant de droite à gauche. Si un chiffre qui est multiplié par deux est
        plus grand que neuf (comme c'est le cas par exemple pour 8 qui devient 16), alors il
        faut le ramener à un chiffre entre 1 et 9.

        Pour cela, il y a 2 manières de faire (pour un résultat identique) :

       		- Soit les chiffres composant le doublement sont additionnés
            	(pour le chiffre 8: on obtient d'abord 16 en le multipliant par 2 puis
                 7 en sommant les chiffres composant le résultat : 1+6).
        	- Soit on lui soustrait 9 (pour le chiffre 8 : on obtient 16 en le multipliant par 2 puis
            	 7 en soustrayant 9 au résultat).

    2) La somme de tous les chiffres obtenus est effectuée.


    3) Le résultat est divisé par 10. Si le reste de la division est égal à zéro, alors le nombre original est valide.



Exemple : d'un nombre valide avec cet algo : 499273987168
 */
$chiffre = '499273987168';
$array_chiffre =  str_split ($chiffre , 1 );
$array_reverse = array_reverse ( $array_chiffre);

foreach ( $array_reverse as $key => $value ){
    if ($key % 2 == 1){
        if( $value * 2 > 9){
            $value = ($value*2)-9;
        }
        else
        {
            $value = $value*2;
        }
        $array_reverse [$key] = $value;
    }

}
if(array_sum ($array_reverse)%10 == 0){
    echo "Le nombre original est valide";
}
else
    echo "Le nombre original n'est pas valide";

/*$sum = array_sum ($array_reverse);
$resultat = $sum%10;
var_dump($array_reverse, $sum,$resultat );*/

