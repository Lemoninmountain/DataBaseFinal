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

// Insert a new manufacture plant
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $manufactureName = $_POST["manufacture_name"];
    $manufactureLocation = $_POST["manufacture_location"];

    $insertSql = "INSERT INTO manufacture_plant_gary (manufacture_name, manufacture_location) VALUES (?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$manufactureName, $manufactureLocation]);
}

// Update a manufacture plant
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $manufacturePlantId = $_POST["manufacture_plant_id"];
    $manufactureName = $_POST["manufacture_name"];
    $manufactureLocation = $_POST["manufacture_location"];

    $updateSql = "UPDATE manufacture_plant_gary SET manufacture_name = ?, manufacture_location = ? WHERE manufacture_plant_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$manufactureName, $manufactureLocation, $manufacturePlantId]);
}

// Delete a manufacture plant
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $manufacturePlantId = $_POST["manufacture_plant_id"];

    $deleteSql = "DELETE FROM manufacture_plant_gary WHERE manufacture_plant_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$manufacturePlantId]);
}

// Query to get manufacture plant data
$sql = "SELECT * FROM manufacture_plant_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manufacture Plant Table</title>
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
                        <h3>Add Manufacture Plant</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Manufacture Name:</span>
                                <input type="text" name="manufacture_name" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Manufacture Location:</span>
                                <input type="text" name="manufacture_location" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" name="insert" class="btn btn-primary" value="Add Manufacture Plant">
                        </form>

                        <!-- Update Form -->
                        <h4>Update Manufacture Plant</h4>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Manufacture Plant ID:</span>
                                <input type="text" name="manufacture_plant_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Manufacture Name:</span>
                                <input type="text" name="manufacture_name" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Manufacture Location:</span>
                                <input type="text" name="manufacture_location" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" name="update" class="btn btn-primary" value="Update Manufacture Plant">
                        </form>

                        <!-- Delete Form -->
                        <h4>Delete Manufacture Plant</h4>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Manufacture Plant ID:</span>
                                <input type="text" name="manufacture_plant_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" name="delete" class="btn btn-primary" value="Delete Manufacture Plant">
                        </form>
                    </div>
                    <div class="col-lg-9 col-sm-12">

                        <!-- Customer Table -->
                        <h1 style="text-align: center;">Manufacture Plant Table</h1>
                        <div class="table-response">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>manufacture_plant_id</th>
                                        <th>manufacture_name</th>
                                        <th>manufacture_location</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["manufacture_plant_id"] . "</td>";
                                            echo "<td>" . $row["manufacture_name"] . "</td>";
                                            echo "<td>" . $row["manufacture_location"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No manufacture plant found</td></tr>";
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