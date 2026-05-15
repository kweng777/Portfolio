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

<section class="hero-replicate">
    <div class="hero-container">
        
        <div class="hero-left">
            <div class="intro-box">
                <div class="greeting-wrapper">
                    <span class="greeting-tag"><?php echo get_field('hero_greeting') ?: "HI THERE!"; ?></span>
                    <div class="greeting-line"></div>
                </div>
                
                <h1 class="hero-title">
                    I'M <span class="highlight"><?php echo get_field('hero_name') ?: "QUENNIE"; ?></span>
                </h1>
                
                <div class="badge-container">
                    <div class="role-badge">
                        SOFTWARE DEVELOPER / WEB DEVELOPER
                    </div>
                    <br>
                    <div class="status-bar">
                        READY TO HANDLE YOUR NEW PROJECT
                    </div>
                </div>

                <p class="hero-desc">
                    <?php echo get_field('hero_description') ?: 'I am eager to learn through hands-on experience, building skills by working on real projects and continuously improving as a developer. I welcome challenges and enjoy turning ideas into practical solutions while growing every day.'; ?>
                </p>

                <a href="<?php echo esc_url($cta_link); ?>" class="btn-more">MORE ABOUT ME</a>
            </div>
        </div>

        <div class="hero-right">
            <div class="image-circle-wrapper">
                <div class="profile-circle">
                    <?php 
                    $hero_img = get_field('hero_image');
                    if( $hero_img ): ?>
                        <img src="<?php echo esc_url($hero_img['url']); ?>" alt="Profile">
                    <?php else: ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/Q1.jpg" alt="Profile">
                    <?php endif; ?>
                </div>
                
                <nav class="circular-nav">
                    <div class="svg-line-wrapper">
                        <svg viewBox="0 0 500 500" class="svg-path-and-dots">
                            <path class="nav-curve-path" d="M 250,10 A 240,240 0 0 1 250,490" fill="none" stroke="#f3b431" stroke-width="4"/>
                            
                            <circle class="curve-end-dot dot-top" cx="250" cy="10" r="5" fill="#f3b431" />
                            <circle class="curve-end-dot dot-bottom" cx="250" cy="490" r="5" fill="#f3b431" />
                        </svg>
                    </div>
                    
                    <ul class="nav-icons">
                        
                        <li style="--icon-index:1;"><a href="#about"><i class="fa-solid fa-user-tie"></i></a></li>
                        
                        <li style="--icon-index:2;"><a href="#works"><i class="fa-solid fa-code"></i></a></li>
                        
                        <li style="--icon-index:3;"><a href="#skills"><i class="fa-solid fa-gears"></i></a></li>
                        
                        <li style="--icon-index:4;"><a href="#certificates"><i class="fa-solid fa-award"></i></a></li>
                        
                        <li style="--icon-index:5;"><a href="#contact"><i class="fa-solid fa-envelope-open-text"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<?php
$works = new WP_Query(array(
    'post_type'      => 'work',
    'posts_per_page' => 3
));
?>

<section class="works-portfolio-wrapper">
    <aside class="portfolio-sidebar">
        <div class="sidebar-top">
            <div class="profile-circle-frame">
                <?php 
                $hero_img = get_field('hero_image');
                if( $hero_img ): ?>
                    <img src="<?php echo esc_url($hero_img['url']); ?>" alt="Profile">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/QRB4.jpg" alt="Profile">
                <?php endif; ?>
            </div>
        </div>
        
        <nav class="sidebar-nav-menu">
            <ul>
                <li><a href="#about">ABOUT</a></li>
                <li><a href="#works" class="active">WORKS</a></li>
                <li><a href="#skills">SKILLS</a></li>
                <li><a href="#certificates">CERTIFICATES</a></li>
                <li><a href="#contact">CONTACT</a></li>
            </ul>
        </nav>
    </aside>

    <main class="portfolio-main-content">
        <div class="header-area">
            <div class="title-with-arrow">
                <span class="arrow-symbol">→</span>
                <h1 class="main-title">MY wORKS</h1>
            </div>
            
            <div class="filter-tabs">
                <span class="tab">IN-CAMPUS </span>
                <span class="tab">OFF-CAMPUS </span>
                <span class="tab highlight">CAPSTONE PROJECT</span>
            </div>
        </div>

        <div class="projects-grid">
            <?php if ($works->have_posts()) : ?>
                <?php while ($works->have_posts()) : $works->the_post(); ?>
                    <div class="project-card">
                        <div class="project-img-box">
                            <?php
                            $logo = get_field('work_logo');
                            if ($logo): ?>
                                <img src="<?php echo esc_url($logo['url']); ?>" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="project-overlay">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo get_field('work_subtitle'); ?></p>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="fallback-msg">No works found.</p>
            <?php endif; ?>
        </div>
    </main>

    <aside class="right-icon-bar">
        <ul class="work-nav-icons">
            <li style="--icon-index:1;"><a href="#about"><i class="fa-solid fa-user-tie"></i></a></li>
            <li style="--icon-index:2;"><a href="#works"><i class="fa-solid fa-code"></i></a></li>
            <li style="--icon-index:3;"><a href="#skills"><i class="fa-solid fa-gears"></i></a></li>
            <li style="--icon-index:4;"><a href="#certificates"><i class="fa-solid fa-award"></i></a></li>
            <li style="--icon-index:5;"><a href="#contact"><i class="fa-solid fa-envelope-open-text"></i></a></li>
        </ul>
    </aside>
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

<?php
// Get skills for each category
function get_skills_by_category($category_name) {
    $skills_raw = get_posts(['post_type' => 'skill', 'posts_per_page' => -1]);
    $skills = [];
    foreach ($skills_raw as $post) {
        $percent = get_field('skill_percent', $post->ID);
        $category = get_field('skill_category', $post->ID);
        if (is_array($category)) {
            $category = $category['value'] ?? $category['label'] ?? '';
        }
        if ($category === $category_name) {
            $skills[] = ['name' => get_the_title($post->ID), 'percent' => $percent];
        }
    }
    return $skills;
}

$categories = [
    ['key' => 'frontend', 'label' => $circle['frontend_label'] ?? 'Frontend', 'icon' => $circle['frontend_icon'] ?? ''],
    ['key' => 'backend', 'label' => $circle['backend_label'] ?? 'Backend', 'icon' => $circle['backend_icon'] ?? ''],
    ['key' => 'soft', 'label' => $circle['soft_label'] ?? 'Soft Skills', 'icon' => $circle['soft_icon'] ?? ''],
    ['key' => 'database', 'label' => $circle['database_label'] ?? 'Database', 'icon' => $circle['database_icon'] ?? ''],
];
?>

<section class="skills-section">
    <div class="skills-container">

        <!-- FLIP CARDS ROW -->
        <div class="flip-cards-row">

            <?php foreach ($categories as $cat):
                $cat_skills = get_skills_by_category($cat['label']);
            ?>
            <div class="flip-card">
                <div class="flip-card-inner">

                    <!-- FRONT: Category Icon & Name -->
                    <div class="flip-card-front">
                        <i class="fa-solid <?php echo esc_attr($cat['icon']); ?>"></i>
                        <span><?php echo esc_html($cat['label']); ?></span>
                    </div>

                    <!-- BACK: Skills List -->
                    <div class="flip-card-back">
                        <div class="flip-card-skills">
                            <?php foreach ($cat_skills as $skill): ?>
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
            </div>
            <?php endforeach; ?>

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
