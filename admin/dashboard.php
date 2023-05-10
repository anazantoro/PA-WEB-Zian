<?php
include 'init.php';
$title = 'Dashboard';
$karyawan = mysqli_num_rows(mysqli_query($db, "SELECT id_user FROM user"));
$customer = mysqli_num_rows(mysqli_query($db, "SELECT no_plat FROM mobil"));
$transaksi = mysqli_num_rows(mysqli_query($db, "SELECT id_antrian FROM transaksi"));
$pendapatan = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(biaya), SUM(extra_biaya) FROM transaksi WHERE status_data = '1'"));
$pendapatan = $pendapatan['SUM(biaya)'] + $pendapatan['SUM(extra_biaya)'] + 0;
?>
<?php include 'template/header.php' ?>
<div class="main-wrapper main-wrapper-1">
    <?php include 'template/navbar.php' ?>
    <?php include 'template/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Karyawan</h4>
                            </div>
                            <div class="card-body">
                                <?= $karyawan ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fas fa-car"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Customer</h4>
                            </div>
                            <div class="card-body">
                                <?= $customer ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Transaksi</h4>
                            </div>
                            <div class="card-body">
                                <?= $transaksi ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pendapatan</h4>
                            </div>
                            <div class="card-body">
                                Rp <?= $pendapatan ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Penjualan Paket</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="paket" height="100"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Penjualan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="penjualan" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?= Flash() ?>

        var controller = 'controllers/ControllerDashboard.php'
        $.ajax({
            method: "GET",
            url: controller,
            data: {
                paket: true
            },
            dataType: "json",
            success: function(response) {
                new Chart($('#paket'), {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: response['count'],
                            backgroundColor: response['color'],
                            label: 'Penjualan Paket Pencucian'
                        }],
                        labels: response['nama'],
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'right',
                        },
                    }
                })
            }
        }).done(function() {
            $.ajax({
                method: "GET",
                url: controller,
                data: {
                    penjualan: true
                },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    new Chart($('#penjualan'), {
                        type: 'bar',
                        data: {
                            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                            datasets: [{
                                label: 'Penjualan Tahun Ini',
                                data: response['count'],
                                backgroundColor: response['color'][0],
                            }]
                        },
                        options: {
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    gridLines: {
                                        drawBorder: false,
                                        color: '#f2f2f2',
                                    },
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: 10
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        display: false
                                    }
                                }]
                            },
                        }
                    })
                }
            });
        })
    });
</script>
<?php include 'template/footer.php' ?>