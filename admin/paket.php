<?php
include 'init.php';
$title = 'Paket';
include 'template/header.php';

if (!visible('admin|manager', $data['status'])) {
    header('Location: dashboard.php');
}

function paket($data = null) {
    if (!empty($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM paket_pencucian WHERE status_data = '1' AND nama_paket LIKE '%$data%' OR desc_paket LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM paket_pencucian WHERE status_data = '1'");
}

$paket = paket($_GET['search']);

?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Paket Pencucian</h1>
            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">Data Paket</div>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-success btn-add">Tambah Paket</button>
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
                                        <button class="btn btn-danger btn-delete" value="<?= $d['id_paket'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-update" value="<?= $d['id_paket'] ?>">
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
        var controller = 'controllers/ControllerPaket.php'
        $('#formAll').attr('action', controller)

        $('.btn-add').click(function() {
            $('#modalTitle').html('Tambah Paket')
            $('#action').val('store')
            $('#modalForm').modal('show')
        });


        $('.btn-update').click(function() {
            $('#modalTitle').html('Update Paket')
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
                    $('#id').val(id)
                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });
                    $('#modalForm').modal('show')
                }
            })

        })
    })
</script>
<?php include 'template/footer.php' ?>