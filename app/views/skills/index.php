<section id="skills" class="skills section">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>My Skills</h2>
            <p class="subtitle">Here are some of my technical skills</p>
        </div>

        <?php if (empty($skills)): ?>
            <?php else: ?>
            
            <div class="scroll-controls text-center mb-3">
                <button id="scroll-left" class="btn-scroll me-2" aria-label="Scroll Left"><i class="bi bi-arrow-left"></i></button>
                <button id="scroll-right" class="btn-scroll" aria-label="Scroll Right"><i class="bi bi-arrow-right"></i></button>
            </div>

            <div class="skills-horizontal-wrapper">
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
            </div>
        <?php endif; ?>
    </div>
</section>
