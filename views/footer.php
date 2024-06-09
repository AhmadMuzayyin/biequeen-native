<!--Bottom TabBar Section Start -->
<?php
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = trim($request_uri, '/');
if ($request_uri != 'checkout' && $request_uri != 'order-success' && $request_uri != 'feedback' && $request_uri != 'product') {
?>
    <div class="bottom-tabbar <?= $request_uri == 'products' ? 'mt-5' : '' ?>">
        <div class="bottom-tabbar-full">
            <nav>
                <a href="/" class="<?= $request_uri == '' ? 'active' : '' ?>">
                    <img src="/views/assets/images/home.svg" alt="home-icon">
                    <span>
                        Home
                    </span>
                </a>
                <a href="/cart" class="<?= $request_uri == 'cart' ? 'active' : '' ?>">
                    <img src="/views/assets/images/cart.svg" alt="cart-icon">
                    <span>
                        Cart
                    </span>
                </a>
                <a href="/feedback">
                    <img src="/views/assets/images/feedback.svg" alt="feedback">
                    <span>
                        Feedback
                    </span>
                </a>
            </nav>
        </div>
    </div>
<?php
}
?>
<!--Bottom TabBar Section End -->
</div>
<script src="/views/assets/js/jquery-min-3.6.0.js"></script>
<script src="/views/assets/js/slick.min.js"></script>
<script src="/views/assets/js/bootstrap.bundle.min.js"></script>
<script src="/views/assets/js/modal.js"></script>
<script src="/views/assets/js/custom.js"></script>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>