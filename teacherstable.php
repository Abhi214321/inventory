<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers</title>
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
            min-height: calc(100vh - 50px);
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

        /* Additional CSS styles */
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
    <div id="content-overlay">
        <?php
        $branch = isset($_GET['branch']) ? $_GET['branch'] : '';

        // Check if branch is provided and valid
        if (!in_array($branch, ['CSE', 'ECE', 'CV', 'ME', 'NES'])) {
            echo "<p>Invalid branch selected!</p>";
        } else {
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

            // Fetch teachers data for the selected branch
            $sql = "SELECT * FROM teacherstable WHERE department_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $branch);
            $stmt->execute();
            $result = $stmt->get_result();

            // Display teachers data
            if ($result->num_rows > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>KG ID</th>
                                <th>Teacher's Name</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['kg_id']}</td>
                            <td>{$row['teachers_name']}</td>
                            <td>{$row['department_name']}</td>
                          </tr>";
                }
                echo "</tbody>
                      </table>";
            } else {
                echo "<p>No records found</p>";
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</div>

</body>
</html>
