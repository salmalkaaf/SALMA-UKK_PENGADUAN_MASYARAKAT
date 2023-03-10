<?php
@session_start();
include('../koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/index.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    }
}
// CRUD
if (isset($_POST['tambahPengaduan'])) {
    $isi_laporan = $_POST['isi_laporan'];
    $tgl = $_POST['tgl_pengaduan'];
    //upload
    $ekstensi_diperbolehkan = array('jpg', 'png');
    $foto = $_FILES['foto']['name'];
    print_r($foto);
    $x = explode(".", $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    if (!empty($foto)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '$foto', '0')";
            $r = mysqli_query($connection, $q);
            if ($r) {
                move_uploaded_file($file_tmp, '../assets/img/masyarakat/' . $foto);
            }
        }
    } else {
        $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '', '0')";
        $r = mysqli_query($connection, $q);
    }
}

// hapus pengaduan
if (isset($_POST['hapus'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    if ($id_pengaduan != '') {
        $q = "SELECT `foto` FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
        $r = mysqli_query($connection, $q);
        $d = mysqli_fetch_object($r);
        unlink('../assets/img/masyarakat/' . $d->foto);
    }
    $q = "DELETE FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
    $r = mysqli_query($connection, $q);
}

// rubah status pengaduan
if (isset($_POST['proses_pengaduan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $status = $_POST['status'];
    $q = "UPDATE `pengaduan` SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'";
    $r = mysqli_query($connection, $q);
}
?>

<!DOCTYPE html>
<html lang="en">
    
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
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
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0 ">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- MENU -->
       <?php include('../assets/menu.php')?>
        <!-- MENU End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include('../assets/navbar.php')?> 

            <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">PENGADUAN</h6>
                    <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                        <button  data-bs-toggle="modal" data-bs-target="#modal-lg" class="btn btn-primary m-2"><i class="fa fa-plus"></i>   Buat Pengaduan</button>
                    <?php } ?> 

                    <div class="modal fade" id="modal-lg">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Buat Pengaduan
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="nik" value="">
                                                    <div class="form-group">
                                                        <label for="isi_laporan">Isi Laporan</label>
                                                        <textarea name="isi_laporan" class="form-control" cols="30" rows="10"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tgl_pengaduan">Tanggal Pengaduan</label>
                                                        <input type="date" name="tgl_pengaduan" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <input type="file" name="foto" class="form-control">
                                                    </div>
                                                    <p> </p>
                                                    <input type="submit" name="tambahPengaduan" value="simpan" class="btn btn-success w-100">
                                                </form>
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </div>
                    </div>
                    
                    <div class="table-responsive">
                    <div class="card-body">        
                        <table class="table" id="dataTablesNya">
                                <thead>
                                <tr style="text-align: center;">
                                    <th scope="col">NO</th>
                                    <th scope="col">TANGGAL PENGADUAN</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">ISI LAPORAN</th>
                                    <th scope="col">FOTO</th>
                                    <th scope="col">STATUS</th>
                                    <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                                    <th scope="col">HAPUS</th>
                                    <?php } ?>
                                    <?php if ($_SESSION['level'] == 'petugas') { ?>
                                    <th scope="col" colspan="2">PROSES PENGADUAN</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;"> <?php
                                            if ($_SESSION['level'] == 'masyarakat') {
                                                $q = "SELECT * FROM `pengaduan` WHERE `nik` = $nik";
                                            } else {
                                                $q = "SELECT * FROM `pengaduan`";
                                            }
                                            $r = mysqli_query($connection, $q);
                                            $no = 1;
                                            while ($d = mysqli_fetch_object($r)) {
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $d->tgl_pengaduan ?></td>
                                                    <td><?= $d->nik ?></td>
                                                    <td><?= $d->isi_laporan ?></td>
                                                    <td><?php if ($d->foto == '') {
                                                            echo '<img style="max-height:100px" class="img img-thumbnail" src="../assets/img/no-img.png">';
                                                        } else {
                                                            echo '<img style="max-height:100px" class="img img-thumbnail" src="../assets/img/masyarakat/' . $d->foto . '">';
                                                        } ?></td>
                                                    <td><?= $d->status ?></td>
                                                    <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                                                    <td>
                                                        <form action="" method="post"><input type="hidden" name="id_tanggapan"
                                                                value="<?= $d->id_tanggapan ?>"><button name="hapusTanggapan"
                                                                class="btn btn-danger" type="submit"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                    <?php } ?>
                                                    <td><?php if ($_SESSION['level'] == 'petugas') { ?>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>">
                                                                <select class="form-control" name="status">
                                                                    <option value="0"> 0 </option>
                                                                    <option value="proses"> proses </option>
                                                                    <option value="selesai"> selesai </option>
                                                                </select>
                                                                
                                                                <td>
                                                                        <button type="submit" name="proses_pengaduan" class="btn btn-success form-control">UBAH</button>
                                                                </td>
                                                            </form>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <!--  Recent Sales End -->


            <!-- MODUL TAMBAH PENGADUAN -->
            <div class="modal fade" id="modal-xl<?= $d->nik ?>">
                <div  class="modal-dialog modal-xl<?= $d->nik ?>">
                    <div class="col-sm-12 col-xl-6">
                    <form action="" method="post">
                        <div class="bg-secondary rounded h-100 p-4">
                        <div class="modal-body">
                            <h6 class="mb-4">Buat Pengaduan</h6>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput"
                                    placeholder="ISI NIK">
                                <label for="floatingInput">ID Pengaduan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword"
                                    placeholder="Password">
                                <label for="floatingPassword">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword"
                                    placeholder="Password">
                                <label for="floatingPassword">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here"
                                    id="floatingTextarea" style="height: 150px;"></textarea>
                                <label for="floatingTextarea">Isi Laporan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="file" class="form-control bg-dark" id="floatingfoto"
                                    placeholder="foto">
                                <label for="floatingfoto">Foto</label>
                            </div>
                            <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-primary w-100" name="tambahp">  Buat Pengaduan</button>
                        </div>
                    </form>
                        </div>
                        </div>
                    </div>
            </div>
            </div>
            <!-- MODUL TAMBAH PENGADUAN END -->


            <!-- FOOTER Start -->
           
            <!-- FOOTER End -->
        </div>
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