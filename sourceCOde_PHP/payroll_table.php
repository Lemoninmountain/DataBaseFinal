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


// Insert a new payroll record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $employeeId = $_POST["employee_id"];
    $salary = $_POST["salary"];
    $bonus = $_POST["bonus"];
    $payDate = $_POST["pay_date"];

    $insertSql = "INSERT INTO payroll_gary (employee_id, salary, bonus, pay_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$employeeId, $salary, $bonus, $payDate]);
}

// Update a payroll record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $payrollId = $_POST["payroll_id"];
    $employeeId = $_POST["employee_id"];
    $salary = $_POST["salary"];
    $bonus = $_POST["bonus"];
    $payDate = $_POST["pay_date"];

    $updateSql = "UPDATE payroll_gary SET employee_id = ?, salary = ?, bonus = ?, pay_date = ? WHERE payroll_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$employeeId, $salary, $bonus, $payDate, $payrollId]);
}

// Delete a payroll record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $payrollId = $_POST["payroll_id"];

    $deleteSql = "DELETE FROM payroll_gary WHERE payroll_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$payrollId]);
}

// Query to get payroll data
$sql = "SELECT * FROM payroll_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Table</title>
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
                            <h3>Add Payroll</h3>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Employee ID:</span>
                                    <input type="text" name="employee_id" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Salary:</span>
                                    <input type="text" name="salary" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Bonus:</span>
                                    <input type="text" name="bonus" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Pay Date:</span>
                                    <input type="date" name="pay_date" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>

                                <input type="submit" class="btn btn-primary" name="insert" value="Add Payroll ">
                            </form>

                            <!-- Update Form -->
                            <h3>Update Payroll </h3>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Payroll ID:</span>
                                    <input type="text" name="payroll_id" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Employee ID:</span>
                                    <input type="text" name="employee_id" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Salary:</span>
                                    <input type="text" name="salary" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Bonus:</span>
                                    <input type="text" name="bonus" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Pay Date:</span>
                                    <input type="date" name="pay_date" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <input type="submit" class="btn btn-primary" name="update"
                                    value="Update Payroll ">
                            </form>

                            <!-- Delete Form -->
                            <h3>Delete Manufacture Plant</h3>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Payroll ID:</span>
                                    <input type="text" name="payroll_id" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        required>
                                </div>
                                <input type="submit" class="btn btn-primary" name="delete" value="Delete ">
                            </form>

                        </div>
                        <div class="col-lg-9 col-sm-12">

                            <!-- Customer Table -->
                            <h1 style="text-align: center;">Payroll Table</h1>
                            <div class="table-response">
                                <table class="table table-dark table-striped">
                                    <thead>
                                        <tr>
                                            <th>payroll_id</th>
                                            <th>employee_id</th>
                                            <th>salary</th>
                                            <th>bonus</th>
                                            <th>pay_date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["payroll_id"] . "</td>";
                                                echo "<td>" . $row["employee_id"] . "</td>";
                                                echo "<td>" . $row["salary"] . "</td>";
                                                echo "<td>" . $row["bonus"] . "</td>";
                                                echo "<td>" . $row["pay_date"] . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No payroll found</td></tr>";
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