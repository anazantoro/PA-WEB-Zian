<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM paket_pencucian WHERE id_paket = $id"));
        $res = array(
            'id' => $d['id_paket'],
            'nama' => $d['nama_paket'],
            'desc' => $d['desc_paket'],
            'harga' => $d['harga_paket'],
        );
    }
    echo json_encode($res);
}

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'store':
            $nama_paket = $_POST['nama'];
            $desc = $_POST['desc'];
            $harga_paket = $_POST['harga'];
            $sql = "INSERT INTO paket_pencucian VALUES ('', '$nama_paket', '$desc', '$harga_paket', '1')";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "tambah customer", "success");
            break;
        case 'delete':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE paket_pencucian SET status_data = '0' WHERE id_paket = '$id'");
            setFlasher("Berhasil", "hapus paket");
            break;
        case 'update':
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $desc = $_POST['desc'];
            $harga = $_POST['harga'];
            $sql = "UPDATE paket_pencucian SET nama_paket = '$nama', desc_paket = '$desc', harga_paket = $harga WHERE id_paket = $id";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "update", "success");
            break;
        case 'restore':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE paket_pencucian SET status_data = '1' WHERE id_paket = '$id'");
            setFlasher("Berhasil", "restore paket");
            break;
        case 'del':
            $id = $_POST["id"];
            mysqli_query($db, "DELETE FROM paket_pencucian WHERE id_paket = '$id'");
            setFlasher("Berhasil", "delete permanent paket");
            break;
        default:
            header('Location: isiKelolaPaket.php');
            break;
    }
}