<?php
include 'init.php';
$title = 'group';
include 'template/header.php';

function group($data = null)
{
    if (isset($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM group_pencuci WHERE nama_group LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], 'SELECT * FROM group_pencuci');
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

$group = group($_GET['search']);

?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Grup Pencuci</h1>
            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">Data Grup Pencuci</div>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-success btn-add">Tambah Grup Pencuci</button>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center no-footer">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Grup</th>
                                <th scope="col">Handler Cucian</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($group)) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['nama_group'] ?></td>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete" value="<?= $d['id_group'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-update" value="<?= $d['id_group'] ?>">
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
        var controller = 'controllers/ControllerGroup.php'
        $('#formAll').attr('action', controller)

        $('.btn-add').click(function() {
            $('#modalTitle').html('Tambah Grup')
            $('#action').val('store')
            $('#modalForm').modal('show')
        });


        $('.btn-update').click(function() {
            $('#modalTitle').html('Update Grup')
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