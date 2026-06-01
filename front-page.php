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
// prefer explicit ACF link, otherwise try to find the About page by template or slug, fallback to #works
$cta_link = get_field( 'hero_cta_link' );
if ( ! $cta_link ) {
    // 1) try to find a page that uses the about page template
    $about_pages = get_posts(array(
        'post_type'  => 'page',
        'meta_key'   => '_wp_page_template',
        'meta_value' => 'templates/page-about.php',
        'numberposts' => 1,
    ));

    if ( ! empty( $about_pages ) ) {
        $cta_link = get_permalink( $about_pages[0]->ID );
    } else {
        // 2) fallback: try a page with slug 'about'
        $about_page = get_page_by_path('about');
        if ( $about_page ) {
            $cta_link = get_permalink( $about_page->ID );
        } else {
            // final fallback: route to /about/ (root page-about.php will render hardcoded content)
            $cta_link = home_url('/about/');
        }
    }
}
$github     = get_field( 'social_github' );
$linkedin   = get_field( 'social_linkedin' );
$email      = get_field( 'social_email' );
?>

<section id="about" class="hero-replicate">
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
                            <path class="nav-curve-path" d="M 250,10 A 240,240 0 0 1 250,490" fill="none" stroke="#FC7E00" stroke-width="4"/>
                            
                            <circle class="curve-end-dot dot-top" cx="250" cy="10" r="5" fill="#FC7E00" />
                            <circle class="curve-end-dot dot-bottom" cx="250" cy="490" r="5" fill="#FC7E00" />
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

