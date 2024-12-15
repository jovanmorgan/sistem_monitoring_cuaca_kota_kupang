    <?php
    // Lakukan koneksi ke database
    include '../../keamanan/koneksi.php';

    // Periksa apakah session id_admin telah diset
    if (isset($_SESSION['id_admin'])) {
        $id_admin = $_SESSION['id_admin'];

        // Query SQL untuk mengambil data admin berdasarkan id_admin dari session
        $query = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
        $result = mysqli_query($koneksi, $query);

        // Periksa apakah query berhasil dieksekusi
        if ($result) {
            // Periksa apakah terdapat data admin
            if (mysqli_num_rows($result) > 0) {
                // Ambil data admin sebagai array asosiatif
                $admin = mysqli_fetch_assoc($result);
    ?>
    <div class="main-header">
        <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">
                <a href="index.html" class="logo">
                    <img src="../../assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                        height="20" />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
            data-background-color="blue">
            <div class="container-fluid">
                <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-search pe-1">
                                <i class="fa fa-search search-icon"></i>
                            </button>
                        </div>
                        <input type="text" placeholder="Search ..." class="form-control" />
                    </div>
                </nav>

                <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                    <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false" aria-haspopup="true">
                            <i class="fa fa-search"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-search animated fadeIn">
                            <form class="navbar-left navbar-form nav-search">
                                <div class="input-group">
                                    <input type="text" placeholder="Search ..." class="form-control" />
                                </div>
                            </form>
                        </ul>
                    </li>

                    <li class="nav-item topbar-user dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <?php if (!empty($admin['fp'])): ?>
                                <img src="../../assets/img/fp_pengguna/admin/<?php echo $admin['fp']; ?>" alt="..."
                                    class="avatar-img rounded-circle" />
                                <?php else: ?>
                                <img src="../../assets/img/avatar/avatar.png" alt="..."
                                    class="avatar-img rounded-circle" />
                                <?php endif; ?>
                            </div>
                            <span class="profile-username">
                                <span class="op-7">Hay,</span>
                                <span class="fw-bold"><?php echo $admin['nama_lengkap']; ?></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg">
                                            <?php if (!empty($admin['fp'])): ?>
                                            <img src="../../assets/img/fp_pengguna/admin/<?php echo $admin['fp']; ?>"
                                                alt="image profile" class="avatar-img rounded" />
                                            <?php else: ?>
                                            <img src="../../assets/img/avatar/avatar.png" alt="..." alt="image profile"
                                                class="avatar-img rounded" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="u-text">
                                            <span class="op-7">Hay,</span>
                                            <span class="fw-bold"><?php echo $admin['nama_lengkap']; ?></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="profile">My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="log_out">Logout</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>

    <?php
            } else {
                // Jika tidak ada data admin
                echo "Tidak ada data admin.";
            }
        } else {
            // Jika query tidak berhasil dieksekusi
            echo "Gagal mengambil data admin: " . mysqli_error($koneksi);
        }
    } else {
        // Jika session id_admin tidak diset
        echo "Session id_admin tidak tersedia.";
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
    ?>