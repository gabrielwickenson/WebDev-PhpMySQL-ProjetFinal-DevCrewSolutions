<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['cart'])) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ecommerce_db;charset=utf8mb4", "root", "", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $name = htmlspecialchars($_POST['customer_name']);
        $email = htmlspecialchars($_POST['customer_email']);
        $address = htmlspecialchars($_POST['delivery_address']);
        
        $total_price = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }

        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, customer_email, delivery_address, total_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $address, $total_price]);
        $order_id = $pdo->lastInsertId();

        $stmt_item = $pdo->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, unit_price) VALUES (?, ?, ?, ?, ?)");
        foreach ($_SESSION['cart'] as $item) {
            $stmt_item->execute([
                $order_id,
                $item['product_id'],
                $item['name'],
                $item['quantity'],
                $item['price']
            ]);
        }

        $pdo->commit();
        unset($_SESSION['cart']);
        header("Location: order_confirmation.php?id=" . $order_id);
        exit;

    } catch (Exception $e) {
        if (isset($pdo)) $pdo->rollBack();
        die("Erreur : " . $e->getMessage());
    }
}