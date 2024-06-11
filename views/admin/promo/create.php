<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kode Promo</h1>
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
                    <form action="/config/promo.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kode" class="col-sm-3 col-form-label">Kode</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kode" name="kode" required>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                            <div class="col-sm-9">
                                <input type="number" min="1000" class="form-control" id="nominal" name="nominal" required>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="tanggal_berakhir" class="col-sm-3 col-form-label">Tanggal Berakhir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir">
                            </div>
                        </div>
                        <input type="hidden" name="voucher_id">
                        <a href="/admin/promo" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="create" class="btn btn-danger">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>