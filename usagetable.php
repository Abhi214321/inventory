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

// Define the path to the JSON file
$jsonFilePath = 'changes.json';

// Check if form is submitted for editing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_submit'])) {
    $kg_id = $_POST['kg_id'];
    $furniture_id = $_POST['furniture_id'];
    $new_quantity = $_POST['new_quantity'];

    // Load existing changes from JSON file
    $existingChanges = [];
    if (file_exists($jsonFilePath)) {
        $existingChanges = json_decode(file_get_contents($jsonFilePath), true);
    }

    // Add or update the change
    $existingChanges[] = [
        'kg_id' => $kg_id,
        'furniture_id' => $furniture_id,
        'new_quantity' => $new_quantity
    ];

    // Save changes to JSON file
    file_put_contents($jsonFilePath, json_encode($existingChanges));

    // Redirect to the same page after successful update
    header("Location: usagetable.php");
    exit();
}

// Fetch data from the database
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT CAST(kg_id AS CHAR) AS kg_id, teachers_name, Department_name, furniture_id, furniture_name, furniture_quantity FROM usagetable";
if (!empty($searchTerm)) {
    $sql .= " WHERE furniture_id LIKE ?";
}

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind parameters for search
if (!empty($searchTerm)) {
    $searchParam = "%{$searchTerm}%";
    $stmt->bind_param("s", $searchParam);
}

// Execute statement
$stmt->execute();
$result = $stmt->get_result();

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        /* Your CSS styles */
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
        #content {

            margin-left: 250px;
            padding: 20px;
            background-size: cover;
            background-position: center;
            min-height: calc(100vh - 50px); /* Adjusted min-height */
            overflow: auto;
            border-top-left-radius: 0px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        /* Styles for the table */
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
            margin-bottom: 20px;
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
        
        /* Additional styles for edit form */
        #editForm {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none;
        }

        #editForm label {
            font-weight: bold;
        }

        #editForm input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        #editForm button {
            background-color: #1e90ff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 8px;
        }

        #editForm button:hover {
            background-color: #0e70bf;
        }
        #department-btn {
            position: absolute;
            top: 70px;
            right: 20px;
            background-color: #1e90ff;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 9999;
        }
        #department-btn:hover {
            background-color: #0e70bf;
            margin-right:0px;
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
    <div class="search-form">
        <form method="get" action="">
            <label for="search">Search by Furniture ID:</label>
            <input type="text" id="search" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <input type="submit" value="Search">
        </form>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>KG ID</th>
                <th>Teacher's Name</th>
                <th>Department</th>
                <th>Furniture ID</th>
                <th>Furniture Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td class='kg_id'>{$row['kg_id']}</td>
                            <td>{$row['teachers_name']}</td>
                            <td>{$row['Department_name']}</td>
                            <td class='furniture_id'>{$row['furniture_id']}</td>
                            <td>{$row['furniture_name']}</td>
                            <td class='quantity'>{$row['furniture_quantity']}</td>
                            
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    
  <!-- Edit form -->
  <div id="editForm">
        <form id="editFormInner" method="post" action="">
            <input type="hidden" name="kg_id" id="edit_kg_id">
            <input type="hidden" name="furniture_id" id="edit_furniture_id">
            <label for="new_quantity">New Quantity:</label>
            <input type="number" id="new_quantity" name="new_quantity">
            <button type="submit" name="edit_submit" id="edit_submit">Save</button>
        </form>
    </div>
    <a id="department-btn" href="department2.php">Department Wise</a>
</div>

<!-- JavaScript code -->
<script>
console.log("JavaScript loaded successfully");

document.querySelectorAll('.edit-btn').forEach(item => {
    item.addEventListener('click', event => {
        console.log("Edit button clicked");
        const kg_id = item.getAttribute('data-kgid');
        const furniture_id = item.getAttribute('data-furnitureid');
        const quantity = item.getAttribute('data-quantity');

        console.log("KG ID:", kg_id);
        console.log("Furniture ID:", furniture_id);
        console.log("Quantity:", quantity);

        document.getElementById('edit_kg_id').value = kg_id;
        document.getElementById('edit_furniture_id').value = furniture_id;
        document.getElementById('new_quantity').value = quantity;
        document.getElementById('editForm').style.display = 'block';
    })
});

document.getElementById('editFormInner').addEventListener('submit', event => {
    console.log("Form submitted");
    event.preventDefault();
    const formData = new FormData(event.target);
    console.log("Form data:", formData);

    fetch(window.location.href, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(text => {
        console.log(text);
        // Reset new quantity field and hide edit form
        document.getElementById('new_quantity').value = '';
        document.getElementById('editForm').style.display = 'none';
        // Reload the page
        window.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>

</body>
</html>

