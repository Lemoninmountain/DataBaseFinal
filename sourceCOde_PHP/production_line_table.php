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

// Insert a new production line record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $manufacturePlantId = $_POST["manufacture_plant_id"];
    $productionLineName = $_POST["production_line_name"];

    $insertSql = "INSERT INTO production_line_gary (manufacture_plant_id, production_line_name) VALUES (?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$manufacturePlantId, $productionLineName]);
}

// Update a production line record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $productionLineId = $_POST["production_line_id"];
    $manufacturePlantId = $_POST["manufacture_plant_id"];
    $productionLineName = $_POST["production_line_name"];

    $updateSql = "UPDATE production_line_gary SET manufacture_plant_id = ?, production_line_name = ? WHERE production_line_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$manufacturePlantId, $productionLineName, $productionLineId]);
}

// Delete a production line record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $productionLineId = $_POST["production_line_id"];

    $deleteSql = "DELETE FROM production_line_gary WHERE production_line_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$productionLineId]);
}

// Query to get production line data
$sql = "SELECT * FROM production_line_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Line Table</title>
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
                        <h3>Add Production Line Record</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Manufacture Plant ID:</span>
                                <input type="text" name="manufacture_plant_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Production Line Name:</span>
                                <input type="text" name="production_line_name" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <input type="submit" class="btn btn-primary" name="insert"
                                value="Add Production Line Record">
                        </form>

                        <!-- Update Form -->
                        <h3>Update Production Line Record</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Production Line ID:</span>
                                <input type="text" name="production_line_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Manufacture Plant ID:</span>
                                <input type="text" name="manufacture_plant_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Production Line Name:</span>
                                <input type="text" name="production_line_name" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="update"
                                value="Update Production Line Record">
                        </form>

                        <!-- Delete Form -->
                        <h3>Delete Production Line Record</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Production Line ID:</span>
                                <input type="text" name="production_line_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="delete" value="Delete Production Line">
                        </form>
                    </div>
                    <div class="col-lg-9 col-sm-12">

                        <!-- Customer Table -->
                        <h1 style="text-align: center;">Production Line Table</h1>
                        <div class="table-response">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>production_line_id</th>
                                        <th>manufacture_plant_id</th>
                                        <th>production_line_name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["production_line_id"] . "</td>";
                                            echo "<td>" . $row["manufacture_plant_id"] . "</td>";
                                            echo "<td>" . $row["production_line_name"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No Production Line found</td></tr>";
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