<?php
include 'init.php';
$title = 'Nota';
include 'template/header.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $transaksi = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM transaksi WHERE id_antrian = $id"));
    $antrian = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM ((antrian INNER JOIN mobil ON antrian.no_plat = mobil.no_plat) INNER JOIN paket_pencucian ON antrian.id_paket = paket_pencucian.id_paket) WHERE antrian.id_antrian = $id"));
}

?>
<div id="content" class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Nota Pembayaran</h1>
            </div>
            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print" id="printable">
                        <div class="row mt-4 mx-1">
                            <div class="col-md-12">
                                <div class="invoice-title">
                                    <h2>Nota Pembayaran</h2>
                                    <div class="invoice-number">Nota #<?= $transaksi['no_nota'] ?></div>
                                </div>
                                <hr class="mt-2 mb-0">
                                <div class="row mt-4">
                                    <div class="col-lg-8">
                                        <address>
                                            <strong>Customer :</strong><br>
                                            <?= $antrian['nama_pemilik'] ?><br>
                                            <?= $antrian['no_plat'] ?><br>
                                        </address>
                                        <address>
                                            <strong>Paket :</strong><br>
                                            <?= ucwords($antrian['nama_paket']) ?><br>
                                        </address>
                                        <address>
                                            <strong>Tanggal :</strong><br>
                                            <?= $antrian['tanggal'] ?><br>
                                        </address>
                                        <address>
                                            <strong>Kasir :</strong><br>
                                            <?= $data['nama_user'] ?>
                                        </address>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Biaya</div>
                                            <div class="invoice-detail-value">Rp <?= $transaksi['biaya'] ?></div>
                                        </div>
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Biaya Tambahan</div>
                                            <div class="invoice-detail-value">Rp <?= $transaksi['extra_biaya'] ?></div>
                                        </div>
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">Rp <?= $transaksi['biaya'] + $transaksi['extra_biaya'] ?></div>
                                        </div>
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Bayar</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">Rp <?= $transaksi['total_bayar'] ?></div>
                                        </div>
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Kembali</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">Rp <?= $transaksi['total_bayar'] - ($transaksi['biaya'] + $transaksi['extra_biaya']) ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                        <div class="float-lg-left mb-lg-0 mb-3">
                            <a href="transaksi.php" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i>
                                Cancel</a>
                        </div>
                        <button id="print" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i>
                            Print</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="invoice w-50 m-0 p-0" id="printarea">

</div>
<script>
    $(document).ready(function() {
        $('#print').click(function() {
            $("#printarea").html($("#printable").html());
            $('#content').addClass('d-none');
            setTimeout(window.print(), 1000)
            $("#printarea").html('');
            $('#content').removeClass('d-none');
        })
    });
</script>
<?php include 'template/footer.php' ?>