<section class="dashboard-section container py-5 mt-5">

    <h1 class="mb-5 dashboard-title"><i class="bi bi-sliders me-2"></i> General Settings</h1>

    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-info custom-flash-alert text-center mb-4">
            <?= htmlspecialchars($_SESSION['flash']); ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="custom-card p-4">
                <div class="card-header mb-4">
                    <h4 class="form-title-accent">Profile & Availability Management</h4>
                </div>
                
                <form action="<?= BASE_URL ?>?controller=dashboard&action=settings" method="POST" enctype="multipart/form-data" class="dashboard-form">
                    
                    <h5 class="mb-3 mt-2 text-muted"><i class="bi bi-info-circle-fill me-2"></i> Personal Info & Links</h5>

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" 
                            value="<?= htmlspecialchars($settings['full_name'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="bio_text" class="form-label">About Me (Bio)</label>
                        <textarea name="bio_text" id="bio_text" rows="5" class="form-control" required><?= htmlspecialchars($settings['bio_text'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="cv_file" class="form-label"><i class="bi bi-file-earmark-pdf"></i> Upload CV (PDF)</label>
                        <input type="file" name="cv_file" id="cv_file" class="form-control" accept=".pdf">
                        
                        <?php if (!empty($settings['cv_link'])): ?>
                            <p class="mt-2 text-muted small">Current CV: 
                                <a href="<?= UPLOAD_DIR . htmlspecialchars($settings['cv_link']) ?>" target="_blank" class="text-primary fw-bold">
                                    <i class="bi bi-download"></i> Download Current File
                                </a>
                            </p>
                            <input type="hidden" name="current_cv_path" value="<?= htmlspecialchars($settings['cv_link']) ?>">
                        <?php endif; ?>
                    </div>

                    <h5 class="mb-3 mt-4 text-muted"><i class="bi bi-bar-chart-fill me-2"></i> Experience & Availability</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="years_of_experience" class="form-label"><i class="bi bi-clock-history"></i> Years of Experience</label>
                            <input type="number" name="years_of_experience" id="years_of_experience" class="form-control" 
                                value="<?= htmlspecialchars($settings['years_of_experience'] ?? 0) ?>" min="0" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="current_job_status" class="form-label"><i class="bi bi-briefcase-fill"></i> Current Job Status</label>
                            <input type="text" name="current_job_status" id="current_job_status" class="form-control" 
                                value="<?= htmlspecialchars($settings['current_job_status'] ?? 'Freelancer') ?>" placeholder="e.g. Full-time, Freelancer, Student" required>
                        </div>
                    </div>
                    
                    <div class="form-check form-switch mb-4 mt-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_available_for_work" name="is_available_for_work" 
                            <?= ($settings['is_available_for_work'] ?? 1) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_available_for_work">
                            <i class="bi bi-check-circle-fill text-success"></i> Available for New Projects
                        </label>
                    </div>
                    
                    <h5 class="mb-3 mt-4 text-muted"><i class="bi bi-image-fill me-2"></i> Profile Image</h5>

                    <div class="mb-4">
                        <label for="profile_image" class="form-label">Update Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control">
                        
                        <?php if (!empty($settings['profile_image'])): ?>
                            <p class="mt-2 text-muted small">Current Image:</p>
                            <img src="<?= UPLOAD_DIR . htmlspecialchars($settings['profile_image']) ?>" alt="Current Profile" class="preview-img">
                            <input type="hidden" name="current_profile_image" value="<?= htmlspecialchars($settings['profile_image']) ?>">
                        <?php endif; ?>
                    </div>

                    <div class="d-grid mt-4 pt-3 border-top">
                        <button type="submit" class="btn-submit"><i class="bi bi-save-fill me-2"></i> Save All Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>