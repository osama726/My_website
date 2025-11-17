    <!-- About Section -->
<section id="about" class="about section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span class="subtitle">About Me</span>
        <h2>About Me</h2>
        <p>Welcome, let's go on a little journey about me</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">
            <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="<?= UPLOAD_DIR . htmlspecialchars($about['profile_image']) ??  'default.jpg'?>" class="img-fluid" alt="<?= htmlspecialchars($about['full_name'] ?? 'Profile') ?>" loading="lazy">
                            <div class="status-indicator <?= ($about['is_available_for_work'] ?? 0) ? 'status-available' : 'status-busy' ?>"></div>
                        </div>
                        <h3><?= htmlspecialchars($about['full_name'] ?? 'Osama Gamal') ?></h3>
                        <span class="role">Software Engineer</span>
                    </div>

                <div class="profile-actions">
                    <?php if (!empty($about['cv_link'])): ?>
                            <a href="<?= UPLOAD_DIR . htmlspecialchars($about['cv_link']) ?>" class="btn-primary" target="_blank" download="<?= UPLOAD_DIR . htmlspecialchars($about['cv_link']) ?>">
                                <i class="bi bi-download"></i> Download My CV
                            </a>
                    <?php endif; ?>
                    <a href="#contact" class="btn-secondary"><i class="bi bi-envelope"></i> Contact</a>
                </div>

                <div class="social-connect">
                    <a href="https://github.com/osama726" target="_blank"><i class="bi bi-github"></i></a>
                    <a href="https://www.linkedin.com/in/osama-gamal1" target="_blank"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100009817217337" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/osama_gamall1?igsh=MWVlMmM2b2FhaWZ5bA==" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a href="https://x.com/Osama_Gamalll" target="_blank"><i class="fa-brands fa-x-twitter"></i></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-8" data-aos="fade-left" data-aos-delay="200">
            <div class="content-wrapper">
                <div class="bio-section">
                    <div class="section-tag">About Me</div>
                    <h2>Transforming Ideas into Digital Reality</h2>
                    <p><?= nl2br(htmlspecialchars($about['bio_text'] ?? 'Please update your bio from the dashboard.')) ?></p>
                    <p>I also have some skills in front-end development, design, and presentations. I have given numerous presentations and helped organize numerous previous events.</p>
                </div>

                <div class="details-grid">
                    <div class="detail-item" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-mortarboard"></i>
                        <div class="detail-content">
                            <span>Degree</span>
                            <strong>Bachelor’s Degree in Management Information Systems (Mis) | 2025</strong>
                        </div>
                    </div>

                    <div class="detail-item" data-aos="fade-up" data-aos-delay="350">
                        <i class="bi bi-geo-alt"></i>
                        <div class="detail-content">
                            <span>Based In</span>
                            <strong>Egypt, Mansoura</strong>
                        </div>
                    </div>

                    <div class="detail-item" data-aos="fade-up" data-aos-delay="100">
                        <i class="bi bi-envelope"></i>
                        <div class="detail-content">
                            <span>Email</span>
                            <strong><a class="gmail" href="mailto:oosamaaggamall@gmail.com">oosamaaggamall@gmail.com</a></strong>
                        </div>
                    </div>

                    <div class="detail-item" data-aos="fade-up" data-aos-delay="150">
                        <i class="bi bi-phone"></i>
                        <div class="detail-content">
                            <span>Phone</span>
                            <strong><a href="tel:01098154424">+2 01098154424</a></strong>
                        </div>
                    </div>

                    <div class="detail-item" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-calendar-check"></i>
                        <div class="detail-content">
                            <span>Availability</span>
                            <strong>
                                <?php if (($about['is_available_for_work'] ?? 0)): ?>
                                    <span class="text-success">Open to Work</span>
                                <?php else: ?>
                                    <span class="text-danger">Currently Busy</span>
                                <?php endif; ?>
                            </strong>
                        </div>
                    </div>

                    <div class="detail-item" data-aos="fade-up" data-aos-delay="250">
                        <i class="bi bi-briefcase"></i>
                        <div class="detail-content">
                            <span>Experience</span>
                            <strong>
                                <?= htmlspecialchars($about['years_of_experience'] ?? '0') ?>+ Years
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="testimonial-section mt-5 pt-5" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-4" data-aos="fade-right" data-aos-delay="200">
                <div class="testimonial-intro">
                    <h3>Technical Overview</h3>
                    <p>Here’s an overview of my main skills and areas of focus in development and design.</p>
                    <div class="swiper-nav-buttons mt-4">
                        <button class="slider-prev"><i class="bi bi-arrow-left"></i></button>
                        <button class="slider-next"><i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="300">
                <div class="testimonial-slider swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 800,
                            "autoplay": {
                            "delay": 5000
                            },
                            "slidesPerView": 1,
                            "spaceBetween": 30,
                            "navigation": {
                            "nextEl": ".slider-next",
                            "prevEl": ".slider-prev"
                            },
                            "breakpoints": {
                            "768": {
                                "slidesPerView": 2
                            }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper">

                        <!-- Fundamentals -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="rating mb-3">
                                    <i class="bi bi-code-slash"></i>
                                </div>
                                <h5>Fundamentals</h5>
                                <p>I learned the basics and OOP in C++ and solved many problems with it. I also studied networking fundamentals and continue to practice problem-solving.</p>
                            </div>
                        </div>

                        <!-- Front End -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="rating mb-3">
                                    <i class="bi bi-window"></i>
                                </div>
                                <h5>Front End</h5>
                                <p>I have solid front-end skills that complement my back-end work. I’ve built several small projects using HTML, CSS, and JavaScript—including this website.</p>
                            </div>
                        </div>

                        <!-- Back End -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="rating mb-3">
                                    <i class="bi bi-hdd-stack"></i>
                                </div>
                                <h5>Back End</h5>
                                <p>The back-end is my main focus. I build web applications using PHP and Laravel, ensuring security, scalability, and performance.</p>
                            </div>
                        </div>

                        <!-- Design -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="rating mb-3">
                                    <i class="bi bi-palette"></i>
                                </div>
                                <h5>Design</h5>
                                <p>I’ve gained hands-on experience in design—creating brand visuals, banners, and card designs using modern design tools.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>