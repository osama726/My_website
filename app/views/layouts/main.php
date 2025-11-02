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
    <title><?= $title ?? 'My Web' ?></title>
    <!-- Bootstrap (for grid/util classes used by the template) -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

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
        <!-- Flash messages (مثال: تسجيل ناجح، خطأ في الفاليديشن...) -->
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="flash">
                <?= htmlspecialchars($_SESSION['flash']); ?>
            </div>
            <?php unset($_SESSION['flash']); // نعرض الرسالة مرة واحدة فقط ?>
        <?php endif; ?>

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
