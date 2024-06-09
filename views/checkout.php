<!-- Checkout Section Start -->
<section id="Checkout-sec" class="checkout-main">
    <div class="container">
        <h1 class="d-none">Checkout Page</h1>
        <div class="Checkout-sec-full">
            <div class="Checkout-first-sec">
                <div class="Checkout-first-sec-full">
                    <span>Pesanan Saya</span>
                    <span>Rp. 300.00</span>
                </div>
                <div class="Checkout-border"></div>
            </div>
            <div class="Checkout-second-sec">
                <div class="Checkout-second-full">
                    <?php
                    for ($i = 0; $i < 2; $i++) {
                    ?>
                        <div class="check-deatils">
                            <span class="check-txt1">Geprek Dada...</span>
                            <span class="check-txt2">1 x Rp. 150.000</span>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="Checkout-third-sec">
                <div class="Checkout-third-sec-full">
                    <a href="#checkout-modal" data-bs-toggle="modal">
                        <div class="shopping-deatils">
                            <div class="check-icon-sec">
                                <img src="/views/assets/svg/location-icon.svg" alt="location-icon">
                            </div>
                            <div class="check-deatils-sec">
                                <p class="shipp-txt1">Alamat Lengkap</p>
                                <p class="shipp-txt2">8000 S Kirkland Ave, Chicago, IL 6065</p>
                            </div>
                            <div class="check-back-sec">
                                <img src="/views/assets/svg/right-icon.svg" alt="right-icon">
                            </div>
                        </div>
                        <div class="shipping-boder"></div>
                    </a>
                    <a href="#checkout-modal-payment" data-bs-toggle="modal">
                        <div class="shopping-deatils mt-16">
                            <div class="check-icon-sec">
                                <img src="/views/assets/images/account-screen/wallet.svg" alt="wallet-icon">
                            </div>
                            <div class="check-deatils-sec">
                                <p class="shipp-txt1">Metode Pembayaran</p>
                                <p class="shipp-txt2">xxxx xxxx xxxx 4865</p>
                            </div>
                            <div class="check-back-sec">
                                <img src="/views/assets/svg/right-icon.svg" alt="right-icon">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="Checkout-fourth-sec">
                <div class="Checkout-fourth-sec-full">
                    <form class="checkout-form">
                        <label>Catatan:</label>
                        <textarea rows="4" placeholder="Tulis catatan disni..." class="product-textarea"></textarea>
                    </form>
                </div>
            </div>
            <div class="confirm-order-btn">
                <a href="/order-success">Konfirmasi Pesanan</a>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
<!-- Checkout Shipping Modal Section Start -->
<div class="modal fade" id="checkout-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content checkout-modal-content">
            <div class="modal-header">
                <p class="checkout-modal-txt1">Tulis Alamat Lengkap Anda</p>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" name="kecamatan" id="kecamatan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kelurahan">Kelurahan</label>
                        <input type="text" name="kelurahan" id="kelurahan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jalan">Jalan</label>
                        <textarea name="jalan" id="jalan" class="form-control"></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <botton class="btn btn-danger">Simpan</botton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Checkout Shipping Modal Section End -->
<!-- Checkout Payment Modal Section Start -->
<div class="modal fade" id="checkout-modal-payment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content checkout-modal-content">
            <div class="modal-header">
                <p class="checkout-modal-txt1">Pilih Metode Pembayaran</p>
            </div>
            <div class="modal-body">
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
    </div>
</div>
<!-- Checkout Payment Modal Section End -->