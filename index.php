<?php
include 'config/db.php';
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = trim($request_uri, '/');
$page = $request_uri ?: '/';
function start_push($key)
{
    ob_start();
    $GLOBALS['__push_stack'][$key] = $GLOBALS['__push_stack'][$key] ?? '';
}

function end_push($key)
{
    $content = ob_get_clean();
    $GLOBALS['__push_stack'][$key] .= $content;
}

function yield_push($key)
{
    return $GLOBALS['__push_stack'][$key] ?? '';
}
if (in_array($page, [
    'admin',
    'admin/menu',
    'admin/create_menu',
    'admin/edit_menu',
    'admin/pesanan',
    'admin/pesanan/create',
    'admin/pesanan/edit',
    'admin/promo',
    'admin/promo/create',
    'admin/promo/edit',
    'admin/pengguna',
    'admin/pengguna/create',
    'admin/pengguna/edit',
    'admin/profil',
    'admin/admin-feedback',
])) {
    include 'views/admin/header.php';
} elseif ($page != 'admin/login') {
    include 'views/header.php';
}
// Routing logic
switch ($request_uri) {
    case '':
        include 'views/index.php';
        break;
    case 'menu':
        include 'views/menu.php';
        break;
    case 'orders':
        include 'orders.php';
        break;
    case 'order-success':
        include 'views/order-success.php';
        break;
    case 'feedback':
        include 'views/feedback.php';
        break;
    case 'cart':
        include 'views/cart.php';
        break;
    case 'checkout':
        include 'views/checkout.php';
        break;
    case 'products':
        include 'views/products.php';
        break;
    case 'product':
        include 'views/product.php';
        break;
        // for admin
    case 'admin':
        include 'views/admin/index.php';
        break;
    case 'admin/menu':
        include 'views/admin/menu/menu.php';
        break;
    case 'admin/create_menu':
        include 'views/admin/menu/create_menu.php';
        break;
    case 'admin/edit_menu':
        include 'views/admin/menu/edit_menu.php';
        break;
    case 'admin/pesanan':
        include 'views/admin/pesanan/index.php';
        break;
    case 'admin/pesanan/create':
        include 'views/admin/pesanan/create.php';
        break;
    case 'admin/pesanan/edit':
        include 'views/admin/pesanan/edit.php';
        break;
    case 'admin/promo':
        include 'views/admin/promo/index.php';
        break;
    case 'admin/promo/create':
        include 'views/admin/promo/create.php';
        break;
    case 'admin/promo/edit':
        include 'views/admin/promo/edit.php';
        break;
    case 'admin/pengguna':
        include 'views/admin/pengguna/index.php';
        break;
    case 'admin/pengguna/create':
        include 'views/admin/pengguna/create.php';
        break;
    case 'admin/pengguna/edit':
        include 'views/admin/pengguna/edit.php';
        break;
    case 'admin/profil':
        include 'views/admin/profil/index.php';
        break;
    case 'admin/admin-feedback':
        include 'views/admin/feedback/index.php';
        break;
    case 'admin/login':
        include 'views/admin/login.php';
        break;
    default:
        include '404.php';
        break;
}

if (in_array($page, [
    'admin',
    'admin/menu',
    'admin/create_menu',
    'admin/edit_menu',
    'admin/pesanan',
    'admin/pesanan/create',
    'admin/pesanan/edit',
    'admin/profil',
    'admin/pengguna',
    'admin/pengguna/create',
    'admin/pengguna/edit',
    'admin/admin-feedback',
    'admin/promo',
    'admin/promo/create',
    'admin/promo/edit',
])) {
    include 'views/admin/footer.php';
} elseif ($page != 'admin/login') {
    include 'views/footer.php';
}

$conn->close();
