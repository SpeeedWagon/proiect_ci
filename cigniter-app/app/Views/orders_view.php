<?= $this->include('templates/header') ?>

<style>
    .order-item { background: #fff; border: 1px solid #ddd; padding: 1.5rem; margin-bottom: 1rem; border-radius: 8px; }
    .order-item-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin-bottom: 1rem; }
</style>

<h1><?= esc($page_title) ?></h1>

<?php if (! empty($orders)): ?>
    <?php foreach ($orders as $order): ?>
        <div class="order-item">
            <div class="order-item-header">
                <h3>Order #<?= esc($order['id']) ?></h3>
                <strong>Total: $<?= number_format($order['total_price'], 2) ?></strong>
            </div>
            <p><strong>Date Placed:</strong> <?= date('F j, Y, g:i a', strtotime($order['created_at'])) ?></p>
            <!-- You could add a sub-query here to list items in the order -->
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>You have not placed any orders yet.</p>
<?php endif; ?>

<?= $this->include('templates/footer') ?>