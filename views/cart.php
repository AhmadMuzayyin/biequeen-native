<!-- Without Promocode Section Start -->
<section id="cart-without-promocode">
    <div class="container">
        <h1 class="d-none">Promocode Details</h1>
        <h2 class="d-none">Promocode</h2>
        <div class="cart-without-promocode-full">
            <?php
            for ($i = 0; $i < 2; $i++) {
            ?>
                <div class="cart-without-promocode-first <?= $i > 0 ? 'mt-16' : '' ?>">
                    <div class="cart-without-promocode-first-full">
                        <div>
                            <div class="cart-without-img-sec">
                                <img src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/718fa01a-8c35-4def-a9ad-d573b608c23c_Go-Biz_20210329_214756.jpeg" width="140" height="140" alt="clothes-img">
                            </div>
                        </div>
                        <div class="cart-without-content-sec">
                            <div class="cart-without-content-sec-full">
                                <p class="price-code-txt1">Geprek Dada</p>
                                <p class="price-code-txt2">Rp. 150.00</p>
                                <div class="card-without-price-sec">
                                    <div class="price-code-txt3">
                                        <span>Varian:</span>
                                        <span>tilt</span>
                                    </div>
                                    <div class="price-code-txt3">
                                        <span>Toping:</span>
                                        <span>M</span>
                                    </div>
                                </div>
                                <div class="card-without-promocode-increment">
                                    <div class="product-incre">
                                        <a href="javascript:void(0)" class="product__minus sub">
                                            <span>
                                                <img src="/views/assets/svg/minus-icon.svg" alt="minus-icon">
                                            </span>
                                        </a>
                                        <input name="quantity" type="text" class="product__input" value="1">
                                        <a href="javascript:void(0)" class="product__plus add">
                                            <span>
                                                <img src="/views/assets/svg/plus-icon.svg" alt="plus-icon">
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart-boder mt-16"></div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="without-code-second">
            <div class="without-code-second-full">
                <p>Nama</p>
                <div class="code-details mt-16">
                    <div class="enter-code-promocode1">
                        <input type="text" value="" name="" id="">
                    </div>
                </div>
            </div>
            <div class="without-code-second-full mt-2">
                <p>Whatsapp</p>
                <div class="code-details mt-16">
                    <div class="enter-code-promocode1">
                        <input type="text" value="" name="" id="">
                    </div>
                </div>
            </div>
            <div class="without-code-second-full mt-2">
                <p>Kode Promo:</p>
                <div class="code-details mt-16">
                    <div class="enter-code-promocode1">
                        <input type="text" value="20firstorder">
                    </div>
                    <div class="code-plus-btn code-cancel-btn">
                        <a href="javascript:void(0)">
                            <img src="/views/assets/svg/cancel-icon.svg" alt="cancel-icon">
                        </a>
                    </div>
                </div>
            </div>
            <div class="cart-boder mt-24"></div>
        </div>
        <div class="check-page-bottom mt-24">
            <div class="check-page-bottom-deatails">
                <div class="check-price-name1">
                    <p>Subtotal</p>
                </div>
                <div class="check-price-list1">
                    <p>Rp. 300.00</p>
                </div>
            </div>
            <div class="check-page-bottom-deatails mt-8">
                <div class="check-price-name">
                    <p>Diskon</p>
                </div>
                <div>
                    <p class="col-green">Rp. 0.00</p>
                </div>
            </div>
            <div class="cart-boder mt-24"></div>
        </div>
        <div class="without-code-last mt-24">
            <div class="without-code-last-full">
                <div>
                    <p class="total-txt">Total:</p>
                    <p class="price-txt">Rp. 300.00</p>
                </div>
                <div class="proceed-to check-btn">
                    <a href="/checkout">Proses Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Without Promocode Section End -->