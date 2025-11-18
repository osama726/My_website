<section id="projects" class="projects section">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>My Projects</h2>
            <p class="subtitle"><?= $showAll ? 'All my projects' : 'Some of my recent work' ?></p>
        </div>

        <?php if (empty($projects)): ?>
            <div class="text-center p-5 border rounded-3 project-empty-state">
                <i class="bi bi-folder2-open display-4 mb-3"></i>
                <h3>No Projects Yet!</h3>
                <p>Add your first project from the dashboard.</p>
            </div>
        <?php else: ?>

            <?php 
                // show only first 6 projects if not showing all
                $displayProjects = $showAll ? $projects : array_slice($projects, 0, 6);
            ?>

            <div class="projects-grid">
                <?php foreach ($displayProjects as $p): ?>
                    <?php 
                        $status = $p['status'] ?? 'In Progress';
                        $statusClass = match($status) {
                            'Completed' => 'bg-success',
                            'In Progress' => 'bg-info',
                            'On Hold' => 'bg-warning',
                            'Archived' => 'bg-secondary',
                            default => 'bg-info',
                        };
                        $statusicon = match($status) {
                            'Completed' => 'bi bi-check-circle-fill',
                            'In Progress' => 'bi bi-hourglass-split',
                            'On Hold' => 'bi bi-stop-circle',
                            'Archived' => 'bi bi-folder2-open',
                            default => 'bi bi-check-circle-fill',
                        };
                    ?>
                    <div class="project-card" data-aos="zoom-in">
                        <div class="project-thumb">
                            <?php if (!empty($p['image'])): ?>
                                <img src="<?= UPLOAD_DIR . htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['title']) ?>">
                            <?php else: ?>
                                <div class="no-image"><i class="bi bi-card-image"></i></div>
                            <?php endif; ?>

                            <span class="project-status-badge badge <?= $statusClass ?>">
                                <!-- <i class="bi bi-check-circle-fill me-1"></i> <?= htmlspecialchars($status) ?> -->
                                <i class="<?= $statusicon ?> me-1"></i> <?= htmlspecialchars($status) ?>
                            </span>

                            <div class="project-overlay">
                                <h4><?= htmlspecialchars($p['title'] ?? 'Untitled Project') ?></h4>
                                <p><?= htmlspecialchars($p['description'] ?? 'No description available.') ?></p>
                            </div>
                        </div>

                        <div class="project-buttons">
                            <?php if (!empty($p['link'])): ?>
                                <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank" class="btn-view">
                                    <i class="bi bi-box-arrow-up-right"></i> Live Demo
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($p['github_link'])): ?>
                                <a href="<?= htmlspecialchars($p['github_link']) ?>" target="_blank" class="btn-code">
                                    <i class="bi bi-github"></i> Code
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (!$showAll && count($projects) > 6): ?>
                <div class="text-center mt-4">
                    <a href="<?= BASE_URL ?>?controller=projects&action=index" class="btn-view-more">
                        <i class="bi bi-grid"></i> View More
                    </a>
                </div>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</section>
