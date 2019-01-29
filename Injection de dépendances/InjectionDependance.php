<?php
/**
 * Design Pattern Injection de dependances

interface ICapsule getCodeBarre();
classes CapsuleCappucino, CapsuleChocolat, CapsuleMilk, etc (différentes capsules)

classe MachineTassimo
attributs :   - $on (si la cafetiere est allumée ou non)
- $reader (le lecteur de code barre)
-	$capsule (la capsule en cours)
methodes : __construct (initialisation de la machine)
onOff		(démarrage électrique de la machine)
start		(démarrage (si possible pour faire une boisson)
addCapsule	(ajout d'une capsule dans la machine)

classe Reader (le lecteur de code barre)

methode : readCodeBarre (la methode de lecture du code barre)
 */

interface ICapsule {
    public function getCodeBarre();
}
class CapsuleChocolat implements ICapsule {
    private $codeBarre = '1508209015'; // eau, vapeur, pression, temperature, capsule courante sur nombre de capsule total
    public function getCodeBarre() {
        return $this->codeBarre;
    }
}
class CapsuleLait implements ICapsule {
    private $codeBarre = '0028209000'; // eau, vapeur, pression, temperature, capsule courante sur nombre de capsule total
    public function getCodeBarre() {
        return $this->codeBarre;
    }
}
class MachineTassimo {

    private $on = false;
    private $reader;
    private $capsule;

    public function __construct() {
        $this->reader = new Reader();
    }

    public function onOff() {
        $this->on = ($this->on ? false : true);
        return $this;
    }

    public function start()
    {
        if(!$this->on) {
            echo 'Allumez la machine !';
        } elseif ($this->capsule instanceof ICapsule) {
            $details = $this->reader->readCodeBarre($this->capsule->getCodeBarre());
            if(count($details) == 5) {
                echo 'En cours de préparation !';
                var_dump($details);
            }
        } else {
            echo 'Vous devez mettre une capsule !';
        }
    }

    public function addCapsule(ICapsule $capsule) {
        $this->capsule = $capsule;
        return $this;
    }
}
class Reader {

    public function readCodeBarre($codeBarre) {
        if(preg_match('/^[0-9]{10}$/', $codeBarre)) {
            return str_split($codeBarre,2);
        } else {
            return false;
        }
    }
}
$cafetiere = new MachineTassimo();
$capsule1 =new CapsuleChocolat();
$capsule2 = new CapsuleLait();
$cafetiere->onOff()->addCapsule($capsule2)->start();


