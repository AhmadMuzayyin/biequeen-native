<?php
$menu_id = $_GET['menu_id'];
$menu = mysqli_query($conn, "SELECT * FROM menus WHERE menu_id = $menu_id limit 1");
$menu = mysqli_fetch_assoc($menu);
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Menu</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
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
                    <form action="/config/menu.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $menu['nama'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="deskripsi" name="deskripsi"><?= $menu['deskripsi'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="varian" class="col-sm-3 col-form-label">Varian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="varian" name="varian" value="<?= $menu['varian'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="toping" class="col-sm-3 col-form-label">Toping</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="toping" name="toping" value="<?= $menu['toping'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis" class="col-sm-3 col-form-label">Jenis</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="jenis" name="jenis" required>
                                    <option value="makanan" <?= $menu['jenis'] == 'makanan' ? 'selected' : '' ?>>Makanan</option>
                                    <option value="minuman" <?= $menu['jenis'] == 'minuman' ? 'selected' : '' ?>>Minuman</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $menu['harga'] ?>" required>
                            </div>
                        </div>
                        <?php if ($menu['gambar']) : ?>
                            <div class="form-group row">
                                <label for="gambar" class="col-sm-3 col-form-label">Gambar</label>
                                <div class="col-sm-9">
                                    <img src="<?= $menu['gambar'] ?>" alt="<?= $menu['nama'] ?>" width="150" class="img-thumbnail">
                                </div>
                            </div>
                            <input type="hidden" name="existing_gambar" value="<?= $menu['gambar'] ?>">
                        <?php endif; ?>
                        <div class="form-group row">
                            <label for="gambar" class="col-sm-3 col-form-label">Gambar</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="gambar" name="gambar">
                            </div>
                        </div>
                        <input type="hidden" name="menu_id" value="<?= $menu['menu_id'] ?>">
                        <a href="/admin/menu" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update_menu" class="btn btn-danger">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>