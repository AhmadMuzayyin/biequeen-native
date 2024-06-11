<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Menu</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <!-- Button trigger modal -->
                        <a href="/admin/create_menu" class="btn btn-danger">
                            <i class="fas fa-plus"></i> Tambah Menu
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Varian</th>
                                    <th>Toping</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Varian</th>
                                    <th>Toping</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $menu = mysqli_query($conn, "SELECT * FROM menus");
                                foreach ($menu as $item) {
                                ?>
                                    <tr>
                                        <td><?= $item['nama'] ?></td>
                                        <td><?= $item['deskripsi'] ?></td>
                                        <td><?= $item['varian'] ?></td>
                                        <td><?= $item['toping'] ?></td>
                                        <td class='text-capitalize'><?= $item['jenis'] ?></td>
                                        <td>Rp.<?= number_format($item['harga']) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <!-- detail -->
                                                <button type="button" class="btn btn-info btn-sm" data-target="#detailMenu-<?= $item['menu_id'] ?>" data-toggle="modal">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="detailMenu-<?= $item['menu_id'] ?>" tabindex="-1">
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
                                                                        <td><?= $item['nama'] ?></td>
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
                                                                        <td>Created_at</td>
                                                                        <td>
                                                                            <?= date('d F Y', strtotime($item['created_at'])) ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Updated_at</td>
                                                                        <td>
                                                                            <?= date('d F Y', strtotime($item['created_at'])) ?>
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
                                                <a href="/admin/edit_menu?menu_id=<?= $item['menu_id'] ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <!-- end edit -->
                                                <a href="/config/menu.php?menu_id=<?= $item['menu_id'] ?>&ac=delete" class="btn btn-danger btn-sm">
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