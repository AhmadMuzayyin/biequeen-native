<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- // get data menu, pesanan, pengguna, feedback from database using mysqli -->
        <?php
        $menu = mysqli_query($conn, "SELECT * FROM menus");
        $menu = mysqli_num_rows($menu);
        $users = mysqli_query($conn, "SELECT * FROM users");
        $users = mysqli_num_rows($users);
        $order = mysqli_query($conn, "SELECT * FROM orders");
        $order = mysqli_num_rows($order);
        $feedback = mysqli_query($conn, "SELECT * FROM feedbacks");
        $feedback = mysqli_num_rows($feedback);
        ?>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Menu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $menu ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $order; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengguna
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $users ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Feedback</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $feedback ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">

            <!-- Dashboard -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="/views/admin/img/undraw_posting_photo.svg" alt="...">
                    </div>
                    <h3 class="text-uppercase text-center mt-5">
                        Selamat Datang <span class="font-weight-bold"><?= $_SESSION['name'] ?></span> di Dashboard Admin <?= $profil != null ? $profil['nama'] : 'Restaurant' ?>.
                    </h3>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->