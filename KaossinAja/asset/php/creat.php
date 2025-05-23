<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $original_price = $_POST['original_price'];
    $stock = $_POST['stock'];

    $targetDir = "../unggahan/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $gambar = isset($_FILES['gambar']['name']) ? $_FILES['gambar']['name'] : '';
    $targetFile = $targetDir . basename($gambar);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (isset($_FILES['gambar']) && $_FILES['gambar']['size'] > 0) {
        $check = getimagesize($_FILES['gambar']['tmp_name']);
        if ($check === false) {
            echo "File yang diunggah bukan gambar.";
            $uploadOk = 0;
        }
    } else {
        echo "File tidak ditemukan.";
        $uploadOk = 0;
    }

    if (!empty($gambar) && file_exists($targetFile)) {
        echo "File sudah ada.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
            $sql = "INSERT INTO products (name, category, price, original_price, stock, gambar) 
                    VALUES ('$name', '$category', '$price', '$original_price', '$stock', '$gambar')";

            if (mysqli_query($con, $sql)) {
                header('Location: ../../indexadmin.php');
                exit();
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New Product</title>
    <link rel="stylesheet" href="../css/styleadmincreat.css" />
</head>

<body>
    <div class="form-container">
        <h2>Add New Product</h2>
        <form action="creat.php" method="POST" enctype="multipart/form-data">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" placeholder="Product Name" required>

            <label for="category">Category</label>
            <input type="text" id="category" name="category" placeholder="Category" required>

            <label for="price">Price</label>
            <input type="number" step="0.01" id="price" name="price" placeholder="Price" required>

            <label for="original_price">Original Price</label>
            <input type="number" step="0.01" id="original_price" name="original_price" placeholder="Original Price" required>

            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" placeholder="Stock" required>

            <label for="gambar">Unggah Gambar</label>
            <input type="file" id="gambar" name="gambar" required>

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>

</html>