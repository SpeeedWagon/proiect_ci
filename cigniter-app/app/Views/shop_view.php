<?= $this->include('templates/header') ?>

<style>
    .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
    .product-card { background: #fff; border: 1px solid #ddd; border-radius: 8px; text-align: center; padding: 1.5rem; transition: box-shadow 0.2s; }
    .product-card:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    .product-card img { max-width: 100%; height: 180px; object-fit: cover; border-radius: 5px; }
    .product-card h3 { margin: 1rem 0 0.5rem 0; }
    .product-card .price { font-size: 1.2rem; font-weight: bold; color: #333; margin-bottom: 1rem; }
</style>

<h1><?= esc($page_title) ?></h1>

<div class="products-grid">
    <?php if (! empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?= esc($product['image_url']) ?>" alt="<?= esc($product['name']) ?>">
                <h3><?= esc($product['name']) ?></h3>
                <div class="price">$<?= number_format($product['price'], 2) ?></div>
                <p><?= esc($product['description']) ?></p>

                <form action="/cart/add" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="product_name" value="<?= esc($product['name']) ?>">
                    <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found at this time.</p>
    <?php endif ?>
</div>

<?= $this->include('templates/footer') ?>