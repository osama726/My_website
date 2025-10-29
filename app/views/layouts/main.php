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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (used by header/footer template) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
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