<section id="works" class="works-portfolio-wrapper">

    <aside class="portfolio-sidebar">
        
        <div class="sidebar-top">
            <div class="profile-circle-frame">
                <?php 
                $hero_img = get_field('hero_image');
                if( $hero_img ): ?>
                    <img src="<?php echo esc_url($hero_img['url']); ?>" alt="Profile">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/orange.PNG" alt="Profile">
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
                <div class="line-arrow"></div>
                <h1 class="main-title">MY wORKS</h1>
            </div>


            <div class="filter-tabs">
                <span class="tab highlight" data-filter="in-campus">IN-CAMPUS</span>
                <span class="tab" data-filter="off-campus">OFF-CAMPUS</span>
                <span class="tab" data-filter="capstone">CAPSTONE PROJECT</span>
            </div>

        </div>


        <div class="projects-grid">

            <?php if ($works->have_posts()) : ?>
                <?php while ($works->have_posts()) : $works->the_post(); ?>

                    <?php
                        $title = get_the_title();

                        $category = '';

                        if (stripos($title, 'Loan Management System') !== false) {
                            $category = 'off-campus';
                        } 
                        elseif (stripos($title, 'HR Information System') !== false) {
                            $category = 'in-campus';
                        } 
                        elseif (stripos($title, 'Thescap Management System') !== false) {
                            $category = 'capstone';
                        }
                    ?>

                    <?php
                        $logo = get_field('work_logo');
                        $work_description = get_field('work_description');
                        $work_frontend = get_field('work_frontend');
                        $work_backend = get_field('work_backend');
                        $work_database = get_field('work_database');
                        $work_role_description = get_field('work_role_description');
                        // increase logo size for specific works
                        $large_logos = array('Loan Management System', 'HR Information System');
                        $logo_class = in_array($title, $large_logos, true) ? 'work-logo--large' : '';
                        $logo_wrapper_class = in_array($title, $large_logos, true) ? 'work-logo-wrapper--large' : '';
                    ?>

                    <div class="project-card" data-category="<?php echo esc_attr($category); ?>">

                    <!-- LEFT SIDE -->
                    <div class="project-card-left">
                        <?php if ($work_description): ?>
                            <div class="project-item-with-icon">
                                <span class="project-label">About</span>
                                <p class="project-description">
                                    <?php echo esc_html($work_description); ?>
                                </p>
                            </div>
                        <?php endif; ?>

                        <?php if ($work_role_description): ?>
                            <div class="project-item-with-icon">
                                <span class="project-label">Role</span>
                                <p class="project-description">
                                    <?php echo esc_html($work_role_description); ?>
                                </p>
                            </div>
                        <?php endif; ?>

                        <?php if ($work_frontend || $work_backend || $work_database): ?>
                            <div class="project-item-with-icon">
                                <span class="project-label">Uses</span>
                                <div class="tech-stack-container">
                                    <?php if ($work_frontend): ?>
                                        <div class="tech-stack-bar">Frontend: <?php echo esc_html($work_frontend); ?></div>
                                    <?php endif; ?>
                                    <?php if ($work_backend): ?>
                                        <div class="tech-stack-bar">Backend: <?php echo esc_html($work_backend); ?></div>
                                    <?php endif; ?>
                                    <?php if ($work_database): ?>
                                        <div class="tech-stack-bar">Database: <?php echo esc_html($work_database); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        
                    </div>

                    <!-- RIGHT SIDE -->
                    <div class="project-card-right <?php echo esc_attr($logo_wrapper_class); ?>">

                        <?php if ($logo): ?>
                            <img src="<?php echo esc_url($logo['url']); ?>" class="<?php echo esc_attr($logo_class); ?>" alt="<?php echo esc_attr(get_the_title()); ?> logo">
                        <?php endif; ?>

                        <h3 class="project-title"><?php the_title(); ?></h3>

                        <p class="project-subtitle">
                            <?php echo get_field('work_subtitle'); ?>
                        </p>

                        <?php 
                        $work_url = get_field('work_url');
                        $is_loan_management = stripos($title, 'Loan Management System') !== false;
                        ?>
                        <a href="<?php echo $is_loan_management && $work_url ? esc_url($work_url) : the_permalink(); ?>" class="project-see-more" data-work-url="<?php echo esc_url($work_url); ?>" data-is-loan-management="<?php echo $is_loan_management ? 'true' : 'false'; ?>">See More</a>

                        <?php
                            // Collect up to 10 images (image1..image10) and their descriptions (image_1_description..image_10_description)
                            $gallery_images = array();
                            for ($i = 1; $i <= 10; $i++) {
                                $img_field = get_field("image{$i}");
                                $desc_field = get_field("image_{$i}_description");

                                if ($img_field && is_array($img_field) && ! empty($img_field['url'])) {
                                    $gallery_images[] = array(
                                        'url' => $img_field['url'],
                                        'alt' => ! empty($img_field['alt']) ? $img_field['alt'] : get_the_title(),
                                        'desc' => $desc_field ?: ''
                                    );
                                }
                            }
                        ?>

                        <?php if (! empty($gallery_images)) : ?>
                            <div class="project-images-data" style="display:none" data-images="<?php echo esc_attr( wp_json_encode($gallery_images) ); ?>"></div>
                        <?php endif; ?>

                    </div>

                </div>

                <?php endwhile; wp_reset_postdata(); ?>

            <?php else : ?>

                <p class="fallback-msg">No works found.</p>

            <?php endif; ?>

        </div>

        <!-- Work lightbox (inside works section, mirrors certificate behavior) -->
        <div class="work-lightbox" aria-hidden="true">
            <button type="button" class="work-lightbox__close" aria-label="Close work preview">&times;</button>
            <div class="work-lightbox__media">
                <div class="work-lightbox__image-wrap">
                    <img class="work-lightbox__image" src="" alt="">
                </div>
                <button type="button" class="work-lightbox__prev" aria-label="Previous">‹</button>
                <button type="button" class="work-lightbox__next" aria-label="Next">›</button>
            </div>
            <div class="work-lightbox__caption" aria-live="polite"></div>
        </div>

    </main>


    <aside class="right-icon-bar">

        <ul class="work-nav-icons">
            <li><a href="#about"><i class="fa-solid fa-user-tie"></i></a></li>
            <li><a href="#works"><i class="fa-solid fa-code"></i></a></li>
            <li><a href="#skills"><i class="fa-solid fa-gears"></i></a></li>
            <li><a href="#certificates"><i class="fa-solid fa-award"></i></a></li>
            <li><a href="#contact"><i class="fa-solid fa-envelope-open-text"></i></a></li>
        </ul>

    </aside>

</section>


