<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "website";

$conn =  mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
