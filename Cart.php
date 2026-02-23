<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $product_id = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;

    switch ($action) {
        case 'increase':
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['product_id'] == $product_id) {
                    $item['quantity']++;
                    break;
                }
            }
            unset($item);
            break;
        case 'decrease':
            foreach ($_SESSION['cart'] as $key => &$item) {
                if ($item['product_id'] == $product_id) {
                    $item['quantity']--;
                    if ($item['quantity'] <= 0) {
                        unset($_SESSION['cart'][$key]);
                    }
                    break;
                }
            }
            unset($item);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;
        case 'remove':
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['product_id'] == $product_id) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;
        case 'clear':
            $_SESSION['cart'] = [];
            break;
    }
    header('Location: cart.php');
    exit;
}

$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>
<?php include 'header.php'; ?>

<?php if (empty($_SESSION['cart'])): ?>
    <div class="alert alert-info">Votre panier est vide.</div>
    <a href="index.php" class="btn btn-primary">Continuer mes achats</a>
<?php else: ?>

    <div class="container">
        <h1 class="mb-4">Votre panier</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($item['name']) ?>
                            </td>
                            <td>
                                <?= number_format($item['price'], 2) ?> €
                            </td>
                            <td>
                                <form action="cart.php" method="post" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <input type="hidden" name="action" value="decrease">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">−</button>
                                </form>
                                <span class="mx-2">
                                    <?= (int) $item['quantity'] ?>
                                </span>
                                <form action="cart.php" method="post" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <input type="hidden" name="action" value="increase">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                                </form>
                            </td>
                            <td>
                                <?= number_format($item['price'] * $item['quantity'], 2) ?> €
                            </td>
                            <td>
                                <form action="cart.php" method="post" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <input type="hidden" name="action" value="remove">
                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total général :</td>
                        <td colspan="2" class="fw-bold">
                            <?= number_format($total, 2) ?> €
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex flex-wrap gap-2 align-items-center">
            <form action="cart.php" method="post">
                <input type="hidden" name="action" value="clear">
                <button type="submit" class="btn btn-warning">Vider le panier</button>
            </form>
            <a href="index.php" class="btn btn-outline-primary">Continuer mes achats</a>
            <a href="checkout.php" class="btn btn-success ms-auto">Procéder au checkout</a>
        </div>
    </div>

<?php endif; ?>

<?php include 'footer.php'; ?>