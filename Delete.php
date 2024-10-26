<?php
require('./Database.php');

if (isset($_POST['delete'])){
    $deleteID = $_POST['deleteID'];

    $querrydelete = "DELETE FROM tbl3a WHERE ID =$deleteID";
    $sqldelete = mysqli_query($connection, $querrydelete);

    echo '<script>alert("Succesfully Deleted!")</script>';
    echo '<script>window.location.href = "/3A-Rainier/Index.php"</script>';
}

?>