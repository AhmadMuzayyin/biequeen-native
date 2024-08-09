<?php
$pengguna_id = $_GET['pengguna_id'];
$pengguna = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $pengguna_id limit 1");
$pengguna = mysqli_fetch_assoc($pengguna);
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Pengguna</h1>
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
                    <form action="/config/pengguna.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?= $pengguna['user_id'] ?>">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="<?= $pengguna['name'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" value="<?= $pengguna['email'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-3 col-form-label">Password Confirmation</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="role" name="role" required>
                                    <option value="Admin" <?= $pengguna['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="Kasir" <?= $pengguna['role'] == 'Kasir' ? 'selected' : '' ?>>Kasir</option>
                                </select>
                            </div>
                        </div>
                        <a href="/admin/pengguna" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update_pengguna" class="btn btn-danger">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>