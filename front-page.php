<?php
/**
 * Template: Front Page (Homepage)
 *
 * Displays hero section + featured works, skills, and certificates.
 * Set this page as your "Static Front Page" in Settings > Reading.
 *
 * @package DevPortfolio
 */

get_header();

// ─── Hero Section ────────────────────────────────────────────────────
$greeting   = get_field( 'hero_greeting' ) ?: 'Hello, I\'m';
$name       = get_field( 'hero_name' ) ?: get_bloginfo( 'name' );
$tagline    = get_field( 'hero_tagline' );
$desc       = get_field( 'hero_description' );
$image      = get_field( 'hero_image' );
$cta_text   = get_field( 'hero_cta_text' ) ?: 'View My Work';
$cta_link   = get_field( 'hero_cta_link' ) ?: '#works';
$github     = get_field( 'social_github' );
$linkedin   = get_field( 'social_linkedin' );
$email      = get_field( 'social_email' );
?>

<section class="hero">

    <div class="hero-content">

        <h1>
            <?php echo get_field('hero_name') ?: "I'M QUENNIE ROSE BARBARONA"; ?>
        </h1>

        <p>
            <?php echo get_field('hero_description') ?: 'EAGER TO LEARN AND GROW IN I.T, AND GRABBING <br> EVERY OPPORTUNITY TO IMPROVE ME.'; ?>
        </p>

        <button class="btn-see-more">
            <?php echo get_field('hero_button_text') ?: 'SEE MORE'; ?>
            <span class="btn-ring"></span>
        </button>

    </div>

    <div class="hero-image-container">

        <img src="<?php echo get_template_directory_uri(); ?>/images/BIBBLE1.png" class="hero-frame">

        <?php
        $portrait = get_field('hero_image');
        if ($portrait): ?>
            <img src="<?php echo esc_url($portrait['url']); ?>" class="hero-portrait">
        <?php endif; ?>

    </div>

</section>

<?php
$works = new WP_Query(array(
    'post_type'      => 'work',
    'posts_per_page' => 3
));
?>

<section class="works-section">
    
        <div class="title-wrapper">
            <div class="title-top-layer">MY WORKS</div>
        </div>

        <div class="projects-carousel">
            <button class="carousel-arrow prev" aria-label="Previous project">‹</button>
            <div class="projects-grid">

                <?php if ($works->have_posts()) : ?>
                    <?php while ($works->have_posts()) : $works->the_post(); ?>

                        <div class="project-card">

                            <div class="project-icon-badge empty"></div>

                            <div class="project-logo">
                                <?php
                                $logo = get_field('work_logo');
                                if ($logo): ?>
                                    <img src="<?php echo esc_url($logo['url']); ?>" alt="">
                                <?php endif; ?>
                            </div>

                            <div class="project-info-label">
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo get_field('work_subtitle'); ?></p>
                            </div>

                        </div>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>

                    <!-- fallback (optional but recommended) -->
                    <p style="color:white;">No works found. Add posts in Dashboard → Works</p>

                <?php endif; ?>

            </div>
            <button class="carousel-arrow next" aria-label="Next project">›</button>
            <div class="carousel-dots" aria-hidden="false"></div>
        </div>
</section>

<?php
$circle = get_field('skills_circle') ?: [];

/*
 * GET ACTIVE CATEGORY FROM URL (CLICK FROM LEFT SIDE)
 * default = Soft Skills
 */
$active_category = isset($_GET['category'])
    ? sanitize_text_field($_GET['category'])
    : 'Soft Skills';

/*
 * GET ALL SKILL POSTS
 */
$skills_raw = get_posts([
    'post_type'      => 'skill',
    'posts_per_page' => -1
]);

$skills = [];

foreach ($skills_raw as $post) {

    $percent  = get_field('skill_percent', $post->ID);
    $category = get_field('skill_category', $post->ID);

    // normalize ACF select (array or string)
    if (is_array($category)) {
        $category = $category['value'] ?? $category['label'] ?? '';
    }

    // ONLY SHOW SELECTED CATEGORY
    if ($category === $active_category) {

        $skills[] = [
            'name'    => get_the_title($post->ID),
            'percent' => $percent
        ];
    }
}
?>

