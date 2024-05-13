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

// Insert a new stock record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $productId = $_POST["product_id"];
    $warehouseId = $_POST["warehouse_id"];
    $quantity = $_POST["quantity"];

    $insertSql = "INSERT INTO stock_gary (product_id, warehouse_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$productId, $warehouseId, $quantity]);
}

// Update a stock record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $stockId = $_POST["stock_id"];
    $productId = $_POST["product_id"];
    $warehouseId = $_POST["warehouse_id"];
    $quantity = $_POST["quantity"];

    $updateSql = "UPDATE stock_gary SET product_id = ?, warehouse_id = ?, quantity = ? WHERE stock_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$productId, $warehouseId, $quantity, $stockId]);
}

// Delete a stock record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $stockId = $_POST["stock_id"];

    $deleteSql = "DELETE FROM stock_gary WHERE stock_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$stockId]);
}

// Query to get stock data
$sql = "SELECT * FROM stock_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Table</title>
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
                        <h3>Add Stock </h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Product ID:</span>
                                <input type="text" name="product_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Warehouse ID:</span>
                                <input type="text" name="warehouse_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Quantity:</span>
                                <input type="text" name="quantity" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>


                            <input type="submit" class="btn btn-primary" name="insert" value="Add Stock ">
                        </form>

                        <!-- Update Form -->
                        <h3>Update Stock </h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Stock ID:</span>
                                <input type="text" name="stock_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Product ID:</span>
                                <input type="text" name="product_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Warehouse ID:</span>
                                <input type="text" name="warehouse_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Quantity:</span>
                                <input type="text" name="quantity" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <input type="submit" class="btn btn-primary" name="update" value="Update Stock ">
                        </form>

                        <!-- Delete Form -->
                        <h3>Delete Stock </h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Stock ID:</span>
                                <input type="text" name="stock_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="delete" value="Delete Stock ">
                        </form>

                    </div>
                    <div class="col-lg-9 col-sm-12">
                        <h1 style="text-align: center;">Stock Table</h1>
                        <div class="table-response">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>stock_id</th>
                                        <th>product_id</th>
                                        <th>warehouse_id</th>
                                        <th>quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["stock_id"] . "</td>";
                                            echo "<td>" . $row["product_id"] . "</td>";
                                            echo "<td>" . $row["warehouse_id"] . "</td>";
                                            echo "<td>" . $row["quantity"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No Stock found</td></tr>";
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