<section class="section register-section">
    <div class="container">
        <div class="section-title text-center">
            <h2>Register</h2>
            <p>Create an account to manage your content.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="<?= BASE_URL ?>?controller=user&action=registerPost" method="POST" class="php-email-form">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" required class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter your phone number">
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-2">Register</button>

                    <p class="mt-3 text-center">
                        Already have an account? <a href="<?= BASE_URL ?>?controller=user&action=login">Log in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
