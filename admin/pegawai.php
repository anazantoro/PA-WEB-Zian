<?php
include 'init.php';
$title = 'Pegawai';
include 'template/header.php';

if (!visible('admin|manager', $data['status'])) {
    header('Location: dashboard.php');
}

function pegawai($data = null, $status = 1)
{
    if (isset($data) || isset($status)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM user WHERE status_data = '$status' AND nama_user LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM user WHERE status_data = '1'");
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

$pegawai = pegawai($_GET['search'], $_GET['status']);

?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pegawai</h1>
            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">Data Pegawai</div>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-success btn-add">Tambah Pegawai</button>
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
                                    <td class="align-middle p-2 my-4 <?= badge($d['status']) ?>"><?= $d['status'] ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete" value="<?= $d['id_user'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-update" value="<?= $d['id_user'] ?>">
                                            <i class="fas fa-edit"></i>
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
        var controller = 'controllers/ControllerPegawai.php'
        $('#formAll').attr('action', controller)

        $('.btn-add').click(function() {
            $('#modalTitle').html('Tambah Pegawai')
            $('#action').val('store')
            $('#modalForm').modal('show')
        });

        $('#st').change(function() {
            $.ajax({
                method: "GET",
                url: "pegawai.php",
                data: $(this).serialize(),
                success: function(response) {
                    window.location = window.location
                }
            });
        });


        $('.btn-update').click(function() {
            $('#modalTitle').html('Update Pegawai')
            $('#action').val('update')
            var id = $(this).val()
            $.ajax({
                method: "GET",
                url: controller,
                data: {
                    id: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    $('#pws').addClass('d-none')
                    $('#password').removeAttr('required name')
                    $('#id').val(id)

                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });

                    if ($('#p').val() == response['jk']) {
                        $("#p").prop("checked", true);
                    } else {
                        $("#l").prop("checked", true);
                    }

                    $('#modalForm').modal('show')
                }
            })

        })
    })
</script>
<?php include 'template/footer.php' ?>