<?php
/**
 * Présentation du design pattern Singleton
 *
 * Le Singleton, en programmation orientée objet, répond à la problématique de n'avoir qu'une seule et unique instance
 * d'une même classe dans un programme.
 * Par exemple, dans le cadre d'une application web dynamique, la connexion au serveur de bases de données est unique.
 * Afin de préserver cette unicité, il est judicieux d'avoir recours à un objet qui adopte la forme d'un singleton.
 * Il suffit donc par exemple de créer l'unique objet représentant l'accès à la base de données,
 * et de stocker la référence à cet objet dans une variable globale du programme
 * afin que l'on puisse y accéder de n'importe où dans le script.
 *
 * Structure d'une classe Singleton
 *
 * Concrètement, un singleton est très simple à mettre en place. Il est composé de 3 caractéristiques :
 * Un attribut privé et statique qui conservera l'instance unique de la classe.
 * Un constructeur privé afin d'empêcher la création d'objet depuis l'extérieur de la classe
 * Une méthode statique qui permet soit d'instancier la classe soit de retourner l'unique instance créée.
 */


class Connect
{
    private $pdo;
    private static $instance;
    private $data;

    /**
     * Connect constructor.
     */
    private function __construct($host, $dbname, $user, $password)
    {
        $this->data = 0;
        $this->pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password); // pour que la classe soit instancie une seule fois
    }

    public function addData() {

        $this->data++;
    }

    public function getData() {

        return $this->data;
    }
    /**
     * @return mixed
     */
    public function getPdo()
    {
        //cnx
        return $this->pdo;
    }


    public static function getInstance($dbname = null, $host = 'localhost', $user = 'root', $password = '') {
        if(self::$instance === null) {

            if($dbname === null) throw new Exception('Le nom de la base de données est nécessaire !');

            self::$instance = new Connect($host, $dbname, $user, $password);
        }
        return self::$instance;
    }

}

$o1 = Connect::getInstance('test','localhost','root','troiswa');
$o1->getPdo();
$o1->addData(); // +1
$o2 = Connect::getInstance();
$o2->getPdo();
$o2->addData(); // +1
$o3 = Connect::getInstance('test','localhost','root','troiswa');
$o3->getPdo();
$o3->addData(); // +1

$o2->getData(); // retourne 3