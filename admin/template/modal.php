<div class="modal fade" data-backdrop="static" tabindex="-1" id="confirm">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus data</h5>
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
<div class="modal fade" id="modalForm" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="formPage">
            <form id="formAll" method="POST" action="">
                <input type="text" hidden name="action" id="action" value="store">
                <input type="text" hidden name="id" id="id">
                <input type="text" hidden name="form" id="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Modal title</h5>
                </div>
                <div class="modal-body">
                    <?php if (thisPage() == 'pegawai.php') : ?>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" maxlength="20" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" maxlength="20" required>
                        </div>
                        <div id="pws" class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" maxlength="20" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="textarea" class="form-control" name="alamat" id="alamat" maxlength="80" required>
                            </div>
                            <div class="col">
                                <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jk" id="p" value="P" required>
                                    <label class="form-check-label" for="p">
                                        Perempuan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jk" id="l" value="L">
                                    <label class="form-check-label" for="l">
                                        Laki-Laki
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="no" class="form-label">Nomor HP</label>
                                <input type="number" class="form-control" name="no" id="no" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status" id="status" aria-label="Default select example" required>
                                    <option value="" selected disabled>Pilih Status</option>
                                    <?php if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM user WHERE status = 'admin' AND status_data = '1'")) <= 0) : ?>
                                        <option value="admin">Admin</option>
                                    <?php endif; ?>
                                    <option value="manager">Manager</option>
                                    <option value="kasir">Kasir</option>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (thisPage() == 'mobilCustomer.php') : ?>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input maxlength="50" type="text" class="form-control" autoComplete="off" name="nama" id="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="no" class="form-label">Nomor HP</label>
                            <input type="number" min="0" class="form-control" autoComplete="off" name="no" id="no" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" required>
                        </div>
                        <div class="mb-3">
                            <label for="plat" class="form-label">Nomor plat</label>
                            <input maxlength="12" type="text" class="form-control" autoComplete="off" name="plat" id="plat" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="merk" class="form-label">Merk Mobil</label>
                                <select type="text" class="form-control select2" data-width="100%" name="merk" id="merk" required />
                                <option selected disabled>Pilih Merk</option>
                                <?php while ($d = mysqli_fetch_assoc($merk)) : ?>
                                    <option value="<?= ucFirst($d['merk_mobil']) ?>"><?= ucFirst($d['merk_mobil']) ?></option>
                                <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="tipe" class="form-label">Tipe Mobil</label>
                                <select type="text" class="form-control select2" data-width="100%" name="tipe" id="tipe" required />
                                <option selected disabled>Pilih Tipe</option>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (thisPage() == 'mobil.php') : ?>
                        <div class="mb-3">
                            <label for="merk" class="form-label">Merk Mobil</label>
                            <input type="text" class="form-control" autoComplete="off" list="merkM" name="merk" id="merk" required maxlength="20" />
                            <datalist id="merkM">
                                <?php while ($d = mysqli_fetch_assoc($merkM)) : ?>
                                    <option value="<?= ucFirst($d['merk_mobil']) ?>">
                                    <?php endwhile; ?>
                            </datalist>
                        </div>
                        <div class="mb-3 row" id="tu">
                            <div class="col">
                                <label for="tipe" class="form-label">Tipe Mobil</label>
                                <input type="text" class="form-control" autoComplete="off" name="tipe" id="tipe" required maxlength="20" />
                            </div>
                            <div class="col">
                                <label for="ukuran" class="form-label">Ukuran Mobil</label>
                                <select type="text" class="form-control" data-width="100%" name="ukuran" id="ukuran" required />
                                <option value="" selected disabled>Pilih Ukuran</option>
                                <option value="kecil">Kecil</option>
                                <option value="sedang">Sedang</option>
                                <option value="Besar">Besar</option>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (thisPage() == 'paket.php') : ?>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input maxlength="30" type="text" class="form-control" autoComplete="off" name="nama" id="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description Paket</label>
                            <textarea maxlength="100" type="text" class="form-control" autoComplete="off" name="desc" id="desc" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Paket</label>
                            <input type="number" min="0" class="form-control" autoComplete="off" name="harga" id="harga" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" required>
                        </div>
                    <?php endif; ?>
                    <?php if (thisPage() == 'antrian.php') : ?>
                        <span id="mobil">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat" class="form-label">Nomor plat</label>
                                    <select type="text" class="form-control select2" data-width="100%" name="plat" id="plat" required />
                                    <option selected disabled>Pilih Merk</option>
                                    <?php while ($d = mysqli_fetch_assoc($plat)) : ?>
                                        <option value="<?= ucwords($d['no_plat']) ?>"><?= ucwords($d['no_plat']) ?></option>
                                    <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="merk" class="form-label">Merk Mobil</label>
                                    <input maxlength="20" type="text" class="form-control" disabled list="merk" name="merk" id="merk" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="tipe" class="form-label">Tipe Mobil</label>
                                    <input maxlength="20" type="text" class="form-control" disabled list="tipe" name="tipe" id="tipe" />
                                </div>
                                <div class="col">
                                    <label for="ukuran" class="form-label">Ukuran</label>
                                    <select class="form-control" name="ukuran" id="ukuran" disabled>
                                        <option value="" selected disabled>Pilih Ukuran</option>
                                        <option value="besar">Besar</option>
                                        <option value="sedang">Sedang</option>
                                        <option value="kecil">Kecil</option>
                                    </select>
                                </div>
                            </div>
                        </span>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="paket" class="form-label">Paket Pencucian</label>
                                <select class="form-control" name="paket" id="paket" required>
                                    <option value="" selected disabled>Pilih Paket</option>
                                    <?php while ($d = mysqli_fetch_assoc($paket)) : ?>
                                        <option value="<?= $d['id_paket'] ?>"><?= ucWords($d['nama_paket']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="harga" class="form-label">Biaya Biaya Pencucian</label>
                                <input type="number" name="harga" class="form-control" id="harga" disabled value="0">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="tanggal" class="form-label">Tanggal Antrian</label>
                                <input id="tanggal" type="text" class="form-control" disabled value="<?= $tgl ?>" required>
                            </div>
                            <div class="col">
                                <label for="no" class="form-label">No Antrian</label>
                                <input id="no" type="text" class="form-control" disabled value="<?= noa() ?>" required>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (thisPage() == 'transaksi.php') : ?>
                        <div class="mb-3">
                            <label for="nota" class="form-label">No. Nota</label>
                            <input type="text" class="form-control" name="nota" id="nota" readonly value="<?= $nota ?>">
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="antrian" class="form-label">Antrian</label>
                                <select class="form-control" name="antrian" id="antrian" required>
                                    <option selected disabled>Pilih Transaksi</option>
                                    <?php while ($p = mysqli_fetch_assoc($antrian)) : ?>
                                        <option value="<?= $p['id_antrian'] ?>"><?= $p['no_plat'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="group" class="form-label">Group Pencuci</label>
                                <select class="form-control" name="group" id="group" required>
                                    <option selected disabled>Pilih Group</option>
                                    <?php while ($p = mysqli_fetch_assoc($group)) : ?>
                                        <option value="<?= $p['id_group'] ?>"><?= $p['nama_group'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="bayar" class="form-label">Bayar</label>
                            <input type="number" class="form-control" name="bayar" id="bayar" placeholder="Jumlah Pembayaran" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" required>
                            <div id="pwindicator" class="pwindicator">
                                <div id="bayaran" class="label text-danger"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="extra" class="form-label">Extra Biaya</label>
                            <input type="number" class="form-control" name="extra" id="extra" placeholder="Extra Biaya" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="biaya" class="form-label">Biaya</label>
                                <input type="number" class="form-control" name="biaya" id="biaya" placeholder="Biaya" readonly>
                            </div>
                            <div class="col">
                                <label for="total" class="form-label">Total biaya</label>
                                <input type="number" class="form-control" id="total" placeholder="Total Biaya" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="kembali" class="form-label">Kembalian</label>
                            <input type="number" class="form-control" id="kembali" placeholder="Kembalian" disabled>
                        </div>
                    <?php endif; ?>
                    <?php if (thisPage() == 'pencuci.php') : ?>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input maxlength="30" type="text" class="form-control" autoComplete="off" name="nama" id="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">No HP</label>
                            <input type="number" class="form-control" name="no" id="no" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Grup</label>
                            <select class="form-control" name="group" id="group">
                                <option selected disabled>Pilih Grup</option>
                                <?php while ($p = mysqli_fetch_assoc($group)) : ?>
                                    <option value="<?= $p['id_group'] ?>"><?= $p['nama_group'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <?php if (thisPage() == 'group.php') : ?>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Grup</label>
                            <input maxlength="30" type="text" class="form-control" autoComplete="off" name="nama" id="nama" required>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button id="submit" type="submit" class="btn btn-success mx-2">Submit</button>
                    <button type="button" class="btn btn-danger btn-cancel" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?= Flash() ?>

        $('.btn-cancel').click(function() {
            $(':input', '#modalForm').val('').prop('checked', false).prop('selected', false)
            $('#pws').removeClass('d-none')
            $('#mobil').removeClass('d-none');
            $('#password').attr({
                required: true,
                name: "password"
            })
            $('#tipe').html('<option selected disabled> Pilih Tipe </option>')
            $('.modal').modal('hide')
        })

        $('#formAll').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response) {
                    $('.modal').modal('hide')
                    window.location = window.location.href.split('?')[0]
                }
            })

        })

        $('.btn-delete').click(function() {
            $('#confirm').modal('show')
            let id = $(this).val()
            $('.confirmation').click(function() {
                if (Boolean($(this).val())) {
                    $.ajax({
                        url: $('#formAll').attr('action'),
                        method: 'POST',
                        data: {
                            id: id,
                            action: "delete",
                            form: $('#form').val()
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
    })
</script>