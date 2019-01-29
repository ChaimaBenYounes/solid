<?php

header('Content-Type: text/html; charset=utf-8');

// Vous recevez 51 cartes (il en manque donc une) trouvez celle manquante !
// les cartes sont nommé comme suit (tous les caractères alpha sont en MAJUSCULE) :
// VALEUR : 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, V, D, R (V= Valet, D = Dame, R = Roi)
// COULEUR : P,C,T,K (P = Pique, C = Coeur, T = Trèfle, K = Carreau)
// Les cartes sont donc nommées : VALEUR+COULEUR
// Exemple = 1P = As de Pique, VK = Valet de Carreau
// le retour doit être du même type (VALEUR+COULEUR)



function laCarteManquante(array $aAllCards) {

    $values = [1,2,3,4,5,6,7,8,9,'V','D','R'];
    $colors = ['P', 'C', 'T', 'K'];


    var_dump($aAllCards);

    foreach ( $values as $value ) {

        foreach ( $colors as $color ) {

           if(!in_array($value.$color, $aAllCards)){

               return $value.$color;
           }
        }
    }


}


function laCarteManquante2(array $aAllCards) {

    $valeurs = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 'V', 'D', 'R'];
    $couleurs = ['P','C','T','K'];
    $completeGame = [];

    foreach($valeurs as $valeur) {
        foreach($couleurs as $couleur) {
            $completeGame[] = $valeur.$couleur;
        }
    }

    $sCardName = current(array_diff($completeGame,$aAllCards));
    return $sCardName;


}


// Pas le droit de toucher à ça :-p
eval(base64_decode('JGExPVtdOyRhMz1leHBsb2RlKCctJywnUCxDLFQsSy0xLDIsMyw0LDUsNiw3LDgsOSwxMCxWLEQsUicpOyRhMj1leHBsb2RlKCcsJywkYTNbMF0pOyRzMj1leHBsb2RlKCcsJywkYTNbMV0pO2ZvcmVhY2goKGFycmF5KSRhMiBhcyAkczEpe2ZvcmVhY2goKGFycmF5KSRzMiBhcyAkczMpeyRhMVtdPSRzMy4kczE7fX11bnNldCgkYTFbcmFuZCgwLGNvdW50KCRhMSktMSldKTtzaHVmZmxlKCRhMSk7aWYoY3RybChsYUNhcnRlTWFucXVhbnRlKCRhMSkpKXtwcmludCBiYXNlNjRfZGVjb2RlKCdWbTkxY3lCaGRtVjZJSExEcVhWemMya2dJU0JDYVdWdUlFcHZkY09wSUNFaElRPT0nKTt9ZWxzZXtwcmludCBiYXNlNjRfZGVjb2RlKCdWbTkxY3lCaGRtVjZJTU9wWTJodmRjT3BJQ0VnUTI5dWRHbHVkV1Y2TGc9PScpO31mdW5jdGlvbiBjdHJsKCRjKXskYj1mYWxzZTtpZihwcmVnX21hdGNoKCcvXigxMHxbMS05VkRSXXsxfSkoW1BDVEtdezF9KSQvaScsJGMsJG8pKXtpZihpbl9hcnJheSgkb1syXSwkR0xPQkFMU1snYTInXSkmJmluX2FycmF5KCRvWzFdLCRHTE9CQUxTWydzMiddKSl7JGI9KCFpbl9hcnJheSgkYywkR0xPQkFMU1snYTEnXSk/dHJ1ZTpmYWxzZSk7fX1yZXR1cm4gJGI7fQ=='));

