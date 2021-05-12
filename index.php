<?php

/* TODO
 * 1. Connectez-vous à votre base de données classicmodels
 * 2. Récupérer la liste des commandes (orderNumber, orderDate, statut de la commande, nom du client)
 * 3. Afficher les résultats dans un tableau dans un fichier phtml
 * 4. Lorsque je clique sur le numéro de la commande, on est redirigé vers une page affichant le détail de la commande
 * Il faudra mettre un lien qui renvoie vers la page detail.php et qui transmet le numéro de la commande à cette page
 * ex: detail.php?order=10100
 * Sur la page detail.php, on affiche dans un premier temps le nom du client qui a passé la commande
 * Démo : http://cedricleclinche.sites.3wa.io/order/index.php
 */

 /* TODO pagination
  * Récupérer le nombre de commandes pour déterminer le nombre de pages ( nombre de pages = nombres de commandes / nombres de commande par page)
  * Récupérer la page actuelle sur laquelle on est
  * Récupérer les commandes de cette page (cf clause LIMIT en SQL)
  */
  
require 'functions.php';

// Connexion à la base de données (utilisez vos propres identifiants et votre base de données)
$pdo = getConnection();

$query = $pdo->prepare('SELECT orderNumber, orderDate, status, customers.customerName 
    FROM customers 
    INNER JOIN orders ON orders.customerNumber = customers.customerNumber 
    ORDER BY orderDate'
);

$query->execute();

$orders = $query->fetchAll();




 
require 'orders.phtml'; 