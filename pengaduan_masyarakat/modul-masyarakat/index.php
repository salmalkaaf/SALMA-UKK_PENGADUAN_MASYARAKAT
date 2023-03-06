<!DOCTYPE html>
<html lang="en">
<?php
include('../koneksi.php');
// if (empty($_SESSION['username'])) {
//     @header('location:../modul-auth/index.php');
// }
if (isset($_POST['edit'])) {
    $status = $_POST['status'];
    $nik = $_POST['nik'];
    $q = mysqli_query($connection, "UPDATE `masyarakat` SET verifikasi = '$status' WHERE nik = '$nik'");
}

if (isset($_POST['hapus'])) {
    $nik = $_POST['nik'];
    $q = mysqli_query($connection, "DELETE FROM `masyarakat` WHERE nik = '$nik'");
}
if (isset($_POST['update'])) {
    $nikLama = $_POST['nikLama'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $telp = $_POST['telp'];
    $password = md5($_POST['password']);
    if ($password == '') {
        $q = mysqli_query($connection, "UPDATE `masyarakat` SET nik = '$nik', nama = '$nama', username = '$username', telp = '$telp' WHERE nik = '$nikLama'");
    } else {
        $q = mysqli_query($connection, "UPDATE `masyarakat` SET `password` = '$password', nik = '$nik', nama = '$nama', username = '$username', telp = '$telp' WHERE nik = '$nikLama'");
    }
}
?>

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

    <?php @session_start();
    if (!empty($_SESSION['username'])) { ?>
        <!-- datatables -->
        <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <?php } ?>

    <style>
        .modal-body {
            background-color: #131313;
        }

        .modal-content {
            background-color: transparent;
        }

        .modal-footer {
            background-color: #131313;
            ;
        }

        .modal-header {
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            -webkit-border-top-left-radius: 6px;
            -webkit-border-top-right-radius: 6px;
            -moz-border-radius-topleft: 6px;
            -moz-border-radius-topright: 6px;
            background-color: #D30000;
            color: white;
        }

        .footer {
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
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
        <?php include('../assets/menu.php') ?>
        <!-- MENU End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include('../assets/navbar.php') ?>

            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->

            <!-- Sale & Revenue End -->

            <!-- Sales Chart Start -->

            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">MASYARAKAT</h6>
                            <div class="table-responsive">
                                <table class="table" style="text-align: center;" id="dataTablesNya">
                                    <thead>
                                        <tr>
                                            <th scope="col">NO</th>
                                            <th scope="col">NIK</th>
                                            <th scope="col">NAMA LENGKAP</th>
                                            <th scope="col">USERNAME</th>
                                            <th scope="col">NOMOR TELFON</th>
                                            <th scope="col">AKSES</th>
                                            <?php if ($_SESSION['level'] == 'admin') { ?>
                                                <th scope="col">EDIT</th>
                                            <?php } ?>
                                            <th scope="col">HAPUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($connection, "SELECT * FROM `masyarakat`");
                                        $no = 1;
                                        while ($d = mysqli_fetch_object($q)) { ?>
                                            <tr>
                                                <td>
                                                    <?= $no ?>
                                                </td>
                                                <td>
                                                    <?= $d->nik ?>
                                                </td>
                                                <td>
                                                    <?= $d->nama ?>
                                                </td>
                                                <td>
                                                    <?= $d->username ?>
                                                </td>
                                                <td>
                                                    <?= $d->telp ?>
                                                </td>
                                                <td>
                                                    <?php if ($d->verifikasi == 0) {
                                                        echo '<form action="" method="post"><input name="nik" type="hidden" value="' . $d->nik . '"><input name="status" type="hidden" value="1"><button name="edit" type="submit" class="btn btn-danger"><i class="fa fa-ban"></i></button></form>';
                                                    } else {
                                                        echo '<form action="" method="post"><input name="nik" type="hidden" value="' . $d->nik . '"><input name="status" type="hidden" value="0"><button name="edit" type="submit" class="btn btn-info"><i class="fa fa-check"></i></button></form>';
                                                    } ?>
                                                </td>
                                                <?php if ($_SESSION['level'] == 'admin') { ?>
                                                    <td><button data-bs-toggle="modal" data-bs-target="#modal-xl<?= $d->nik ?>"
                                                            class="btn btn-success"><i class="fa fa-pen"></i></button></td>
                                                <?php } ?>
                                                <td>
                                                    <form action="" method="post"><input type="hidden" name="nik"
                                                            value="<?= $d->nik ?>"><button name="hapus"
                                                            class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal-xl<?= $d->nik ?>">
                                                <div class="modal-dialog modal-xl<?= $d->nik ?>">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data</h4>
                                                        </div>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="nikLama" value="<?= $d->nik ?>">
                                                            <div class="modal-body">
                                                                <div class="form-group"><label for="nik">Nik</label>
                                                                    <input class="form-control" type="text" name="nik"
                                                                        value="<?= $d->nik ?>">
                                                                </div>
                                                                <div class="form-group"><label for="nama">Nama</label>
                                                                    <input class="form-control" type="text" name="nama"
                                                                        value="<?= $d->nama ?>">
                                                                </div>
                                                                <div class="form-group"><label
                                                                        for="username">Username</label>
                                                                    <input class="form-control" type="text" name="username"
                                                                        value="<?= $d->username ?>">
                                                                </div>
                                                                <div class="form-group"><label for="username">New
                                                                        Password</label>
                                                                    <input class="form-control" type="password"
                                                                        name="password" value="<?= $d->password ?>">
                                                                </div>
                                                                <div class="form-group"><label
                                                                        for="username">Telepon</label>
                                                                    <input class="form-control" type="number" name="telp"
                                                                        value="<?= $d->nik ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="submit" name="update"
                                                                    class="btn btn-success btn-block  w-100 mb-4">Save
                                                                    changes</button>
                                                            </div>
                                                    </div>
                                                    </form>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- modal - ends -->

                                            <?php $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <!-- Recent Sales End -->


        <!-- Widgets End -->


        <!-- FOOTER Start -->
                                    </div>
                                    </div>
        <!-- FOOTER End -->

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

    <script src="../assets/js/main.js"></script>
    <?php @session_start();
    if (!empty($_SESSION['username'])) { ?>
        <!-- DataTables  & Plugins -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../assets/plugins/jszip/jszip.min.js"></script>
        <script src="../assets/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script>
            $(function () {
                $("#dataTablesNya").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["excel", "pdf", "print"]
                }).buttons().container().appendTo('#dataTablesNya_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    <?php } ?>
</body>

</html>