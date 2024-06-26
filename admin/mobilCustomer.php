<?php
include 'init.php';
$title = 'Customer';
include 'template/header.php';

$merk = mysqli_query($db, "SELECT * FROM merk_mobil");
$tipe = mysqli_query($db, "SELECT * FROM tipe_mobil");

function mobilCustomer($data = null) {
    if (isset($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM mobil INNER JOIN tipe_mobil ON mobil.tipe_mobil = tipe_mobil.tipe_mobil WHERE tipe_mobil.merk_mobil LIKE '%$data%' OR mobil.no_plat LIKE '%$data%' OR mobil.tipe_mobil LIKE '%$data%' AND mobil.status_data = '1'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM mobil INNER JOIN tipe_mobil ON mobil.tipe_mobil = tipe_mobil.tipe_mobil WHERE status_data = '1'");
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
                                        <button class="btn btn-danger btn-delete my-2" value="<?= $d['no_plat'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-update my-2" value="<?= $d['no_plat'] ?>">
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
        var controller = 'controllers/ControllerMobil.php'
        $('#formAll').attr('action', controller)
        $('#form').val('mobil')

        $('#merk').on('change', function(e) {
            $.ajax({
                url: controller,
                method: 'GET',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#tipe').html('<option selected disabled> Pilih Tipe </option>')
                    $.each(response['tipe'], function(i, item) {
                        $('#tipe').append($('<option>', {
                            value: item,
                            text: item
                        }));
                    });
                }
            })
        })

        $('.btn-add').click(function() {
            $('#modalTitle').html('Tambah Mobil')
            $('#action').val('store')
            $('#modalForm').modal('show')
        });

        $('.btn-update').click(function() {
            $('#modalTitle').html('Update Mobil')
            var id = $(this).val()
            $.ajax({
                method: "GET",
                url: controller,
                data: {
                    id: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    $('#action').val('update')
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