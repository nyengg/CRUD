<?php
require('./Database.php');

if (isset($_POST['registration'])) {
    $Uname = $_POST['Uname'];
    $Ename = $_POST['Ename'];
    $Pname = $_POST['Pname'];

    // Hash the password before storing it (important for security)
    $hashedPassword = password_hash($Pname, PASSWORD_DEFAULT);

    $queryRegistration = "INSERT INTO register (Username, Email, Password) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($queryRegistration);

    // Check if the statement was prepared successfully
    if ($stmt) {
        $stmt->bind_param("sss", $Uname, $Ename, $hashedPassword);

        if ($stmt->execute()) {
            echo '<div class="success">Successfully registered! Please log in.</div>';
            echo '<script>setTimeout(() => { window.location.href = "Login.php"; }, 2000);</script>';
        } else {
            echo '<div class="error">Registration failed. Please try again.</div>';
        }

        $stmt->close();
    } else {
        echo '<div class="error">Database error. Please try again later.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            background: #2B2D35;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        * {
            font-family: sans-serif;
            box-sizing: border-box;
        }

        form {
            width: 500px;
            border: 2px solid #ccc;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
        }

        h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-group {
            margin: 10px 0;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input {
            display: block;
            border: 2px solid #ccc;
            width: 95%;
            padding: 10px;
            margin: 10px auto;
            border-radius: 5px;
        }

        label {
            color: #888;
            font-size: 18px;
            padding: 10px;
        }

        button {
            float: right;
            background: #555;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            margin-right: 10px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            opacity: .7;
        }

        .error {
            background: #F2DEDE;
            color: #A94442;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
            margin: 20px auto;
            text-align: center;
        }

        .success {
            background: #D4EDDA;
            color: #40754C;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
            margin: 20px auto;
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #fff;
        }

        .ca {
            font-size: 14px;
            display: inline-block;
            padding: 10px;
            text-decoration: none;
            color: #444;
        }

        .ca:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<form action="Registration.php" method="post"> 
        <h2>SIGN UP</h2>
        <div class="form-group">
            <input type="text" name="Uname" placeholder="Enter your username" required/>
        </div>
        <div class="form-group">
            <input type="email" name="Ename" placeholder="Enter your email" required/>
        </div>
        <div class="form-group">
            <input type="password" name="Pname" placeholder="Enter your password" required/> 
        </div>
        <button type="submit" name="registration">REGISTER</button>
        <p>Already have an account? <a href="Login.php">Login</a></p>
    </form>
    </form>
</body>
</html>