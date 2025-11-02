<!-- <section id="about-section" class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4">من أنا</h2>
        
        <div class="row">
            <div class="col-md-4">
                <img src="<?= htmlspecialchars($about['image_path'] ?? '') ?>" alt="صورة الملف الشخصي لأسامة" class="img-fluid rounded-circle">
            </div>
            
            <div class="col-md-8">
                <h3><?= htmlspecialchars($about['headline'] ?? '') ?></h3>
                <p class="lead"><?= nl2br(htmlspecialchars($about['bio'] ?? '')) ?></p>
                
                <?php if (!empty($about['cv_link'])): ?>
                    <a href="<?= htmlspecialchars($about['cv_link']) ?>" class="btn btn-primary" target="_blank">
                        <i class="fa-solid fa-download"></i> تحميل السيرة الذاتية (CV)
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section> -->


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
                            <img src="<?= htmlspecialchars($about['image_path'] ?? '') ?>" class="img-fluid" alt="">
                            <div class="status-indicator"></div>
                        </div>
                        <h3>Osama Gamal</h3>
                        <span class="role">Full Stack Developer</span>
                        <div class="rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <span>4.8</span>
                        </div>
                    </div>

                <div class="profile-stats">
                    <div class="stat-item">
                        <h4>156</h4>
                        <p>Projects</p>
                        </div>
                        <div class="stat-item">
                        <h4>8+</h4>
                        <p>Years</p>
                        </div>
                        <div class="stat-item">
                        <h4>42</h4>
                        <p>Awards</p>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="<?= htmlspecialchars($about['cv_link']) ?>" class="btn-primary"><i class="bi bi-download"></i> Download My CV</a>
                    <a href="#" class="btn-secondary"><i class="bi bi-envelope"></i> Contact</a>
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
                    <p><?= htmlspecialchars($about['bio'] ?? '') ?></p>
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
                            <strong><a class="gmail" href="mailto:oosamaaggamall@gmail.com" style="color: white;">oosamaaggamall@gmail.com</a></strong>
                        </div>
                    </div>

                    <div class="detail-item" data-aos="fade-up" data-aos-delay="150">
                        <i class="bi bi-phone"></i>
                        <div class="detail-content">
                            <span>Phone</span>
                            <strong><a href="tel:01098154424" style="color: white;">+2 01098154424</a></strong>
                        </div>
                    </div>

                    <div class="detail-item" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-calendar-check"></i>
                        <div class="detail-content">
                            <span>Availability</span>
                            <strong>Open to Work</strong>
                        </div>
                    </div>

                    <div class="detail-item" data-aos="fade-up" data-aos-delay="250">
                        <i class="bi bi-briefcase"></i>
                        <div class="detail-content">
                            <span>Experience</span>
                            <strong>1+ Years</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
