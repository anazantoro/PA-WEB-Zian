<?php
include 'init.php';
$title = 'Antrian';
include 'template/header.php';

$tgl = date("Y-m-d");

function noa()
{
    $tgl = $GLOBALS['tgl'];
    return (mysqli_num_rows(mysqli_query($GLOBALS['db'], "SELECT id_antrian from antrian WHERE tanggal = '$tgl'")) + 1);
}

if (!visible('admin|kasir', $data['status'])) {
    header('Location: dashboard.php');
}

function antrian($data = null)
{
    if (isset($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM ((antrian INNER JOIN mobil ON antrian.no_plat = mobil.no_plat) INNER JOIN paket_pencucian ON antrian.id_paket = paket_pencucian.id_paket) WHERE antrian.status_data='1' AND paket_pencucian.status_data='1' AND antrian.no_plat LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], "SELECT * FROM ((antrian INNER JOIN mobil ON antrian.no_plat = mobil.no_plat) INNER JOIN paket_pencucian ON antrian.id_paket = paket_pencucian.id_paket) WHERE antrian.status_data='1' AND paket_pencucian.status_data='1'");
}

$plat = mysqli_query($db, 'SELECT * FROM mobil');
$paket = mysqli_query($db, 'SELECT * FROM paket_pencucian');
$antrian = antrian($_GET['search']);


function status($st, $s)
{
    return ($st == $s) ? "selected" : "";
}
?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Antrian</h1>
            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">Data Antrian</div>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-success btn-add">Tambah Antrian</button>
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
                                    <td class="align-middle"><?= $d['nama_paket'] ?></td>
                                    <td class="align-middle"><?= $d['no_antrian'] ?></td>
                                    <td class="align-middle"><?= $d['tanggal'] ?></td>
                                    <td class="align-middle"><?= $d['waktu'] ?></td>
                                    <td class="align-middle">
                                        <select class="form-control status" name="status">
                                            <option <?= status($d['status'], 'menunggu') ?> value="<?= $d['id_antrian'] ?> menunggu">Menunggu</option>
                                            <option <?= status($d['status'], 'dicuci') ?> value="<?= $d['id_antrian'] ?> dicuci">Dicuci</option>
                                            <option <?= status($d['status'], 'selesai') ?> value="<?= $d['id_antrian'] ?> selesai">Selesai</option>
                                            <option <?= status($d['status'], 'batal') ?> value="<?= $d['id_antrian'] ?> batal">Batal</option>
                                        </select>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete" value="<?= $d['id_antrian'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-update" value="<?= $d['id_antrian'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <?php if ($d['status'] == 'selesai') : ?>
                                            <a href="transaksi.php?id=<?= $d['id_antrian'] ?>" class="btn btn-success btn-transaksi">
                                                <i class="fas fa-coins"></i>
                                            </a>
                                        <?php endif; ?>
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
        var biaya = 0;
        var paket = 0;
        var controller = 'controllers/ControllerAntrian.php'
        $('#formAll').attr('action', controller)

        $('#plat').on('change', function(e) {
            $.ajax({
                url: controller,
                method: 'GET',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    biaya = parseInt(response['biaya'])
                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });
                    $('#harga').val(biaya + paket)
                },
            })
        })

        $('#paket').on('change', function(e) {
            $.ajax({
                url: controller,
                method: 'GET',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    paket = parseInt(response['harga'])
                    $('#harga').val(biaya + paket)
                }
            })
        })

        $('.status').on('change', function(e) {
            $.ajax({
                url: controller,
                method: 'POST',
                data: {
                    status: $(this).serialize(),
                    action: "updateStatus"
                },
                success: function(response) {
                    window.location = window.location;
                },
                error: function(response) {
                    console.log(response)
                }
            })
        })

        $('.btn-add').click(function() {
            $('#modalTitle').html('Tambah Antrian')
            $('#action').val('store')
            $('#modalForm').modal('show')
            $('#tanggal').val('<?= $tgl ?>');
            $('#no').val('<?= noa() ?>');
        });


        $('.btn-update').click(function() {
            $('#modalTitle').html('Update Antrian')
            $('#action').val('update')
            $('#mobil').addClass('d-none');
            var id = $(this).val()
            $.ajax({
                method: "GET",
                url: controller,
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    biaya = parseInt(response['biaya'])
                    paket = parseInt(response['harga'])
                    $.each(response, function(key, value) {
                        $('#' + key).val(value);
                    });
                    $('#harga').val(biaya + paket)

                    $('#modalForm').modal('show')
                }
            })

        })
    })
</script>
<?php include 'template/footer.php' ?>