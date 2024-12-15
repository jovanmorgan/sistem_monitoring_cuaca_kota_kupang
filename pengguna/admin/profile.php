<?php include 'fitur/penggunah.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'fitur/head.php'; ?>
<?php include 'fitur/nama_halaman.php'; ?>
<?php include 'fitur/nama_halaman_proses.php'; ?>

<body>
    <div class="wrapper">
        <?php include 'fitur/sidebar.php'; ?>
        <div class="main-panel">
            <?php include 'fitur/navbar.php'; ?>
            <div class="container">
                <div class="page-inner">
                    <?php include 'fitur/papan_halaman.php'; ?>

                    <div id="load_data">
                        <section class="section profile">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="card">
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
                                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                            <a href="javascript:void(0)"
                                                onclick="document.getElementById('editFotoProfile').click()">
                                                <?php if (!empty($admin['fp'])): ?>
                                                <img src="../../assets/img/fp_pengguna/admin/<?php echo $admin['fp']; ?>"
                                                    alt="Profile" class="gbrr rounded-circle" width="150" />
                                                <?php else: ?>
                                                <img src="../../assets/img/avatar/avatar.png" alt="ananddavis"
                                                    class="img-fluid" width="150" />
                                                <?php endif; ?>
                                            </a>
                                            <!-- Input file tersembunyi untuk memilih gambar -->
                                            <input type="file" class="d-none" id="editFotoProfile"
                                                name="editFotoProfile" accept="image/*"
                                                onchange="previewAndUpdateProfile(this)">

                                            <!-- Modal -->
                                            <div class="modal fade" id="editFotoProfileModal" tabindex="-1"
                                                aria-labelledby="editFotoProfileModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editFotoProfileModalLabel">Edit
                                                                Foto Profile
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                id="closeTambahModal" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="gambar">
                                                                <img id="editFotoProfilePreview" src="#"
                                                                    alt="Preview Foto Profile" class="img-fluid">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"
                                                                onclick="location.reload();">Close</button>
                                                            <button type="button" class="btn btn-primary"
                                                                id="btnSaveProfile">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="text-center mt-3"><?php echo $admin['nama_lengkap']; ?></h4>
                                            <h5 class="text-center mb-2"><?php echo $admin['username']; ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                .profile-picturess .gbrr {
                                    border-radius: 50%;
                                    /* Sesuaikan dengan ukuran yang diinginkan */
                                    object-fit: cover;
                                    /* Memastikan gambar mengisi area tanpa distorsi */
                                }

                                .gambar {
                                    max-width: 500px;
                                    height: 500px;
                                }
                                </style>
                                <div class="col-xl-8">
                                    <div class="card">
                                        <div class="card-body pt-3">
                                            <!-- Bordered Tabs -->
                                            <ul class="nav nav-tabs nav-tabs-bordered">
                                                <li class="nav-item">
                                                    <button class="nav-link active" data-bs-toggle="tab"
                                                        data-bs-target="#profile-overview">
                                                        Overview
                                                    </button>
                                                </li>

                                                <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab"
                                                        data-bs-target="#profile-edit">
                                                        Edit Profile
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="tab-content pt-2">
                                                <div class="tab-pane fade show active profile-overview"
                                                    id="profile-overview">

                                                    <h5 class="card-title mt-3">Profile Details</h5>

                                                    <div class="row mt-3">
                                                        <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                                        <div class="col-lg-9 col-md-8">
                                                            <?php echo $admin['nama_lengkap']; ?>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-lg-3 col-md-4 label">Nomor Pengguna</div>
                                                        <div class="col-lg-9 col-md-8">
                                                            <?php echo $admin['username']; ?>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-lg-3 col-md-4 label">Passweord</div>
                                                        <div class="col-lg-9 col-md-8"><?php echo $admin['password']; ?>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                                    <!-- Profile Edit Form -->
                                                    <form id="editProfileForm">
                                                        <input type="text" name="id_admin" id="id_admin"
                                                            value="<?php echo $admin['id_admin']; ?>" hidden>
                                                        <div class="row mb-3">
                                                            <label for="fullName"
                                                                class="col-md-4 col-lg-3 col-form-label">Nama
                                                                Lengkap</label>
                                                            <div class="col-md-8 col-lg-9">
                                                                <input name="nama_lengkap" type="text"
                                                                    class="form-control" id="nama_lengkap"
                                                                    value="<?php echo $admin['nama_lengkap']; ?>" />
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="username"
                                                                class="col-md-4 col-lg-3 col-form-label">Nomor
                                                                Pengguna</label>
                                                            <div class="col-md-8 col-lg-9">
                                                                <input name="username" type="text" class="form-control"
                                                                    id="username"
                                                                    value="<?php echo $admin['username']; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="password"
                                                                class="col-md-4 col-lg-3 col-form-label">Password</label>
                                                            <div class="col-md-8 col-lg-9">
                                                                <input name="password" type="text" class="form-control"
                                                                    id="password"
                                                                    value="<?php echo $admin['password']; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary">
                                                                Save Data
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <!-- End Profile Edit Form -->
                                                </div>
                                            </div>
                                            <!-- End Bordered Tabs -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
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

                    <!-- Loading Element -->
                    <div class="loading" style="display: none;">
                        <div class="spinner"></div>
                    </div>

                    <!-- CSS for Loading Spinner -->
                    <style>
                    .loading {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        background-color: rgba(0, 0, 0, 0.5);
                        z-index: 9999;
                    }

                    .spinner {
                        width: 50px;
                        height: 50px;
                        border: 5px solid #f3f3f3;
                        border-top: 5px solid #3498db;
                        border-radius: 50%;
                        animation: spin 1s linear infinite;
                    }

                    @keyframes spin {
                        0% {
                            transform: rotate(0deg);
                        }

                        100% {
                            transform: rotate(360deg);
                        }
                    }
                    </style>
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"
                        rel="stylesheet">
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                    // Variabel global untuk menyimpan instance Cropper
                    var cropper;

                    const loding = document.querySelector('.loading');

                    // Fungsi untuk menampilkan gambar yang dipilih dan menampilkan modal
                    function previewAndUpdateProfile(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#editFotoProfilePreview').attr('src', e.target.result);
                                $('#editFotoProfileModal').modal('show');
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    // Fungsi untuk memotong gambar dan menyimpannya
                    function cropImage() {
                        var croppedCanvas = cropper.getCroppedCanvas({
                            width: 200, // Tentukan lebar gambar yang diinginkan
                            height: 200 // Tentukan tinggi gambar yang diinginkan
                        });
                        var croppedDataUrl = croppedCanvas.toDataURL();

                        // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                        loding.style.display = 'flex';

                        // Simpan data gambar ke server menggunakan AJAX
                        $.ajax({
                            type: 'POST',
                            url: 'proses/akun/foto_profile.php',
                            data: {
                                imageBase64: croppedDataUrl
                            },
                            success: function(response) {

                                // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                                loding.style.display = 'none';

                                // Tampilkan sweet alert dengan pesan respon tanpa tombol OK dan hilang dalam 1,5 detik
                                swal({
                                    title: "Sukses!",
                                    text: "Foto profile berhasil diperbarui.",
                                    icon: "success",
                                    timer: 1500,
                                    buttons: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                // Tampilkan sweet alert dengan pesan error
                                swal("Error!", xhr.responseText, "error");
                            }
                        });

                        // Sembunyikan modal pemotongan gambar
                        $('#editFotoProfileModal').modal('hide');
                    }

                    $(document).ready(function() {
                        $('#editFotoProfileModal').on('shown.bs.modal', function() {
                            // Inisialisasi Cropper setelah modal ditampilkan
                            var containerWidth = $('.gambar').width();
                            var containerHeight = $('.gambar').height();
                            cropper = new Cropper($('#editFotoProfilePreview')[0], {
                                aspectRatio: 1, // 1:1 aspect ratio
                                viewMode: 1, // Crop mode
                                minContainerWidth: containerWidth, // Set minimum container width to match image container width
                                minContainerHeight: containerHeight, // Set minimum container height to match image container height
                            });
                        });

                        $('#btnSaveProfile').on('click', function() {
                            cropImage();
                        });

                        $('#editFotoProfileModal').on('hidden.bs.modal', function() {
                            // Hapus cropper ketika modal ditutup
                            if (cropper) {
                                cropper.destroy();
                            }
                        });
                    });

                    $(document).ready(function() {
                        $('#editProfileForm').on('submit', function(event) {
                            event.preventDefault(); // Mencegah perilaku default form submit

                            // Tangkap data formulir
                            var formData = $('#editProfileForm').serialize();

                            // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                            loding.style.display = 'flex';

                            $.ajax({
                                type: 'POST',
                                url: 'proses/akun/data_profile.php',
                                data: formData, // Kirim data formulir yang telah ditangkap
                                success: function(response) {

                                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                                    loding.style.display = 'none';

                                    // Periksa apakah respons adalah 'success'
                                    if (response === 'success') {
                                        // Tampilkan sweet alert dengan pesan sukses tanpa tombol OK dan hilang dalam 1,5 detik
                                        swal({
                                            title: "Sukses!",
                                            text: "Data diri berhasil diperbarui",
                                            icon: "success",
                                            timer: 1500,
                                            buttons: false
                                        }).then(() => {
                                            location
                                                .reload(); // Muat ulang halaman setelah SweetAlert hilang
                                        });
                                    } else if (response === 'error_username_exists') {
                                        // Jika Nomor Pengguna sudah ada, tampilkan pesan khusus
                                        swal({
                                            title: "Nomor Pengguna Sudah Ada!",
                                            text: "Nomor Pengguna yang Anda masukkan sudah terdaftar",
                                            icon: "info",
                                            timer: 1500,
                                            buttons: false
                                        });
                                    } else {
                                        // Jika respons adalah sesuatu yang tidak diharapkan, tampilkan pesan error
                                        swal({
                                            title: "Error!",
                                            text: response,
                                            icon: "error",
                                            timer: 1500,
                                            buttons: false
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // Tampilkan sweet alert dengan pesan error
                                    swal("Error!", xhr.responseText, "error");
                                }
                            });
                        });
                    });
                    </script>
                    <!--   Core JS Files   -->
                    <script src="../../assets/js/core/jquery.min.js?v=<?= time(); ?>"></script>
                    <script src="../../assets/js/core/popper.min.js?v=<?= time(); ?>"></script>
                    <script src="../../assets/js/core/bootstrap.min.js?v=<?= time(); ?>"></script>
                    <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js?v=<?= time(); ?>"></script>
                    <?php include 'fitur/js.php'; ?>
</body>

</html>