<?php include 'nama_halaman.php'; ?>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $page_title ?> | Sistem Bme280SS</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link href="../../assets/img/sistem_iot/logo.jpg?v=<?= time(); ?>" rel="icon" />
    <!-- Fonts and icons -->
    <script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["../../assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css?v=<?= time(); ?>" />
    <link rel="stylesheet" href="../../assets/css/plugins.min.css?v=<?= time(); ?>" />
    <link rel="stylesheet" href="../../assets/css/kaiadmin.min.css?v=<?= time(); ?>" />
    <style>
        canvas {
            width: 100% !important;
            max-height: 400px;
        }

        .card {
            margin-bottom: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #4e73df;
            font-weight: bold;
        }

        body {
            background-color: #f8f9fc;
        }
    </style>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../../assets/css/demo.css?v=<?= time(); ?>" />
</head>