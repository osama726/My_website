<?php
// app/views/dashboard/skills.php
// متغيرات واردة: $skills, $title, $skill (لو تعديل)
?>

<section class="dashboard-section container py-5">

    <h1 class="mb-4 text-center"><?= htmlspecialchars($title) ?></h1>

    <!-- Flash Message -->
    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-info text-center mb-4">
            <?= htmlspecialchars($_SESSION['flash']); ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="row">
        <!-- العمود: قائمة المهارات -->
        <div class="col-md-8">
            <div class="card p-3 shadow-sm">
                <h3 class="mb-3">All Skills</h3>

                <?php if (!empty($skills)): ?>
                    <table class="table table-dark table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Icon / Class</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($skills as $s): ?>
                                <tr>
                                    <td><?= $s['id'] ?></td>
                                    <td><?= htmlspecialchars($s['name']) ?></td>
                                    <td>
                                        <?php if (!empty($s['icon'])): ?>
                                            <!-- نعرض الأيقونة لو هي class -->
                                            <i class="<?= htmlspecialchars($s['icon']) ?>"></i>
                                            <small class="text-muted ms-2"><?= htmlspecialchars($s['icon']) ?></small>
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= BASE_URL ?>?controller=dashboard&action=skills&id=<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= BASE_URL ?>?controller=dashboard&action=skills&delete=<?= $s['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this skill?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No skills found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- العمود: الفورم لإضافة أو تعديل -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <?php
                    $isEdit = isset($_GET['id']);
                    $formTitle = $isEdit ? 'Edit Skill' : 'Add New Skill';
                    $currentSkill = $isEdit ? $skill : null;
                    $formAction = BASE_URL . "?controller=dashboard&action=skills";
                ?>

                <h3 class="mb-3 text-center"><?= $formTitle ?></h3>

                <form action="<?= $formAction ?>" method="POST">
                    <?php if ($isEdit && !empty($currentSkill['id'])): ?>
                        <input type="hidden" name="skill_id" value="<?= htmlspecialchars($currentSkill['id']) ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="name" class="form-label">Skill Name</label>
                        <input type="text" name="name" id="name" class="form-control" required value="<?= $isEdit ? htmlspecialchars($currentSkill['name']) : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon (CSS class)</label>
                        <input type="text" name="icon" id="icon" class="form-control" placeholder="e.g. bi bi-code" value="<?= $isEdit ? htmlspecialchars($currentSkill['icon']) : '' ?>">
                        <div class="form-text">Put the icon class (Bootstrap Icons / FontAwesome) or leave empty.</div>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <?= $isEdit ? 'Update Skill' : 'Add Skill' ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
