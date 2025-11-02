<!-- <section class="hero home d-flex align-items-center justify-content-center flex-column text-center" style="min-height:60vh;">
	<div class="container">
		<h1 class="display-4 fw-bold mb-3" style="font-family: var(--heading-font); color: var(--heading-color);">
			<?= $title ?? 'مرحبا بك في Craftivo!' ?>
		</h1>
		<p class="lead mb-4" style="color: var(--default-color);">
			<?= $message ?? 'منصة لعرض مشاريعك ومهاراتك بشكل احترافي. استكشف، شارك، وابدأ رحلتك الآن!' ?>
		</p>
		<a href="#about" class="btn btn-primary btn-lg btn-getstarted mb-4" style="background: var(--accent-color); color: var(--contrast-color); border-radius: 50px;">
			ابدأ الآن
		</a>
		<div class="social-links d-flex justify-content-center mt-3">
			<a href="#" class="mx-2"><i class="bi bi-twitter-x"></i></a>
			<a href="#" class="mx-2"><i class="bi bi-facebook"></i></a>
			<a href="#" class="mx-2"><i class="bi bi-instagram"></i></a>
			<a href="#" class="mx-2"><i class="bi bi-linkedin"></i></a>
		</div>
	</div>
</section> -->

<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

		<img src="<?= UPLOAD_DIR ?>me2.jpeg" alt="" data-aos="fade-in">
		
		<div class="container" data-aos="fade-up" data-aos-delay="100">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<h2><?= $title ?? '' ?></h2>
					<p>I'm a <span class="typed" data-typed-items="Designer, Developer, Freelancer, Photographer"></span><span class="typed-cursor" aria-hidden="true"></span></p>
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
	include __DIR__ . '/../projects/index.php';
	include __DIR__ . '/../skills/index.php';