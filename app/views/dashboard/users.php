<section class="dashboard-section users-dashboard py-5">
    <div class="container">

        <div class="section-title text-center mb-5">
            <h3 class="subtitle mt-5">Manage all registered users and roles.</h3>
        </div>

        <!-- Flash Message -->
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert alert-info text-center mb-4">
                <?= htmlspecialchars($_SESSION['flash']); ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <div class="row g-4">

            <!-- جدول المستخدمين -->
            <div class="col-lg-8">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4><i class="bi bi-people-fill me-2"></i>All Users</h4>
                        <span class="badge bg-accent px-3"><?= count($users) ?> total</span>
                    </div>

                    <?php if (!empty($users)): ?>
                        <div class="table-responsive">
                            <table class="custom-table align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $u): ?>
                                        <tr>
                                            <td><?= $u['id'] ?></td>
                                            <td><?= htmlspecialchars($u['name']) ?></td>
                                            <td><?= htmlspecialchars($u['email']) ?></td>
                                            <td><?= htmlspecialchars($u['phone'] ?? '—') ?></td>
                                            <td>
                                                <span class="badge <?= $u['role'] == 'admin' ? 'bg-danger' : 'bg-secondary' ?>">
                                                    <?= htmlspecialchars(ucfirst($u['role'])) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL ?>?controller=dashboard&action=users&id=<?= $u['id'] ?>" 
                                                    class="btn-icon edit" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="<?= BASE_URL ?>?controller=dashboard&action=users&delete=<?= $u['id'] ?>" 
                                                    class="btn-icon delete" 
                                                    onclick="return confirm('Are you sure you want to delete this user?')" 
                                                    title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center mt-4">No users found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- نموذج الإضافة أو التعديل -->
            <div class="col-lg-4">
                <div class="dashboard-form">
                    <?php
                        $isEdit = isset($userData) && !empty($userData);
                        $formTitle = $isEdit ? 'Edit User' : 'Add New User';
                        $formAction = BASE_URL . "?controller=dashboard&action=users";
                    ?>
                    <h4 class="text-center mb-4">
                        <i class="bi <?= $isEdit ? 'bi-person-gear' : 'bi-person-plus' ?>"></i>
                        <?= $formTitle ?>
                    </h4>

                    <form action="<?= $formAction ?>" method="POST">
                        <?php if ($isEdit): ?>
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($userData['id']) ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                    value="<?= $isEdit ? htmlspecialchars($userData['name']) : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                    value="<?= $isEdit ? htmlspecialchars($userData['email']) : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" maxlength="11" class="form-control"
                                    value="<?= $isEdit ? htmlspecialchars($userData['phone']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="user" <?= $isEdit && $userData['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= $isEdit && $userData['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label"><?= $isEdit ? 'New Password (optional)' : 'Password' ?></label>
                            <input type="password" name="password" id="password" class="form-control" <?= $isEdit ? '' : 'required' ?>>
                        </div>

                        <button type="submit" class="btn-submit w-100">
                            <i class="bi bi-check-circle"></i>
                            <?= $isEdit ? 'Update User' : 'Add User' ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
