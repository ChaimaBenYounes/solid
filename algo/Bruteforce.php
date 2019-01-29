<?php

/**
créer un Bruteforce

Tout les mots de passe ont le prefixe "Mast€rKeYPriv@te__" (grain de sel), ils sont hashés en SHA1
Il faut donc créer un Bruteforce recevant en entrée une chaine SHA1 (hashage) où son role est de tester toute
les combinaisons possible jusqu'a trouver la correspondance du hashage
Exemple :

Mast€rKeYPriv@te__test donne b4972e2759214c67f8a390518a1bf909934bbdde

Vous devez grace à votre code trouver les différents mot de passe (ils commencent tous par Mast€rKeYPriv@te__)

: 9e66b0af59d51e51a5ea9cd3132f277cbc642eaa
: 24749492142798c83404cb78f2e58941f8264b31
: 3e810f7223c44b31a9767ddffff5d23fa7ae1e3b
: 434776c39a9cea654090e5e7435cedd0c2911176
: 9f2f6bac189c6744c3f7aacf41a70d986ba35b38
: 690e7743350b9cbdab5516dd55730616afed42d9
: 65d74c2cb35a3dd6c27fbd66a270ba27d91c0410
: 2e179b9a67acb360566409604efaf30669b4718c
: e0fdf181ac4ee847cb312bfd815c0a0759be3a95

 **/



function bruteForce($hash, $currentSize, $prefix = '', $suffix = '', $position = 0, $baseText = '')
{
    $chars = range('a','z');
    $chars = array_merge($chars, range('A','Z'));
    $chars = array_merge($chars,range(0,9));
    $chars = array_merge($chars,['&','é','è','ë','ê','ï','î','ö','ô','#','{','(','-','[','|','_','!',';','?','%','*','=','+','@','°',']','}',')']);

    foreach($chars as $char)
    {
        if ($position < $currentSize-1) {
            bruteForce($hash, $currentSize, $prefix, $suffix, $position+1, $baseText.$char);
        }

        if(SHA1($prefix.$baseText.$char.$suffix) == $hash) {
            exit('Le mot de passe est : '.$prefix.$baseText.$char.$suffix);
        }
    }
}

for($size = 1; $size <= 4; $size++) {
    bruteForce('8252bf8992ff56621589ea3a3c32658172b1651a', $size, 'Mast€rKeYPriv@te__');
}