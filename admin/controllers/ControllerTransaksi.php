<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['antrian'])) {
        $id = $_GET['antrian'];
        $dt = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM antrian INNER JOIN mobil ON antrian.no_plat = mobil.no_plat WHERE id_antrian = $id"));

        $tipe = $dt['tipe_mobil'];
        $ukr = mysqli_fetch_assoc(mysqli_query($db, "SELECT ukuran_mobil FROM tipe_mobil WHERE tipe_mobil = '$tipe'"));

        $ukr = $ukr['ukuran_mobil'];
        $dba = mysqli_fetch_assoc(mysqli_query($db, "SELECT biaya_tambahan FROM ukuran_mobil WHERE ukuran_mobil = '$ukr'"));

        $pkt = $dt['id_paket'];
        $dbp = mysqli_fetch_assoc(mysqli_query($db, "SELECT harga_paket FROM paket_pencucian WHERE id_paket = $pkt"));

        $biaya = $dba['biaya_tambahan'] + $dbp['harga_paket'];
        $res = array(
            'biaya' => $biaya,
        );
    } else if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM transaksi WHERE id_antrian = $id"));

        $res = array(
            'id' => $d['id_antrian'],
            'nota' => $d['no_nota'],
            'antrian' => $d['id_antrian'],
            'group' => $d['id_group'],
            'bayar' => $d['total_bayar'],
            'extra' => $d['extra_biaya'],
            'biaya' => $d['biaya'],
        );
    }
    echo json_encode($res);
}

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'store':
            $nt = $_POST['nota'];
            $ant = $_POST['antrian'];
            $grp = $_POST['group'];
            $byr = $_POST['bayar'];
            $ext = $_POST['extra'];
            $bya = $_POST['biaya'];
            mysqli_query($db, "UPDATE antrian SET status_data = '0' WHERE id_antrian = '$ant'");
            mysqli_query($db, "INSERT INTO transaksi VALUES ($ant, $grp, '$nt', $bya, $ext, $byr, '1')");
            setFlasher("Berhasil", "tambah transaksi", "success");
            break;
        case 'delete':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE transaksi SET status_data = '0' WHERE id_antrian = '$id'");
            setFlasher("Berhasil", "hapus transaksi", "success");
            break;
        case 'restore':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE transaksi SET status_data = '1' WHERE id_antrian = '$id'");
            setFlasher("Berhasil", "restore transaksi");
            break;
        case 'del':
            $id = $_POST['id'];
            mysqli_query($db, "DELETE FROM transaksi WHERE id_antrian = '$id'");
            setFlasher("Berhasil", "delete permanent transaksi");
            break;
        default:
            header('Location: ../index.php');
            break;
    }
}
