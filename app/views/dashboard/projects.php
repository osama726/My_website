<section class="section dashboard-section">
    <div class="container" data-aos="fade-up">

        <div class="section-title text-center">
            <h3 class="subtitle mt-5">Manage your portfolio projects easily</h3>
        </div>

        <!-- Flash Message -->
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert alert-info text-center mb-4">
                <?= htmlspecialchars($_SESSION['flash']); ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <div class="row g-4">
        
            <!-- 🧱 Projects Table -->
            <div class="col-lg-8">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h4><i class="bi bi-list-task me-2"></i> All Projects</h4>
                    </div>

                    <?php if (!empty($projects)): ?>
                        <div class="table-responsive">
                            <table class="custom-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Links</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($projects as $p): ?>
                                        <tr>
                                            <td><?= $p['id'] ?></td>
                                            <td><?= htmlspecialchars($p['title']) ?></td>
                                            <td><?= htmlspecialchars(substr($p['description'], 0, 60)) ?>...</td>
                                            <td>
                                                <?php if (!empty($p['image'])): ?>
                                                    <img src="<?= UPLOAD_DIR . htmlspecialchars($p['image']) ?>" alt="" class="table-thumb">
                                                <?php else: ?>
                                                    <span class="text-muted">No image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($p['link'])): ?>
                                                    <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank" class="link-icon" title="Live Preview"><i class="bi bi-box-arrow-up-right"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($p['github_link'])): ?>
                                                    <a href="<?= htmlspecialchars($p['github_link']) ?>" target="_blank" class="link-icon" title="GitHub Repo"><i class="bi bi-github"></i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL ?>?controller=dashboard&action=projects&id=<?= $p['id'] ?>" class="btn-icon edit"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="<?= BASE_URL ?>?controller=dashboard&action=projects&delete=<?= $p['id'] ?>" onclick="return confirm('Delete this project?')" class="btn-icon delete"><i class="bi bi-trash3-fill"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center py-4 text-muted">No projects found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 🧩 Add/Edit Project Form -->
            <div class="col-lg-4">
                <?php
                    $isEdit = isset($_GET['id']);
                    $formTitle = $isEdit ? 'Edit Project' : 'Add New Project';
                    $formAction = BASE_URL . "?controller=dashboard&action=projects";
                    $currentProject = $isEdit ? $project : null;
                ?>
                <div class="dashboard-card">
                    <div class="card-header text-center">
                        <h4><i class="bi bi-plus-circle"></i> <?= $formTitle ?></h4>
                    </div>

                    <form action="<?= $formAction ?>" method="POST" enctype="multipart/form-data" class="dashboard-form">
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
                            <label for="github_link" class="form-label">GitHub Link</label>
                            <input type="url" name="github_link" id="github_link" class="form-control"
                                value="<?= $isEdit ? htmlspecialchars($currentProject['github_link']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Project Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <?php if ($isEdit && !empty($currentProject['image'])): ?>
                                <img src="<?= UPLOAD_DIR . htmlspecialchars($currentProject['image']) ?>" alt="Current" class="preview-img">
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn-submit">
                            <?= $isEdit ? 'Update Project' : 'Add Project' ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
