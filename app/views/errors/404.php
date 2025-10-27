<?php
    // app/views/errors/404.php
    http_response_code(404);
?>

<!-- <p>الصفحة المطلوبة غير موجودة.</p> -->

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">404</li>
          </ol>
        </nav>
        <h1>404</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Error 404 Section -->
    <section id="error-404" class="error-404 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-8">
            <div class="error-box text-center">
              <div class="error-icon" data-aos="zoom-in" data-aos-delay="200">
                <i class="bi bi-exclamation-triangle"></i>
              </div>
              <div class="error-code" data-aos="fade-up" data-aos-delay="300">
                <span>4</span>
                <span>0</span>
                <span>4</span>
              </div>
              <h2 data-aos="fade-up" data-aos-delay="400">Page Not Found</h2>
              <p data-aos="fade-up" data-aos-delay="500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <div class="error-actions" data-aos="fade-up" data-aos-delay="600">
                <a href="/" class="btn-home">
                  <i class="bi bi-house-door"></i>
                  <span>Back to Home</span>
                </a>
                <a href="/contact" class="btn-support">
                  <i class="bi bi-headset"></i>
                  <span>Get Support</span>
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Error 404 Section -->

  </main>