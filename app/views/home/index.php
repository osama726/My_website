<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

		<img src="<?= UPLOAD_DIR ?>me2.jpeg" alt="" data-aos="fade-in">
		<!-- <img src="<?= UPLOAD_DIR ?>title.png" alt="" data-aos="fade-in"> -->
		<!-- <div class="img"></div> -->
		
		<div class="container" data-aos="fade-up" data-aos-delay="100">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<h2><?= $title ?? 'Welcome to My Portfolio' ?></h2>
					<p>I'm a <span class="typed" data-typed-items="Software Engineer, Back_End, Developer, Freelancer, Programmer"></span><span class="typed-cursor" aria-hidden="true"></span></p>
					<div class="social-links">
						<a href="https://github.com/osama726" target="_blank"><i class="bi bi-github"></i></a>
						<a href="https://www.linkedin.com/in/osama-gamal1" target="_blank"><i class="bi bi-linkedin"></i></a>
						<a href="https://www.facebook.com/profile.php?id=100009817217337" target="_blank"><i class="bi bi-facebook"></i></a>
						<a href="https://www.instagram.com/osama_gamall1?igsh=MWVlMmM2b2FhaWZ5bA==" target="_blank"><i class="bi bi-instagram"></i></a>
						<a href="https://x.com/Osama_Gamalll" target="_blank"><i class="fa-brands fa-x-twitter"></i></i></a>
					</div>
				</div>
			</div>
		</div>
</section>

<?php
	include __DIR__ . '/../about/index.php';
	include __DIR__ . '/../skills/index.php';
	include __DIR__ . '/../projects/index.php';
	include __DIR__ . '/../contact/contact.php';