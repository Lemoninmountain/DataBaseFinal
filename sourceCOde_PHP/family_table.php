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

// Insert a new family
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $employeeId = $_POST["employee_id"];
    $familyPhone = $_POST["family_phone"];
    $familyPosition = $_POST["family_position"];

    $insertSql = "INSERT INTO family_gary (employee_id, family_phone, family_position) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$employeeId, $familyPhone, $familyPosition]);
}

// Update a family
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $familyId = $_POST["family_id"];
    $employeeId = $_POST["employee_id"];
    $familyPhone = $_POST["family_phone"];
    $familyPosition = $_POST["family_position"];

    $updateSql = "UPDATE family_gary SET employee_id = ?, family_phone = ?, family_position = ? WHERE family_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$employeeId, $familyPhone, $familyPosition, $familyId]);
}

// Delete a family
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $familyId = $_POST["family_id"];

    $deleteSql = "DELETE FROM family_gary WHERE family_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$familyId]);
}

// Query to get family data
$sql = "SELECT * FROM family_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Table</title>
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
                        <h3>Add Family</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Employee ID:</span>
                                <input type="text" name="employee_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Family Phone:</span>
                                <input type="text" name="family_phone" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Family Position:</span>
                                <input type="text" name="family_position" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <input type="submit" class="btn btn-primary" name="insert" value="Add Family">
                        </form>

                        <!-- Update Form -->
                        <h3>Update Family</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Family ID:</span>
                                <input type="text" name="family_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Employee ID:</span>
                                <input type="text" name="employee_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Family Phone:</span>
                                <input type="text" name="family_phone" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Family Position:</span>
                                <input type="text" name="family_position" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="update" value="Update Family">
                        </form>

                        <!-- Delete Form -->
                        <h3>Delete Family</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Family ID:</span>
                                <input type="text" name="family_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="delete" value="Delete Family">
                        </form>
                    </div>
                    <div class="col-lg-9 col-sm-12">

                        <!-- Customer Table -->
                        <h1 style="text-align: center;">Family Table</h1>
                        <div class="table-response">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>family_id</th>
                                        <th>employee_id</th>
                                        <th>family_phone</th>
                                        <th>family_position</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["family_id"] . "</td>";
                                            echo "<td>" . $row["employee_id"] . "</td>";
                                            echo "<td>" . $row["family_phone"] . "</td>";
                                            echo "<td>" . $row["family_position"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No family found</td></tr>";
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