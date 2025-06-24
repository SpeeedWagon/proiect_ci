<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page_title ?? 'CI Shop') ?></title>
    
    <!-- Basic Styling with Blue Accents -->
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        nav {
            background-color: #ffffff;
            padding: 1rem 2rem;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        nav a:hover {
            background-color: #e7f3ff;
        }
        nav .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }
        h1, h2, h3 { color: #0056b3; }
        
        /* Forms */
        .form-wrapper { max-width: 500px; margin: 40px auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 500; }
        .form-group input, .form-group select { width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        
        /* Buttons */
        .btn { display: inline-block; padding: 0.75rem 1.5rem; border-radius: 5px; border: none; color: #fff; text-align: center; cursor: pointer; text-decoration: none; transition: background-color 0.2s; }
        .btn-primary { background-color: #007bff; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-danger { background-color: #dc3545; }
        .btn-danger:hover { background-color: #c82333; }
        
        /* Tables */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #e7f3ff; color: #0056b3; }

        /* Alerts */
        .alert { padding: 1rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: 5px; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .alert-error { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .validation-error { color: #721c24; font-size: 0.9em; }

    </style>
</head>
<body>

    <nav>
        <a href="/" class="logo">CI Shop</a>
        <div>
            <a href="/">Shop</a>
            <a href="/cart">Cart</a>
            <?php if (session()->get('is_logged_in')): ?>
                <a href="/orders">My Orders</a>
                <?php if (session()->get('role') === 'admin'): ?>
                    <a href="/admin">Admin</a>
                <?php endif; ?>
                <a href="/logout">Logout (<?= esc(session()->get('username')) ?>)</a>
            <?php else: ?>
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <!-- Session Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>