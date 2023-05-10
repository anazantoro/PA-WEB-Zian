<div class="modal fade" data-backdrop="static" tabindex="-1" id="confirm">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Restore data</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="controller">
                <input type="hidden" name="form" id="form">
                <p>Apakah anda yakin untuk mengembalikan data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning confirmation" value="true">Restore</button>
                <button type="button" class="btn btn-cancel confirmation">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" data-backdrop="static" tabindex="-1" id="delete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data Permanen</h5>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk hapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger confirmation" value="true">Delete</button>
                <button type="button" class="btn btn-warning confirmation">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?= Flash() ?>

        $('.btn-restore').click(function() {
            $('#confirm').modal('show')
            let id = $(this).val()
            $('.confirmation').click(function() {
                if (Boolean($(this).val())) {
                    $.ajax({
                        url: $('#controller').val(),
                        method: 'POST',
                        data: {
                            id: id,
                            action: "restore",
                        },
                        success: function(response) {
                            window.location = window.location;
                        }
                    })
                } else {
                    $('#confirm').modal('hide')
                }
            })
        })

        $('.btn-delete').click(function() {
            $('#delete').modal('show')
            let id = $(this).val()
            $('.confirmation').click(function() {
                if (Boolean($(this).val())) {
                    $.ajax({
                        url: $('#controller').val(),
                        method: 'POST',
                        data: {
                            id: id,
                            action: "del",
                        },
                        success: function(response) {
                            window.location = window.location;
                        }
                    })
                } else {
                    $('#delete').modal('hide')
                }
            })
        })
    })
</script>