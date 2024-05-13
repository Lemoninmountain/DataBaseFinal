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

// Insert a new sales order record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $customerId = $_POST["customer_id"];
    $productId = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    $orderDate = $_POST["order_date"];

    $insertSql = "INSERT INTO sales_order_gary (customer_id, product_id, quantity, order_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$customerId, $productId, $quantity, $orderDate]);
}

// Update a sales order record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $salesOrderId = $_POST["sales_order_id"];
    $customerId = $_POST["customer_id"];
    $productId = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    $orderDate = $_POST["order_date"];

    $updateSql = "UPDATE sales_order_gary SET customer_id = ?, product_id = ?, quantity = ?, order_date = ? WHERE sales_order_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$customerId, $productId, $quantity, $orderDate, $salesOrderId]);
}

// Delete a sales order record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $salesOrderId = $_POST["sales_order_id"];

    $deleteSql = "DELETE FROM sales_order_gary WHERE sales_order_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$salesOrderId]);
}

// Query to get sales order data
$sql = "SELECT * FROM sales_order_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Order Table</title>
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
                        <h2>Add Sales Order</h2>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Customer ID:</span>
                                <input type="text" name="customer_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Product ID:</span>
                                <input type="text" name="product_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Quantity:</span>
                                <input type="text" name="quantity" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Order Date:</span>
                                <input type="date" name="order_date" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>



                            <input type="submit" class="btn btn-primary" name="insert" value="Add Sales Order ">
                        </form>

                        <!-- Update Form -->
                        <h3>Update Sales Order </h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Sales Order ID:</span>
                                <input type="text" name="sales_order_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Customer ID:</span>
                                <input type="text" name="customer_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Product ID:</span>
                                <input type="text" name="product_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Quantity:</span>
                                <input type="text" name="quantity" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Order Date:</span>
                                <input type="date" name="order_date" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="update" value="Update Sales Order ">
                        </form>

                        <!-- Delete Form -->
                        <h3>Delete Sales Order </h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Sales Order ID:</span>
                                <input type="text" name="sales_order_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="delete" value="Delete Sales Order ">
                        </form>

                    </div>
                    <div class="col-lg-9 col-sm-12">
                        <h1 style="text-align: center;">Sales Order Table</h1>
                        <div class="table-response">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>sales_order_id</th>
                                        <th>customer_id</th>
                                        <th>product_id</th>
                                        <th>quantity</th>
                                        <th>order_date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["sales_order_id"] . "</td>";
                                            echo "<td>" . $row["customer_id"] . "</td>";
                                            echo "<td>" . $row["product_id"] . "</td>";
                                            echo "<td>" . $row["quantity"] . "</td>";
                                            echo "<td>" . $row["order_date"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No Sales Order found</td></tr>";
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