<?php
$conn = new mysqli("localhost", "root", "rootroot", "quiz");
mysqli_set_charset($conn, 'utf8');

if (mysqli_connect_errno()) {
    echo "Database connection error: " . mysqli_connect_error();
    exit();
}
