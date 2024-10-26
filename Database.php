<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db3aa';

$connection = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_error()) {
    echo "Error: Unable to connect to MYSQL<br>";
    echo "Message: ".mysqli_connect_error()."<br>";
}
    //to check connect if tama na!
    //else {
      //  echo "Succesfully Connected to your Database!";
    //}


?>