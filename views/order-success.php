<?php
$profil = mysqli_query($conn, "SELECT * FROM company_profiles");
$profil = mysqli_fetch_assoc($profil);
?>
<!-- OrderSucceesfully Section Start -->
<section id="oder-success-screen">
    <div class="container">
        <div class="oder-success-screen-full">
            <div class="oder-success-img">
                <!-- <img src="/views/assets/images/oder-successfull/successfull.png" alt="order-img" class="img-fluid"> -->
                <img src="<?= $profil['logo'] ?>" width="343" height="343" alt="order-img" class="img-fluid">
            </div>
            <div class="oder-success-content mt-32">
                <div class="oder-success-content-full text-center">
                    <h1>Terima Kasih Atas Pesanan Anda!</h1>
                    <p>Pesanan Anda sedang disiapkan.</p>
                    <?php
                    session_start();
                    if (isset($_SESSION['pembayaran'])) {
                        if ($_SESSION['pembayaran'] == 'cod') {
                            echo "<p>Silahkan tunggu konfirmasi dari kami melalui WhatsApp.</p>";
                        } else {
                    ?>
                            <p>Silahkan lakukan pembayaran ke rekening berikut dan konfimasi ke admin:</p>
                            <img src='<?= $profil['qris_pembayaran'] ?>' width="200" height="230" alt="qris_pembayaran">
                            <p>
                                <a href="https://wa.me/<?= $profil['whatsapp'] ?>" target="_blank">Konfimasi</a>
                            </p>
                    <?php
                        }
                    }
                    ?>
                    <div class="success-home">
                        <a href="/">Go To Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- OrderSucceesfully Section End -->