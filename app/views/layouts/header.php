<?php
    // app/views/layouts/header.php
    $user = $_SESSION['user'] ?? null;
?>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        
        <nav id="navmenu" class="navmenu">
            <ul>
                <a href="index.php" class="logo d-flex align-items-center me-auto">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.webp" alt=""> -->
                    <img src="<?= UPLOAD_DIR ?>Logo_osama2.png">
                    <!-- <h1 class="sitename">Craftivo</h1> -->
                </a>
                <li><a href="<?= BASE_URL ?>" class="active">Home</a></li>
                <li><a href="<?= BASE_URL ?>?controller=projects&action=index">Projects</a></li>
                <li><a href="<?= BASE_URL ?>?controller=skills&action=index">Skills</a></li>
                <!-- <li><a href="#portfolio">Portfolio</a></li> -->
                <!-- <li><a href="#resume">Resume</a></li> -->
                <!-- <li><a href="#about">About</a></li> -->
                <!-- <li><a href="#contact">Contact</a></li> -->
                <?php if ($user): ?>
                    <a href="<?= BASE_URL ?>?controller=dashboard&action=index">لوحة التحكم</a>
                    <a href="<?= BASE_URL ?>?controller=user&action=logout">تسجيل خروج (<?= htmlspecialchars($user['name']); ?>)</a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>?controller=user&action=login">تسجيل دخول</a>
                    <a href="<?= BASE_URL ?>?controller=user&action=register">تسجيل جديد</a>
                <?php endif; ?>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="#about">Get Started</a>

    </div>
</header>