<script>
;(function(){
    function init(){
        const tabs = document.querySelectorAll(".filter-tabs .tab");
        console.log('[front-page] filter script initialized', { tabs: tabs.length });

        function normalize(text){
            return (text || '').toString().toLowerCase().replace(/\s+/g,'-').trim();
        }

        function filterCards(filter) {
            const cards = document.querySelectorAll(".project-card");
            const filterNorm = normalize(filter);
            console.log('[front-page] filterCards()', { filter, filterNorm, cards: cards.length });
            cards.forEach(card => {
                const category = card.getAttribute("data-category") || '';
                const catNorm = normalize(category);
                const titleEl = card.querySelector('.project-title');
                const titleNorm = normalize(titleEl ? titleEl.textContent : '');

                // match by normalized category or title text; keep layout intact
                if(filterNorm === "all" || catNorm.includes(filterNorm) || titleNorm.includes(filterNorm)) {
                    card.classList.remove('filtered-hidden');
                } else {
                    card.classList.add('filtered-hidden');
                }
            });
        }

        tabs.forEach(tab => {
            tab.addEventListener("click", function(){
                tabs.forEach(t => t.classList.remove("highlight"));
                this.classList.add("highlight");
                const filter = this.getAttribute("data-filter");
                console.log('[front-page] tab clicked', { filter });
                filterCards(filter);
            });
        });

        // determine initial filter: prefer any pre-highlighted tab, otherwise default to capstone
        let initialFilter = 'capstone';
        const preHighlighted = document.querySelector('.filter-tabs .tab.highlight');
        if (preHighlighted) {
            initialFilter = preHighlighted.getAttribute('data-filter') || initialFilter;
        } else if (tabs.length > 0) {
            // if no pre-highlight exists, mark the first tab as highlighted
            tabs[0].classList.add('highlight');
            initialFilter = tabs[0].getAttribute('data-filter') || initialFilter;
        }

        // ensure the visual highlight matches the initial filter
        tabs.forEach(t => t.classList.toggle('highlight', t.getAttribute('data-filter') === initialFilter));

        // apply filter based on the resolved initial filter
        filterCards(initialFilter);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    function smoothNavigateLinks(selector){
        document.querySelectorAll(selector).forEach(function(a){
            a.addEventListener('click', function(e){
                var href = a.getAttribute('href');
                if(!href || href.charAt(0) !== '#') return;
                var target = document.querySelector(href);
                if(target){
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    try{ target.setAttribute('tabindex','-1'); target.focus(); }catch(err){}
                    if(window.history && history.pushState){
                        history.pushState(null, '', href);
                    } else {
                        location.hash = href;
                    }
                }
            });
        });
    }

    smoothNavigateLinks('.sidebar-nav-menu a');
    smoothNavigateLinks('.nav-icons a');
    smoothNavigateLinks('.work-nav-icons a');
});
</script>

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

<section id="skills" class="works-portfolio-wrapper">

    <aside class="portfolio-sidebar">
        
        <div class="sidebar-top">
            <div class="profile-circle-frame">
                <?php 
                $hero_img = get_field('hero_image');
                if( $hero_img ): ?>
                    <img src="<?php echo esc_url($hero_img['url']); ?>" alt="Profile">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/orange.PNG" alt="Profile">
                <?php endif; ?>
            </div>
        </div>

        <nav class="sidebar-nav-menu">
            <ul>
                <li><a href="#about">ABOUT</a></li>
                <li><a href="#works">WORKS</a></li>
                <li><a href="#skills" class="active">SKILLS</a></li>
                <li><a href="#certificates">CERTIFICATES</a></li>
                <li><a href="#contact">CONTACT</a></li>
            </ul>
        </nav>

    </aside>

    <main class="portfolio-main-content">

        <div class="header-area">

            <div class="title-with-arrow">
                <div class="line-arrow"></div>
                <h1 class="main-title">MY SKILLS</h1>
            </div>

        </div>

        <div class="skills-section">

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

    </main>

    <aside class="right-icon-bar">

        <ul class="work-nav-icons">
            <li><a href="#about"><i class="fa-solid fa-user-tie"></i></a></li>
            <li><a href="#works"><i class="fa-solid fa-code"></i></a></li>
            <li><a href="#skills"><i class="fa-solid fa-gears"></i></a></li>
            <li><a href="#certificates"><i class="fa-solid fa-award"></i></a></li>
            <li><a href="#contact"><i class="fa-solid fa-envelope-open-text"></i></a></li>
        </ul>

    </aside>

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
<?php $certificate_lightbox_images = array(); ?>
<section id="certificates" class="works-portfolio-wrapper">

    <aside class="portfolio-sidebar">
        
        <div class="sidebar-top">
            <div class="profile-circle-frame">
                <?php 
                $hero_img = get_field('hero_image');
                if( $hero_img ): ?>
                    <img src="<?php echo esc_url($hero_img['url']); ?>" alt="Profile">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/orange.PNG" alt="Profile">
                <?php endif; ?>
            </div>
        </div>

        <nav class="sidebar-nav-menu">
            <ul>
                <li><a href="#about">ABOUT</a></li>
                <li><a href="#works">WORKS</a></li>
                <li><a href="#skills">SKILLS</a></li>
                <li><a href="#certificates" class="active">CERTIFICATES</a></li>
                <li><a href="#contact">CONTACT</a></li>
            </ul>
        </nav>

    </aside>

    <main class="portfolio-main-content">

        <div class="header-area">

            <div class="title-with-arrow">
                <div class="line-arrow"></div>
                <h1 class="main-title">MY CERTIFICATES</h1>
            </div>

        </div>

        <div class="certificates-section">
            <div class="container">
                <div class="certificates-grid">
                    <?php while ( $certs->have_posts() ) : $certs->the_post(); ?>
                        <?php
                        $certificate_image = get_field( 'cert_image' );
                        $certificate_full_image = '';

                        if ( $certificate_image && ! empty( $certificate_image['url'] ) ) {
                            $certificate_full_image = $certificate_image['url'];
                        } elseif ( has_post_thumbnail() ) {
                            $certificate_full_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        }

                        $certificate_lightbox_images[] = array(
                            'src' => $certificate_full_image,
                            'alt' => get_the_title(),
                        );
                        ?>
                        <?php get_template_part( 'template-parts/card', 'certificate' ); ?>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <div class="certificate-lightbox" aria-hidden="true">
                    <button type="button" class="certificate-lightbox__close" aria-label="Close certificate preview">&times;</button>
                    <img class="certificate-lightbox__image" src="" alt="">
                </div>
                
            </div>
        </div>

    </main>

    <aside class="right-icon-bar">

        <ul class="work-nav-icons">
            <li><a href="#about"><i class="fa-solid fa-user-tie"></i></a></li>
            <li><a href="#works"><i class="fa-solid fa-code"></i></a></li>
            <li><a href="#skills"><i class="fa-solid fa-gears"></i></a></li>
            <li><a href="#certificates"><i class="fa-solid fa-award"></i></a></li>
            <li><a href="#contact"><i class="fa-solid fa-envelope-open-text"></i></a></li>
        </ul>

    </aside>

</section>
<script>
(function () {
    const certificateImages = <?php echo wp_json_encode( $certificate_lightbox_images ); ?>;

    function initCertificateLightbox() {
        const section = document.querySelector('.certificates-section');
        const lightbox = document.querySelector('.certificate-lightbox');

        if (!section || !lightbox) {
            return;
        }

        const cards = section.querySelectorAll('.certificates-grid .cert-card');
        const lightboxImage = lightbox.querySelector('.certificate-lightbox__image');
        const closeButton = lightbox.querySelector('.certificate-lightbox__close');

        function closeLightbox() {
            lightbox.classList.remove('is-open');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('certificate-lightbox-open');
            lightboxImage.removeAttribute('src');
            lightboxImage.setAttribute('alt', '');
        }

        function openLightbox(imageData, fallbackImage) {
            const imageSrc = imageData && imageData.src ? imageData.src : fallbackImage.src;

            if (!imageSrc) {
                return;
            }

            lightboxImage.src = imageSrc;
            lightboxImage.alt = imageData && imageData.alt ? imageData.alt : fallbackImage.alt;
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.classList.add('certificate-lightbox-open');
            closeButton.focus();
        }

        cards.forEach(function (card, index) {
            const cardImage = card.querySelector('.cert-card__image img');

            if (!cardImage) {
                return;
            }

            card.addEventListener('click', function (event) {
                if (event.target.closest('a')) {
                    return;
                }

                openLightbox(certificateImages[index], cardImage);
            });
        });

        closeButton.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', function (event) {
            if (event.target === lightbox) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && lightbox.classList.contains('is-open')) {
                closeLightbox();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCertificateLightbox);
    } else {
        initCertificateLightbox();
    }
})();
</script>
<?php endif; ?>

