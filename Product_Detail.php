<?php
require_once 'config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

$product = get_product($id);
if (!$product) {
    header('Location: index.php');
    exit;
}
?>
<?php include 'header.php'; ?>

<div class="container">
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h1 class="card-title">
                    <?= htmlspecialchars($product['name']) ?>
                </h1>
                <h4 class="text-primary">
                    <?= number_format($product['price'], 2) ?> €
                </h4>
                <p class="card-text">
                    <?= htmlspecialchars($product['description']) ?>
                </p>

                <form action="add_to_cart.php" method="post" class="mt-4">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <div class="row g-2 align-items-center">
                        <div class="col-auto">
                            <label for="quantity" class="col-form-label">Quantité :</label>
                        </div>
                        <div class="col-auto">
                            <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control"
                                style="width: 80px;" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success">Ajouter au panier</button>
                        </div>
                    </div>
                </form>
                <a href="index.php" class="btn btn-outline-secondary mt-3">← Continuer mes achats</a>
            </div>
        </div>
    </div>
</div>
</div>


<?php include 'footer.php'; ?>