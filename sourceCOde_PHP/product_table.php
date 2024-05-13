<?php
$servername = "localhost:3306";
$username = "root";
$password = "Gzx132465798.";

try {
    $conn = new PDO("mysql:host=$servername;dbname=montanawidgetcompany", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Connect to the database
$mysqli = new mysqli("localhost", $username, $password, "montanawidgetcompany");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Insert a new product record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $productName = $_POST["product_name"];
    $category = $_POST["category"];
    $material = $_POST["material"];

    $insertSql = "INSERT INTO product_gary (product_name, category, material) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$productName, $category, $material]);
}

// Update a product record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $productId = $_POST["product_id"];
    $productName = $_POST["product_name"];
    $category = $_POST["category"];
    $material = $_POST["material"];

    $updateSql = "UPDATE product_gary SET product_name = ?, category = ?, material = ? WHERE product_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$productName, $category, $material, $productId]);
}

// Delete a product record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $productId = $_POST["product_id"];

    $deleteSql = "DELETE FROM product_gary WHERE product_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$productId]);
}

// Query to get product data
$sql = "SELECT * FROM product_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Table</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>


<body>
    <div class="row">
        <div class="col-lg-2 ">
            <?php include 'main.php' ?>
        </div>
        <div class="col-lg-10 col-sm-12">

            <div class="container-fluid">

                <div class="row col-lg-10">

                    <div class="col-lg-3 col-sm-12">


                        <!-- Insert Form -->
                        <h3>Add Product</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Product Name:</span>
                                <input type="text" name="product_name" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Category:</span>
                                <input type="text" name="category" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Material:</span>
                                <input type="text" name="material" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="insert" value="Add Product">
                        </form>

                        <!-- Update Form -->
                        <h3>Update Product</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Product ID:</span>
                                <input type="text" name="product_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Product Name:</span>
                                <input type="text" name="product_name" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Category:</span>
                                <input type="text" name="category" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Material:</span>
                                <input type="text" name="material" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="update" value="Update Product">
                        </form>

                        <!-- Delete Form -->
                        <h3>Delete Product</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Product ID:</span>
                                <input type="text" name="product_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="delete" value="Delete Product">
                        </form>

                    </div>
                    <div class="col-lg-9 col-sm-12">

                        <!-- Customer Table -->
                        <h1 style="text-align: center;">Product Table</h1>
                        <div class="table-response">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>product_id</th>
                                        <th>product_name</th>
                                        <th>category</th>
                                        <th>material</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["product_id"] . "</td>";
                                            echo "<td>" . $row["product_name"] . "</td>";
                                            echo "<td>" . $row["category"] . "</td>";
                                            echo "<td>" . $row["material"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No Product found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>