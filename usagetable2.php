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

// Check if branch parameter is provided
if(isset($_GET['branch'])) {
    $branch = $_GET['branch'];

    // Fetch data from the database for the selected branch
    $sql = "SELECT kg_id, teachers_name, Department_name, furniture_id, furniture_name, furniture_quantity FROM usagetable WHERE Department_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $branch);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Fetch all data if branch parameter is not provided
    $sql = "SELECT kg_id, teachers_name, Department_name, furniture_id, furniture_name, furniture_quantity FROM usagetable";
    $result = $conn->query($sql);
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usage Table</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        /* Top bar styles */
        #top-bar {
            background: #1e90ff;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: white;
            position: fixed;
            width:100%;
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

        /* Sidebar styles */
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

        /* Content styles */
        #content {
            margin-left: 250px;
            margin-top: 0px;
            padding: 20px;
            background-color: #f7f7f7;
            min-height: calc(100vh - 50px);
            overflow: auto;
            box-sizing: border-box;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
    <h1>Usage Table</h1>

    <table>
        <thead>
            <tr>
                <th>KG ID</th>
                <th>Teacher's Name</th>
                <th>Department</th>
                <th>Furniture ID</th>
                <th>Furniture Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['kg_id']}</td>
                            <td>{$row['teachers_name']}</td>
                            <td>{$row['Department_name']}</td>
                            <td>{$row['furniture_id']}</td>
                            <td>{$row['furniture_name']}</td>
                            <td>{$row['furniture_quantity']}</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
