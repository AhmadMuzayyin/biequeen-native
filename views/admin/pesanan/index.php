<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pesanan</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <!-- Button trigger modal -->
                        <a href="/admin/pesanan/create" class="btn btn-danger">
                            <i class="fas fa-plus"></i> Tambah Pesanan
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Whatsapp</th>
                                    <th>Pesanan</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "
                                    SELECT 
                                        orders.id, orders.nama_pelanggan, orders.whatsapp, orders.jumlah, orders.total_harga, orders.catatan, 
                                        menus.nama AS pesanan, menus.deskripsi, menus.harga AS harga , orders.status, orders.created_at, menus.gambar, menus.varian, menus.toping, menus.jenis, menus.menu_id
                                    FROM 
                                        orders
                                    JOIN 
                                        menus ON orders.menu_id = menus.menu_id
                                    WHERE in_cart = 0
                                    ORDER BY 
                                        orders.created_at DESC;
                                    ";
                                $data = mysqli_query($conn, $sql);
                                foreach ($data as $key => $item) {
                                ?>
                                    <tr>
                                        <td><?= $item['nama_pelanggan'] ?></td>
                                        <td>
                                            <a href="https://wa.me/<?= $item['whatsapp'] ?>" target="_blank"><?= $item['whatsapp'] ?></a>
                                        </td>
                                        <td><?= $item['pesanan'] ?></td>
                                        <td>Rp.<?= number_format($item['harga']) ?></td>
                                        <td><?= $item['jumlah'] ?></td>
                                        <td>Rp.<?= number_format($item['total_harga']) ?></td>
                                        <td>
                                            <?php if ($item['status'] != 'Dibatalkan' && $item['status'] != 'Selesai') : ?>
                                                <select name="status" id="status-tabel<?= $item['id'] ?>" class="form-control">
                                                    <option value="Menunggu" <?= $item['status'] == 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                                    <option value="Diproses" <?= $item['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                                                    <option value="Selesai" <?= $item['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                                    <option value="Dibatalkan" <?= $item['status'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                                </select>
                                                <?php start_push('js'); ?>
                                                <script>
                                                    $(function() {
                                                        $('#status-tabel<?= $item['id'] ?>').on('change', function() {
                                                            $.ajax({
                                                                url: '/config/pesanan.php',
                                                                method: 'POST',
                                                                data: {
                                                                    order_id: <?= $item['id'] ?>,
                                                                    new_status: $(this).val(),
                                                                },
                                                                success: function(data) {
                                                                    setTimeout(() => {
                                                                        location.reload();
                                                                    }, 1000);
                                                                }

                                                            })
                                                        })
                                                    })
                                                </script>
                                                <?php end_push('js'); ?>
                                            <?php elseif ($item['status'] == 'Dibatalkan') : ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?= $item['status'] ?>
                                                </div>
                                            <?php else : ?>
                                                <div class="alert alert-success" role="alert">
                                                    <?= $item['status'] ?>
                                                </div>
                                            <?php endif ?>
                                        </td>
                                        <!-- <td><?= date('d F Y', strtotime($item['created_at'])) ?></td> -->
                                        <td>
                                            <div class="btn-group">
                                                <!-- detail -->
                                                <button type="button" class="btn btn-info btn-sm" data-target="#detailMenu-<?= $key ?>" data-toggle="modal">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="detailMenu-<?= $key ?>" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail Menu</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table">
                                                                    <tr>
                                                                        <td>Nama</td>
                                                                        <td><?= $item['pesanan'] ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Deskripsi</td>
                                                                        <td><?= $item['deskripsi'] ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Varian</td>
                                                                        <td><?= $item['varian'] ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Toping</td>
                                                                        <td><?= $item['toping'] ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Jenis</td>
                                                                        <td class='text-capitalize'><?= $item['jenis'] ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Harga</td>
                                                                        <td>Rp.<?= number_format($item['harga']) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Gambar</td>
                                                                        <td>
                                                                            <img src="<?= $item['gambar'] ?>" alt="<?= $item['nama'] ?>" class="img-thumbnail" width="100">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Catatan</td>
                                                                        <td>
                                                                            <?= $item['catatan'] ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end Modal -->
                                                <!-- end detail -->
                                                <!-- edit -->
                                                <!-- <a href="/admin/edit_menu?menu_id=<?= $item['menu_id'] ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a> -->
                                                <!-- end edit -->
                                                <a href="/config/pesanan.php?menu_id=<?= $item['menu_id'] ?>&pesanan_id=<?= $item['id'] ?>&ac=delete" class="btn btn-danger btn-sm">
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