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
    mysqli_query($connection, "UPDATE `tanggapan` SET tgl_tanggapan = '$tgl_tanggapan', tanggapan = '$tanggapan' WHERE `id_tanggapan` = '$id_tanggapan'");
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

<?php @session_start();
    if (!empty($_SESSION['username'])) { ?>
        <!-- datatables -->
        <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <?php } ?>

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
        <!-- MENU End -->
        
        <?php include('../assets/menu.php') ?>

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include('../assets/navbar.php')?> 


            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">TANGGAPAN</h6>
                            
                            <button data-bs-toggle="modal" data-bs-target="#modal-lg" type="submit"
                                class="btn btn-primary m-2"><i class="fa fa-plus"></i> Buat tanggapan</button>

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
                                                <p> </p>
                                                <button name="tambah_tanggapan" type="submit"
                                                    class="btn btn-danger">simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table" style="text-align: center"  id="dataTablesNya";>
                                    <thead>
                                        <tr>
                                            <th scope="col">NO</th>
                                            <th scope="col">ID TANGGAPAN</th>
                                            <th scope="col">ID PENGADUAN</th>
                                            <th scope="col">TANGGAL PENGADUAN</th>
                                            <th scope="col">TANGGAPAN</th>
                                            <th scope="col">ID PETUGAS</th>
                                            <th scope="col">HAPUS</th>
                                            <th scope="col">EDIT</th>
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
                                                    <?= $d->id_tanggapan ?>
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
                                                        <button class="btn btn-success" data-bs-toggle="modal"
                                                            data-bs-target="#modal-lg<?= $d->id_pengaduan ?>"
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
                                                                    class="btn btn-success btn-block  w-100 mb-4">Update</button>
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
         $(function() {
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