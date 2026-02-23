<?php
// Démarrer la session (nécessaire pour le panier)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définir les produits en dur (tableau associatif)
$products = [
    1 => [
        'id' => 1,
        'name' => 'Smartphone Galaxy S21',
        'price' => 699.99,
        'description' => 'Un smartphone puissant avec écran 120Hz et appareil photo 108MP.'
    ],
    2 => [
        'id' => 2,
        'name' => 'Laptop Dell XPS 13',
        'price' => 1199.99,
        'description' => 'Ultra-portable, processeur i7, 16Go RAM, SSD 512Go.'
    ],
    3 => [
        'id' => 3,
        'name' => 'Casque audio Sony WH-1000XM4',
        'price' => 349.99,
        'description' => 'Casque sans fil à réduction de bruit active, autonomie 30h.'
    ],
    // Ajoute d'autres produits jusqu'à 8-12
    4 => [
        'id' => 4,
        'name' => 'Montre connectée Apple Watch Series 7',
        'price' => 429.00,
        'description' => 'Écran toujours activé, capteur de oxygène sanguin.'
    ],
    5 => [
        'id' => 5,
        'name' => 'Tablette Samsung Tab S7',
        'price' => 649.99,
        'description' => 'Écran 11", S-Pen inclus, idéal pour le travail et le divertissement.'
    ],
    6 => [
        'id' => 6,
        'name' => 'Enceinte Bluetooth JBL Charge 5',
        'price' => 179.99,
        'description' => 'Étanche, batterie 20h, power bank intégré.'
    ],
    7 => [
        'id' => 7,
        'name' => 'Clavier mécanique Logitech MX',
        'price' => 99.99,
        'description' => 'Confortable, sans fil, rétroéclairé.'
    ],
    8 => [
        'id' => 8,
        'name' => 'Souris gaming Razer DeathAdder',
        'price' => 59.99,
        'description' => 'Capteur optique 16000 DPI, 7 boutons programmables.'
    ]
];

// Fonction pour récupérer tous les produits
function get_all_products()
{
    global $products;
    return $products;
}

// Fonction pour récupérer un produit par son ID
function get_product($id)
{
    global $products;
    return isset($products[$id]) ? $products[$id] : null;
}