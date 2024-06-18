<!-- Without Promocode Section Start -->
<section id="cart-without-promocode">
    <div class="container">
        <h1 class="d-none">Promocode Details</h1>
        <h2 class="d-none">Promocode</h2>
        <div class="cart-without-promocode-full">
            <?php if (isset($_SESSION['errors'])) { ?>
                <ul style="color:red;">
                    <?php foreach ($_SESSION['errors'] as $error) {
                        echo "<li>$error</li>";
                    } ?>
                </ul>
            <?php } ?>
            <?php
            $cart = mysqli_query($conn, "SELECT m.*, o.jumlah FROM orders o INNER JOIN menus m ON o.menu_id = m.menu_id WHERE o.in_cart = 1; ");
            foreach ($cart as $i => $item) :
            ?>
                <div class="cart-without-promocode-first <?= $i > 0 ? 'mt-16' : '' ?>">
                    <div class="cart-without-promocode-first-full">
                        <div>
                            <div class="cart-without-img-sec">
                                <img src="<?= $item['gambar'] ?>" width="140" height="140" alt="clothes-img">
                            </div>
                        </div>
                        <div class="cart-without-content-sec">
                            <div class="cart-without-content-sec-full">
                                <p class="price-code-txt1"><?= $item['nama'] ?></p>
                                <p class="price-code-txt2">Rp. <?= number_format($item['harga']) ?></p>
                                <div class="card-without-price-sec">
                                    <div class="price-code-txt3">
                                        <span>Varian:</span>
                                        <span><?= $item['varian'] ?></span>
                                    </div>
                                    <div class="price-code-txt3">
                                        <span>Toping:</span>
                                        <span><?= $item['toping'] ?></span>
                                    </div>
                                </div>
                                <div class="card-without-promocode-increment">
                                    <div class="product-incre">
                                        <form action="/config/order.php" method="post">
                                            <input type="hidden" name="menu_id" value="<?= $item['menu_id'] ?>">
                                            <input type="hidden" name="harga" value="<?= $item['harga'] ?>">
                                            <button name="min_qty" value="<?= $item['jumlah'] ?>" style="border: 0; background: transparent;" class="product__minus sub">
                                                <span>
                                                    <img src="/views/assets/svg/minus-icon.svg" alt="minus-icon">
                                                </span>
                                            </button>
                                        </form>
                                        <input name="quantity" type="text" class="product__input" value="<?= $item['jumlah'] ?>">
                                        <form action="/config/order.php" method="post">
                                            <input type="hidden" name="menu_id" value="<?= $item['menu_id'] ?>">
                                            <input type="hidden" name="harga" value="<?= $item['harga'] ?>">
                                            <button name="add_qty" value="<?= $item['jumlah'] ?>" style="border: 0; background: transparent;" class="product__plus add">
                                                <span>
                                                    <img src="/views/assets/svg/plus-icon.svg" alt="plus-icon">
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart-boder mt-16"></div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
        <!-- biodata -->
        <div class="without-code-second">
            <div class="without-code-second-full">
                <p>Nama</p>
                <div class="code-details mt-16">
                    <div class="enter-code-promocode1">
                        <input type="text" name="nama" id="nama">
                    </div>
                </div>
            </div>
            <div class="without-code-second-full mt-2">
                <p>Whatsapp</p>
                <div class="code-details mt-16">
                    <div class="enter-code-promocode1">
                        <input type="number" min="1" name="wa" id="wa">
                    </div>
                </div>
            </div>
            <div class="without-code-second-full mt-2">
                <p>Kode Promo:</p>
                <div class="code-details mt-16">
                    <div class="enter-code-promocode1">
                        <input type="text" value="<?= isset($_SESSION['kode_diskon']) ? $_SESSION['kode_diskon'] : '' ?>" name="diskon" id="diskon">
                    </div>
                    <div class="code-plus-btn code-cancel-btn">
                        <a href="javascript:void(0)" onclick="diskon()">
                            <img src="/views/assets/svg/white-plus.svg" alt="cancel-icon">
                        </a>
                    </div>
                </div>
            </div>
            <div class="cart-boder mt-24"></div>
        </div>
        <!-- subtotal -->
        <div class="check-page-bottom mt-24">
            <div class="check-page-bottom-deatails">
                <div class="check-price-name1">
                    <p>Subtotal</p>
                </div>
                <div class="check-price-list1">
                    <?php
                    $sub_total = 0;
                    foreach ($cart as $item) {
                        $sub_total += $item['harga'] * $item['jumlah'];
                    }
                    ?>
                    <p>Rp. <?= number_format($sub_total) ?></p>
                </div>
            </div>
            <div class="check-page-bottom-deatails mt-8">
                <div class="check-price-name">
                    <p>Diskon</p>
                </div>
                <div>
                    <?php
                    $diskon = 0;
                    if (isset($_SESSION['diskon'])) {
                        $diskon = $_SESSION['diskon'];
                    }
                    ?>
                    <p class="col-green" id="nominal_diskon">Rp. <?= number_format($diskon) ?></p>
                </div>
            </div>
            <div class="cart-boder mt-24"></div>
        </div>
        <!-- total -->
        <div class="without-code-last mt-24">
            <div class="without-code-last-full">
                <div>
                    <?php
                    $total = $sub_total - $diskon;
                    ?>
                    <p class="total-txt">Total:</p>
                    <p class="price-txt">Rp. <?= number_format($total) ?></p>
                </div>
                <div class="proceed-to check-btn">
                    <a href="javascript:void(0)" onclick="proses()">Proses Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Without Promocode Section End -->

<script>
    function diskon() {
        $('#diskon').val();
        $.ajax({
            url: '/config/order.php',
            type: 'POST',
            data: {
                diskon: $('#diskon').val(),
                getDiskon: true
            },
            success: function(data) {
                if (data.status == 'success') {
                    window.location.reload();
                    alert(data.message);
                    $('#diskon').val(data.diskon.kode);
                    $('#nominal_diskon').text(data.diskon.nominal);
                } else {
                    alert(data.message);
                }
            }
        })
    }

    function proses() {
        $.ajax({
            url: '/config/checkout.php',
            type: 'POST',
            data: {
                nama: $('#nama').val(),
                wa: $('#wa').val(),
                checkout: true
            },
            success: function(response) {
                if (response.status == 'success') {
                    window.location.href = '/checkout';
                } else {
                    alert(response.message);
                }
            },
            error: function(err) {
                console.log(err.responseText);
            }
        })
    }
</script>