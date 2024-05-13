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

// Insert a new production order record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $productionLineId = $_POST["production_line_id"];
    $productId = $_POST["product_id"];
    $orderDate = $_POST["order_date"];

    $insertSql = "INSERT INTO production_order_gary (production_line_id, product_id, order_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$productionLineId, $productId, $orderDate]);
}

// Update a production order record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $productionOrderId = $_POST["production_order_id"];
    $productionLineId = $_POST["production_line_id"];
    $productId = $_POST["product_id"];
    $orderDate = $_POST["order_date"];

    $updateSql = "UPDATE production_order_gary SET production_line_id = ?, product_id = ?, order_date = ? WHERE production_order_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$productionLineId, $productId, $orderDate, $productionOrderId]);
}

// Delete a production order record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $productionOrderId = $_POST["production_order_id"];

    $deleteSql = "DELETE FROM production_order_gary WHERE production_order_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$productionOrderId]);
}

// Query to get production order data
$sql = "SELECT * FROM production_order_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Order Table</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

<body>

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
                            <h3>Add Production Order</h3>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Production Line ID:</span>
                                    <input type="text" name="production_line_id" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Product ID:</span>
                                    <input type="text" name="product_id" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Order Date:</span>
                                    <input type="text" name="order_date" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>


                                <input type="submit" class="btn btn-primary" name="insert"
                                    value="Add Production Order">
                            </form>

                            <!-- Update Form -->
                            <h3>Update Production Order</h3>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Production Order ID:</span>
                                    <input type="text" name="production_order_id" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Production Line ID:</span>
                                    <input type="text" name="production_line_id" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Product ID:</span>
                                    <input type="text" name="product_id" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Order Date:</span>
                                    <input type="text" name="order_date" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>

                                <input type="submit" class="btn btn-primary" name="update"
                                    value="Update Production Order">
                            </form>

                            <!-- Delete Form -->
                            <h3>Delete Production Order</h3>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Production Order ID:</span>
                                    <input type="text" name="production_order_id" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <input type="submit" class="btn btn-primary" name="delete"
                                    value="Delete Production Order">
                            </form>


                        </div>
                        <div class="col-lg-9 col-sm-12">

                            <!-- Customer Table -->
                            <h1 style="text-align: center;">Production Order Table</h1>
                            <div class="table-response">
                                <table class="table table-dark table-striped">
                                    <thead>
                                        <tr>
                                            <th>production_order_id</th>
                                            <th>production_line_id</th>
                                            <th>product_id</th>
                                            <th>order_date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["production_order_id"] . "</td>";
                                                echo "<td>" . $row["production_line_id"] . "</td>";
                                                echo "<td>" . $row["product_id"] . "</td>";
                                                echo "<td>" . $row["order_date"] . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No Production Order found</td></tr>";
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