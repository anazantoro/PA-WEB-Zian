<?php
include 'init.php';
$title = 'Transaksi';
include 'template/header.php';

if (!visible('admin|kasir', $data['status'])) {
    header('Location: dashboard.php');
}

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $dt = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM antrian INNER JOIN mobil ON antrian.no_plat = mobil.no_plat WHERE id_antrian = $id"));

    $tipe = $dt['tipe_mobil'];
    $ukr = mysqli_fetch_assoc(mysqli_query($db, "SELECT ukuran_mobil FROM tipe_mobil WHERE tipe_mobil = '$tipe'"));

    $ukr = $ukr['ukuran_mobil'];
    $dba = mysqli_fetch_assoc(mysqli_query($db, "SELECT biaya_tambahan FROM ukuran_mobil WHERE ukuran_mobil = '$ukr'"));

    $pkt = $dt['id_paket'];
    $dbp = mysqli_fetch_assoc(mysqli_query($db, "SELECT harga_paket FROM paket_pencucian WHERE id_paket = $pkt"));

    $biaya = $dba['biaya_tambahan'] + $dbp['harga_paket'];
}


$nota = date("Ymd") . (mysqli_num_rows(mysqli_query($db, "SELECT * FROM transaksi")) + 1);
$antrian = mysqli_query($db, "SELECT id_antrian, no_plat FROM antrian WHERE status_data = '1' AND status = 'selesai'");
$group = mysqli_query($db, "SELECT id_group, nama_group FROM group_pencuci");

function transaksi($data = null)
{
    if (isset($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM ((transaksi INNER JOIN antrian ON transaksi.id_antrian = antrian.id_antrian) INNER JOIN group_pencuci ON transaksi.id_group = group_pencuci.id_group) WHERE group_pencuci.nama_group LIKE '%$data%' OR antrian.no_plat LIKE '%$data%' AND transaksi.status_data='0'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM ((transaksi INNER JOIN antrian ON transaksi.id_antrian = antrian.id_antrian) INNER JOIN group_pencuci ON transaksi.id_group = group_pencuci.id_group) WHERE transaksi.status_data='0'");
}

$transaksi = transaksi($_GET['search']);
?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>History Transaksi</h1>
            </div>
            <div id="updateForm">

            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">History Transaksi</div>
                </div>
                <div class="col-12 mb-3 d-flex justify-content-between">
                    <div class="form-group m-0 p-0">
                        <form method="POST" action="laporan.php">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="0" readonly>
                                <input type="text" name="daterange" class="form-control daterange">
                                <div class="input-group-prepend p-0 m-0">
                                    <button type="submit" class="btn btn-info form-control shadow-none"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Plat</th>
                                <th scope="col">Grup Pencuci </th>
                                <th scope="col">Nomor Nota</th>
                                <th scope="col">Biaya</th>
                                <th scope="col">Extra Biaya</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($transaksi)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['no_plat'] ?></td>
                                    <td class="align-middle"><?= $d['nama_group'] ?></td>
                                    <td class="align-middle"><?= $d['no_nota'] ?></td>
                                    <td class="align-middle"><?= $d['biaya'] ?></td>
                                    <td class="align-middle"><?= $d['extra_biaya'] ?></td>
                                    <td class="align-middle"><?= $d['total_bayar'] ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete my-2" value="<?= $d['id_antrian'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-restore" value="<?= $d['id_antrian'] ?>">
                                            <i class="fas fa fa-window-restore"></i>
                                        </button>
                                        <a href="nota.php?id=<?= $d['id_antrian'] ?>" class="btn btn-info btn-update my-2">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php $i++;
                            endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<?php include 'template/history.php' ?>
<script>
    $(document).ready(function() {
        var controller = 'controllers/ControllerTransaksi.php'
        $('#controller').val(controller)
    })
</script>
<?php include 'template/footer.php' ?>