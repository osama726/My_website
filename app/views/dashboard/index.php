<section class="section dashboard-section">
    <div class="container">

        <div class="section-title text-center">
            <h2>Welcome, <?= htmlspecialchars($user['name']) ?></h2>
            <p class="subtitle">This is your personal dashboard</p>
        </div>

        <div class="row gy-4">
        
            <!-- 🧠 معلومات المستخدم -->
            <div class="col-lg-4">
                <div class="card p-4" style="background: var(--surface-color); border-radius: 10px;">
                    <h5>User Info</h5>
                    <ul class="list-unstyled mt-3">
                        <li><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
                        <li><strong>Phone:</strong> <?= htmlspecialchars($user['phone'] ?? '—') ?></li>
                    </ul>
                    <a href="<?= BASE_URL ?>?controller=user&action=logout" class="btn btn-danger btn-sm mt-3">
                        Log out
                    </a>
                </div>
            </div>

            <!-- 💼 المشاريع -->
            <div class="col-lg-4">
                <div class="card p-4" style="background: var(--surface-color); border-radius: 10px;">
                    <h5>Your Projects</h5>
                    <p>Total: <?= count($projects) ?></p>
                    <ul class="list-unstyled">
                        <?php foreach ($projects as $p): ?>
                        <li>• <?= htmlspecialchars($p['title']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?= BASE_URL ?>?controller=projects&action=index" class="btn btn-primary btn-sm mt-3 mb-3">
                        View Projects
                    </a>
                    <a href="<?= BASE_URL ?>?controller=dashboard&action=projects" class="btn btn-outline-primary">
                        Manage Projects
                    </a>
                </div>
            </div>

            <!-- ⚙️ المهارات -->
            <div class="col-lg-4">
                <div class="card p-4" style="background: var(--surface-color); border-radius: 10px;">
                    <h5>Your Skills</h5>
                    <p>Total: <?= count($skills) ?></p>
                    <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                        <?php foreach ($skills as $s): ?>
                        <span class="badge bg-secondary"><?= htmlspecialchars($s['name']) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?= BASE_URL ?>?controller=skills&action=index" class="btn btn-outline-light btn-sm mt-3 mb-3">
                        View Skills
                    </a>
                    <a href="<?= BASE_URL ?>?controller=dashboard&action=skills" class="btn btn-outline-primary">
                        Manage Skills
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
