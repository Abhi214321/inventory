<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize search year variable
$searchYear = '';

// Check if search year is provided
if(isset($_GET['search_year'])) {
    // Sanitize input to prevent SQL injection
    $searchYear = mysqli_real_escape_string($conn, $_GET['search_year']);
}

// Fetch data from the database based on search year
$sql = "SELECT Audit_id, Audit_date,furniture_id,furniture_name,from_delivery, Audit_quantity, Audit_amountpp,Audit_amount
        FROM audittable 
        WHERE YEAR(Audit_date) = '$searchYear'";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Table</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        #top-bar {
            background: #1e90ff;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: white;
        }

        #content {
            margin-left: 250px;
            margin-top: 0px;
            padding: 20px;
            background-size: cover;
            background-position: center;
            min-height: calc(100vh - 50px); /* Adjusted min-height */
            overflow: auto;
            border-top-left-radius: 0px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        #top-bar a {
            text-decoration: none;
            color: white;
            margin-right: 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        #top-bar a:hover {
            color: #f1f1f1;
        }

        #sidebar {
            width: 250px;
            height: 100%;
            background: #2c3e50;
            position: fixed;
            left: 0;
            top: 50px;
            overflow-x: hidden;
            padding-top: 20px;
            transition: all 0.3s ease;
        }

        #sidebar a {
            padding: 15px 10px;
            text-decoration: none;
            font-size: 18px;
            color: #ccc;
            display: block;
            transition: all 0.3s ease;
        }

        #sidebar a:hover {
            background-color: #34495e;
            color: white;
        }

    

        h1 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #1e90ff;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .search-form {
            margin-bottom: 15px;
        }

        .search-form input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-form input[type="submit"] {
            background-color: #1e90ff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-form input[type="submit"]:hover {
            background-color: #0e70bf;
        }
        </style>
</head>
<body>

<div id="top-bar">
    <div>
        <a href="admin.php"><i class="fas fa-user"></i> Admin</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div id="sidebar">
    <a href="department.php"><i class="fas fa-building"></i> Department</a>
    <a href="furnituretable.php"><i class="fas fa-chair"></i> Furniture</a>
    <a href="usagetable.php"><i class="fas fa-chart-bar"></i> Usage</a>
    <a href="audittable.php"><i class="fas fa-clipboard-list"></i> Audit</a>
</div>

<div id="content">
    <div class="container">
        <div class="search-form">
            <form method="GET" action="">
                <label for="search_year">Search by Year:</label>
                <input type="text" id="search_year" name="search_year" placeholder="YYYY" value="<?php echo htmlspecialchars($searchYear); ?>">
                <input type="submit" value="Search">
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Audit ID</th>
                    <th>Date</th>
                    <th>Furniture ID</th>
                    <th>Furniture Name</th>
                    <th>Delivered By</th>
                    <th>Quantity</th>
                    <th>Amount per Unit</th>
                    <th>Total Amount(incl Taxes)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Output data of each row
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Capitalize first letter of each word
                        $furnitureName = ucfirst(strtolower($row['furniture_name']));
                        $deliveredBy = ucfirst(strtolower($row['from_delivery']));
                        
                        echo "<tr>
                                <td>{$row['Audit_id']}</td>
                                <td>{$row['Audit_date']}</td>
                                <td>{$row['furniture_id']}</td>
                                <td>{$furnitureName}</td>
                                <td>{$deliveredBy}</td>
                                <td>{$row['Audit_quantity']}</td>
                                <td>{$row['Audit_amountpp']}</td>
                                <td>{$row['Audit_amount']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>