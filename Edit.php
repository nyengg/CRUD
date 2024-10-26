<?php
require('./Database.php');

$editF = $editM = $editL = "";
$editID = 0;

if (isset($_POST['edit'])) {
    $editID = $_POST['editID'];
    $editF = $_POST['editF'];
    $editM = $_POST['editM'];
    $editL = $_POST['editL'];
}

if (isset($_POST['update'])) {
    $updateID = $_POST['updateID'];
    $updateF = $_POST['updateF'];
    $updateM = $_POST['updateM'];
    $updateL = $_POST['updateL'];

    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("UPDATE tbl3a SET FirstName = ?, MiddleName = ?, LastName = ? WHERE ID = ?");
    $stmt->bind_param("sssi", $updateF, $updateM, $updateL, $updateID);

    if ($stmt->execute()) {
        echo '<script>alert("Successfully Edited!")</script>';
        echo '<script>window.location.href = "/3A-Rainier/Index.php"</script>';
    } else {
        echo '<script>alert("Error updating record: ' . $stmt->error . '")</script>';
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #2B2D35;
            padding: 100px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
        }
        h3 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-custom {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: black;
            color: white;
        }
        .btn-custom:hover {
            background-color: #333; /* Darker shade for hover effect */
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h3>Edit Info</h3>
            <input type="text" class="form-control" name="updateF" placeholder="Enter your Firstname" value="<?php echo htmlspecialchars($editF); ?>" required />
            <input type="text" class="form-control" name="updateM" placeholder="Enter your Middlename" value="<?php echo htmlspecialchars($editM); ?>" required />
            <input type="text" class="form-control" name="updateL" placeholder="Enter your Lastname" value="<?php echo htmlspecialchars($editL); ?>" required />
            <input type="hidden" name="updateID" value="<?php echo htmlspecialchars($editID); ?>" />
            <input type="submit" name="update" class="btn btn-custom" value="SAVE" />
        </form>
    </div>
</body>
</html>
