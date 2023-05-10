<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM user WHERE id_user = $id"));
        $res = array(
            'id' => $d['id_user'],
            'nama' => $d['nama_user'],
            'no' => $d['no_user'],
            'alamat' => $d['alamat_user'],
            'status' => $d['status'],
            'jk' => $d['jenis_kelamin'],
            'username' => $d['username'],
        );
    }
    echo json_encode($res);
}

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'store':
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $no = $_POST['no'];
            if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM user WHERE username = '$username' OR no_user = '$no'")) == 0) {
                $password = md5($_POST['password']);
                $alamat = $_POST['alamat'];
                $jk = $_POST['jk'];
                $status = $_POST['status'];
                $sql= "INSERT INTO user VALUES ('', '$nama', '$no', '$alamat', '$status', '$jk', '$username', '$password', '1')";
                mysqli_query($db, $sql);
                setFlasher("Berhasil", "tambah pegawai");
            } else {
                setFlasher("Gagal", "tambah pegawai", "error");
            }
            break;
        case 'delete':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE user SET status_data = '0' WHERE id_user = $id");

            setFlasher("Berhasil", "hapus pegawai");
            break;
        case 'update':
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $alamat = $_POST['alamat'];
            $no = $_POST['no'];
            $jk = $_POST['jk'];
            $status = $_POST['status'];
            $sql = "UPDATE user SET nama_user = '$nama', no_user = '$no', alamat_user = '$alamat', status = '$status', jenis_kelamin = '$jk', username = '$username' WHERE id_user = $id";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "update");
            break;
        case 'restore':
            $id = $_POST['id'];
            mysqli_query($db, "UPDATE user SET status_data = '1' WHERE id_user = $id");
            setFlasher("Berhasil", "restore pegawai");
            break;
        default:
            header('Location: ../pegawai.php');
        break;
    }
}