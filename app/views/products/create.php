<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$form = isset($form) && is_array($form) ? $form : [
    'product_name' => '',
    'description' => '',
    'price' => '',
    'quantity' => '',
];

function create_value(array $form, string $key): string
{
    return htmlspecialchars($form[$key] ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Product | Inventory Desk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('public/css/mint-turquoise.css') ?>" rel="stylesheet">
    <style>
        :root { --ink: #262626; --paper: #f5f5f5; --coral: #4a4a4a; --line: #dedede; --muted: #737373; }
        body.product-page { background: var(--paper); color: var(--ink); font-family: "Space Grotesk", sans-serif; }
        body.product-page::before { display: none; }
        .product-topbar { position: relative; z-index: 2; background: #fff !important; border-bottom: 1px solid var(--line); }
        .product-topbar .navbar-brand { color: var(--ink) !important; font-size: 1rem; }
        .topbar-label { color: var(--muted); font: .66rem "DM Mono", monospace; letter-spacing: .12em; text-transform: uppercase; }
        .btn-signout { display: inline-block; margin-left: .35rem; border: 1px solid #bdbdbd; border-radius: 6px; background: #fff; color: #262626 !important; font: .72rem "Space Grotesk", sans-serif; letter-spacing: 0; padding: .45rem .65rem; text-decoration: none; text-transform: none; }
        .btn-signout:hover { background: #fff; color: var(--ink); }
        .product-page main { position: relative; z-index: 1; padding-top: 3.25rem !important; }
        .hero-kicker { color: var(--coral); font: .67rem "DM Mono", monospace; letter-spacing: .13em; text-transform: uppercase; }
        .hero-kicker span { display: inline-block; width: 26px; height: 1px; margin: 0 .6rem .2rem; background: currentColor; }
        .product-form-header { align-items: end; margin-bottom: 1.75rem; }
        .product-form-header h1 { color: var(--ink); font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 600; letter-spacing: -.03em; line-height: 1.05; }
        .product-form-header h1 em { color: var(--ink); font-family: inherit; font-weight: 600; }
        .product-form-header .btn-outline-secondary { border-radius: 6px; border-color: var(--line); color: var(--ink); }
        .product-form-header .btn-outline-secondary:hover { background: var(--ink); color: #fff; }
        .product-form-card { background: #fff; border: 1px solid var(--line) !important; border-radius: 8px !important; box-shadow: 0 4px 18px rgba(38,50,56,.04); }
        .form-label { color: var(--ink); font: 600 .75rem "DM Mono", monospace; letter-spacing: .04em; text-transform: uppercase; }
        .form-label span { color: var(--coral); margin-right: .55rem; }
        .form-control, textarea.form-control { background: transparent; border: 0; border-bottom: 1px solid var(--line); border-radius: 0; color: var(--ink); padding: .7rem 0; }
        .form-control:focus { background: transparent; border-color: var(--coral); box-shadow: 0 1px 0 var(--coral); }
        .btn-primary { --bs-btn-bg: var(--coral); --bs-btn-border-color: var(--coral); --bs-btn-hover-bg: #333; --bs-btn-hover-border-color: #333; border-radius: 6px; box-shadow: none; }
    </style>
</head>
<body class="product-page product-form-page">
<nav class="product-topbar"><div class="container"><a class="navbar-brand fw-semibold" href="<?= site_url('products'); ?>">Products</a><span class="topbar-label"><a class="btn btn-signout" href="<?= site_url('logout'); ?>">Sign out</a></span></div></nav>
<main class="container py-4">
    <div class="row justify-content-center"><div class="col-lg-8">
        <div class="product-form-header"><div><h1 class="h3 mb-0">Add product</h1></div><a href="<?= site_url('products'); ?>" class="btn btn-outline-secondary">&#8592; Back</a></div>
        <?php if (!empty($errors)) : ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $error) : ?><li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li><?php endforeach; ?></ul></div><?php endif; ?>
        <div class="card product-form-card border-0"><div class="card-body p-4">
            <form method="post" action="<?= site_url('products/store'); ?>">
                <div class="mb-3"><label class="form-label" for="product_name"><span>01</span> Product name</label><input class="form-control" id="product_name" name="product_name" maxlength="100" required value="<?= create_value($form, 'product_name'); ?>" placeholder="Give it a memorable name"></div>
                <div class="mb-3"><label class="form-label" for="description"><span>02</span> Description</label><textarea class="form-control" id="description" name="description" rows="4" placeholder="What makes this one special?"><?= create_value($form, 'description'); ?></textarea></div>
                <div class="row"><div class="col-md-6 mb-3"><label class="form-label" for="price"><span>03</span> Price</label><input class="form-control" id="price" name="price" type="number" min="0" step="0.01" required value="<?= create_value($form, 'price'); ?>" placeholder="0.00"></div><div class="col-md-6 mb-3"><label class="form-label" for="quantity"><span>04</span> Quantity</label><input class="form-control" id="quantity" name="quantity" type="number" min="0" step="1" required value="<?= create_value($form, 'quantity'); ?>" placeholder="0"></div></div>
                <button class="btn btn-primary" type="submit">Add to collection <span aria-hidden="true">&#8599;</span></button>
            </form>
        </div></div>
    </div></div>
</main>
</body>
</html>