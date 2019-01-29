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

http://sharemycode.fr/v2g
UML origine : https://drive.google.com/file/d/1wqdm2PRD2MV3ENp1vMBgZkvOUIlKcGZw/view?usp=sharing
UML corrigé : https://drive.google.com/file/d/1SBWrPz2RVOROUnOf8jCM6p_n7xTni5U5/view?usp=sharing

*/
interface IProduct{
    public function __construct($isbn, $price);
    public function getPrice();
}

class Book implements IProduct
{
    private $isbn;
    private $price;
    public function __construct($isbn, $price)
    {
        $this->isbn = $isbn;
        $this->price = $price;
    }
    public function getPrice(){
        return $this->price;
    }
}

class Magazine implements IProduct
{
    private $isbn;
    public function __construct($isbn,$price )
    {
        $this->isbn = $isbn;
        $this->price = $price;
    }
    public function getPrice(){
        return $this->price;
    }
}


interface IPayment{
   public function execute($totalAmount, array $paymentDetails = null);
}

class BankTransferPayment implements IPayment{

    public function execute($totalAmount, array $paymentDetails = null){
        echo $totalAmount."euro paiement par virement SEPA</br>";
        return true;
    }

}

class CreditCardPayment implements IPayment{

    public function execute($totalAmount, array $paymentDetails = null){
        echo $totalAmount."euro paiement par Carte Crédit</br>";
        return true;
    }

}

class FiveMonthsInstalmentPayment implements IPayment{

    public function execute($totalAmount, array $paymentDetails = null){
        echo $totalAmount."euro paiement sur 5X</br>";
        return true;
    }

}

class ThreeMonthsInstalmentPayment implements IPayment{

    public function execute($totalAmount, array $paymentDetails = null){
        echo $totalAmount."euro paiement sur 3X </br>";
        return true;
    }

}
class Order
{
    private $basket;
    public function __construct()
    {
        $this->basket = [];
    }
    public function addProduct(IProduct $product)
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
            $price = 0;
            foreach ($this->basket as $pro){
                $price += $pro->getPrice();
            }
            // calculant le montant total HT du panier.
            return $price;
        }
    }
    public function removeProduct(IProduct $product)
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
    private $customer;
    private $payment;

    public function __construct(ICustomer $customer, IPayment $payment)
    {
        $this->customer = $customer;
        $this->payment = $payment;
    }
    public function checkout($totalAmount,$paymentDetails = null)
    {
        if($this->payment->execute($totalAmount, $paymentDetails) == true)
        {
            $this->customer->sendMail('Ticket de paiement numéro 12345');
        }
    }
}

interface ICustomer{

    public function addProduct( IProduct $product);
    Public function buy();
    public function getOrder();
    public function removeProduct(IProduct $product);
    public function sendMail($body);
}
abstract class Customer implements ICustomer
{
    protected $currentOrder;

    public function addProduct(IProduct $product)
    {
        $this->getOrder()->addProduct($product);
    }

    public function getOrder()
    {
        // Est-ce que le panier est vide ?
        if($this->currentOrder == null)
        {
            $this->currentOrder = new Order(1.20);// 20%de TVA
        }
        return $this->currentOrder;
    }

    public function removeProduct(IProduct $product)
    {

        // Est-ce que le panier est vide ?
        if($this->currentOrder == null)
        {
            throw new Exception("On ne peut pas retirer un produit d'un panier vide !");
        }
        $this->getOrder()->removeProduct($product);
    }

    public function sendMail($body)
    {
        // TODO: Implement sendMail() method.
    }
}

class PersonalCustomer extends Customer {

    public function __construct()
    {
        echo "<h2>Je suis un client particulier </h2></br>";
        $this->currentOrder = null;

    }
    public function buy()
    {
        // Est-ce que le panier est vide ?
        if($this->currentOrder == null)
        {
            // Oui, donc aucun achat à faire.
            return false;
        }
        $orderProcessor = new OrderProcessor($this, new CreditCardPayment());
        $totalAmount = $this->currentOrder->getTotalAmount();
        // Procède au paiement de la commande.
        $orderProcessor->checkout($totalAmount, [ 'credit-card' => '1234-5678' ]);
        return true;
    }

}

class BusinessCustomer extends Customer {
    private $payment;
    private $paymentDetails;

    public function __construct()
    {
        echo "<h2>Je suis un client Business</h2></br>";
        $this->currentOrder = null;
    }

    public function buy()
    {
        $orderProcessor = new OrderProcessor($this, $this->payment);
        $totalAmount = $this->currentOrder->getTotalAmount();

        $orderProcessor->checkout($totalAmount, $this->paymentDetails);
        return true;
    }

    public function setPaymentMethod(IPayment $payment,array $paymentDetails )
    {
        if($payment instanceof BankTransferPayment ||
            $payment instanceof ThreeMonthsInstalmentPayment)
        {
            $this->payment        = $payment;
            $this->paymentDetails = $paymentDetails;
        }

    }
    public function sendMail($body)
    {
        // TODO: Implement sendMail() method.
    }
}

class VipCustomer extends Customer {

    public function __construct()
    {
        echo "<h2>Je suis un client VIP</h2> </br>";
        $this->currentOrder = null;
    }
    public function buy()
    {
        if($this->currentOrder == null)
        {
            // Oui, donc aucun achat à faire.
            return false;
        }
        $orderProcessor = new OrderProcessor($this, new FiveMonthsInstalmentPayment());
        $totalAmount = $this->currentOrder->getTotalAmount();
        // Procède au paiement de la commande.
        $orderProcessor->checkout($totalAmount, [ 'instalment' => true ]);
        return true;

    }

}

$customer1 = new BusinessCustomer();
$customer1->addProduct(new Book('123456'));
$customer1->addProduct(new Book('112233'));
$customer1->setPaymentMethod(new BankTransferPayment(), [ 'iban' => '12345678' ]); // !! Doit être appelé avant la méthode buy()
$customer1->buy();
$customer2 = new PersonalCustomer();
$customer2->addProduct(new Book('522341'));
$customer2->buy();
$customer3 = new VipCustomer();
$customer3->addProduct(new Magazine('123456'));
$customer3->addProduct(new Book('122435'));
$customer3->addProduct(new Magazine('5675432'));
$customer3->buy();

