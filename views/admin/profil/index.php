<?php
$query = mysqli_query($conn, "SELECT * FROM company_profiles");
$profil = mysqli_fetch_assoc($query);
$count = mysqli_num_rows($query);
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profil Perusahaan</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['errors'])) { ?>
                        <ul style="color:red;">
                            <?php foreach ($_SESSION['errors'] as $error) {
                                echo "<li>$error</li>";
                            } ?>
                        </ul>
                    <?php } ?>
                    <form action="/config/profil.php" method="post" enctype="multipart/form-data">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $profil['nama'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $profil['email'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>
                                    <textarea class="form-control" id="alamat" name="alamat"><?= $profil['alamat'] ?></textarea>
                                </td>
                            </tr>
                            <?php if ($profil['logo']) : ?>
                                <tr>
                                    <td>
                                        <img src="<?= $profil['logo'] ?>" alt="<?= $profil['nama'] ?>" width="100">
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td>Logo</td>
                                <td>
                                    <input type="file" class="form-control" id="logo" name="logo">
                                </td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"><?= $profil['deskripsi'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Whatsapp</td>
                                <td>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= $profil['whatsapp'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Facebook</td>
                                <td>
                                    <input type="text" class="form-control" id="facebook" name="facebook" value="<?= $profil['facebook'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Instagram</td>
                                <td>
                                    <input type="text" class="form-control" id="instagram" name="instagram" value="<?= $profil['instagram'] ?>">
                                </td>
                            </tr>
                            <?php if ($profil['qris_pembayaran']) : ?>
                                <tr>
                                    <td>
                                        <img src="<?= $profil['qris_pembayaran'] ?>" alt="<?= $profil['nama'] ?>" width="100">
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td>Qris Pembayaran</td>
                                <td>
                                    <input type="file" class="form-control" id="qris_pembayaran" name="qris_pembayaran">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" class="btn btn-danger">
                                        <?php if ($count > 0) : ?>
                                            <input type="hidden" name="id" value="<?= $profil['id'] ?>">
                                            <input type="hidden" name="update_profil" value="1">
                                            Perbarui
                                        <?php else : ?>
                                            <input type="hidden" name="add_profil" value="1">
                                            Simpan
                                        <?php endif; ?>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>