<!DOCTYPE html>
<html lang="en">

<?php
@session_start();
include('../koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/index.php');
} else {
    $id_petugas = $_SESSION['id_petugas'];
}
?>


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
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
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
                    <h6 class="mb-4">PETUGAS</h6>
                    <div class="table-responsive" >
                        <table class="table" id="dataTablesNya">
                            <thead  style="text-align: center";>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">ID PETUGAS</th>
                                    <th scope="col">NAMA PETUGAS</th>
                                    <th scope="col">USERNAME</th>
                                    <th scope="col">PASSWORD</th>
                                    <th scope="col">NOMOR TELFON</th>
                                    <th scope="col">LEVEL</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                              $q = mysqli_query($connection,"SELECT * FROM `petugas`");
                                            $no = 1;
                                            while($d = mysqli_fetch_object($q)) { ?>
                                            
                                                <tr>
                                                    <th> <?= $no ?></th>
                                                    <th> <?= $d->id_petugas ?></th>
                                                    <th> <?= $d->nama_petugas?></th>
                                                    <th> <?= $d->username ?></th>
                                                    <th> <?= $d->password ?></th>
                                                    <th> <?= $d->telp ?></th>
                                                    <th> <?= $d->level ?></th>
                                                </tr>
                                            <?php $no++;
                                            }?>
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