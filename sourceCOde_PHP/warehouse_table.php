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

// Insert a new warehouse record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $warehouseId = $_POST["warehouse_id"];
    $warehouseLocation = $_POST["warehouse_location"];

    $insertSql = "INSERT INTO warehouse_gary (warehouse_id, warehouse_location) VALUES (?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$warehouseId, $warehouseLocation]);
}

// Update a warehouse record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $warehouseId = $_POST["warehouse_id"];
    $warehouseLocation = $_POST["warehouse_location"];

    $updateSql = "UPDATE warehouse_gary SET warehouse_location = ? WHERE warehouse_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$warehouseLocation, $warehouseId]);
}

// Delete a warehouse record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $warehouseId = $_POST["warehouse_id"];

    $deleteSql = "DELETE FROM warehouse_gary WHERE warehouse_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$warehouseId]);
}

// Query to get warehouse data
$sql = "SELECT * FROM warehouse_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Table</title>
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
                        <h3>Add Warehouse </h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Warehouse Location:</span>
                                <input type="text" name="warehouse_location" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <input type="submit" class="btn btn-primary" name="insert" value="Add Warehouse ">
                        </form>

                        <!-- Update Form -->
                        <h3>Update Warehouse </h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Warehouse ID:</span>
                                <input type="text" name="warehouse_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Warehouse Location:</span>
                                <input type="text" name="warehouse_location" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <input type="submit" class="btn btn-primary" name="update" value="Update Warehouse ">
                        </form>

                        <!-- Delete Form -->
                        <h3>Delete Warehouse </h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Warehouse ID:</span>
                                <input type="text" name="warehouse_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <input type="submit" class="btn btn-primary" name="delete" value="Delete Warehouse ">
                        </form>


                    </div>
                    <div class="col-lg-9 col-sm-12">

                        <!-- Customer Table -->
                        <h1 style="text-align: center;">Warehouse Table</h1>
                        <div class="table-response">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>warehouse_id</th>
                                        <th>warehouse_location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["warehouse_id"] . "</td>";
                                            echo "<td>" . $row["warehouse_location"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='2'>No Warehouse found</td></tr>";
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