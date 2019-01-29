<?php
interface IProduct
{
    public function __construct($isbn);
}
class Book implements IProduct
{
    private $isbn;
    public function __construct($isbn)
    {
        $this->isbn = $isbn;
    }
}
class Magazine implements IProduct
{
    private $isbn;
    public function __construct($isbn)
    {
        $this->isbn = $isbn;
    }
}
/////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// MOYENS DE PAIEMENT
interface IPayment
{
    public function execute($totalAmount, array $paymentDetails);
}
class BankTransferPayment implements IPayment
{
    public function execute($totalAmount, array $paymentDetails)
    {
        echo '<h2>Paiement par virement SEPA</h2>';
        // (...) Code exécutant l'ordre de paiement par carte bleue.
        // Oui, le paiement a été réalisé.
        return true;
    }
}
class CreditCardPayment implements IPayment
{
    public function execute($totalAmount, array $paymentDetails)
    {
        echo '<h2>Paiement par carte bancaire</h2>';
        // (...) Code exécutant l'ordre de paiement par carte bleue.
        // Oui, le paiement a été réalisé.
        return true;
    }
}
class FiveMonthsInstalmentPayment implements IPayment
{
    public function execute($totalAmount, array $paymentDetails)
    {
        echo '<h2>Paiement en 5x</h2>';
        // (...) Code exécutant l'ordre de paiement en 5x.
        // Oui, le paiement a été réalisé.
        return true;
    }
}
class ThreeMonthsInstalmentPayment implements IPayment
{
    public function execute($totalAmount, array $paymentDetails)
    {
        echo '<h2>Paiement en 3x</h2>';
        // (...) Code exécutant l'ordre de paiement en 3x.
        // Oui, le paiement a été réalisé.
        return true;
    }
}
/////////////////////////////////////////////////////////
class Order
{
    private $basket;
    public function __construct()
    {
        $this->basket  = [];
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
            // (...) Code calculant le montant total HT du panier.
            $totalAmount = 125.85; // exemple de résultat
            return $totalAmount;
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
    public function __construct(ICustomer $customer, IPayment $payment) // injection des dépendances via le constructeur
    {
        $this->customer = $customer;
        $this->payment  = $payment;
    }
    public function checkout($totalAmount, array $paymentDetails)
    {
        if($this->payment->execute($totalAmount, $paymentDetails) == true)
        {
            $this->customer->sendMail('Ticket de paiement numéro 12345');
        }
    }
}
///////////////////////////////////////////////////////// CLIENTS
interface ICustomer
{
    public function addProduct(IProduct $product);
    public function buy();
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
            $this->currentOrder = new Order(1.20); // 20% de TVA
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
        // (...) Code envoyant le message à l'adresse e-mail du client.
    }
}
class BusinessCustomer extends Customer
{
    private $payment;
    private $paymentDetails;
    public function __construct()
    {
        echo '<h2>Je suis un client business</h2>';
        // Au départ le panier est vide.
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
        $orderProcessor = new OrderProcessor($this, $this->payment);
        $totalAmount = $this->currentOrder->getTotalAmount();
        // Procède au paiement de la commande.
        $orderProcessor->checkout($totalAmount, $this->paymentDetails);
        return true;
    }
    public function setPaymentMethod(IPayment $payment, array $paymentDetails) // injection des dépendances via un setter
    {
        if($payment instanceof BankTransferPayment ||
            $payment instanceof ThreeMonthsInstalmentPayment)
        {
            $this->payment        = $payment;
            $this->paymentDetails = $paymentDetails;
        }
    }
}




class PersonalCustomer extends Customer
{
    public function __construct()
    {
        echo '<h2>Je suis un client particulier</h2>';
        // Au départ le panier est vide.
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
class VipCustomer extends Customer
{
    public function __construct()
    {
        echo '<h2>Je suis un client VIP</h2>';
        // Au départ le panier est vide.
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
        $orderProcessor = new OrderProcessor($this, new FiveMonthsInstalmentPayment());
        $totalAmount = $this->currentOrder->getTotalAmount();
        // Procède au paiement de la commande.
        $orderProcessor->checkout($totalAmount, [ 'instalment' => true ]);
        return true;
    }
}
/////////////////////////////////////////////////////////
// (...) CODE CLIENT
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