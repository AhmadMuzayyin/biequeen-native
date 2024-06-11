<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pengguna</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <!-- Button trigger modal -->
                        <a href="/admin/pengguna/create" class="btn btn-danger">
                            <i class="fas fa-plus"></i> Tambah Pengguna
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = mysqli_query($conn, "SELECT * FROM users");
                                foreach ($data as $item) {
                                ?>
                                    <tr>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td><?= $item['role'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <!-- edit -->
                                                <a href="/admin/pengguna/edit?pengguna_id=<?= $item['user_id'] ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <!-- end edit -->
                                                <a href="/config/pengguna.php?pengguna_id=<?= $item['user_id'] ?>&ac=delete" class="btn btn-danger btn-sm">
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