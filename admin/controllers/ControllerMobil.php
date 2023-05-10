<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if ($_GET['merk']) {
            $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM merk_mobil WHERE merk_mobil = '$id'"));
            $res = array(
                'merk' => $d['merk_mobil']
            );
        } else if ($_GET['tipe']) {
            $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM tipe_mobil WHERE tipe_mobil = '$id'"));
            $res = array(
                'merk' => $d['merk_mobil'],
                'tipe' => $d['tipe_mobil'],
                'ukuran' => $d['ukuran_mobil']
            );
        } else {
            $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM mobil WHERE no_plat = '$id'"));
            $res = array(
                'plat' => $d['no_plat'],
                'nama' => $d['nama_pemilik'],
                'no' => $d['no_pemilik'],
                'merk' => $d['merk_mobil'],
                'tipe' => $d['tipe_mobil'],
            );
        }
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
    }
    echo json_encode($res);
}

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'store':
            switch ($_POST['form']) {
                case 'mobil':
                    $nm = $_POST['nama'];
                    $no = $_POST['no'];
                    $plt = strtoupper($_POST['plat']);
                    $typ = ucFirst($_POST['tipe']);
                    $ukr = $_POST['ukuran'];
        
                    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM mobil WHERE no_pemilik = '$no'")) > 0) {
                        setFlasher("Gagal", "tambah mobil, no Hp telah terpakai");
                        return;
                    }
        
                    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM mobil WHERE no_plat = '$plt'")) > 0) {
                        setFlasher("Gagal", "tambah mobil, no plat telah terpakai", "error");
                        return;
                    } else {
                        $sql = "INSERT INTO mobil VALUES ('$plt', '$typ', '$nm', '$no', '1')";
                        mysqli_query($db, $sql);
                    }
                    setFlasher("berhasil", "tambah mobil");
                    break;
                case 'merk':
                    $mrk = ucFirst($_POST['merk']);
                    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM merk_mobil WHERE merk_mobil LIKE '$mrk'")) <= 0) {
                        $sql = "INSERT INTO merk_mobil VALUES ('$mrk')";
                        mysqli_query($db, $sql);
                        setFlasher("berhasil", "tambah merk");
                    } else {
                        setFlasher("Gagal", "tambah merk", "error");
                    }
                    break;
                case 'tipe':
                    $mrk = ucFirst($_POST['merk']);
                    $typ = ucFirst($_POST['tipe']);
                    $ukr = $_POST['ukuran'];

                    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM tipe_mobil WHERE tipe_mobil LIKE '$typ' AND tipe_mobil LIKE '$mrk'")) <= 0) {
                        $sql = "INSERT INTO tipe_mobil VALUES ('$mrk', '$typ', '$ukr')";
                        mysqli_query($db, $sql);
                        setFlasher("berhasil", "tambah tipe");
                    } else {
                        setFlasher("gagal", "tambah tipe", "error");
                    }
                    break;
                default:
                    header('Location: ../dashboard.php');
                    break;
            }
            break;
        case 'delete':
            $id = $_POST['id'];
            switch ($_POST['form']) {
                case 'mobil':
                    $id = $_POST['id'];
                    mysqli_query($db, "UPDATE mobil SET status_data = '0' WHERE no_plat = '$id'");
                    setFlasher("Berhasil", "hapus mobil");
                    break;
                case 'merk':
                    $id = $_POST['id'];
                    $sql = "DELETE FROM merk_mobil WHERE merk_mobil = '$id'";
                    mysqli_query($db, $sql);
                    setFlasher("Berhasil", "hapus merk mobil");
                    break;
                case 'tipe':
                    $id = $_POST['id'];
                    $sql = "DELETE FROM tipe_mobil WHERE tipe_mobil = '$id'";
                    mysqli_query($db, $sql);
                    setFlasher("Berhasil", "hapus tipe mobil");
                    break;
                default:
                    header('Location: ../dashboard.php');
                    break;
            }
                break;
        case 'update':
            $id = $_POST['id'];
            switch ($_POST['form']) {
                case 'mobil':
                    $plat = $_POST['plat'];
                    $nm = $_POST['nama'];
                    $no = $_POST['no'];
                    $tipe = $_POST['tipe'];
                    mysqli_query($db, "UPDATE mobil SET no_plat = '$plat', nama_pemilik = '$nm', no_pemilik = '$no', tipe_mobil = '$tipe' WHERE no_plat = '$id'");
                    setFlasher("Berhasil", "update mobil");
                    break;
                case 'merk':
                    $mrk = $_POST['merk'];
                    mysqli_query($db, "UPDATE merk_mobil SET merk_mobil = '$mrk' WHERE merk_mobil = '$id'");
                    setFlasher("Berhasil", "update mobil", "success");
                    break;
                case 'tipe':
                    $mrk = $_POST['merk'];
                    $typ = $_POST['tipe'];
                    $ukr = $_POST['ukuran'];
                    mysqli_query($db, "UPDATE tipe_mobil SET merk_mobil = '$mrk', tipe_mobil = '$typ', ukuran_mobil = '$ukr' WHERE tipe_mobil = '$id'");
                    setFlasher("Berhasil", "update mobil", "success");
                    break;
                default:
                    header('Location: ../dashboard.php');
                    break;
            }
            break;
        case 'restore':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE mobil SET status_data = '1' WHERE no_plat = '$id'");
            setFlasher("Berhasil", "restore mobil");
            break;
        case 'del':
            $id = $_POST["id"];
            mysqli_query($db, "DELETE FROM mobil WHERE no_plat = '$id'");
            setFlasher("Berhasil", "delete permanent mobil");
            break;
        default:
            header('Location: ../dashboard.php');
            break;
    }
}
