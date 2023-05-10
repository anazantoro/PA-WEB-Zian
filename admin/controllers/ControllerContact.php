<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (!empty($_POST)) {
    $nama = $_POST['name'];
    $email = $_POST['email'];
    $no = $_POST['no'];
    $msg = $_POST['pesan'];
    mysqli_query($db, "INSERT INTO pesan VALUES ('', '$nama', '$email', '$no', '$msg')");
    setFlasher('Berhasil', 'kirim pesan');
}
header('location: ../../index.php');