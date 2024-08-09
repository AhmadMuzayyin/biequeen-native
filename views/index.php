<?php
unset($_SESSION['pembayaran']);
unset($_SESSION['diskon']);
unset($_SESSION['kode_diskon']);
unset($_SESSION['errors']);
?>
<section id="noresult-screen" class="no-result-main">
    <h1 class="d-none">Search Screen</h1>
    <h2 class="d-none">Search</h2>
    <div class="container">
        <div class="noresult-screen-full">
            <div class="input-group search-page-searchbar ">
                <span class="input-group-text search-iconn">
                    <img src="/views/assets/svg/search-icon.svg" alt="search-icon">
                </span>
                <input type="search" placeholder="Search" class="form-control search-text" id="search-input">
            </div>
        </div>
    </div>
</section>
<!--Homepage 1 Screen Start -->
<section id="homescreen1-deatils-page" class="homescreen1-main" style="margin-top: -10%;">
    <div class="homescreen1-deatils-page-full">
        <!-- produk terbaru -->
        <div class="homescreen-second-wrapper">
            <div class="container">
                <div class="homescreen-second-wrapper-top">
                    <div class="categories-first">
                        <h2 class="home1-txt3">Produk Terbaru</h2>
                    </div>
                </div>
            </div>
            <div class="homescreen-second-wrapper-bottom mt-16">
                <div class="homescreen-second-wrapper-slider">
                    <?php
                    $produk_terbaru = mysqli_query($conn, 'SELECT * FROM menus ORDER BY created_at DESC LIMIT 3;');
                    // $produk_terbaru = mysqli_fetch_array($produk_terbaru);
                    foreach ($produk_terbaru as $val) :
                    ?>
                        <div class="category-slide redirect-clothes">
                            <img src="<?= $val['gambar'] ?>" width="100" height="100" alt="category-img">
                            <div class="category-slide-content">
                                <h4><?= $val['nama'] ?></h4>
                                <h5>Rp. <?= number_format($val['harga']) ?> </h5>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <!-- discount -->
        <!-- <div class="homescreen-third-sec mt-32">
            <div class="container">
                <div class="homescreen-third-wrapper">
                    <h3>Spring Discounts Up To 30% Off</h3>
                    <p>Get a discount for every course order! Only valid for today!</p>
                    <div class="home1-shop-now-btn mt-32">
                        <a href="offer-screen.html">Shop Now</a>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- produk terlaris -->
        <div class="homescreen-fourth-sec mt-32">
            <div class="homescreen-fourth-wrapper">
                <div class="container">
                    <div class="homescreen-second-wrapper-top">
                        <div class="categories-first">
                            <?php
                            $cek = 0;
                            if ($cek > 1) :
                            ?>
                                <h2 class="home1-txt3">Produk Terlaris</h2>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="homescreen-fourth-wrapper-bottom mt-16">
                    <div class="homescreen-fourth-wrapper-slider">
                        <?php
                        $produk_terlaris = mysqli_query($conn, 'SELECT m.menu_id, m.nama, m.harga, m.gambar, COUNT(o.menu_id) AS jumlah_pesanan FROM orders o JOIN menus m ON o.menu_id = m.menu_id GROUP BY o.menu_id, m.menu_id, m.nama ORDER BY jumlah_pesanan DESC LIMIT 5;');
                        foreach ($produk_terlaris as $vall) :
                            if ($vall['jumlah_pesanan'] > 2) :
                                $cek = 1;
                        ?>
                                <div class="seller-slide redirect-clothes">
                                    <div class="seller-slide-top-content">
                                        <img src="<?= $vall['gambar'] ?>" width="200" height="240" alt="seller-img">
                                    </div>
                                    <div class="seller-slide-bottom-content">
                                        <h3 class="seller-name">Shor summer dress</h3>
                                        <div class="seller-bottom-price">
                                            <div class="seller-bottom-price1">
                                                <span class="seller-price-txt1">Rp. 680.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endif;
                        endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- semua produk -->
        <div class="homescreen-eight-sec mt-32">
            <div class="homescreen-eight-wrapper">
                <div class="container">
                    <div class="homescreen-second-wrapper-top">
                        <div class="categories-first">
                            <h2 class="home1-txt3">Semua Menu</h2>
                        </div>
                    </div>
                </div>
                <!-- menu dengan kategori -->
                <div class="homescreen-eight-wrapper-bottom mt-16">
                    <div class="homescreen-eight-bottom-full">
                        <!-- <ul class="nav nav-pills mb-3" id="homepage1-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active custom-home1-tab-btn" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-selected="true">Semua</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link custom-home1-tab-btn" id="pills-clothes-tab" data-bs-toggle="pill" data-bs-target="#pills-makanan" type="button" role="tab" aria-selected="false">Makanan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link custom-home1-tab-btn" id="pills-electronics-tab" data-bs-toggle="pill" data-bs-target="#pills-minuman" type="button" role="tab" aria-selected="false">Minuman</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link custom-home1-tab-btn" id="pills-cosmetics-tab" data-bs-toggle="pill" data-bs-target="#pills-snack" type="button" role="tab" aria-selected="false">Snack</button>
                            </li>
                        </ul> -->
                        <div class="tab-content" id="pills-tabContent">
                            <!-- semua menu -->
                            <?php
                            $menu  = mysqli_query($conn, "SELECT * FROM menus;");
                            foreach ($menu as $mn) :
                            ?>
                                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" tabindex="0">
                                    <div class="container">
                                        <div class="homepage1-tab-details">
                                            <div class="homepage1-tab-details-wrapper">
                                                <div class="home1-tab-img">
                                                    <img src="<?= $mn['gambar'] ?>" width="128" height="110" alt="watch-img">
                                                </div>
                                                <div class="home1-tab-details">
                                                    <div class="home1-tab-details-full">
                                                        <p class="tab-home1-txt1"><?= $mn['nama'] ?></p>
                                                        <h3 class="tab-home1-txt2">Rp. <?= number_format($mn['harga']) ?></h3>
                                                    </div>
                                                </div>
                                                <div class="home1-tab-favourite">
                                                    <div class="plus-bnt-home1">
                                                        <form action="/config/order.php" method="post">
                                                            <input type="hidden" name="menu_id" value="<?= $mn['menu_id'] ?>">
                                                            <input type="hidden" name="harga" value="<?= $mn['harga'] ?>">
                                                            <button role="button" type="submit" name="tambah_keranjang">
                                                                <img src="/views/assets/svg/plus-icon.svg" alt="plus-icon">
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            <!-- tab menu kategori -->
                            <?php
                            $makanan = mysqli_query($conn, "SELECT * FROM menus WHERE jenis = 'makanan';");
                            foreach ($makanan as $mkn) :
                            ?>
                                <div class="tab-pane fade" id="pills-makanan" role="tabpanel" tabindex="0">
                                    <div class="container">
                                        <div class="homepage1-tab-details">
                                            <div class="homepage1-tab-details-wrapper">
                                                <div class="home1-tab-img">
                                                    <img src="<?= $mkn['gambar'] ?>" width="128" height="110" alt="watch-img">
                                                </div>
                                                <div class="home1-tab-details">
                                                    <div class="home1-tab-details-full">
                                                        <p class="tab-home1-txt1"><?= $mkn['nama'] ?></p>
                                                        <h3 class="tab-home1-txt2">Rp. <?= number_format($mkn['harga']) ?></h3>
                                                    </div>
                                                </div>
                                                <div class="home1-tab-favourite">
                                                    <div class="plus-bnt-home1">
                                                        <a href="javascript:void(0)">
                                                            <img src="/views/assets/svg/plus-icon.svg" alt="plus-icon">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                            <?php
                            $minuman = mysqli_query($conn, "SELECT * FROM menus WHERE jenis like 'minuman';");
                            foreach ($minuman as $minum) :
                            ?>
                                <div class="tab-pane fade" id="pills-minuman" role="tabpanel" tabindex="0">
                                    <div class="container">
                                        <div class="homepage1-tab-details">
                                            <div class="homepage1-tab-details-wrapper">
                                                <div class="home1-tab-img">
                                                    <img src="<?= $minum['gambar'] ?>" width="128" height="110" alt="watch-img">
                                                </div>
                                                <div class="home1-tab-details">
                                                    <div class="home1-tab-details-full">
                                                        <p class="tab-home1-txt1"><?= $minum['nama'] ?></p>
                                                        <h3 class="tab-home1-txt2">Rp. <?= number_format($minum['harga']) ?></h3>
                                                    </div>
                                                </div>
                                                <div class="home1-tab-favourite">
                                                    <div class="plus-bnt-home1">
                                                        <a href="javascript:void(0)">
                                                            <img src="/views/assets/svg/plus-icon.svg" alt="plus-icon">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            <!-- <div class="tab-pane fade" id="pills-snack" role="tabpanel" tabindex="0">
                                <div class="container">
                                    <div class="homepage1-tab-details">
                                        <div class="homepage1-tab-details-wrapper">
                                            <div class="home1-tab-img">
                                                <img src="/views/assets/images/homescreen-1/arrivals-4.png" alt="watch-img">
                                            </div>
                                            <div class="home1-tab-details">
                                                <div class="home1-tab-details-full">
                                                    <p class="tab-home1-txt1">Girl's Alloy Rose Gold Plated Dual Heart Pendant for mom with</p>
                                                    <h3 class="tab-home1-txt2">Rp. 450.00</h3>
                                                </div>
                                            </div>
                                            <div class="home1-tab-favourite">
                                                <div class="plus-bnt-home1">
                                                    <a href="javascript:void(0)">
                                                        <img src="/views/assets/svg/plus-icon.svg" alt="plus-icon">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Homepage 1 Screen End -->