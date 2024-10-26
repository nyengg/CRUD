<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = ''; 
$database = "db3aa";

$connection = new mysqli($host, $user, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Prepare the statement with error handling
    $stmt = $connection->prepare("SELECT Password FROM register WHERE Username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Fetch the hashed password
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($input_password, $hashed_password)) {
                $_SESSION['username'] = $input_username;
                echo '<script>alert("Login successfully!")</script>';
                echo '<script>window.location.href = "Index.php"</script>';
            } else {
                echo '<script>alert("Invalid username or password.")</script>';
            }
        } else {
            echo '<script>alert("Invalid username or password.")</script>';
        }

        $stmt->close();
    } else {
        // Error message if statement preparation fails
        echo "Error preparing statement: " . $connection->error;
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            background: #2B2D35;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            margin: 0;
        }

        * {
            font-family: sans-serif;
            box-sizing: border-box;
        }

        .container {
            width: 400px;
            border: 2px solid #ccc;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin: 15px 0;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        p {
            text-align: center;
            margin-top: 15px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="Login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <input type="submit" value="Login">
            <p>Don't have an account? <a href="Registration.php">Register</a></p>
        </form>
    </div>
</body>
</html>