<?php
require 'asset/php/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KaosSin Aja</title>
    <link rel="stylesheet" href="asset/css/styleadmin.css" />
    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <h1>Gataco</h1>
        <div class="categories">
            <h2>Categories</h2>
            <ul>
                <?php
                $sql_categories = "SELECT category, COUNT(*) as count FROM products GROUP BY category";
                $result_categories = mysqli_query($con, $sql_categories);

                if (mysqli_num_rows($result_categories) > 0) {
                    while ($row_category = mysqli_fetch_assoc($result_categories)) {
                        echo '<li>' . $row_category['category'] . ' <span>' . $row_category['count'] . '</span></li>';
                    }
                } else {
                    echo '<li>No products</li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>All Products</h2>
            <a href="asset/php/creat.php"><button>Add New Product</button></a>
            <a href="index.php"><button>Log Out</button></a>
        </header>

        <div class="product-grid">
            <?php
            $sql_products = "SELECT * FROM products";
            $result_products = mysqli_query($con, $sql_products);

            if (mysqli_num_rows($result_products) > 0) {
                while ($row = mysqli_fetch_assoc($result_products)) {
                    echo '<div class="product-card">';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<p>Category: ' . $row['category'] . '</p>';
                    if (isset($row['price'])) {
                        echo '<p>Price: $' . $row['price'] . '</p>';
                    } else {
                        echo '<p>Price: Not available</p>';
                    }
                    echo '<div class="product-info">';
                    if (isset($row['original_price'])) {
                        echo '<p>Original Price: $' . $row['original_price'] . '</p>';
                    } else {
                        echo '<p>Original Price: Not available</p>';
                    }
                    echo '<p>Remaining Products: ' . $row['stock'] . '</p>';
                    echo '</div>';
                    echo '<div class="product-actions">';
                    echo '<a href="asset/php/update.php?id=' . $row['id'] . '"><button>Update</button></a>';
                    echo '<form action="asset/php/delet.php" method="POST" style="display:inline;">';
                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                    echo '<button type="submit">Delete</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p style="margin-top: 36px;">No products found.</p>';
            }
            ?>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>
