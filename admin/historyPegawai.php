<?php
include 'init.php';
$title = 'Pegawai';
include 'template/header.php';

if (!visible('admin|manager', $data['status'])) {
    header('Location: dashboard.php');
}

function pegawai($data = null)
{
    if (isset($data) || isset($status)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM user WHERE status_data = '0' AND nama_user LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM user WHERE status_data = '0'");
}

function jenisKelamin($j)
{
    return ($j == "L") ? "Laki-Laki" : "Perempuan";
}

function badge($s)
{
    switch ($s) {
        case 'admin':
            return 'badge badge-danger';
            break;
        case 'manager':
            return 'badge badge-info';
            break;
        default:
            return 'badge badge-primary';
            break;
    }
}

$pegawai = pegawai($_GET['search']);

?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>History Pegawai</h1>
            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">Data Pegawai</div>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center no-footer">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($pegawai)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['username'] ?></td>
                                    <td class="align-middle"><?= $d['nama_user'] ?></td>
                                    <td class="align-middle"><?= jenisKelamin($d['jenis_kelamin']) ?></td>
                                    <td class="align-middle"><?= $d['alamat_user'] ?></td>
                                    <td class="align-middle"><?= $d['no_user'] ?></td>
                                    <td class="align-middle p-2 my-4 h-50 <?= badge($d['status']) ?>"><?= $d['status'] ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-warning btn-restore" value="<?= $d['id_user'] ?>">
                                            <i class="fas fa fa-window-restore"></i>
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
        var controller = 'controllers/ControllerPegawai.php'
        $('#controller').val(controller)
    })
</script>
<?php include 'template/footer.php' ?>