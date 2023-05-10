<?php
session_start();
require_once '../../config/auth.php';
require_once '../../config/flasher.php';
require_once '../../database/database.php';

if ($_GET['logout']) {
    logout();
    setFlasher('Berhasil', 'logout');
    header('Location: ../index.php');
    die();
} else {
    header('Location: ../index.php');
}

if (!empty($_POST)) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $no = $_POST['no'];
        $username = $_POST['username'];
        try {
            if ($_POST['wpswd'] == 'on') {
                $password = md5($_POST['password']);
                mysqli_query($db, "UPDATE user SET nama_user = '$name', no_user = '$no', username = '$username', password = '$password', status_data = '1' WHERE id_user = $id");
            } else {
                mysqli_query($db, "UPDATE user SET nama_user = '$name', no_user = '$no', username = '$username', status_data = '1' WHERE id_user = $id");
            }
            setFlasher('Berhasil', 'ganti profile');
        } catch(Exception $e) {
            setFlasher('Gagal', 'ganti profile', 'error');
        }
        header('Location: ../dashboard.php');
        die();
    } else {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = md5($_POST['password']);
        $data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND status_data = '1'"));
        if (isset($data)) {
            setFlasher('Berhasil', 'login');  
            login(true, $data['id_user']);
            header('Location: ../dashboard.php');
        } else {
            setFlasher('Gagal', 'login', 'error');
            header('Location: ../index.php');
        }
    }
} else {
    setFlasher('Gagal', 'login', 'error');
    header('Location: ../index.php');
}