<section class="skills-section">
    <div class="skills-container">
        
        <!-- LEFT: CIRCLE -->
        <div class="skills-circle-wrapper">
            <div class="skills-pie-container">
                
                <!-- Frontend -->
                <a href="?category=Frontend" class="skill-wedge-link skill-wedge-link-top">
                    <div class="skill-wedge top">
                        <div class="wedge-content">
                            <i class="fa-solid <?php echo esc_attr($circle['frontend_icon'] ?? ''); ?>"></i>
                            <span><?php echo esc_html($circle['frontend_label'] ?? 'Frontend'); ?></span>
                        </div>
                    </div>
                </a>

                <!-- Backend -->
                <a href="?category=Backend" class="skill-wedge-link skill-wedge-link-right">
                    <div class="skill-wedge right">
                        <div class="wedge-content">
                            <i class="fa-solid <?php echo esc_attr($circle['backend_icon'] ?? ''); ?>"></i>
                            <span><?php echo esc_html($circle['backend_label'] ?? 'Backend'); ?></span>
                        </div>
                    </div>
                </a>

                <!-- Soft Skills (ACTIVE) -->
                <a href="?category=Soft Skills" class="skill-wedge-link skill-wedge-link-bottom">
                    <div class="skill-wedge bottom active">
                        <div class="wedge-content">
                            <i class="fa-solid <?php echo esc_attr($circle['soft_icon'] ?? ''); ?>"></i>
                            <span><?php echo esc_html($circle['soft_label'] ?? 'Soft Skills'); ?></span>
                        </div>
                    </div>
                </a>

                <!-- Database -->
                <a href="?category=Database" class="skill-wedge-link skill-wedge-link-left">
                    <div class="skill-wedge left">
                        <div class="wedge-content">
                            <i class="fa-solid <?php echo esc_attr($circle['database_icon'] ?? ''); ?>"></i>
                            <span><?php echo esc_html($circle['database_label'] ?? 'Database'); ?></span>
                        </div>
                    </div>
                </a>

                <!-- Center -->
                <div class="skills-inner-circle">
                    <span>Skills</span>
                </div>

            </div>

            <div class="outer-ring-decoration"></div>
        </div>

        <!-- RIGHT: SKILL BARS -->
        <div class="soft-skills-card">

            <div class="card-header">
                <h2><?php echo esc_html($active_category); ?></h2>
                <i class="fa-solid <?php echo esc_attr($circle['soft_icon'] ?? ''); ?> decorative-icon"></i>
            </div>

            <div class="progress-container">

                <?php foreach ($skills as $skill): ?>
                    <?php if (!empty($skill['name'])): ?>
                        <div class="skill-bar-item">
                            <div class="skill-info">
                                <span><?php echo esc_html($skill['name']); ?></span>
                                <span><?php echo esc_html($skill['percent']); ?>%</span>
                            </div>

                            <div class="progress-line">
                                <div class="fill" style="width: <?php echo esc_attr($skill['percent']); ?>%;"></div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>

        </div>

    </div>
</section>

<?php
// ─── Featured Certificates Section ──────────────────────────────────
$certs = new WP_Query( array(
    'post_type'      => 'certificate',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<?php if ( $certs->have_posts() ) : ?>
<section class="section section--certificates" id="certificates">
    <div class="container">
        <h2 class="section__title">Certificates</h2>
        <p class="section__subtitle">Certifications & achievements</p>
        <div class="certificates-grid">
            <?php while ( $certs->have_posts() ) : $certs->the_post(); ?>
                <?php get_template_part( 'template-parts/card', 'certificate' ); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="section__cta">
            <a href="<?php echo get_post_type_archive_link( 'certificate' ); ?>" class="btn btn--outline">View All Certificates</a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
