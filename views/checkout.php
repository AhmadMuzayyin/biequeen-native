<!-- Checkout Section Start -->
<section id="Checkout-sec" class="checkout-main">
    <div class="container">
        <h1 class="d-none">Checkout Page</h1>
        <div class="Checkout-sec-full">
            <div class="Checkout-first-sec">
                <div class="Checkout-first-sec-full">
                    <?php if (isset($_SESSION['errors'])) { ?>
                        <ul style="color:red;">
                            <?php foreach ($_SESSION['errors'] as $error) {
                                echo "<li>$error</li>";
                            } ?>
                        </ul>
                    <?php } ?>
                    <?php
                    $cart = mysqli_query($conn, "SELECT 
                SUM(
                    CASE 
                        WHEN orders.diskon IS NOT NULL THEN (orders.jumlah * menus.harga) - orders.diskon
                        ELSE orders.jumlah * menus.harga
                    END
                ) AS total_harga
            FROM orders
            JOIN menus ON orders.menu_id = menus.menu_id
            WHERE orders.in_cart = 1; ");
                    ?>
                    <span>Pesanan Saya</span>
                    <span>Rp. <?= $cart->num_rows > 0 ? number_format($cart->fetch_assoc()['total_harga']) : 0 ?></span>
                </div>
                <div class="Checkout-border"></div>
            </div>
            <div class="Checkout-second-sec">
                <div class="Checkout-second-full">
                    <?php
                    $diskon = 0;
                    $orders = mysqli_query($conn, "SELECT m.*, o.jumlah, o.diskon FROM orders o INNER JOIN menus m ON o.menu_id = m.menu_id WHERE o.in_cart = 1; ");
                    foreach ($orders as $order) {
                        $diskon += $order['diskon'];
                    ?>
                        <div class="check-deatils">
                            <span class="check-txt1"><?= $order['nama'] ?></span>
                            <span class="check-txt2"><?= $order['jumlah'] ?> x Rp. <?= number_format($order['harga']) ?></span>
                        </div>
                    <?php
                    }
                    ?>
                    <hr>
                    <div class="check-deatils">
                        <span class="check-txt1 text-success">Diskon</span>
                        <span class="check-txt2 text-success">Rp. <?= number_format($diskon) ?></span>
                    </div>
                </div>
            </div>
            <div class="Checkout-third-sec">
                <div class="Checkout-third-sec-full">
                    <form>
                        <div class="form-check border-bottom px-0 custom-radio ">
                            <input class="form-check-input" type="radio" name="pembayaran" id="cod" value="cod">
                            <label class="form-check-label checkout-modal-lbl-payment" for="cod">
                                <span class="payment-type">
                                    <img src="/views/assets/images/account-screen/wallet.svg" alt="wallet-icon" class="black-icon">
                                </span>
                                <span class="wallet-txt1">Cash On Delivery</span>
                            </label>
                        </div>
                        <div class="form-check border-bottom px-0 custom-radio">
                            <input class="form-check-input" type="radio" name="pembayaran" id="qris" value="qris">
                            <label class="form-check-label checkout-modal-lbl-payment" for="qris">
                                <span class="payment-type">
                                    <img src="/views/assets/svg/payment1.svg" alt="Payment-icon">
                                </span>
                                <span class="wallet-txt1">QRIS</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="Checkout-fourth-sec">
                <div class="Checkout-fourth-sec-full">
                    <form class="checkout-form">
                        <label>Catatan:</label>
                        <textarea rows="4" id="catatan" placeholder="Tulis catatan disni..." class="product-textarea"></textarea>
                    </form>
                </div>
            </div>
            <div class="confirm-order-btn">
                <!-- <a href="/order-success">Konfirmasi Pesanan</a> -->
                <a href="javascript:void(0)" onclick="konfimasi()">Konfirmasi Pesanan</a>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
<script>
    function konfimasi() {
        var note = $('#catatan').val()
        var selectedValue = $("input[name='pembayaran']:checked").val();
        if (selectedValue) {
            $.ajax({
                url: '/config/checkout.php',
                type: 'POST',
                data: {
                    konfimasi: true,
                    catatan: note,
                    pembayaran: selectedValue
                },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.href = '/order-success';
                    } else {
                        alert(response.message);
                    }
                }
            });
        } else {
            alert('Pilih metode pembayaran terlebih dahulu');
        }
    }
</script>