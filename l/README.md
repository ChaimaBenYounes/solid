# Le code doit être S.O.L.I.D

## Liskov Substitute Principle (LSP)

Le principe de _substitution de liskov_ dit que **le type d'une classe enfant doit en permanence pouvoir remplacer le 
type de sa classe parent**, sans que le programme perde en cohérence de fonctionnement.

Concrètement cela signifie qu'il ne faut pas qu'une classe enfant change totalement de comportement par rapport à sa 
classe parent.

Le code manipulant des objets de la classe parent pourra alors également manipuler des objets de la classe enfant, sans 
modification. 

## Présentation

Le fichier `original.php` contient un ensemble de classes représentant plus ou moins des oiseaux...

_Il faut l'analyser avant de lire l'énoncé._

## Énoncé

Plusieurs problèmes sont identifiés :
- Dans le code client certains oiseaux jettent des exceptions, ce n'est pas normal !
- Le canard de bain ne peut pas réellement reproduire le son naturel d'un canard !

Le chef de projet vous demande par ailleurs de gérer également des pingouins (_Auk_ en anglais) qui sont des oiseaux 
incapables de voler.

L'implémentation actuelle est clairement fragile et ne résiste pas à l'ajout de nouvelles fonctionnalités...

Une séance de **refactoring** paraît indispensable !