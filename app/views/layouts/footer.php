<?php
// app/views/layouts/footer.php
?>

<footer id="footer" class="footer">

  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-5 col-md-12 footer-about">
        <a href="index.php" class="logo d-flex align-items-center me-auto">
            <img src="<?= UPLOAD_DIR ?>dark_logo.png" class="logo-dark">
            <img src="<?= UPLOAD_DIR ?>light_logo.png" class="logo-light">
        </a>
        <p><pre>والناسُ إن رَأَوا الجمالَ فإنَّما … أبصارُهم لا تُبصرُ الجوهَرَا
            فهنا أعمل حيث لا تُسلَّط الأضواء، ولكن ينهض كل شيء مما أكتب.</pre></p>
        <div class="social-links d-flex mt-4">
          <a href="https://github.com/osama726" target="_blank"><i class="bi bi-github"></i></a>
          <a href="https://www.linkedin.com/in/osama-gamal1" target="_blank"><i class="bi bi-linkedin"></i></a>
          <a href="https://www.facebook.com/profile.php?id=100009817217337" target="_blank"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/osama_gamall1?igsh=MWVlMmM2b2FhaWZ5bA==" target="_blank"><i class="bi bi-instagram"></i></a>
          <a href="https://x.com/Osama_Gamalll" target="_blank"><i class="fa-brands fa-x-twitter"></i></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-6 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><a href="#hero">Home</a></li>
          <li><a href="#about">About us</a></li>
          <li><a href="#skills">Skills</a></li>
          <li><a href="#projects">Projects</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-6 footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><a href="#contact">Back_End Development</a></li>
          <li><a href="#contact">Web Development</a></li>
          <li><a href="#contact">Web Design</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
        <h4>Contact Us</h4>
        <p class="mt-4"><strong>Phone:</strong> <span><a href="tel:01098154424">01098154424</a></span></p>
        <p><strong>Email:</strong> <a class="gmail" href="mailto:oosamaaggamall@gmail.com">oosamaaggamall@gmail.com</a></p>
      </div>

    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>&copy; <?= date('Y') ?> <strong class="px-1 sitename">Osama</strong> — Built with php & a lot of caffeine ☕</p>
    <div class="credits">
      Created by <strong><a href="#about">OSAMA GAMAL</a></strong>
    </div>
  </div>
</footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>