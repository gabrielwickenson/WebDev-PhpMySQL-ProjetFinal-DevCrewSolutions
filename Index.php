<?php
require_once 'config.php';
$products = get_all_products();
?>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="mb-4">Nos produits</h1>
    <div class="row g-4">
        <?php foreach ($products as $product): ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <?= htmlspecialchars($product['name']) ?>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-primary">
                            <?= number_format($product['price'], 2) ?> €
                        </h6>
                        <p class="card-text flex-grow-1">
                            <?= htmlspecialchars($product['description']) ?>
                        </p>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="product_detail.php?id=<?= $product['id'] ?>"
                                class="btn btn-outline-primary btn-sm">Voir
                                détails</a>
                            <a href="product_detail.php?id=<?= $product['id'] ?>" class="btn btn-primary btn-sm">Ajouter</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php include 'footer.php'; ?>