<?php 


function getConnection(): PDO
{
    $options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
    return new PDO(
        'mysql:host=home.3wa.io:3307;dbname=classicmodels;charset=UTF8', 
        'cedricleclinche', 
        'M2MyNzJkNGZiODk4OTIzMGFkMmFmYmE43Wa!',
        $options,
        
    );
}

function formatMoney(float $amount): string
{
    return number_format($amount, 2, ',', ' ');
}