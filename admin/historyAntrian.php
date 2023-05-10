<?php
include 'init.php';
$title = 'History';
include 'template/header.php';

function antrian($data = null)
{
    if (!empty($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM antrian INNER JOIN mobil ON antrian.no_plat = mobil.no_plat WHERE antrian.status_data = '0' AND antrian.no_plat LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM antrian INNER JOIN mobil ON antrian.no_plat = mobil.no_plat WHERE antrian.status_data = '0'");
}

$antrian = antrian($_GET['search']);

?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>History <?= ucwords($_GET['content']) ?></h1>
            </div>
            <div class="row">
                <?php if ($_GET['content'] == 'antrian' || empty($_GET['content'])) : ?>
                    <div class="col-12">
                        <div class="section-title">History Antrian</div>
                    </div>
                    <div class="col-12">
                        <table class="table table-hover text-center no-footer">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Customer</th>
                                    <th scope="col">Nomor Plat</th>
                                    <th scope="col">Paket</th>
                                    <th scope="col">Nomor Antrian</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($d = mysqli_fetch_assoc($antrian)) : ?>
                                    <tr>
                                        <td class="align-middle"><?= $i ?></td>
                                        <td class="align-middle"><?= $d['nama_pemilik'] ?></td>
                                        <td class="align-middle"><?= $d['no_plat'] ?></td>
                                        <td class="align-middle"><?= $d['id_paket'] ?></td>
                                        <td class="align-middle"><?= $d['no_antrian'] ?></td>
                                        <td class="align-middle"><?= $d['tanggal'] ?></td>
                                        <td class="align-middle"><?= $d['waktu'] ?></td>
                                        <td class="align-middle"><?= $d['status'] ?></td>
                                        <td class="align-middle">
                                            <button class="btn btn-warning btn-restore" value="<?= $d['id_antrian'] ?>">
                                                <i class="fas fa fa-window-restore"></i>
                                            </button>
                                            <button class="btn btn-danger btn-delete" value="<?= $d['id_antrian'] ?>">
                                                <i class="fas fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>
<?php include 'template/history.php' ?>
<script>
    $(document).ready(function() {
        var controller = 'controllers/ControllerAntrian.php'
        $('#controller').val(controller)
    })
</script>
<?php include 'template/footer.php' ?>