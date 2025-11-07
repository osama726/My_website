<section class="section dashboard-section">
    <div class="container">

        <div class="section-title text-center">
            <p class="subtitle mt-5" style="font-size: larger; margin-bottom: -50px">Quick overview and management shortcuts.</p>
            
        </div>

        <div class="row gy-4 mb-5">
            
            <div class="col-lg-4 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg-accent"><i class="bi bi-folder-fill"></i></div>
                    <div class="stat-content">
                        <p class="stat-label">Total Projects</p>
                        <h3 class="stat-value"><?= count($projects) ?></h3>
                    </div>
                    <a href="<?= BASE_URL ?>?controller=dashboard&action=projects" class="btn-manage">
                        Manage Projects <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg-secondary"><i class="bi bi-gear-fill"></i></div>
                    <div class="stat-content">
                        <p class="stat-label">Total Skills</p>
                        <h3 class="stat-value"><?= count($skills) ?></h3>
                    </div>
                    <a href="<?= BASE_URL ?>?controller=dashboard&action=skills" class="btn-manage">
                        Manage Skills <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg"><i class="bi bi-people-fill"></i></div>
                    <div class="stat-content">
                        <p class="stat-label">Access Level</p>
                        <h3 class="stat-value text-capitalize"><?= htmlspecialchars($user['role'] ?? 'User') ?></h3>
                    </div>
                    <a href="<?= BASE_URL ?>?controller=dashboard&action=users" class="btn-manage">
                        Manage Users <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row gy-4 mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg-info"><i class="bi bi-envelope-fill"></i></div>
                    <div class="stat-content">
                        <p class="stat-label">Unread Messages</p>
                        <h3 class="stat-value text-danger"><?= $totalUnreadMessages ?? 0 ?></h3> 
                    </div>
                    <a href="<?= BASE_URL ?>?controller=dashboard&action=messages" class="btn-manage">
                        View Messages <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="info-box">
                    <h4>User Profile & Actions</h4>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li><i class="bi bi-envelope-fill"></i> <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
                        <li><i class="bi bi-phone-fill"></i> <strong>Phone:</strong> <?= htmlspecialchars($user['phone'] ?? '—') ?></li>
                    </ul>
                    <a href="<?= BASE_URL ?>" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-house-door-fill"></i> View Website
                    </a>
                    <a href="<?= BASE_URL ?>?controller=user&action=logout" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Log out
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</section>