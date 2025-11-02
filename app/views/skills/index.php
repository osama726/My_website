<section class="section skills-section" id="Skills">
    <div class="container text-center">
        <div class="section-title">
            <h2><?= htmlspecialchars($title) ?></h2>
            <p class="subtitle">Here are some of my technical skills</p>
        </div>

        <?php if (empty($skills)): ?>
            <p>No skills added yet 😅</p>
        <?php else: ?>
            <div class="row justify-content-center gy-4">
                <?php foreach ($skills as $skill): ?>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="skill-box">
                            <?php if (!empty($skill['icon'])): ?>
                                <i class="<?= htmlspecialchars($skill['icon']) ?>"></i>
                            <?php else: ?>
                                <i class="bi bi-gear"></i>
                            <?php endif; ?>
                            <h5><?= htmlspecialchars($skill['name']) ?></h5>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
