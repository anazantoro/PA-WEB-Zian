<?php
include 'init.php';
$title = 'Pencuci';
include 'template/header.php';

function pencuci($data = null)
{
    if (isset($data)) {
        return mysqli_query($GLOBALS['db'], "SELECT * FROM pencuci INNER JOIN group_pencuci ON pencuci.id_group = group_pencuci.id_group WHERE nama_pencuci LIKE '%$data%'");
    }
    return mysqli_query($GLOBALS['db'], 'SELECT * FROM pencuci INNER JOIN group_pencuci ON pencuci.id_group = group_pencuci.id_group');
}

$pencuci = pencuci($_GET['search']);
$group = mysqli_query($db, "SELECT id_group, nama_group FROM group_pencuci");

?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pencuci</h1>
            </div>
            <div class="row list-data">
                <div class="col-12">
                    <div class="section-title">Data Pencuci</div>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-success btn-add">Tambah Pencuci</button>
                </div>
                <div class="col-12">
                    <table class="table table-hover text-center no-footer">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Grup</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($d = mysqli_fetch_assoc($pencuci   )) : ?>
                                <tr>
                                    <td class="align-middle"><?= $i ?></td>
                                    <td class="align-middle"><?= $d['nama_pencuci'] ?></td>
                                    <td class="align-middle"><?= $d['no_pencuci'] ?></td>
                                    <td class="align-middle"><?= $d['nama_group'] ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-danger btn-delete" value="<?= $d['id_pencuci'] ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="btn btn-warning btn-update" value="<?= $d['id_pencuci'] ?>">
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
        var controller = 'controllers/ControllerPencuci.php'
        $('#formAll').attr('action', controller)

        $('.btn-add').click(function() {
            $('#modalTitle').html('Tambah Pencuci')
            $('#action').val('store')
            $('#modalForm').modal('show')
        });


        $('.btn-update').click(function() {
            $('#modalTitle').html('Update Pencuci')
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