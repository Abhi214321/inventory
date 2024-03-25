<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT ID,fullname,email FROM users WHERE email = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

// Fetch user data
$user = $result->fetch_assoc();

// Close statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #333;
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


        header {
            background-color:#fff ;
            color: #1e90ff;
            padding: 20px;
            text-align: center;
            top-margin:50px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        h1 {
            margin: 0;
            font-size: 32px;
        }

        section {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            position: relative;
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

    <header>
        <h1>User Dashboard</h1>
    </header>

    <section>
        <h2>Welcome, <?php echo $user['fullname']; ?>!</h2>
        <p>User ID: <?php echo $user['ID']; ?></p>
        <p>Email: <?php echo $user['email']; ?></p>
        <form method="POST" action="logout.php">
            <button type="submit" name="logout">Logout</button>
        </form>
    </section>

</body>
</html>
