<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE id = '$id'";
    if (mysqli_query($con, $sql)) {
        header('Location: ../../indexadmin.php?message=Data%20berhasil%20dihapus');
        exit();
    } else {
        header('Location: ../../indexadmin.php?message=Error:%20' . urlencode(mysqli_error($con)));
        exit();
    }
}
?>
