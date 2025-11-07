<?php
    // app/views/dashboard/messages.php

    // المسار الصحيح للتحويل بعد الإجراءات
    $redirectUrl = BASE_URL . '?controller=dashboard&action=messages';
?>

<section class="dashboard-section container py-5">

    <h1 class="mb-5 dashboard-title"><i class="bi bi-chat-left-dots-fill me-2"></i> <?= htmlspecialchars($title) ?></h1>

    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-info custom-flash-alert text-center mb-4">
            <?= $_SESSION['flash']; ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="custom-card p-4 table-responsive">
                
                <h3 class="mb-4 form-title-accent">
                    Inbox 
                    <?php 
                        // عرض عدد الرسائل غير المقروءة
                        $unreadCount = count(array_filter($messages ?? [], fn($m) => $m['is_read'] == 0));
                    ?>
                    <span class="badge bg-danger ms-2"><?= $unreadCount ?> NEW</span>
                </h3>

                <?php if (!empty($messages)): ?>
                    <table class="table custom-dashboard-table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Subject</th>
                                <th>From</th>
                                <th>Received</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $m): ?>
                                <tr class="<?= $m['is_read'] == 0 ? 'unread-message-row' : '' ?>">
                                    <td><?= $m['id'] ?></td>
                                    <td>
                                        <span class="message-status badge 
                                            <?= $m['is_read'] == 0 ? 'bg-warning' : 'bg-success' ?>">
                                            <?= $m['is_read'] == 0 ? 'NEW' : 'Read' ?>
                                        </span>
                                    </td>
                                    <td class="message-subject">
                                        <a href="#message-<?= $m['id'] ?>" class="subject-link" data-bs-toggle="collapse" title="View Details">
                                            <?= htmlspecialchars(substr($m['subject'] ?? 'No Subject', 0, 40)) ?>...
                                        </a>
                                    </td>
                                    <td>
                                        <i class="bi bi-envelope me-1"></i> <?= htmlspecialchars($m['email']) ?><br>
                                        <i class="bi bi-person me-1"></i> <?= htmlspecialchars($m['name']) ?>
                                    </td>
                                    <td>
                                        <?= date('M j, H:i', strtotime($m['created_at'] ?? '')) ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons-group">
                                            <?php if ($m['is_read'] == 0): ?>
                                                <a href="<?= $redirectUrl ?>&read=<?= $m['id'] ?>" class="btn-icon read" title="Mark as Read">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                            <a href="<?= $redirectUrl ?>&delete=<?= $m['id'] ?>" class="btn-icon delete" onclick="return confirm('Delete this message?')" title="Delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="6" class="p-0 border-0">
                                        <div class="collapse message-details-row" id="message-<?= $m['id'] ?>">
                                            <div class="p-3 message-content-box">
                                                <p class="mb-2"><strong>Phone:</strong> <?= htmlspecialchars($m['phone'] ?? 'N/A') ?></p>
                                                <hr>
                                                <p class="mb-0 message-body">
                                                    <?= nl2br(htmlspecialchars($m['message'] ?? '')) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted text-center py-4">No messages found in your inbox.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>