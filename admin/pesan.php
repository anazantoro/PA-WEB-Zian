<?php
include 'init.php';
$title = 'pesan';
include 'template/header.php';

function pesan($data = null)
{
    if (isset($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM pesan WHERE nama_pesan LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], 'SELECT * FROM pesan');
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

$pesan = pesan($_GET['search']);

?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pesan Customer</h1>
            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">List Pesan Customer</div>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center no-footer">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Pesan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($pesan)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['nama_pesan'] ?></td>
                                    <td class="align-middle"><?= $d['email'] ?></td>
                                    <td class="align-middle"><?= $d['no_pesan'] ?></td>
                                    <td class="align-middle"><?= $d['pesan'] ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete" value="<?= $d['id_pesan'] ?>">
                                            <i class="fas fa-times"></i>
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
<?php include 'template/modal.php' ?>
<script>
    $(document).ready(function() {
        var controller = 'controllers/Controllerpesan.php'
        $('#formAll').attr('action', controller)
    })
</script>
<?php include 'template/footer.php' ?>