<?php
include '../../database/database.php';
function randColor() {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

if (isset($_GET)) {
    $clr = array();
    if (!empty($_GET['paket'])) {
        $tmp = array();
        $pkt = array();
        $len = mysqli_num_rows(mysqli_query($db, "SELECT id_paket FROM paket_pencucian WHERE status_data = '1'"));
        $paket = mysqli_query($db, "SELECT id_paket FROM paket_pencucian");
        while ($p = mysqli_fetch_assoc($paket)) {
            $pt = mysqli_fetch_assoc(mysqli_query($db, "SELECT nama_paket FROM paket_pencucian WHERE id_paket = " . $p['id_paket']));
            $pt = $pt['nama_paket'];
            array_push($pkt, ucwords($pt));
            array_push($tmp, mysqli_num_rows(mysqli_query($db, "SELECT * FROM antrian WHERE id_paket = " . $p['id_paket'] . " AND status = 'selesai'")));
            array_push($clr, randColor());
        }

        $sum = array_sum($tmp);
        for ($i = 0; $i < $len; $i++) { 
            $tmp[$i] = round($tmp[$i] / $sum * 100);
        }

        $res = array(
            'nama' => $pkt,
            'count' => $tmp,
            'color' => $clr
        );
    } else if ($_GET['penjualan']) {
        $cnt = array();
        $tahun = date("Y");
        for ($i = 1; $i <= 12; $i++) {
            if ($i <= 9) {
                $tanggal = "$tahun-0$i"; 
            } else {
                $tanggal = "$tahun-$i";
            }
            array_push($cnt, mysqli_num_rows(mysqli_query($db, "SELECT * FROM antrian WHERE tanggal LIKE '%$tanggal%' AND status = 'selesai'")));
        }
        $res = array(
            'count' => $cnt,
            'color' => [randColor(), randColor()]
        );
    }
    echo json_encode($res);
}