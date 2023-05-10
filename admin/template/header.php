<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Carwash &rsaquo; <?= $title ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="../resources/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../resources/modules/prism/prism.css">
    <link rel="stylesheet" href="../resources/modules/datatables/css/datatables.min.css">
    <link rel="stylesheet" href="../resources/modules/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="../resources/modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="../resources/modules/bootstrap-daterangepicker/daterangepicker.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/components.css">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>

    <!-- General JS Scripts -->
    <script src="../resources/modules/jquery.min.js"></script>
    <script src="../resources/modules/popper.js"></script>
    <script src="../resources/modules/tooltip.js"></script>
    <script src="../resources/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../resources/modules/moment.min.js"></script>
    <script src="../resources/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="../resources/modules/prism/prism.js"></script>
    <script src="../resources/modules/datatables/datatables.min.js"></script>
    <script src="../resources/modules/izitoast/js/iziToast.min.js"></script>
    <script src="../resources/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="../resources/modules/chart.min.js"></script>
    <script src="../resources/modules/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Page Specific JS File -->
    <script src="../resources/js/page/bootstrap-modal.js"></script>
    <script src="../resources/js/page/modules-toastr.js"></script>
    <script src="../resources/js/page/modules-chartjs.js"></script>
    <script src="../resources/js/page/forms-advanced-forms.js"></script>

    <!-- Template JS File -->
    <script src="../resources/js/scripts.js"></script>
    <script src="../resources/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                searching: false,
                ordering: true,
                paging: false,
            });

            $('.daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                drops: 'down',
                opens: 'right'
            });
        });
    </script>
</head>

<body class="sidebar-mini">
    <div id="app">