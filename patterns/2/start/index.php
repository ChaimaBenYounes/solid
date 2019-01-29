<!--
uml : https://drive.google.com/file/d/1EaqdgbkHABLo9vHh0xVjRqJM1o6Ammfc/view
COURS : https://www.grafikart.fr/tutoriels/pattern-decorator-786
        https://phpenthusiast.com/blog/the-decorator-design-pattern-in-php-explained
-->
<meta charset="utf8">
<?php

include 'IMeal.php';

include 'Sweet.php';

include 'Pancake.php';
include 'Waffle.php';

include 'Topping.php';

include 'ChocolateTopping.php';
include 'FudgeTopping.php';
include 'WhippedCreamTopping.php';

$pancake = new Pancake();
echo "<h3>Je suis ".$pancake->getDescription()."</h3><em>Coût : ".$pancake->getPrice()." €</em>";

$pancake = new WhippedCreamTopping($pancake);
echo "<h3>Je suis ".$pancake->getDescription()."</h3><em>Coût : ".$pancake->getPrice()." €</em>";

$pancake = new FudgeTopping($pancake);
echo "<h3>Je suis ".$pancake->getDescription()."</h3><em>Coût : ".$pancake->getPrice()." €</em>";


$waffle = new Waffle();
echo "<h3>Je suis ".$waffle->getDescription()."</h3><em>Coût : ".$waffle->getPrice()." €</em>";

$waffle = new WhippedCreamTopping($waffle);
echo "<h3>Je suis ".$waffle->getDescription()."</h3><em>Coût : ".$waffle->getPrice()." €</em>";

$waffle = new ChocolateTopping($waffle);
echo "<h3>Je suis ".$waffle->getDescription()."</h3><em>Coût : ".$waffle->getPrice()." €</em>";
