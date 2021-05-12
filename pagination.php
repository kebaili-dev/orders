<?php

require 'functions.php';

$pdo = getConnection();

$query = $pdo->prepare('
    SELECT COUNT(orderNumber) AS totalOrders
    FROM orders
');

$query->execute();

$results = $query->fetch();

$resultsPerPage = 15;
$totalPages = ceil($results['totalOrders'] / $resultsPerPage);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    // Page par défaut quand aucune page n'est stipulée dans l'url
    $page = 1;
}

$offset = ($page - 1) * $resultsPerPage;

$query = $pdo->prepare("
    SELECT orderNumber, orderDate, status, customerName 
    FROM customers
    INNER JOIN orders ON orders.customerNumber = customers.customerNumber
    ORDER BY orderDate
    LIMIT $resultsPerPage OFFSET $offset
");

$query->execute();

$orders = $query->fetchAll();

require 'pagination.phtml';