<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "inventory";

$conn = new mysqli('localhost','root','','inventory');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("location: Dashboard.php");
    } else {
        $error = "Invalid username or password";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style> 
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-image: url('https://c8.alamy.com/comp/J4THW9/small-chalkboard-with-inventory-control-3d-J4THW9.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }
    .login-container {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 450px; /* Increased width */
        margin: 20px auto;
    }

    .login-form {
        display: flex; /* Use flexbox */
        flex-direction: column;
    }

    label {
        margin-top: 10px;
        color: #555;
    }

    .input-container {
        position: relative; /* Container for input field and eye symbol */
    }

    input {
        padding: 8px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        flex: 1; /* Allow input field to grow */
        width:430px;
    }

    #togglePassword {
        position: absolute; /* Position eye symbol */
        top: 50%; /* Align vertically */
        right: 10px; /* Align to the right */
        transform: translateY(-50%); /* Adjust vertical centering */
        cursor: pointer;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-top: 0;
    }

    button {
        background-color: #1e90ff; /* Changed button color to blue */
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #007acc; /* Darker shade of blue on hover */
    }
   
</style>
</head>
<body>
    <div class="login-container">
        <form class="login-form" method="post" action="">
            <h2>Login</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <div class="input-container">
                <input type="password" id="password" name="password" required>
                <span id="togglePassword" onclick="togglePasswordVisibility()">👁️</span>
            </div>

            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleButton = document.getElementById("togglePassword");
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.textContent = "👁️";
            } else {
                passwordField.type = "password";
                toggleButton.textContent = "👁️";
            }
        }
    </script>
</body>
</html>

