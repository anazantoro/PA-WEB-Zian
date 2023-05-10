<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM group_pencuci WHERE id_group = $id"));
        $res = array(
            'id' => $d['id_group'],
            'nama' => $d['nama_group'],
        );
    }
    echo json_encode($res);
}

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'store':
            $namaGroup = $_POST['nama'];
            $sql = "SELECT * FROM group_pencuci WHERE nama_group = '$namaGroup'";
            if (mysqli_num_rows(mysqli_query($db, $sql)) == 0) {
                $sql = "INSERT INTO group_pencuci VALUES ('', '$namaGroup')";
                mysqli_query($db, $sql);
                setFlasher("Berhasil", "tambah pegawai", "success");
            } else {
                setFlasher("Gagal", "tambah pegawai", "danger");
            }
            break;
        case 'delete':
            $id = $_POST['id'];
            $sql = "DELETE FROM group_pencuci WHERE id_group = '$id'";
            mysqli_query($db, $sql);
            break;
        case 'update':
            $id = $_POST['id'];
            $nm = $_POST['nama'];
            $sql = "UPDATE group_pencuci SET nama_group = '$nm' WHERE id_group = $id";
            try {
                mysqli_query($db, $sql);
                setFlasher("Berhasil", "update", "success");
            } catch (Exception $e) {
                setFlasher("Gagal", "update", "success");
            }
            break;
        default:
            header('Location: ../group.php');
            break;
    }
}