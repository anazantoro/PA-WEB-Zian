<?php
session_start();
include '../../database/database.php';
include '../../config/flasher.php';

if (isset($_GET)) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $d = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pencuci WHERE id_pencuci = $id"));
        $res = array(
            'id' => $d['id_pencuci'],
            'nama' => $d['nama_pencuci'],
            'no' => $d['no_pencuci'],
            'group' => $d['id_group']
        );
    }
    echo json_encode($res);
}

if (!empty($_POST)) {
    switch ($_POST['action']) {
        case 'store':
            $nm = $_POST['nama'];
            $no = $_POST['no'];
            $gp = $_POST['group'];
            if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM pencuci WHERE no_pencuci = '$no'")) == 0) {
                $sql = "INSERT INTO pencuci VALUES ('', '$nm', '$no', '$gp')";
                mysqli_query($db, $sql);
                setFlasher("Berhasil", "tambah pencuci");
            } else {
                setFlasher("Gagal", "tambah pencuci", "error");
            }
            break;
        case 'delete':
            $id = $_POST['id'];
            if (mysqli_num_rows(mysqli_query($db, "DELETE FROM pencuci WHERE id_pencuci = '$id'")) <= 0) {
                setFlasher("Gagal", "hapus pencuci", "error");
            } else {
                mysqli_query($db, "DELETE FROM pencuci WHERE id_pencuci = '$id'");
                setFlasher("Berhasil", "hapus pencuci");
            }
            break;
        case 'update':
            $id = $_POST['id'];
            $nm = $_POST['nama'];
            $no = $_POST['no'];
            $gp = $_POST['group'];
            $sql = "UPDATE pencuci SET nama_pencuci = '$nm', no_pencuci = '$no', id_group = '$gp' WHERE id_pencuci = $id";
            mysqli_query($db, $sql);
            setFlasher("Berhasil", "update");
            break;
        default:
            header('Location: ../pencuci.php');
            break;
    }
}
