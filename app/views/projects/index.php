<!-- app/views/projects/index.php -->
<section class="section">
    <div class="container">
        <div class="section-title">
        <h2><?= htmlspecialchars($title) ?></h2>
        <p class="subtitle">My recent work</p>
        </div>

        <?php if (empty($projects)): ?>
            <p>No projects yet. <a href="<?= BASE_URL ?>?controller=dashboard&action=index">Go to dashboard</a> to add one.</p>
        <?php else: ?>
            <div class="row">
                <?php foreach ($projects as $p): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card p-3" style="background:var(--surface-color);">
                            <h5><?= htmlspecialchars($p['title'] ?? 'Untitled') ?></h5>
                            <p style="color: #a15252;"><?= htmlspecialchars($p['description'] ?? '') ?></p>
                            <a href="<?= BASE_URL ?>?controller=projects&action=show&id=<?= $p['id'] ?? '' ?>">View</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
