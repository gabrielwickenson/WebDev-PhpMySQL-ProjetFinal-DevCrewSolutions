<?php
session_start();
include 'header.php';

$total = 0;
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<div class="container">
    <h2>Finaliser ma commande</h2>
    
    <h3>Récapitulatif</h3>
    <table>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Sous-total</th>
        </tr>
        <?php foreach ($cart as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><?= $item['quantity'] ?></td>
            <td><?= number_format($item['price'], 2) ?> €</td>
            <td><?= number_format($item['price'] * $item['quantity'], 2) ?> €</td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total Général</strong></td>
            <td><strong><?= number_format($total, 2) ?> €</strong></td>
        </tr>
    </table>

    <h3>Informations de livraison</h3>
    <form action="process_order.php" method="POST">
        <input type="text" name="customer_name" placeholder="Nom complet" required>
        <input type="email" name="customer_email" placeholder="Email" required>
        <textarea name="delivery_address" placeholder="Adresse de livraison" required></textarea>
        <button type="submit">Valider la commande</button>
        <a href="cart.php">Retour au panier</a>
    </form>
</div>