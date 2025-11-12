<!-- app/views/layouts/main.php -->
<?php
    // require_once __DIR__ . '/../../config/config.php';

    // بداية الصفحة نبدأ الجلسة لو ما كانتش بدأت
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Osama Gamal</title>
    <meta content="Portfolio and projects of Osama Gamal, PHP and Laravel developer." name="description">
    <link rel="icon" type="image/png" href="<?= UPLOAD_DIR ?>dark_logo.png">
    <link rel="apple-touch-icon" href="<?= UPLOAD_DIR ?>dark_logo.png"> 
    <link rel="apple-touch-icon" href="<?= UPLOAD_DIR ?>dark_logo.png" sizes="192x192">
    <!-- Vendor CSS Files -->
    <link href="<?= BASE_URL ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

    <!-- main CSS File -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/main.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>

        <!-- هنا يُحمّل محتوى الصفحة -->
        <?php require $viewPath; ?>

    </main>

    <?php include 'footer.php'; ?>


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <!-- <div id="preloader"></div> -->

    <!-- Vendor JS Files -->
    <script src="<?= BASE_URL ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/aos/aos.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/typed.js/typed.umd.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- jQuery JS File -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

    <!-- Main JS File -->
    <script src="<?= BASE_URL ?>assets/js/main.js"></script>

    <!-- إمكانية تحميل سكربتات خاصة بالصفحة -->
    <?php if (!empty($pageScripts) && is_array($pageScripts)): ?>
        <?php foreach ($pageScripts as $script): ?>
            <script src="<?= BASE_URL . $script ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
