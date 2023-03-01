<!-- pengaduan -->
<!DOCTYPE html>
<html lang="en">
<?php
// SESSION
session_start();
include('../koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/index.php');
}

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
    $update = $_POST['update'];
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

<?php
$_SERVER="localhost";
$_SERVER="root";
$_SERVER="localhost";
$_SERVER="localhost";
?>