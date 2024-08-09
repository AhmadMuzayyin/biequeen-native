<?php
unset($_SESSION['errors']);
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Promo</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <!-- Button trigger modal -->
                        <a href="/admin/promo/create" class="btn btn-danger">
                            <i class="fas fa-plus"></i> Tambah Promo
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nominal</th>
                                    <th>Tanggal Berkahir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $voucher = mysqli_query($conn, "SELECT * FROM vouchers");
                                foreach ($voucher as $item) {
                                ?>
                                    <tr>
                                        <td><?= $item['kode'] ?></td>
                                        <td>Rp.<?= number_format($item['nominal']) ?></td>
                                        <td><?= date('d F Y', strtotime($item['tanggal_berakhir'])) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <!-- edit -->
                                                <a href="/admin/promo/edit?voucher_id=<?= $item['id'] ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <!-- end edit -->
                                                <a href="/config/promo.php?voucher_id=<?= $item['id'] ?>&ac=delete" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>