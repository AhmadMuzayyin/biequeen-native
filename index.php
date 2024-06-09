<?php
include 'config/db.php';
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = trim($request_uri, '/');
$page = $request_uri ?: '/';

$page != 'admin' ? include 'views/header.php' : include 'views/admin/header.php';
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
    default:
        include '404.php';
        break;
}

$page != 'admin' ? include 'views/footer.php' : include 'views/admin/footer.php';

$conn->close();
