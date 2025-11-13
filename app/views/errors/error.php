<?php
    // app/views/errors/error.php
    http_response_code($code ?? 404);
?>

<main class="main_error">

    <!-- Error Section -->
    <section id="error-404" class="error-404 section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="error-box text-center">

                        <!-- ✅ الأيقونة حسب الكود -->
                        <div class="error-icon" data-aos="zoom-in" data-aos-delay="200">
                            <?php if ($code == 403): ?>
                                <i class="bi bi-shield-lock"></i>
                            <?php elseif ($code == 500): ?>
                                <i class="bi bi-bug"></i>
                            <?php else: ?>
                                <i class="bi bi-exclamation-triangle"></i>
                            <?php endif; ?>
                        </div>


                        <!-- ✅ الكود نفسه -->
                        <div class="error-code" data-aos="fade-up" data-aos-delay="300">
                            <span><?= htmlspecialchars($code) ?></span>
                        </div>

                        <!-- ✅ العنوان -->
                        <h2 data-aos="fade-up" data-aos-delay="400">
                            <?= htmlspecialchars($title ?? 'Error') ?>
                        </h2>

                        <!-- ✅ الرسالة -->
                        <p data-aos="fade-up" data-aos-delay="500">
                            <?= htmlspecialchars($message ?? 'An unexpected error occurred.') ?>
                        </p>

                        <!-- ✅ زر العودة -->
                        <div class="error-actions" data-aos="fade-up" data-aos-delay="600">
                            <a href="<?= BASE_URL ?>" class="btn-home">
                                <i class="bi bi-house-door"></i>
                                <span>Back to Home</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Error Section -->

</main>
