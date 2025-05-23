<?php
$host = "localhost";
$username = "root";
$password = "";
$databasename = "kaossinaja";
$con = @mysqli_connect($host, $username, $password, $databasename);


if (!$con) {
    echo "Error: " . mysqli_connect_error();
    exit();
}


//untuk menyabungkan stock dalam halproduct ke database
// dengan mengambil id s 
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT stock FROM products WHERE id = $product_id";
$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['stock'];
} else {
}


