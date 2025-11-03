<section id="skills" class="skills section">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>My Skills</h2>
            <p class="subtitle">Here are some of my technical skills</p>
        </div>
            
        <?php if (empty($skills)): ?>
            <div class="text-center p-5 border rounded-3 skill-empty-state">
                <i class="bi bi-tools display-4 mb-3"></i>
                <h3>Skills section is empty!</h3>
                <p class="lead">It looks like no technical skills have been added yet.</p>
            </div>
        <?php else: ?>
            <div class="skills-grid">
                <?php foreach ($skills as $skill): ?> 
                    <div class="skill-item" style="--progress:90%">
                        <?php if (!empty($skill['icon'])): ?>
                            <i class="<?= htmlspecialchars($skill['icon']) ?>"></i>
                        <?php else: ?>
                            <i class="bi bi-gear"></i>
                        <?php endif; ?>
                        <h4><?= htmlspecialchars($skill['name']) ?></h4>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
