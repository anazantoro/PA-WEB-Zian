<?php
include 'init.php';
$title = 'Mobil';
include 'template/header.php';

function merkMobil($merk = null) {
    if (!empty($merk)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM merk_mobil WHERE merk_mobil = '$merk'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM merk_mobil");
}

function tipeMobil($tipe = null) {
    if (!empty($tipe)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM tipe_mobil WHERE tipe_mobil = '$tipe' OR merk_mobil = '$tipe'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM tipe_mobil");
}

$merk = merkMobil($_GET['search']);
$merkM = mysqli_query($db, "SELECT * FROM merk_mobil");
$tipe = tipeMobil($_GET['search']);

?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Mobil</h1>
            </div>
            <div class="row">
                <div class="col">
                    <div class="section-title">Data Merk Mobil</div>
                </div>
                <div class="col">
                    <div class="section-title">Data Tipe Mobil</div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <button class="btn btn-success btn-add-merk">Tambah Merk Mobil</button>
                    </div>
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Merk</th>
                                <th scope="col" width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($merk)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['merk_mobil'] ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete btn-delete-merk" value="<?= $d['merk_mobil'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-update-merk" value="<?= $d['merk_mobil'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php $i++;
                            endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <button class="btn btn-success btn-add-tipe">Tambah Tipe Mobil</button>
                    </div>
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Merk mobil</th>
                                <th scope="col">Tipe mobil</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col" width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($tipe)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['merk_mobil'] ?></td>
                                    <td class="align-middle"><?= $d['tipe_mobil'] ?></td>
                                    <td class="align-middle"><?= $d['ukuran_mobil'] ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete btn-delete-tipe" value="<?= $d['tipe_mobil'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-update btn-update-tipe" value="<?= $d['tipe_mobil'] ?>">
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
        function requiredTipe() {
            $('#tipe').attr('required', true);
            $('#ukuran').attr('required', true);
        }

        function inessentialTipe() {
            $('#tipe').removeAttr('required');
            $('#ukuran').removeAttr('required');
        }

        var controller = 'controllers/ControllerMobil.php'
        $('#formAll').attr('action', controller)

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

        $('.btn-add-merk').click(function() {
            $('#modalTitle').html('Tambah Merk Mobil')
            $('#action').val('store')
            $('#form').val('merk')

            inessentialTipe()

            $('#tu').addClass('d-none')
            $('#modalForm').modal('show')
        })

        $('.btn-add-tipe').click(function() {
            $('#modalTitle').html('Tambah Tipe Mobil')
            $('#action').val('store')
            $('#form').val('tipe')

            requiredTipe()

            $('#tu').removeClass('d-none')
            $('#modalForm').modal('show')
        })

        $('.btn-update-merk').click(function() {
            $('#modalTitle').html('Update merk Mobil')
            $('#tu').addClass('d-none')
            inessentialTipe()
            var id = $(this).val()
            $.ajax({
                method: "GET",
                url: controller,
                data: {
                    id: $(this).val(),
                    merk: true
                },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    $('#action').val('update')
                    $('#form').val('merk')
                    $('#id').val(id)

                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });

                    $('#modalForm').modal('show')
                }
            })

        })

        $('.btn-update-tipe').click(function() {
            $('#modalTitle').html('Update Tipe Mobil')
            $('#tu').removeClass('d-none')
            requiredTipe()
            var id = $(this).val()
            $.ajax({
                method: "GET",
                url: controller,
                data: {
                    id: $(this).val(),
                    tipe: true
                },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    $('#action').val('update')
                    $('#form').val('tipe')
                    $('#id').val(id)

                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });

                    $('#modalForm').modal('show')
                }
            })

        })

        $('.btn-delete-merk').click(function() {
            $('#form').val('merk')
        })

        $('.btn-delete-tipe').click(function() {
            $('#form').val('tipe')
        })

    })
</script>
<?php include 'template/footer.php' ?>