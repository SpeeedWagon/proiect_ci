<?= $this->include('templates/header') ?>

<div style="background: #e7f3ff; border-left: 5px solid #007bff; padding: 2rem;">
    <h1><?= esc($page_title) ?></h1>
    <p>Welcome to the administrative backend. This area is protected and only accessible to users with the 'admin' role.</p>
</div>

<div style="margin-top: 2rem;">
    <h2>Quick Stats (Example)</h2>
    <div style="display:flex; gap: 20px;">
        <div style="flex:1; padding: 1.5rem; background:#fff; border: 1px solid #ddd;">Total Users: 10</div>
        <div style="flex:1; padding: 1.5rem; background:#fff; border: 1px solid #ddd;">Total Products: 4</div>
        <div style="flex:1; padding: 1.5rem; background:#fff; border: 1px solid #ddd;">Pending Orders: 2</div>
    </div>
</div>

<?= $this->include('templates/footer') ?>