<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "No product ID provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $original_price = $_POST['original_price'];
    $stock = $_POST['stock'];


    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = "../uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $gambar = basename($_FILES['gambar']['name']);
        $targetFile = $uploadDir . $gambar;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
            $gambar = $targetFile;
        } else {
            echo "Failed to upload image.";
            exit();
        }
    } else {
        $gambar = $product['gambar']; 
    }

    $sql = "UPDATE products SET 
            name = '$name', 
            category = '$category', 
            price = '$price',
            original_price = '$original_price', 
            stock = '$stock', 
            gambar = '$gambar'
            WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        header('Location: ../../indexadmin.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Product</title>
    <link rel="stylesheet" href="../css/styleadmincreat.css" />
</head>
<body>
    <div class="form-container">
        <h2>Update Product</h2>
        <form action="update.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <label for="name">Product Name</label>
            <input type="text" name="name" placeholder="Product Name" value="<?php echo $product['name']; ?>" required>

            <label for="category">Category</label>
            <input type="text" name="category" placeholder="Category" value="<?php echo $product['category']; ?>" required>

            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" placeholder="Price" value="<?php echo $product['price']; ?>" required>

            <label for="original_price">Original Price</label>
            <input type="number" step="0.01" name="original_price" placeholder="Original Price" value="<?php echo $product['original_price']; ?>" required>

            <label for="stock">Stock</label>
            <input type="number" name="stock" placeholder="Stock" value="<?php echo $product['stock']; ?>" required>

            <label for="gambar">Upload Image</label>
            <input type="file" id="gambar" name="gambar">

            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>
