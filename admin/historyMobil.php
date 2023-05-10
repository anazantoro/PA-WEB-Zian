<?php
include 'init.php';
$title = 'Customer';
include 'template/header.php';

function mobilCustomer($data = null)
{
    if (isset($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM mobil INNER JOIN tipe_mobil ON mobil.tipe_mobil = tipe_mobil.tipe_mobil WHERE tipe_mobil.merk_mobil LIKE '%$data%' OR mobil.no_plat LIKE '%$data%' OR mobil.tipe_mobil LIKE '%$data%' AND mobil.status_data = '0'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM mobil INNER JOIN tipe_mobil ON mobil.tipe_mobil = tipe_mobil.tipe_mobil WHERE status_data = '0'");
}

$mobilCustomer = mobilCustomer($_GET['search']);

?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Mobil Customer</h1>
            </div>
            <div id="updateForm">

            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">Data Mobil Customer</div>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-success btn-add">Tambah Customer</button>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Plat</th>
                                <th scope="col">Nama</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Merk Mobil</th>
                                <th scope="col">Tipe Mobil</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($mobilCustomer)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['no_plat'] ?></td>
                                    <td class="align-middle"><?= $d['nama_pemilik'] ?></td>
                                    <td class="align-middle"><?= $d['no_pemilik'] ?></td>
                                    <td class="align-middle"><?= $d['merk_mobil'] ?></td>
                                    <td class="align-middle"><?= $d['tipe_mobil'] ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-warning btn-restore" value="<?= $d['no_plat'] ?>">
                                            <i class="fas fa fa-window-restore"></i>
                                        </button>
                                        <button class="btn btn-danger btn-delete" value="<?= $d['no_plat'] ?>">
                                            <i class="fas fa fa-times"></i>
                                        </button>
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
        var controller = 'controllers/ControllerMobil.php'
        $('#controller').val(controller)
    })
</script>
<?php include 'template/footer.php' ?>