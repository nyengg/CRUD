<?php
require('./Database.php');


if (isset($_POST['create'])){
    $Fname = $_POST['Fname'];
    $Mname = $_POST['Mname'];
    $Lname = $_POST['Lname'];
    

    $querryCreate = "INSERT INTO tbl3a VALUES (null, '$Fname', '$Mname', '$Lname')";
    $sqlcreate = mysqli_query($connection, $querryCreate);

    echo '<script>alert("Succesfully Created!")</script>';
    echo '<script>window.location.href = "/3A-Rainier/Index.php"</script>';
}

?>