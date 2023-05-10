<?php
include 'init.php';
$title = 'History';
include 'template/header.php';

function paket($data = null)
{
    if (!empty($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM paket_pencucian WHERE status_data = '0' AND nama_paket LIKE '%$data%' OR desc_paket LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM paket_pencucian WHERE status_data = '0'");
}

$paket = paket($_GET['search']);
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
                <?php if ($_GET['content'] == 'paket' || empty($_GET['content'])) : ?>
                    <div class="col-12">
                        <div class="section-title">Data Paket</div>
                    </div>
                    <div class="col-12">
                        <table class="table table-hover text-center no-footer">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($d = mysqli_fetch_assoc($paket)) : ?>
                                    <tr>
                                        <td class="align-middle"><?= $i ?></td>
                                        <td class="align-middle"><?= $d['nama_paket'] ?></td>
                                        <td class="align-middle"><?= $d['desc_paket'] ?></td>
                                        <td class="align-middle"><?= $d['harga_paket'] ?></td>
                                        <td class="align-middle">
                                            <button class="btn btn-warning btn-restore" value="<?= $d['id_paket'] ?>">
                                                <i class="fas fa fa-window-restore"></i>
                                            </button>
                                            <button class="btn btn-danger btn-delete" value="<?= $d['id_paket'] ?>">
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
        var controller = 'controllers/ControllerPaket.php'
        $('#controller').val(controller)
    })
</script>
<?php include 'template/footer.php' ?>