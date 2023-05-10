<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['plat'])) {
        $plt = $_GET['plat'];
        $dt = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM mobil WHERE no_plat = '$plt'"));

        $tipe = $dt['tipe_mobil'];
        $ukr = mysqli_fetch_assoc(mysqli_query($db, "SELECT ukuran_mobil FROM tipe_mobil WHERE tipe_mobil = '$tipe'"));

        $ukr = $ukr['ukuran_mobil'];
        $dba = mysqli_fetch_assoc(mysqli_query($db, "SELECT biaya_tambahan FROM ukuran_mobil WHERE ukuran_mobil = '$ukr'"));

        $res = array(
            'merk' => $dt['merk_mobil'],
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
    } else if (isset($_GET['merk'])) {
        $mrk = $_GET['merk'];
        $tmp = array();
        $d = mysqli_query($db, "SELECT tipe_mobil FROM tipe_mobil WHERE merk_mobil = '$mrk'");
        while ($dt = mysqli_fetch_assoc($d)) {
            array_push($tmp, $dt['tipe_mobil']);
        }

        $res = array(
            'tipe' => $tmp,
        );
    } else if ($_GET['tipe']) {
        $id = $_GET['tipe'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM tipe_mobil WHERE tipe_mobil = '$id'"));
        $ukr = $d['ukuran_mobil'];
        $dt = mysqli_fetch_assoc(mysqli_query($db, "SELECT biaya_tambahan FROM ukuran_mobil WHERE ukuran_mobil = '$ukr'"));
        $res = array(
            'ukuran' => ucwords($ukr),
            'biaya' => $dt['biaya_tambahan']
        );
    } else if ($_GET['search']) {
        $id = $_GET['search'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM antrian WHERE no_plat = '$id' AND status_data = '1'"));
        $dpkt = $d['id_paket'];
        $dt = mysqli_fetch_assoc(mysqli_query($db, "SELECT nama_paket FROM paket_pencucian WHERE id_paket = '$dpkt'"));
        $res = array(
            'plt' => $d['no_plat'],
            'pkt' => $dt['nama_paket'],
            'ant' =>$d['no_antrian'],
            'sta' => $d['status']
        );
    }
    echo json_encode($res);
}
 
if(!empty($_POST)) {
    $status = false;
    $nm = $_POST['nama'];
    $no = $_POST['no'];
    $plt = $_POST['plat'];
    $mrk = $_POST['merk'];
    $typ = $_POST['tipe'];
    $ukr = $_POST['ukuran'];

    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM mobil WHERE no_pemilik = '$no' AND no_plat = '$plt'")) > 0) {
        mysqli_query($db, "UPDATE mobil SET nama_pemilik = '$nm', tipe_mobil = '$typ', status_data = '1' WHERE no_plat = '$plt'");
        $status = true;
    } else {
        if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM mobil WHERE no_pemilik = '$no'")) > 0) {
            setFlasher("Gagal", "tambah mobil, no Hp telah terpakai");
        }
        
        if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM mobil WHERE no_plat = '$plt'")) > 0) {
            setFlasher("Gagal", "tambah mobil, no plat telah terpakai", "error");
        } else {
            mysqli_query($db, "INSERT INTO mobil VALUES ('$plt', '$typ', '$nm', '$no', '1')");
            $status = true;
        }
    }

    if ($status) {
        $paket = $_POST['paket'];
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $antrian = mysqli_num_rows(mysqli_query($db, "SELECT * from antrian WHERE tanggal = '$date'")) + 1;
        $sql = "INSERT INTO antrian VALUES ('', '$plt', '$paket', '$antrian', '$date', '$time', 'menunggu', '1')";
        mysqli_query($db, $sql);
        setFlasher("Berhasil", "tambah antrian", "success");
    }
}