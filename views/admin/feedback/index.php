<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Feedback</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Whatsapp</th>
                                    <th>pesan</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $menu = mysqli_query($conn, "SELECT * FROM feedbacks");
                                foreach ($menu as $item) {
                                ?>
                                    <tr>
                                        <td><?= $item['nama'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td><?= $item['whatsapp'] ?></td>
                                        <td><?= $item['pesan'] ?></td>
                                        <td><?= date('d F Y', strtotime($item['created_at'])) ?></td>
                                        <td><?= date('d F Y', strtotime($item['updated_at'])) ?></td>
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