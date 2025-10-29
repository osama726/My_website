<?php
// app/views/dashboard/projects.php

// بيانات الصفحة
// المتغيرات اللي جاية من الكنترولر: $projects, $title
// وممكن يجي كمان project لو احنا جايين من وضع تعديل
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
        <!-- 🧩 عمود عرض المشاريع -->
        <div class="col-md-8">
            <div class="card p-3 shadow-sm">
                <h3 class="mb-3">All Projects</h3>

                <?php if (!empty($projects)): ?>
                    <table class="table table-dark table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projects as $p): ?>
                                <tr>
                                    <td><?= $p['id'] ?></td>
                                    <td><?= htmlspecialchars($p['title']) ?></td>
                                    <td><?= htmlspecialchars(substr($p['description'], 0, 50)) ?>...</td>
                                    <td>
                                        <?php if (!empty($p['image'])): ?>
                                            <img src="<?= UPLOAD_DIR . htmlspecialchars($p['image']) ?>" alt="" style="width: 60px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="text-muted">No image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($p['link'])): ?>
                                            <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank">Visit</a>
                                        <?php else: ?>
                                            <span class="text-muted">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= BASE_URL ?>?controller=dashboard&action=projects&id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= BASE_URL ?>?controller=dashboard&action=projects&delete=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this project?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No projects found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- 🧩 عمود الإضافة أو التعديل -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <?php
                    // لو الصفحة جايه ومعاها ?id= يبقى وضع تعديل
                    $isEdit = isset($_GET['id']);
                    $formTitle = $isEdit ? 'Edit Project' : 'Add New Project';
                    $formAction = BASE_URL . "?controller=dashboard&action=projects";
                    $currentProject = $isEdit ? $project : null;
                ?>

                <h3 class="mb-3 text-center"><?= $formTitle ?></h3>

                <form action="<?= $formAction ?>" method="POST" enctype="multipart/form-data">
                    <?php if ($isEdit && !empty($currentProject['id'])): ?>
                        <input type="hidden" name="project_id" value="<?= htmlspecialchars($currentProject['id']) ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="title" class="form-label">Project Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="<?= $isEdit ? htmlspecialchars($currentProject['title']) : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required><?= $isEdit ? htmlspecialchars($currentProject['description']) : '' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Project Link</label>
                        <input type="url" name="link" id="link" class="form-control"
                            value="<?= $isEdit ? htmlspecialchars($currentProject['link']) : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Project Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <?php if ($isEdit && !empty($currentProject['image'])): ?>
                            <img src="<?= UPLOAD_DIR . htmlspecialchars($currentProject['image']) ?>" alt="Current" style="width:100px; margin-top:10px; border-radius:8px;">
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <?= $isEdit ? 'Update Project' : 'Add Project' ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
