<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['plat'])) {
        $plt = $_GET['plat'];
        $dt = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM mobil WHERE no_plat = '$plt'"));

        $tipe = $dt['tipe_mobil'];
        $ukr = mysqli_fetch_assoc(mysqli_query($db, "SELECT ukuran_mobil, merk_mobil FROM tipe_mobil WHERE tipe_mobil = '$tipe'"));

        $mrk = $ukr['merk_mobil'];
        $ukr = $ukr['ukuran_mobil'];
        $dba = mysqli_fetch_assoc(mysqli_query($db, "SELECT biaya_tambahan FROM ukuran_mobil WHERE ukuran_mobil = '$ukr'"));

        $res = array(
            'merk' => $mrk,
            'tipe' => $tipe,
            'ukuran' => $ukr,
            'biaya' => $dba['biaya_tambahan'],
        );
    } else if (isset($_GET['paket'])) {
        $pkt = $_GET['paket'];
        $dbp = mysqli_fetch_assoc(mysqli_query($db, "SELECT harga_paket FROM paket_pencucian WHERE id_paket = $pkt"));
        $res = array(
            'harga' => $dbp['harga_paket'],
        );
    } else if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM antrian INNER JOIN mobil ON antrian.no_plat = mobil.no_plat WHERE id_antrian = $id"));

        $tipe = $d['tipe_mobil'];
        $ukr = mysqli_fetch_assoc(mysqli_query($db, "SELECT ukuran_mobil FROM tipe_mobil WHERE tipe_mobil = '$tipe'"));
        
        $ukr = $ukr['ukuran_mobil'];
        $dba = mysqli_fetch_assoc(mysqli_query($db, "SELECT biaya_tambahan FROM ukuran_mobil WHERE ukuran_mobil = '$ukr'"));

        $pkt = $d['id_paket'];
        $dbp = mysqli_fetch_assoc(mysqli_query($db, "SELECT harga_paket FROM paket_pencucian WHERE id_paket = $pkt"));
        
        $res = array(
            'id' => $d['id_antrian'],
            'paket' => $pkt,
            'biaya' => $dba['biaya_tambahan'],
            'harga' => $dbp['harga_paket'],
            'no' => $d['no_antrian'],
            'tanggal' => $d['tanggal'],
            'waktu' => $d['waktu'],
        );
    }
    echo json_encode($res);
}

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'store':
            $plat = $_POST['plat'];
            $paket = $_POST['paket'];
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $antrian = mysqli_num_rows(mysqli_query($db, "SELECT * from antrian WHERE tanggal = '$date'")) + 1;
            $sql = "INSERT INTO antrian VALUES ('', '$plat', '$paket', '$antrian', '$date', '$time', 'menunggu', '1')";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "tambah antrian", "success");
            break;
        case 'delete':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE antrian SET status_data = '0' WHERE id_antrian = '$id'");
            setFlasher("Berhasil", "hapus antrian", "success");
            break;
        case 'update':
            $id = $_POST['id'];
            $paket = $_POST['paket'];
            $sql = "UPDATE antrian SET id_paket = '$paket' WHERE id_antrian = '$id'";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "update antrian", "success");
            break;
        case 'updateStatus':
            $status = str_replace('status=', '', $_POST['status']);
            $data = explode("%20", $status);
            $id = $data[0];
            $st = $data[1];
            $sql = "UPDATE antrian SET status = '$st' WHERE id_antrian = $id";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "update status antrian");
            break;
        case 'restore':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE antrian SET status_data = '1' WHERE id_antrian = '$id'");
            setFlasher("Berhasil", "restore antrian");
            break;
        case 'del':
            $id = $_POST['id'];
            mysqli_query($db, "DELETE FROM antrian WHERE id_antrian = '$id'");
            setFlasher("Berhasil", "delete permanent antrian");
            break;
        default:
            header('Location: ../index.php');
            break;
    }
}