<!-- MENU -->
<!--  -->

<?php
@session_start();
include('../koneksi.php');
?>
<head>
    <meta charset="utf-8">
    <title>SISPEMAS | LOGIN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-globe me-2"></i>SISPEMAS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                <div class="navbar-nav w-100">
                    <li class="nav-item">
                        <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/dokumentasi/pengaduan_masyarakat/modul-profile/index.php" class="nav-link">
                            <i class="nav-icon fas fa-user-circle me-2"></i>
                            <p>
                                PROFILE
                            </p>
                        </a>
                    </li>
                    <?php }?>
                    <?php if ($_SESSION['level'] == 'admin') { ?>
                        <li class="nav-item">
                            <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/dokumentasi/pengaduan_masyarakat/modul-masyarakat/index.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    MASYARAKAT
                                </p>
                            </a>
                        </li>

                        <?php } ?>
                    
                        <li class="nav-item">
                            <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/dokumentasi/pengaduan_masyarakat/modul-pengaduan/index.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    PENGADUAN
                                </p>
                            </a>
                        </li>

                    <?php if ($_SESSION['level'] == 'admin') { ?>
                        <li class="nav-item">
                            <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/dokumentasi/pengaduan_masyarakat/modul-petugas/index.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    PETUGAS
                                </p>
                            </a>
                        </li>
                        <?php } ?>

                        
                    <?php if ($_SESSION['level'] == 'admin') { ?>
                        <li class="nav-item">
                            <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/dokumentasi/pengaduan_masyarakat/modul-tanggapan/index.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    TANGGAPAN
                                </p>
                            </a>
                        </li>
                        <?php } ?>

                    <!-- 
                    <a href="../modul-profile/index.html" class="nav-item nav-link  nav-link active" ><i class="fa fa-user me-2"></i>PROFILE</a>
                    <a href="../modul-masyarakat/index.html" class="nav-item nav-link nav-item"><i class="fa fa-users me-2"></i>MASYARAKAT</a>
                    <a href="../modul-pengaduan/index.html" class="nav-item nav-link"><i class="fa fa-exclamation me-2"></i>PENGADUAN</a>
                    <a href="../modul-petugas/index.html" class="nav-item nav-link"><i class="fa fa-user-tie me-2"></i>PETUGAS</a>
                    <a href="../modul-tanggapan/index.html" class="nav-item nav-link"><i class="fa fa-user-edit me-2"></i>TANGGAPAN</a> -->
                    <a href="../modul-auth/logout.php" class="nav-item nav-link"><i class="fa fa-pen-square me-2"></i>LOG OUT</a> 
                </div>
            </nav>
                    </ul>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/chart/chart.min.js"></script>
    <script src="..assets//lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>

        
        <!-- MENU End -->