<?= $this->include('templates/header') ?>

<h1><?= esc($page_title) ?></h1>

<?php if (! empty($cart_items)): ?>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $grand_total = 0; ?>
            <?php foreach($cart_items as $item): ?>
                <tr>
                    <td><?= esc($item['name']) ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td><?= esc($item['quantity']) ?></td>
                    <td>$<?= number_format($item['quantity'] * $item['price'], 2) ?></td>
                    <td>
                        <a href="/cart/remove/<?= $item['id'] ?>" class="btn btn-danger" style="padding: 0.5rem 1rem;">Remove</a>
                    </td>
                </tr>
                <?php $grand_total += $item['quantity'] * $item['price']; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr style="font-weight: bold;">
                <td colspan="3" style="text-align: right;">Grand Total</td>
                <td colspan="2">$<?= number_format($grand_total, 2) ?></td>
            </tr>
        </tfoot>
    </table>

    <div style="text-align: right; margin-top: 20px;">
        <a href="/cart/clear" style="margin-right: 10px; color: #dc3545;">Clear Cart</a>
        <form action="/orders/create" method="post" style="display:inline;">
             <?= csrf_field() ?>
             <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
        </form>
    </div>

<?php else: ?>
    <p>Your shopping cart is currently empty.</p>
    <a href="/" class="btn btn-primary">Continue Shopping</a>
<?php endif; ?>

<?= $this->include('templates/footer') ?>