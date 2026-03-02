<?php
require_once 'config.php';
include 'header.php';

$order_id = (int)($_GET['id'] ?? 0);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ecommerce_db;charset=utf8mb4", "root", "");
    
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$order_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt_items = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt_items->execute([$order_id]);
    $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

if (!$order) die("Commande introuvable.");
?>
<div class="container mt-4">
    <div class="alert alert-success">
        Merci <?= htmlspecialchars($order['customer_name']) ?>, commande #<?= $order['id'] ?> validée.
    </div>
    <table class="table">
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['product_name']) ?> x <?= $item['quantity'] ?></td>
            <td><?= number_format($item['unit_price'], 2) ?> €</td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <th>Total</th>
            <th><?= number_format($order['total_price'], 2) ?> €</th>
        </tr>
    </table>
    <a href="index.php" class="btn btn-secondary">Retour accueil</a>
</div>
<?php include 'footer.php'; ?>