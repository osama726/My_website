<section id="skills" class="skills section">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>My Skills</h2>
            <p class="subtitle">Here are some of my technical skills</p>
        </div>

        <?php if (empty($skills)): ?>
            <div class="text-center p-5 border rounded-3 skill-empty-state">
                <i class="bi bi-tools display-4 mb-3"></i>
                <h3>No Skills Added Yet!</h3>
                <p>Or perhaps the admin is making some changes</p>
            </div>
        <?php else: ?>
            <div class="skills-board">
                <?php foreach ($skills as $skill): ?> 
                    <div class="skill-item" data-aos="zoom-in" data-aos-delay="<?= $index * 100 ?>">
                        <div class="icon-circle" >
                            <i class="<?= htmlspecialchars($skill['icon'] ?? 'bi bi-gear') ?>"></i>
                        </div>
                        <span><?= htmlspecialchars($skill['name']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
