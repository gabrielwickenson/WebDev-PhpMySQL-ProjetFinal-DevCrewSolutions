<?php
require_once 'config.php';
include 'header.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $item) { $total += $item['price'] * $item['quantity']; }
?>

<div class="container mt-4">
    <h2>Détails de la livraison</h2>
    <form action="process_order.php" method="POST">
        <input type="text" name="customer_name" placeholder="Nom Complet" class="form-control mb-2" required>
        <input type="email" name="customer_email" placeholder="Email" class="form-control mb-2" required>
        <textarea name="delivery_address" placeholder="Adresse" class="form-control mb-2" required></textarea>
        <h4>Total : <?= number_format($total, 2) ?> €</h4>
        <button type="submit" class="btn btn-primary">Payer la commande</button>
    </form>
</div>

<?php include 'footer.php'; ?>