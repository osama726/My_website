<section class="section register-section">
    <div class="container">
        <div class="section-title text-center">
            <h2>Create Your Account</h2>
            <p>Join now to build and manage your professional portfolio.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="auth-card">
                    <form action="<?= BASE_URL ?>?controller=user&action=registerPost" method="POST">
                        
                        <div class="form-group mb-4">
                            <label for="name" class="form-label-styled">
                                <i class="bi bi-person-fill"></i> Full Name
                            </label>
                            <input type="text" name="name" required class="form-control" placeholder="Your name">
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="form-label-styled">
                                <i class="bi bi-envelope-fill"></i> Email Address
                            </label>
                            <input type="email" name="email" required class="form-control" placeholder="Your email">
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label-styled">
                                <i class="bi bi-lock-fill"></i> Password
                            </label>
                            <input type="password" name="password" required class="form-control" placeholder="Choose a secure password">
                        </div>

                        <div class="form-group mb-4">
                            <label for="phone" class="form-label-styled">
                                <i class="bi bi-phone-fill"></i> Phone Number
                            </label>
                            <input type="text" name="phone" class="form-control" placeholder="e.g. 010XXXXXXXX">
                        </div>

                        <button type="submit" class="btn btn-accent w-100 mt-3">
                            <i class="bi bi-person-plus-fill"></i> Register
                        </button>

                        <p class="mt-4 text-center">
                            Already have an account? <a href="<?= BASE_URL ?>?controller=user&action=login" class="accent-link">Log in</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>