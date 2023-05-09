<?php
$db = mysqli_connect("localhost", "root", "", "db_carwash");

// Check connection
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}

function dd($request) {
    var_dump($request);
    die();
}