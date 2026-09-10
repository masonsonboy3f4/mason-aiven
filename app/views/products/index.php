<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
function product_value($product, $key, $default = '')
{
    return is_array($product) ? ($product[$key] ?? $default) : ($product->$key ?? $default);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Desk | LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('public/css/mint-turquoise.css') ?>" rel="stylesheet">
    <style>
        :root { --ink: #262626; --paper: #f5f5f5; --coral: #4a4a4a; --yellow: #eeeeee; --line: #dedede; --muted: #737373; }
        body.product-page { background: var(--paper); color: var(--ink); font-family: "Space Grotesk", sans-serif; }
        body.product-page::before { display: none; }
        .product-topbar { position: relative; z-index: 2; background: #fff !important; border-bottom: 1px solid var(--line); }
        .product-topbar .navbar-brand { color: var(--ink) !important; font-size: 1rem; }
        .topbar-meta { display: flex; align-items: center; gap: .5rem; color: var(--muted); font: .66rem "DM Mono", monospace; letter-spacing: .12em; text-transform: uppercase; }
        .btn-pink, .btn-primary { --bs-btn-bg: var(--coral); --bs-btn-border-color: var(--coral); --bs-btn-color: #fff; --bs-btn-hover-bg: #333; --bs-btn-hover-border-color: #333; border-radius: 6px; box-shadow: none; }
        .btn-signout { display: inline-block; margin-left: 0; border: 1px solid #bdbdbd; border-radius: 6px; background: #fff; color: #262626 !important; font-size: .72rem; padding: .45rem .65rem; text-decoration: none; }
        .btn-signout:hover { background: #fff; color: var(--ink); }
        .product-page main { position: relative; z-index: 1; padding-top: 3.25rem !important; }
        .hero-kicker, .section-note { color: var(--coral); font: .67rem "DM Mono", monospace; letter-spacing: .13em; text-transform: uppercase; }
        .hero-kicker span { display: inline-block; width: 26px; height: 1px; margin: 0 .6rem .2rem; background: currentColor; }
        .product-header h1, .product-form-header h1 { color: var(--ink); font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 600; letter-spacing: -.03em; line-height: 1.05; }
        .product-header h1 em, .product-form-header h1 em { color: var(--ink); font-family: inherit; font-weight: 600; }
        .product-header p { color: var(--muted) !important; }
        .hero-rule { height: 1px; margin-top: 2.25rem; background: var(--ink); }
        .inventory-toolbar { display: flex; justify-content: space-between; margin-bottom: .75rem; }
        .section-note { color: var(--muted); }
        .product-card, .product-form-card { background: #fff; border: 1px solid var(--line) !important; border-radius: 8px !important; box-shadow: 0 4px 18px rgba(38,50,56,.04); }
        .table thead th { background: #f1f5f7; color: var(--muted); padding: 1.05rem 1rem; font: .63rem "DM Mono", monospace; letter-spacing: .1em; text-transform: uppercase; }
        .table tbody td { background: transparent; border-color: var(--line); color: var(--ink); padding: 1.2rem 1rem; }
        .table tbody tr:hover td { background: rgba(242,99,77,.06); }
        .product-index { color: var(--muted) !important; font: .72rem "DM Mono", monospace; }
        .btn-outline-primary { border-color: var(--line); border-radius: 6px; color: var(--coral); }
        .btn-outline-primary:hover { background: var(--coral); border-color: var(--coral); color: #fff; }
        @media (max-width: 767.98px) { .product-page main { padding-top: 2.2rem !important; } .table thead { display: none; } .table tbody, .table tbody tr, .table tbody td { display: block; width: 100%; } .table tbody tr { padding: .7rem .4rem; border-bottom: 1px solid var(--line); } .table tbody td { padding: .35rem .75rem; border: 0; } .table tbody td::before { color: var(--muted); content: attr(data-label); display: inline-block; margin-right: .5rem; font: .62rem "DM Mono", monospace; text-transform: uppercase; } .table tbody td:nth-child(1)::before { content: "No."; } .table tbody td:nth-child(2)::before { content: "Name"; } .table tbody td:nth-child(3)::before { content: "About"; } .table tbody td:nth-child(4)::before { content: "Price"; } .table tbody td:nth-child(5)::before { content: "Qty"; } .table tbody td:nth-child(6)::before { content: "Added"; } .table tbody td:nth-child(7)::before { content: ""; } }
    </style>
</head>
<body class="product-page product-index-page">
<nav class="product-topbar">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="<?= site_url('products'); ?>">Products</a>
        <div class="topbar-meta"><a class="btn btn-pink" href="<?= site_url('products/create'); ?>">Add product</a> <a class="btn btn-signout" href="<?= site_url('logout'); ?>">Sign out</a></div>
    </div>
</nav>
<main class="container py-4">
    <section class="inventory-hero">
        <div class="product-header">
        <div>
            <h1>Products</h1>
        </div>
        </div>
        <div class="hero-rule"></div>
    </section>

    <?php if (!empty($flash)) : ?>
        <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card product-card border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Created</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)) : ?>
                        <tr><td colspan="7" class="text-center text-secondary py-5">No products found.</td></tr>
                    <?php else : ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td class="product-index"><?= str_pad((string) (int) product_value($product, 'id'), 2, '0', STR_PAD_LEFT); ?></td>
                                <td class="product-title fw-semibold"><?= htmlspecialchars(product_value($product, 'product_name'), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-secondary"><?= htmlspecialchars(product_value($product, 'description'), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>$<?= number_format((float) product_value($product, 'price'), 2); ?></td>
                                <td><?= (int) product_value($product, 'quantity'); ?></td>
                                <td><?= htmlspecialchars(product_value($product, 'created_at'), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-end text-nowrap">
                                    <a class="btn btn-sm btn-outline-primary" href="<?= site_url('products/edit/' . (int) product_value($product, 'id')); ?>">Edit</a>
                                    <form class="d-inline" method="post" action="<?= site_url('products/delete/' . (int) product_value($product, 'id')); ?>" onsubmit="return confirm('Delete this product?');">
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>