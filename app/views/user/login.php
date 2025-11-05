<section class="section login-section">
    <div class="container">
        <div class="section-title text-center">
            <h2>Welcome Back!</h2>
            <p>Please log in to access the dashboard and manage your portfolio.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="auth-card">
                    <form action="<?= BASE_URL ?>?controller=user&action=loginPost" method="POST">
                        
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
                            <input type="password" name="password" required class="form-control" placeholder="Your password">
                        </div>

                        <button type="submit" class="btn btn-accent w-100 mt-3">
                            <i class="bi bi-box-arrow-in-right"></i> Log in
                        </button>

                        <p class="mt-4 text-center">
                            New user? <a href="<?= BASE_URL ?>?controller=user&action=register" class="accent-link">Create an account</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>