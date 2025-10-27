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
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/main.css">
    <!-- <link rel="stylesheet" href="assets/style.css"> -->
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="container">
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

    <script src="<?= BASE_URL ?>assets/js/main.js"></script>

        <!-- إمكانية تحميل سكربتات خاصة بالصفحة -->
    <?php if (!empty($pageScripts) && is_array($pageScripts)): ?>
        <?php foreach ($pageScripts as $script): ?>
            <script src="<?= BASE_URL . $script ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
