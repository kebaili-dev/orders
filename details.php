<?php

require 'functions.php';

// Connexion à la base de données (utilisez vos propres identifiants et votre base de données)
$pdo = getConnection();
 
 // 1er PARTIE CLIENT

$query = $pdo->prepare('
    SELECT  customerName, contactFirstName, contactLastName, addressLine1, city
    FROM customers
    INNER JOIN orders ON orders.customerNumber = customers.customerNumber
    WHERE orderNumber = ?
    
    
    
');


$query->execute([
    $_GET['order']
]);

$customer = $query->fetch();


// 2eme PARTIE PRODUIT COMMANDé

$query = $pdo->prepare('
    SELECT productName, quantityOrdered, priceEach,  (priceEach * quantityOrdered) AS Total, orders.orderNumber
    FROM products
    INNER JOIN orderdetails ON orderdetails.productCode = products.productCode
    INNER JOIN orders ON orders.orderNumber = orderdetails.orderNumber
    WHERE orders.orderNumber = ?
    ORDER BY productName DESC'
    
);


$orderId = $_GET['order'];

$query->execute([
    $orderId
]);

$ship = $query->fetchAll();

//3eme PARTIE TOTAL COMMANDE



$query = $pdo->prepare
(
    'SELECT SUM(priceEach * quantityOrdered) AS totalFinal
     FROM orderdetails
     WHERE orderNumber = ?'
);

$query->execute([
    $_GET['order']
]);

$result = $query->fetch();


$totalFinal = $result['totalFinal'];


require 'details.phtml';