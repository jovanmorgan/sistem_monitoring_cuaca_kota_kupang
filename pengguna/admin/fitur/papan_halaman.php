 <?php include 'nama_halaman.php'; ?>

 <div class="page-header">
     <h3 class="fw-bold mb-3"><?= $page_title ?> </h3>
     <ul class="breadcrumbs mb-3">
         <li class="nav-home">
             <a href="dashboard">
                 <i class="icon-home"></i>
             </a>
         </li>
         <li class="separator">
             <i class="icon-arrow-right"></i>
         </li>
         <?php if ($page_title == "Pegawai" || $page_title == "Kepala Sekolah"): ?>
             <li class="nav-item">
                 <a href="#">Penggunah</a>
             </li>
             <li class="separator">
                 <i class="icon-arrow-right"></i>
             </li>
         <?php endif; ?>
         <?php if ($page_title !== "Galeri" && $page_title !== "Pegawai" && $page_title !== "Kepala Sekolah" && $page_title !== "Profile Saya"): ?>
             <li class="nav-item">
                 <a href="#">Sistem</a>
             </li>
             <li class="separator">
                 <i class="icon-arrow-right"></i>
             </li>
         <?php endif; ?>

         <li class="nav-item">
             <a href="#"><?= $page_title ?> </a>
         </li>
     </ul>
     <?php if ($page_title !== "Dashboard" && $page_title !== "Profile Saya"): ?>
         <div class="ms-md-auto py-2 py-md-0">
             <?php include 'nama_halaman_proses.php'; ?>
             <?php if ($page_title !== "Galeri"): ?>
                 <a target="_blank" href="export/<?= $page_title_proses ?>" class="btn btn-label-info btn-round me-2">Export</a>
             <?php endif; ?>

         </div>
     <?php endif; ?>

 </div>