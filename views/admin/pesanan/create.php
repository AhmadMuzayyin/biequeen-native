<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Pesanan</h1>
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
                    <form action="/config/pesanan.php" method="post">
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="whatsapp" class="col-sm-3 col-form-label">Whatsapp</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="whatsapp" name="whatsapp" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="menu_id" class="col-sm-3 col-form-label">Menu</label>
                                    <div class="col-sm-9">
                                        <?php
                                        $menu = mysqli_query($conn, "SELECT * FROM menus");
                                        ?>
                                        <select class="form-control" id="menu_id" name="menu_id" required>
                                            <?php while ($row = mysqli_fetch_assoc($menu)) : ?>
                                                <option value="<?= $row['menu_id'] ?>"><?= $row['nama'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="catatan" class="col-sm-3 col-form-label">Catatan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="catatan" name="catatan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" min="1" class="form-control" placeholder="Qty" id="jumlah" name="jumlah">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <h5>Total: </h5>
                                            <input type="hidden" min="1" class="form-control" id="total_harga" name="total_harga" placeholder="Total" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="/admin/pesanan" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                        <button type="submit" name="add_pesanan" class="btn btn-danger">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>