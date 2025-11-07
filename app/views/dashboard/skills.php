<section class="section dashboard-section">
    <div class="container" data-aos="fade-up">

        <div class="section-title text-center">
            <h3 class="subtitle mt-5">Manage your technical skills easily</h3>
        </div>

        <!-- Flash Message -->
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert alert-info text-center mb-4">
                <?= htmlspecialchars($_SESSION['flash']); ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <div class="row g-4">
        
            <!-- 🧠 Skills Table -->
            <div class="col-lg-8">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h4><i class="bi bi-list-check me-2"></i> All Skills</h4>
                    </div>

                    <?php if (!empty($skills)): ?>
                        <div class="table-responsive">
                            <table class="custom-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Skill</th>
                                        <th>Icon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($skills as $s): ?>
                                        <tr>
                                            <td><?= $s['id'] ?></td>
                                            <td><strong><?= htmlspecialchars($s['name']) ?></strong></td>
                                            <td>
                                                <?php if (!empty($s['icon'])): ?>
                                                    <i class="<?= htmlspecialchars($s['icon']) ?> me-2"></i>
                                                    <small class="text-muted"><?= htmlspecialchars($s['icon']) ?></small>
                                                <?php else: ?>
                                                    <span class="text-muted">—</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL ?>?controller=dashboard&action=skills&id=<?= $s['id'] ?>" class="btn-icon edit"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="<?= BASE_URL ?>?controller=dashboard&action=skills&delete=<?= $s['id'] ?>" onclick="return confirm('Delete this skill?')" class="btn-icon delete"><i class="bi bi-trash3-fill"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center py-4 text-muted">No skills found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 🧩 Add/Edit Skill Form -->
            <div class="col-lg-4">
                <?php
                    $isEdit = isset($_GET['id']);
                    $formTitle = $isEdit ? 'Edit Skill' : 'Add New Skill';
                    $currentSkill = $isEdit ? $skill : null;
                    $formAction = BASE_URL . "?controller=dashboard&action=skills";
                ?>
                <div class="dashboard-card">
                    <div class="card-header text-center">
                        <h4><i class="bi bi-plus-circle"></i> <?= $formTitle ?></h4>
                    </div>

                    <form action="<?= $formAction ?>" method="POST" class="dashboard-form">
                        <?php if ($isEdit && !empty($currentSkill['id'])): ?>
                            <input type="hidden" name="skill_id" value="<?= htmlspecialchars($currentSkill['id']) ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Skill Name</label>
                            <input type="text" name="name" id="name" class="form-control" required value="<?= $isEdit ? htmlspecialchars($currentSkill['name']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (CSS class)</label>
                            <input type="text" name="icon" id="icon" class="form-control" placeholder="e.g. bi bi-code-slash" value="<?= $isEdit ? htmlspecialchars($currentSkill['icon']) : '' ?>">
                            <div class="form-text" style="color: rgb(140 143 147);">Use Bootstrap Icons, FontAwesome, etc. Leave empty for default.</div>
                        </div>

                        <button type="submit" class="btn-submit">
                            <?= $isEdit ? 'Update Skill' : 'Add Skill' ?>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
