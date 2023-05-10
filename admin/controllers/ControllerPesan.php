<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'delete':
            $id = $_POST['id'];
            mysqli_query($db, "DELETE FROM pesan WHERE id_pesan = $id");
            setFlasher("Berhasil", "hapus pesan");
            break;
        default:
            header('Location: ../pesan.php.php');
            break;
    }
}
