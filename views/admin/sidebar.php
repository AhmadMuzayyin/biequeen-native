<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <img src="/views/assets/images/favicon/icon.png" alt="logo" class="img-fluid shadow" width="50">
        </div>
        <div class="sidebar-brand-text mx-3"><?= $profil != null ? $profil['nama'] : 'Restaurant' ?> <sup>V1.0</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <?php $page = $request_uri; ?>
    <li class="nav-item <?= $page == 'admin' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= $page == 'admin/menu' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/menu">
            <i class="fas fa-list-ol"></i>
            <span>Menu</span></a>
    </li>
    <li class="nav-item <?= $page == 'admin/pesanan' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/pesanan">
            <i class="fas fa-dolly"></i>
            <span>Pesanan</span></a>
    </li>
    <li class="nav-item <?= $page == 'admin/promo' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/promo">
            <i class="fas fa-percent"></i>
            <span>Promo</span></a>
    </li>
    <li class="nav-item <?= $page == 'admin/pengguna' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/pengguna">
            <i class="fas fa-users"></i>
            <span>Pengguna</span></a>
    </li>
    <li class="nav-item <?= $page == 'admin/profil' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/profil">
            <i class="far fa-id-badge"></i>
            <span>Profil</span></a>
    </li>
    <li class="nav-item <?= $page == 'admin/admin-feedback' ? 'active' : '' ?>">
        <a class="nav-link" href="/admin/admin-feedback">
            <i class="fas fa-comment-dots"></i>
            <span>Feedback</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->