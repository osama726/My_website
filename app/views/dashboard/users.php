<?php
// app/views/dashboard/users.php
?>

<section class="dashboard-section container py-5">
    <h1 class="mb-4 text-center"><?= htmlspecialchars($title) ?></h1>

    <!-- ✅ Flash Message -->
    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-info text-center mb-4">
            <?= htmlspecialchars($_SESSION['flash']); ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="row">
        <!-- 🧾 جدول المستخدمين -->
        <div class="col-md-8">
            <div class="card p-3 shadow-sm">
                <h3 class="mb-3">All Users</h3>

                <?php if (!empty($users)): ?>
                    <table class="table table-dark table-striped align-middle">
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
                                    <td><?= htmlspecialchars($u['phone'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($u['role'] ?? 'user') ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>?controller=dashboard&action=users&id=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= BASE_URL ?>?controller=dashboard&action=users&delete=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted">No users found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- 🧩 فورم الإضافة / التعديل -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <?php
                    $isEdit = isset($userData) && !empty($userData);
                    $formTitle = $isEdit ? 'Edit User' : 'Add New User';
                    $formAction = BASE_URL . "?controller=dashboard&action=users";
                ?>

                <h3 class="mb-3 text-center"><?= $formTitle ?></h3>

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
                        <input type="text" name="phone" id="phone" class="form-control" maxlength="11"
                            value="<?= $isEdit ? htmlspecialchars($userData['phone']) : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select">
                            <option value="user" <?= $isEdit && $userData['role'] == 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $isEdit && $userData['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label"><?= $isEdit ? 'New Password (optional)' : 'Password' ?></label>
                        <input type="password" name="password" id="password" class="form-control" <?= $isEdit ? '' : 'required' ?>>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <?= $isEdit ? 'Update User' : 'Add User' ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
