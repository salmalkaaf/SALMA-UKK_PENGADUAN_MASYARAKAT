<?php
// SESSION
@session_start();
include('../koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/index.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    } else {
        $id_petugas = $_SESSION['id_petugas'];
    }
}
// tambah tanggapan
if (isset($_POST['tambah_tanggapan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $id_petugas = $_POST['id_petugas'];
    $tanggapan = $_POST['tanggapan'];
    $q = "INSERT INTO `tanggapan` (id_tanggapan, id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ('','$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')";
    $r = mysqli_query($connection, $q);
}
// hapus tanggapan
if (isset($_POST['hapusTanggapan'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    mysqli_query($connection, "DELETE FROM `tanggapan` WHERE id_tanggapan = '$id_tanggapan'");
}
// update tanggapan
if (isset($_POST['ubahTanggapan'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $tanggapan = $_POST['tanggapan'];
    mysqli_query($conection, "UPDATE `tanggapan` SET tgl_tanggapan = '$tgl_tanggapan', tanggapan = '$tanggapan' WHERE `id_tanggapan` = '$id_tanggapan'");
}
?>
<!DOCTYPE html>
<html lang="en">

<style>
   .modal-body
{
    background-color: #131313;
}

.modal-content
{
    background-color: transparent;
}

.modal-header
{
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    -webkit-border-top-left-radius: 6px;
    -webkit-border-top-right-radius: 6px;
    -moz-border-radius-topleft: 6px;
    -moz-border-radius-topright: 6px;
    background-color: #D30000;
    color: white;
}
 
</style>

<head>
    <meta charset="utf-8">
    <title>SISPEMAS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ../assets/Libraries Stylesheet -->
    <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- MENU -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-globe me-2"></i>SISPEMAS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle me-lg-2" src="../assets/img/admin.jpg" alt=""
                            style="width: 40px; height: 40px;">
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <?php include('../assets/menu.php') ?>
            </nav>
        </div>
        <!-- MENU End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">

                    <div class="nav-item dropdown">


                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../assets/img/admin.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">TANGGAPAN</h6>

                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Tambah Tanggapan
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <label for="id_pengaduan"> Pilih Id Pengaduan</label>
                                                <select name="id_pengaduan" class="form-control">
                                                    <?php
                                                    $q = "SELECT * FROM pengaduan JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik";
                                                    $r = mysqli_query($connection, $q);
                                                    while ($d = mysqli_fetch_object($r)) { ?>
                                                        <option value="<?= $d->id_pengaduan ?>"><?= $d->id_pengaduan . '|' . $d->nik . '|' . $d->nama ?></option>
                                                    <?php } ?>
                                                </select>
                                                <br>
                                                <label for="tgl_tanggapan">Tanggal</label>
                                                <input class="form-control" type="date" name="tgl_tanggapan">
                                                <label for="tanggapan">Beri Tanggapan</label>
                                                <textarea class="form-control" name="tanggapan" id="" cols="30"
                                                    rows="10"></textarea>
                                                <label for="id_petugas">ID Petugas</label>
                                                <input name="id_petugas" type="text" class="form-control"
                                                    value="<?= $id_petugas ?>" readonly>
                                                <br>
                                                <button name="tambah_tanggapan" type="submit"
                                                    class="btn btn-danger">simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button data-bs-toggle="modal" data-bs-target="#modal-lg" type="submit"
                                class="btn btn-primary m-2"><i class="fa fa-plus"></i> Buat tanggapan</button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID_Tanggapan</th>
                                            <th scope="col">ID_Pengaduan</th>
                                            <th scope="col">Tanggal Pengaduan</th>
                                            <th scope="col">Tanggapan</th>
                                            <th scope="col">ID_Petugas</th>
                                            <th scope="col">Hapus</th>
                                            <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $q = "SELECT * FROM `tanggapan` JOIN `petugas` JOIN `pengaduan`
                             WHERE tanggapan.id_petugas = petugas.id_petugas 
                             AND tanggapan.id_pengaduan = pengaduan.id_pengaduan";
                                        $r = mysqli_query($connection, $q);
                                        while ($d = mysqli_fetch_object($r)) { ?>
                                            <tr>
                                                <td>
                                                    <?= $no ?>
                                                </td>
                                                <td>
                                                    <?= $d->id_pengaduan ?>
                                                </td>
                                                <td>
                                                    <?= $d->tgl_tanggapan ?>
                                                </td>
                                                <td>
                                                    <?= $d->tanggapan ?>
                                                </td>
                                                <td>
                                                    <?= $d->nama_petugas ?>
                                                </td>
                                                <td>
                                                    <?php if ($_SESSION['level'] != 'masyarakat') { ?>
                                                        <form action="" method="post"><input type="hidden" name="id_tanggapan"
                                                                value="<?= $d->id_tanggapan ?>"><button name="hapusTanggapan"
                                                                class="btn btn-danger" type="submit"><i
                                                                    class="fa fa-trash"></i></button></form>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($_SESSION['level'] != 'masyarakat') { ?>
                                                        <button class="btn btn-success" data-toggle="modal"
                                                            data-target="#modal-lg<?= $d->id_pengaduan ?>"
                                                            class="btn btn-success"><i class="fa fa-pen"></i></button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal-lg<?= $d->id_pengaduan ?>">
                                                <div class="modal-dialog modal-lg<?= $d->id_pengaduan ?>">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            Edit Pengaduan
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body">
                                                                <input class="form-control" name="id_tanggapan"
                                                                    type="hidden" value="<?= $d->id_tanggapan ?>">
                                                                <label for="id_pengaduan">ID Pengaduan</label><br>
                                                                <select class="form-control" name="id_pengaduan">
                                                                    <?php
                                                                    $result = mysqli_query($connection, "SELECT * FROM `pengaduan` JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik");
                                                                    while ($data = mysqli_fetch_object($result)) { ?>
                                                                        <option value="<?= $data->id_pengaduan ?>" <?php if ($d->id_pengaduan == $data->id_pengaduan) {
                                                                              echo 'selected';
                                                                          } ?>><?= $data->id_pengaduan . '|' . $data->nik . '|' . $data->nama ?></option>
                                                                    <?php } ?>
                                                                </select><br>
                                                                <label for="tgl_tanggapan">Tanggal Tanggapan</label>
                                                                <input class="form-control" name="tgl_tanggapan"
                                                                    class="form-control" type="date" name=""
                                                                    value="<?= $d->tgl_tanggapan ?>">
                                                                <label for="tanggapan">Tanggapan</label>
                                                                <textarea class="form-control" name="tanggapan" id=""
                                                                    cols="30" rows="10"><?= $d->tanggapan ?></textarea>
                                                                <br>
                                                                <button name="ubahTanggapan" type="submit"
                                                                    class="btn btn-info">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php $no++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- MODUL TANGGAPAN -->

            <!-- MODUL TANGGAPAN END -->


            <!-- FOOTER Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">SISPEMAS</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FOOTER End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/chart/chart.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>
</body>

</html>