<section id="contact" class="works-portfolio-wrapper">

    <aside class="portfolio-sidebar">
        <div class="sidebar-top">
            <div class="profile-circle-frame">
                <?php 
                $hero_img = get_field('hero_image');
                if( $hero_img ): ?>
                    <img src="<?php echo esc_url($hero_img['url']); ?>" alt="Profile">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/orange.PNG" alt="Profile">
                <?php endif; ?>
            </div>
        </div>

        <nav class="sidebar-nav-menu">
            <ul>
                <li><a href="#about">ABOUT</a></li>
                <li><a href="#works">WORKS</a></li>
                <li><a href="#skills">SKILLS</a></li>
                <li><a href="#certificates">CERTIFICATES</a></li>
                <li><a href="#contact" class="active">CONTACT</a></li>
            </ul>
        </nav>
    </aside>

    <main class="portfolio-main-content">

        <div class="header-area">
            <div class="title-with-arrow">
                <div class="line-arrow"></div>
                <h1 class="main-title">CONTACT ME</h1>
            </div>
        </div>

        <div class="contact-card-container">
            
            <div class="contact-info-panel">
                <div class="form-header-text">
                    <h3>GET IN TOUCH</h3>
                </div>
                
                <div class="info-item">
                    <span class="info-icon"><i class="fa-solid fa-location-dot"></i></span>
                    <p class="info-text">Maa,<br>Davao City, <br>Philippines</p>
                </div>
                
                <div class="info-item">
                    <span class="info-icon"><i class="fa-solid fa-phone"></i></span>
                    <p class="info-text">+63 929 719 8867</p>
                </div>
                
                <div class="info-item">
                    <span class="info-icon"><i class="fa-solid fa-envelope"></i></span>
                    <p class="info-text">quenniebarbarona777 <br> @gmail.com</p>
                </div>
                
                <div class="social-section">
                    <p class="social-title">You can find me here too!</p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/quennie.barbarona" target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="https://www.tiktok.com/@username" target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        <a href="https://instagram.com/quennie_barbarona" target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrapper">
                

                <?php echo do_shortcode('[contact-form-7 id="57da92d" title="Contact form 1"]'); ?>
            </div>

        </div>

    </main>

    <aside class="right-icon-bar">
        <ul class="work-nav-icons">
            <li><a href="#about"><i class="fa-solid fa-user-tie"></i></a></li>
            <li><a href="#works"><i class="fa-solid fa-code"></i></a></li>
            <li><a href="#skills"><i class="fa-solid fa-gears"></i></a></li>
            <li><a href="#certificates"><i class="fa-solid fa-award"></i></a></li>
            <li><a href="#contact"><i class="fa-solid fa-envelope-open-text"></i></a></li>
        </ul>
    </aside>

