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

// Insert a new customer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $customerName = $_POST["customer_name"];
    $contactEmail = $_POST["contact_email"];
    $contactPerson = $_POST["contact_person"];

    $insertSql = "INSERT INTO customer_gary (customer_name, contact_email, contact_person) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->execute([$customerName, $contactEmail, $contactPerson]);
}

// Update a customer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $customerId = $_POST["customer_id"];
    $customerName = $_POST["customer_name"];
    $contactEmail = $_POST["contact_email"];
    $contactPerson = $_POST["contact_person"];

    $updateSql = "UPDATE customer_gary SET customer_name = ?, contact_email = ?, contact_person = ? WHERE customer_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->execute([$customerName, $contactEmail, $contactPerson, $customerId]);
}

// Delete a customer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $customerId = $_POST["customer_id"];

    $deleteSql = "DELETE FROM customer_gary WHERE customer_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->execute([$customerId]);
}

// Query to get customer data
$sql = "SELECT * FROM customer_gary";
$result = $mysqli->query($sql);

// Close database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Table</title>
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
                        <h3>Add Customer</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Customer Name:</span>
                                <input type="text" name="customer_name" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Contact Email:</span>
                                <input type="email" name="contact_email" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Contact Person:</span>
                                <input type="text" name="contact_person" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="insert" value="Add Customer">
                        </form>

                        <!-- Update Form -->
                        <h3>Update Customer</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Customer ID:</span>
                                <input type="text" name="customer_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Customer Name:</span>
                                <input type="text" name="customer_name" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Contact Email:</span>
                                <input type="email" name="contact_email" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Contact Person:</span>
                                <input type="text" name="contact_person" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <input type="submit" class="btn btn-primary" name="update" value="Update Customer">
                        </form>

                        <!-- Delete Form -->
                        <h3>Delete Customer</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Customer ID:</span>
                                <input type="text" name="customer_id" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>

                            <input type="submit" class="btn btn-primary" name="delete" value="Delete Customer">
                        </form>

                    </div>
                    <div class="col-lg-9 col-sm-12">

                        <!-- Customer Table -->
                        <h1 style="text-align: center;">Customer Table</h1>
                        <div class="table-response">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Contact Email</th>
                                        <th>Contact Person</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["customer_id"] . "</td>";
                                            echo "<td>" . $row["customer_name"] . "</td>";
                                            echo "<td>" . $row["contact_email"] . "</td>";
                                            echo "<td>" . $row["contact_person"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No customers found</td></tr>";
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