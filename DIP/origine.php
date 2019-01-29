<?php
/*
Dependency Inversion Principle (DIP)

Le principe d'inversion des dépendances est un peu un principe secondaire. En effet,
il résulte d'une application stricte de deux autres principes, à savoir les principes OCP et LSP.
Sa définition est la suivante:
Les modules de haut niveau ne doivent pas dépendre des modules de bas niveau.
Les deux doivent dépendre d'abstractions.
Les abstractions ne doivent pas dépendre des détails.
Les détails doivent dépendre des abstractions.
Par module de haut niveau, on va entendre les modules contenant les fonctionnalités métier,
les modules de bas niveau gérant la communication entre machines, les logs, la persistance.
Si on change le mode de fonctionnement de la base (passage de Oracle à SQL Server),
du réseau (changement de protocole), de système d'exploitation, les classes métiers ne doivent pas être impactées.
Inversement, le fait de changer les règles de validation au niveau de la partie métier
du framework ne doit pas demander une modification
de la base de données (à la limite, modifier une fonction, mais ne pas changer les briques de base).
Ce principe apporte:
Une nette diminution du couplage
Une meilleure encapsulation, l'implémentation concrète pouvant éventuellement être choisie dynamiquement

// Besoin : pouvoir vendre des magazines
// Besoin : nouveau type de client = les clients VIPs
// Besoin : les clients VIP devront payer en 5x
// Besoin : les clients business pourront autant payer en 3x que payer par virement SEPA
// Rappels :
// - Loi de Demeter : Il vaut mieux qu'une classe en connaisse le moins possible sur les autres et au pire uniquement celles de son "entourage"
// - Tell, don't ask : Il vaut mieux dire que demander, une méthode qui appelle plein de "getters" d'une autre classe devrait se trouver dans cette classe
// https://www.dotnetdojo.com/loi-de-demeter/
// https://martinfowler.com/bliki/TellDontAsk.html
// https://rnowif.github.io/blog/2015/07/28/tell-dont-ask/
/*
Classes de moyens de paiement :
- Virement SEPA : BankTransferPayment
- Paiement carte bleue : CreditCardPayment
- Paiement en 3x : ThreeMonthsInstalmentPayment
- Paiement en 5x : FiveMonthsInstalmentPayment
Classes de clients :
- Particulier : PersonalCustomer
- Business : BusinessCustomer
- VIP : VipCustomer

*/
class Book
{
    private $isbn;
    public function __construct($isbn)
    {
        $this->isbn = $isbn;
    }
}
class Order
{
    private $basket;
    public function __construct()
    {
        $this->basket = [];
    }
    public function addProduct(Book $product)
    {
        // Ajout du produit spécifié au panier.
        array_push($this->basket, $product);
    }
    public function getTotalAmount()
    {
        if(empty($this->basket) == true)
        {
            return 0;
        }
        else
        {
            // (...) Code calculant le montant total HT du panier.
            return 125.85; // exemple de résultat
        }
    }
    public function removeProduct(Book $product)
    {
        // Recherche le produit spécifié dans le panier.
        $index = array_search($product, $this->basket);
        if($index !== false)
        {
            // Suppression du produit spécifié du panier.
            array_splice($this->basket, $index, 1);
            return true;
        }
        return false;
    }
}
class OrderProcessor
{
    public function checkout(Customer $customer)
    {
        $totalAmount = $customer->getOrder()->getTotalAmount();
        if($customer->isBusiness() == false)
        {
            echo '<h2>Paiement du client particulier</h2>';
            // (...) Code spécifique de paiement par carte bleue pour les clients particuliers.
        }
        else
        {
            echo '<h2>Paiement du client business</h2>';
            // (...) Code spécifique de paiement en 3x pour les clients business.
        }
    }
}
class Customer
{
    private $currentOrder;
    private $isBusiness;
    public function __construct($type)
    {
        if($type == 'personal')
        {
            echo '<h2>Je suis un client particulier</h2>';
            $this->isBusiness = false;
        }
        else if($type == 'business')
        {
            echo '<h2>Je suis un client business</h2>';
            $this->isBusiness = true;
        }
        // Au départ le panier est vide.
        $this->currentOrder = null;
    }
    public function addProduct(Book $product)
    {
        // Est-ce que le panier est vide ?
        if($this->currentOrder == null)
        {
            $this->currentOrder = new Order();
        }
        $this->getOrder()->addProduct($product);
    }
    public function buy(OrderProcessor $orderProcessor)
    {
        // Est-ce que le panier est vide ?
        if($this->currentOrder == null)
        {
            // Oui, donc aucun achat à faire.
            return false;
        }
        // Procède au paiement de la commande.
        $orderProcessor->checkout($this);
        return true;
    }
    public function getOrder()
    {
        // Est-ce que le panier est vide ?
        if($this->currentOrder == null)
        {
            $this->currentOrder = new Order();
        }
        return $this->currentOrder;
    }
    public function isBusiness()
    {
        return $this->isBusiness;
    }
    public function removeProduct(Book $product)
    {
        // Est-ce que le panier est vide ?
        if($this->currentOrder == null)
        {
            throw new Exception("On ne peut pas retirer un produit d'un panier vide !");
        }
        $this->getOrder()->removeProduct($product);
    }
}
// (...) CODE CLIENT
$customer1 = new Customer('business');
$customer1->addProduct(new Book('123456'));
$customer1->addProduct(new Book('112233'));
$customer1->buy(new OrderProcessor());
$customer2 = new Customer('personal');
$customer2->addProduct(new Book('522341'));
$customer2->buy(new OrderProcessor());
