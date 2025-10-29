<section class="section login-section">
    <div class="container">
        <div class="section-title text-center">
            <h2>Login</h2>
            <p>Welcome back! Please log in to continue.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="<?= BASE_URL ?>?controller=user&action=loginPost" method="POST" class="php-email-form">
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" required class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-2">Log in</button>

                    <p class="mt-3 text-center">
                        Don't have an account? <a href="<?= BASE_URL ?>?controller=user&action=register">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
