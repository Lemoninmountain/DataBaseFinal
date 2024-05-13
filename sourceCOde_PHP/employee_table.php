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

// Insert a new employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $name = $_POST["name"];
    $position = $_POST["position"];
    $manufacturePlantId = $_POST["manufacture_plant_id"];

    $insertSql = "INSERT INTO employee_gary (name, position, manufacture_plant_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$name, $position, $manufacturePlantId]);
}

// Update an employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $employeeId = $_POST["employee_id"];
    $name = $_POST["name"];
    $position = $_POST["position"];
    $manufacturePlantId = $_POST["manufacture_plant_id"];

    $updateSql = "UPDATE employee_gary SET name = ?, position = ?, manufacture_plant_id = ? WHERE employee_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$name, $position, $manufacturePlantId, $employeeId]);
}

// Delete an employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $employeeId = $_POST["employee_id"];

    $deleteSql = "DELETE FROM employee_gary WHERE employee_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$employeeId]);
}

// Query to get employee data
$sql = "SELECT * FROM employee_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Table</title>
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
                        <h2>Add Employee</h2>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Name:</span>
                                <input type="text" name="name" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">position:</span>
                                <input type="text" name="position" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Manufacture Plant ID:</span>
                                <input type="text" name="manufacture_plant_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="insert" value="Add Customer">
                        </form>

                        <!-- Update Form -->
                        <h2>Update Employee</h2>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <label for="employee_id" class="input-group-text">Employee ID:</label>
                                <input type="text" name="employee_id" class="form-control" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <label for="name" class="input-group-text">Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <label for="position" class="input-group-text">Position:</label>
                                <input type="text" name="position" class="form-control" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <label for="manufacture_plant_id" class="input-group-text">Manufacture Plant ID:</label>
                                <input type="text" name="manufacture_plant_id" class="form-control" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="update" value="Update Employee">
                        </form>


                        <!-- Delete Form -->
                        <h2>Delete Employee</h2>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <label for="employee_id" class="input-group-text">Employee ID:</label>
                                <input type="text" name="employee_id" class="form-control" required>
                            </div>

                            <input type="submit" class="btn btn-primary" name="delete" value="Delete Employee">
                        </form>
                    </div>
                    <div class="col-lg-9 col-sm-12">
                        <h1 style="text-align: center;">Employee Table</h1>
                        <div class="table-response">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>employee_id</th>
                                        <th>name</th>
                                        <th>position</th>
                                        <th>manufacture_plant_id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["employee_id"] . "</td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["position"] . "</td>";
                                            echo "<td>" . $row["manufacture_plant_id"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No employee found</td></tr>";
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