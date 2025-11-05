<?php
    // app/views/layouts/header.php
    $user = $_SESSION['user'] ?? null;
?>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="index.php" class="logo d-flex align-items-center me-auto">
            <img src="<?= UPLOAD_DIR ?>Logo_osama2.png">
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="<?= BASE_URL ?>" class="active">Home</a></li>
                <li><a href="<?= BASE_URL ?>#about">About</a></li>
                <!-- <li><a href="<?= BASE_URL ?>?controller=skills&action=index">Skills</a></li> -->
                <li><a href="<?= BASE_URL ?>#skills">Skills</a></li>
                <!-- <li><a href="<?= BASE_URL ?>?controller=projects&action=index">Projects</a></li> -->
                <li><a href="<?= BASE_URL ?>#projects">Projects</a></li>
                <?php if (!empty($user)): ?>
                    <?php if (!empty($user['role']) && $user['role'] === 'admin'): ?>
                        <a class="btn-log" href="<?= BASE_URL ?>?controller=dashboard&action=index">Dashboard</a>
                    <?php endif; ?>

                    <a class="btn-log" href="<?= BASE_URL ?>?controller=user&action=logout">
                        Log out (<?= htmlspecialchars($user['name']); ?>)
                    </a>
                <?php else: ?>
                    <a class="btn-log" href="<?= BASE_URL ?>?controller=user&action=login">Log in</a>
                    <a class="btn-log" href="<?= BASE_URL ?>?controller=user&action=register">Sign in</a>
                <?php endif; ?>

                <!-- <a class="btn-getstarted" href="#about">Get Started</a> -->
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>
