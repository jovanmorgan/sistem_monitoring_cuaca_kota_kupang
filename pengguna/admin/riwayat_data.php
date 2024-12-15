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
                        <section class="section">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <!-- Search Form -->
                                            <form method="GET" action="">
                                                <div class="input-group mt-3">
                                                    <input type="text" class="form-control"
                                                        placeholder="Cari jabatan atau nomor rekening..." name="search"
                                                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                                    <button class="btn btn-outline-secondary"
                                                        type="submit">Cari</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <?php
                        include '../../keamanan/koneksi.php';

                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $limit = 10;
                        $offset = ($page - 1) * $limit;

                        // Query untuk mendapatkan data sistem dan sistem dengan pencarian dan pagination
                        $query = "
                                    SELECT sistem.*
                                    FROM sistem 
                                    WHERE sistem.suhu LIKE ? 
                                    OR sistem.tekanan LIKE ? 
                                    OR sistem.ketinggian LIKE ? 
                                    OR sistem.kelembaban LIKE ? 
                                    OR sistem.waktu LIKE ? 
                                    LIMIT ?, ?";

                        $stmt = $koneksi->prepare($query);
                        $search_param = '%' . $search . '%';
                        $stmt->bind_param("sssssii", $search_param, $search_param, $search_param, $search_param, $search_param, $offset, $limit);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Hitung total halaman
                        $total_query = "
    SELECT COUNT(*) as total 
    FROM sistem 
    WHERE sistem.tekanan LIKE ? 
    OR sistem.suhu LIKE ? 
    OR sistem.ketinggian LIKE ? 
    OR sistem.kelembaban LIKE ?
    OR sistem.waktu LIKE ?";

                        $stmt_total = $koneksi->prepare($total_query);
                        $stmt_total->bind_param("sssss", $search_param, $search_param, $search_param, $search_param, $search_param);
                        $stmt_total->execute();
                        $total_result = $stmt_total->get_result();
                        $total_row = $total_result->fetch_assoc();
                        $total_pages = ceil($total_row['total'] / $limit);
                        ?>

                        <!-- Tabel Data sistem -->
                        <section class="section">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body" style="overflow-x: hidden;">
                                            <div style="overflow-x: auto;">
                                                <?php if ($result->num_rows > 0): ?>
                                                <table class="table table-hover text-center mt-3"
                                                    style="border-collapse: separate; border-spacing: 0;">
                                                    <thead>
                                                        <tr>
                                                            <th>Nomor</th>
                                                            <th>Tekanan</th>
                                                            <th>Suhu</th>
                                                            <th>Ketinggihan</th>
                                                            <th>Kelembaban</th>
                                                            <th>Waktu</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $nomor = $offset + 1;
                                                            while ($row = $result->fetch_assoc()) :
                                                            ?>
                                                        <tr>
                                                            <td><?php echo $nomor++; ?></td>
                                                            <td><?php echo htmlspecialchars($row['tekanan']); ?>
                                                            </td>
                                                            <td><?php echo htmlspecialchars($row['suhu']); ?>
                                                            </td>
                                                            <td><?php echo htmlspecialchars($row['ketinggian']); ?>
                                                            </td>
                                                            <td><?php echo htmlspecialchars($row['kelembaban']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['waktu']); ?></td>
                                                            <td>
                                                                <button class="btn btn-danger btn-sm"
                                                                    onclick="hapus('<?php echo $row['id_sistem']; ?>')">Hapus</button>
                                                            </td>

                                                        </tr>
                                                        <?php endwhile; ?>
                                                    </tbody>
                                                </table>
                                                <?php else: ?>
                                                <p class="text-center mt-4">Data tidak ditemukan.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                        <!-- Pagination Section -->
                        <section class="section">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <!-- Pagination with icons -->
                                            <nav aria-label="Pagxample" style="margin-top: 2.2rem;">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item <?php if ($page <= 1) {
                                                                                echo 'disabled';
                                                                            } ?>">
                                                        <a class="page-link" href="<?php if ($page > 1) {
                                                                                        echo "?page=" . ($page - 1) . "&search=" . $search;
                                                                                    } ?>" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                                    <li class="page-item <?php if ($i == $page) {
                                                                                    echo 'active';
                                                                                } ?>">
                                                        <a class="page-link"
                                                            href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
                                                    </li>
                                                    <?php } ?>
                                                    <li class="page-item <?php if ($page >= $total_pages) {
                                                                                echo 'disabled';
                                                                            } ?>">
                                                        <a class="page-link" href="<?php if ($page < $total_pages) {
                                                                                        echo "?page=" . ($page + 1) . "&search=" . $search;
                                                                                    } ?>" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <!-- End Pagination with icons -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahDataModalLabel">Tambah <?= $page_title ?></h5>
                            <button type="button" class="btn-close" id="closeTambahModal" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="tambahForm" method="POST" action="proses/<?= $page_title_proses ?>/tambah.php"
                                enctype="multipart/form-data">
                                <!-- sistem (Select Option) -->
                                <div class="mb-3">
                                    <label for="id_sistem" class="form-label">Nama sistem</label>
                                    <select id="id_sistem" name="id_sistem" class="form-control" required>
                                        <option value="" selected>Silakan pilih sistem</option>
                                        <?php
                                        $sistem_query = "SELECT id_sistem, tekanan FROM sistem";
                                        $sistem_result = mysqli_query($koneksi, $sistem_query);
                                        while ($sistem = mysqli_fetch_assoc($sistem_result)) {
                                            echo "<option value='{$sistem['id_sistem']}'>{$sistem['tekanan']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="suhu" class="form-label">Tanggal sistem</label>
                                    <input type="date" id="suhu" name="suhu" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="ketinggian" class="form-label">Tempat sistem</label>
                                    <input type="text" id="ketinggian" name="ketinggian" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="kelembaban" class="form-label">SK sistem</label>
                                    <input type="text" id="kelembaban" name="kelembaban" class="form-control" required>
                                </div>

                                <!-- Wrapper for the submit button to align it to the right -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Edit -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editDataModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDataModalLabel">Edit <?= $page_title ?></h5>
                            <button type="button" class="btn-close" id="closeEditModal" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" method="POST" action="proses/<?= $page_title_proses ?>/edit.php"
                                enctype="multipart/form-data">
                                <input type="hidden" id="id_sistem" name="id_sistem">

                                <!-- sistem Pokok -->
                                <div class="mb-3">
                                    <label for="edit_suhu" class="form-label">Tanggal sistem</label>
                                    <input type="date" id="edit_suhu" name="suhu" class="form-control" required>
                                </div>

                                <!-- Tunjangan -->
                                <div class="mb-3">
                                    <label for="edit_ketinggian" class="form-label">Tempat sistem</label>
                                    <input type="number" id="edit_ketinggian" name="ketinggian" class="form-control"
                                        required>
                                </div>

                                <!-- Potongan -->
                                <div class="mb-3">
                                    <label for="edit_kelembaban" class="form-label">SK sistem</label>
                                    <input type="number" id="edit_kelembaban" name="kelembaban" class="form-control"
                                        required>
                                </div>

                                <!-- sistem (Select Option) -->
                                <div class="mb-3">
                                    <label for="edit_id_sistem" class="form-label">Nama sistem</label>
                                    <select id="edit_id_sistem" name="id_sistem" class="form-control" required>
                                        <!-- PHP untuk menampilkan pilihan sistem -->
                                        <option value="" selected>Silakan pilih sistem</option>
                                        <?php
                                        $sistem_result = mysqli_query($koneksi, "SELECT id_sistem, tekanan FROM sistem");
                                        while ($sistem = mysqli_fetch_assoc($sistem_result)) {
                                            echo "<option value='{$sistem['id_sistem']}'>{$sistem['tekanan']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'fitur/footer.php'; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('tambahForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Menghentikan aksi default form submit

            var form = this;
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'proses/<?= $page_title_proses ?>/tambah.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = xhr.responseText.trim();
                    console.log(response); // Debugging

                    if (response === 'success') {
                        form.reset();
                        document.getElementById('closeTambahModal').click();
                        loadTable(); // reload table data

                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil ditambahkan",
                            icon: "success",
                            timer: 1200, // 1,2 detik
                            showConfirmButton: false, // Tidak menampilkan tombol OK
                        });
                    } else if (response === 'data_sudah_ada') {
                        Swal.fire({
                            title: "Error",
                            text: "Data data sudah dipromosikan, silakan pilih data roti lainnya",
                            icon: "info",
                            timer: 2000, // 2 detik
                            showConfirmButton: false,
                        });
                    } else if (response === 'data_tidak_lengkap') {
                        Swal.fire({
                            title: "Error",
                            text: "Data yang anda masukan belum lengkap",
                            icon: "info",
                            timer: 2000, // 2 detik
                            showConfirmButton: false,
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Gagal menambahkan data",
                            icon: "error",
                            timer: 2000, // 2 detik
                            showConfirmButton: false,
                        });
                    }
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "Terjadi kesalahan saat mengirim data",
                        icon: "error",
                        timer: 2000, // 2 detik
                        showConfirmButton: false,
                    });
                }
            };
            xhr.send(formData);
        });
    });

    function openEditModal(id_sistem, suhu, ketinggian, kelembaban, id_sistem) {
        // Mengisi nilai input di modal edit
        document.getElementById('id_sistem').value = id_sistem;
        document.getElementById('edit_suhu').value = suhu;
        document.getElementById('edit_ketinggian').value = ketinggian;
        document.getElementById('edit_kelembaban').value = kelembaban;
        document.getElementById('edit_id_sistem').value = id_sistem;

        // Pilihan sistem pada select option
        let selectsistem = document.getElementById('edit_id_sistem');
        for (let i = 0; i < selectsistem.options.length; i++) {
            if (selectsistem.options[i].value == id_sistem) {
                selectsistem.selectedIndex = i;
                break;
            }
        }

        // Menampilkan modal edit
        var editModal = new bootstrap.Modal(document.getElementById('editModal'), {
            keyboard: false
        });
        editModal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Menghentikan aksi default form submit

            var form = this;
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'proses/<?= $page_title_proses ?>/edit.php', true);
            xhr.onload = function() {

                if (xhr.status === 200) {
                    var response = xhr.responseText.trim();
                    console.log(response); // Debugging

                    if (response === 'success') {
                        form.reset();
                        document.getElementById('closeEditModal').click();
                        loadTable(); // reload table data

                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil diperbarui",
                            icon: "success",
                            timer: 1200, // 1,2 detik
                            showConfirmButton: false, // Tidak menampilkan tombol OK
                        });
                    } else if (response === 'data_sudah_ada') {
                        Swal.fire({
                            title: "Error",
                            text: "Data data sudah dipromosikan, silakan pilih data data lainnya",
                            icon: "info",
                            timer: 2000, // 2 detik
                            showConfirmButton: false,
                        });
                    } else if (response === 'data_tidak_lengkap') {
                        Swal.fire({
                            title: "Error",
                            text: "Data yang anda masukan belum lengkap",
                            icon: "info",
                            timer: 2000, // 2 detik
                            showConfirmButton: false,
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Gagal memperbarui data",
                            icon: "error",
                            timer: 2000, // 2 detik
                            showConfirmButton: false,
                        });
                    }
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "Terjadi kesalahan saat mengirim data",
                        icon: "error",
                        timer: 2000, // 2 detik
                        showConfirmButton: false,
                    });
                }
            };
            xhr.send(formData);
        });
    });

    function hapus(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi untuk menghapus
                var xhr = new XMLHttpRequest();

                xhr.open('POST', 'proses/<?= $page_title_proses ?>/hapus.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {

                    if (xhr.status === 200) {
                        var response = xhr.responseText.trim();
                        if (response === 'success') {
                            loadTable();
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Data berhasil dihapus.',
                                icon: 'success',
                                timer: 1200, // 1,2 detik
                                showConfirmButton: false // Menghilangkan tombol OK
                            }).then(() => {
                                location.reload()
                            })
                        } else if (response === 'error') {
                            Swal.fire({
                                title: 'Error',
                                text: 'Gagal menghapus Data.',
                                icon: 'error',
                                timer: 2000, // 2 detik
                                showConfirmButton: false // Menghilangkan tombol OK
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Terjadi kesalahan saat mengirim data.',
                                icon: 'error',
                                timer: 2000, // 2 detik
                                showConfirmButton: false // Menghilangkan tombol OK
                            });
                        }
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengirim data.',
                            icon: 'error',
                            timer: 2000, // 2 detik
                            showConfirmButton: false // Menghilangkan tombol OK
                        });
                    }
                };
                xhr.send("id=" + id);
            } else {
                // Jika pengguna membatalkan penghapusan
                Swal.fire({
                    title: 'Penghapusan dibatalkan',
                    icon: 'info',
                    timer: 1500, // 1,5 detik
                    showConfirmButton: false // Menghilangkan tombol OK
                });
            }
        });
    }

    function loadTable() {
        // Get current page and search query from URL
        var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
        var searchQuery = new URLSearchParams(window.location.search).get('search') || '';

        var xhrTable = new XMLHttpRequest();
        xhrTable.onreadystatechange = function() {
            if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                document.getElementById('load_data').innerHTML = xhrTable.responseText;
            }
        };

        // Send request with current page and search query
        xhrTable.open('GET', 'proses/<?= $page_title_proses ?>/load_data.php?page=' + currentPage + '&search=' +
            encodeURIComponent(
                searchQuery), true);
        xhrTable.send();
    }
    </script>
    <?php include 'fitur/js.php'; ?>
</body>

</html>