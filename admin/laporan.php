<?php
include 'init.php';
$title = 'Laporan';
include 'template/header.php';

if (isset($_POST)) {
    $date = explode(' - ', $_POST['daterange']);
    $status = $_POST['status'];
    $str = $date[0];
    $end = $date[1];
    $transaksi = mysqli_query($db, "SELECT * FROM ((antrian INNER JOIN transaksi ON antrian.id_antrian = transaksi.id_antrian) INNER JOIN group_pencuci ON transaksi.id_group = group_pencuci.id_group) WHERE antrian.tanggal BETWEEN '$str' AND '$end' AND transaksi.status_data = '$status'");
}

?>
<div id="content" class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php' ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Pencucian</h1>
            </div>
            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print row" id="printable">
                        <div class="col-12 text-center mt-3 mb-3">
                            <h3>Laporan Pencucian <?= $str ?> hingga <?= $end ?></h3>
                        </div>
                        <div class="col-12">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No Nota</th>
                                        <th scope="col">No Plat</th>
                                        <th scope="col">Group Pencuci</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $sum = 0;
                                    while ($d = mysqli_fetch_assoc($transaksi)) : ?>
                                        <tr>
                                            <td class="align-middle"><?= $i ?></td>
                                            <td class="align-middle"><?= $d['no_nota'] ?></td>
                                            <td class="align-middle"><?= $d['no_plat'] ?></td>
                                            <td class="align-middle"><?= $d['nama_group'] ?></td>
                                            <td class="align-middle"><?= $d['tanggal'] ?></td>
                                            <td class="align-middle"><?= $d['waktu'] ?></td>
                                            <td class="align-middle"><?= $sm = $d['biaya'] + $d['extra_biaya'] ?></td>
                                        </tr>
                                    <?php $i++;
                                        $sum += $sm;
                                    endwhile; ?>
                                    <tr class="align-middle border-top">
                                        <td colspan="6" class="align-right">Total Pendapatan</td>
                                        <td colspan="1" class="align-right"><?= $sum ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                        <div class="float-lg-left mb-lg-0 mb-3">
                            <a href="transaksi.php" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i>Cancel</a>
                        </div>
                        <button id="print" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i>Print</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="invoice w-100 m-0 p-0" id="printarea">

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