<section class="hero d-flex align-items-center justify-content-center flex-column text-center" style="min-height:60vh;">
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
</section>