</section>

<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const worksSection = document.querySelector('.works-portfolio-wrapper');
    const lightbox = worksSection ? worksSection.querySelector('.work-lightbox') : null;
    if(!worksSection || !lightbox) return;

    const imgEl = lightbox.querySelector('.work-lightbox__image');
    const closeBtn = lightbox.querySelector('.work-lightbox__close');
    const prevBtn = lightbox.querySelector('.work-lightbox__prev');
    const nextBtn = lightbox.querySelector('.work-lightbox__next');
    const captionEl = lightbox.querySelector('.work-lightbox__caption');

    let currentImages = [];
    let currentIndex = 0;

    function openLightbox(images, startIndex, fallback){
        currentImages = images || [];
        currentIndex = startIndex || 0;
        const data = currentImages[currentIndex] || fallback || {};
        imgEl.src = data.url || (fallback && fallback.src) || '';
        imgEl.alt = data.alt || (fallback && fallback.alt) || '';
        captionEl.textContent = data.desc || '';
        lightbox.classList.add('is-open');
        lightbox.setAttribute('aria-hidden','false');
        document.body.classList.add('work-lightbox-open');
        closeBtn.focus();
    }

    function closeLightbox(){
        lightbox.classList.remove('is-open');
        lightbox.setAttribute('aria-hidden','true');
        imgEl.removeAttribute('src');
        imgEl.setAttribute('alt', '');
        currentImages = [];
        document.body.classList.remove('work-lightbox-open');
    }

    let currentWorkUrl = '';
    let currentIsLoanManagement = false;

    function showNext(){
        if(currentIsLoanManagement && currentWorkUrl){
            window.open(currentWorkUrl, '_blank');
            return;
        }
        if(currentImages.length === 0) return;
        currentIndex = (currentIndex + 1) % currentImages.length;
        openLightbox(currentImages, currentIndex);
    }
    function showPrev(){ if(currentImages.length === 0) return; currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length; openLightbox(currentImages, currentIndex); }

    // attach click to project titles and see more buttons
    const cards = worksSection.querySelectorAll('.projects-grid .project-card');
    cards.forEach(function(card){
        const titleEl = card.querySelector('.project-title');
        const seeMoreEl = card.querySelector('.project-see-more');
        
        function openCardLightbox(e){
            const dataEl = card.querySelector('.project-images-data');
            if(!dataEl) return;
            let images = [];
            try{ images = JSON.parse(dataEl.getAttribute('data-images') || '[]'); }catch(err){ images = []; }
            const fallback = { src: card.querySelector('img') ? card.querySelector('img').src : '', alt: card.querySelector('img') ? card.querySelector('img').alt : '' };
            if(images.length === 0 && !fallback.src) return;
            openLightbox(images, 0, fallback);
        }
        
        if(titleEl){
            titleEl.style.cursor = 'pointer';
            titleEl.addEventListener('click', openCardLightbox);
        }
        
        if(seeMoreEl){
            seeMoreEl.style.cursor = 'pointer';
            seeMoreEl.addEventListener('click', function(e){
                const isLoanManagement = seeMoreEl.getAttribute('data-is-loan-management') === 'true';
                const workUrl = seeMoreEl.getAttribute('data-work-url') || '';
                
                // For Loan Management System, open lightbox with image1 and image_1_description
                if(isLoanManagement){
                    e.preventDefault();
                    currentWorkUrl = workUrl;
                    currentIsLoanManagement = true;
                    
                    const dataEl = card.querySelector('.project-images-data');
                    let images = [];
                    if(dataEl){
                        try{ images = JSON.parse(dataEl.getAttribute('data-images') || '[]'); }catch(err){ images = []; }
                    }
                    
                    // Only show the first image (image1) for Loan Management System
                    if(images.length > 0){
                        openLightbox([images[0]], 0);
                    }
                    return;
                }
                
                // For other projects, open lightbox with all images
                e.preventDefault();
                currentWorkUrl = '';
                currentIsLoanManagement = false;
                openCardLightbox(e);
            });
        }
    });

    closeBtn.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function(e){ if(e.target === lightbox) closeLightbox(); });

    prevBtn.addEventListener('click', function(e){ e.stopPropagation(); showPrev(); });
    nextBtn.addEventListener('click', function(e){ e.stopPropagation(); showNext(); });

    document.addEventListener('keydown', function(event){
        if(!lightbox.classList.contains('is-open')) return;
        if(event.key === 'Escape') closeLightbox();
        if(event.key === 'ArrowRight') showNext();
        if(event.key === 'ArrowLeft') showPrev();
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function(){
    // make entire right icon list item clickable and scroll smoothly to section
    document.querySelectorAll('.work-nav-icons li').forEach(function(li){
        li.style.cursor = 'pointer';
        li.addEventListener('click', function(e){
            var a = li.querySelector('a');
            if(!a) return;
            var href = a.getAttribute('href');
            if(!href) return;
            if(href.charAt(0) === '#'){
                var target = document.querySelector(href);
                if(target){
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    // update focus for accessibility
                    try{ target.setAttribute('tabindex','-1'); target.focus(); }catch(e){}
                } else {
                    // fallback to default navigation
                    window.location.href = href;
                }
            } else {
                window.location.href = href;
            }
        });
    });
});
</script>
