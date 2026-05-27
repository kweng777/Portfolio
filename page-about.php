<?php
/**
 * Page: About (hardcoded)
 * Placed at theme root so WP will use this for the /about/ slug automatically.
 */

get_header();
?>

<section class="works-portfolio-wrapper">

    <aside class="portfolio-sidebar">
        <div class="sidebar-top">
            <a class="profile-circle-link" href="<?php echo esc_url( home_url( '/#about' ) ); ?>">
                <div class="profile-circle-frame">
                    <?php 
                    $hero_img = get_field('hero_image');
                    if( $hero_img ): ?>
                        <img src="<?php echo esc_url($hero_img['url']); ?>" alt="Profile">
                    <?php else: ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/orange.PNG" alt="Profile">
                    <?php endif; ?>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav-menu">
            <ul>
                <li><a href="<?php echo esc_url( home_url('/about/') ); ?>" class="active">ABOUT</a></li>
                <li><a href="<?php echo esc_url( home_url('/works/') ); ?>">WORKS</a></li>
                <li><a href="<?php echo esc_url( home_url('/skills/') ); ?>">SKILLS</a></li>
                <li><a href="<?php echo esc_url( home_url('/certificates/') ); ?>">CERTIFICATES</a></li>
                <li><a href="<?php echo esc_url( home_url('/contact/') ); ?>">CONTACT</a></li>
            </ul>
        </nav>

    </aside>

    <main class="portfolio-main-content">

        <div class="header-area">
            <div class="title-with-arrow">
                <div class="line-arrow"></div>
                <h1 class="main-title">ABOUT</h1>
            </div>
        </div>

        <div class="projects-grid">
            <!-- About content injected into the works main area per request -->
            <div class="about-content" style="max-width:1090px; margin:0 auto; margin-right: 35px;">

                <style>
                /* Scoped about page styles */
                .about-banner{ background:#000; color:#fff; padding:22px 24px; border-radius:12px 12px 0 0; }
                .about-banner h2{ margin:0; font-size:2.6rem; }
                .about-banner h3{ margin:6px 0 0 0; font-size:1.1rem; font-weight:600; }

                .about-inner{ display:flex; gap:28px; align-items:stretch; padding:28px; background:#fff; border-radius:0 0 12px 12px; box-shadow:0 8px 20px rgba(0,0,0,0.06); }
                .about-left{ flex:1 1 auto; }
                .about-right-tech{ flex:0 0 420px; display:flex; flex-direction:column; justify-content:flex-end; }

                .tech-panel{ background:transparent; padding:8px; }
                .tech-panel h4{ margin:0 0 12px 0; font-size:1.1rem; }
                .tech-grid{ display:grid; grid-template-columns:repeat(5,1fr); gap:12px; }
                .tech-item{ width:64px; height:64px; border-radius:50%; background:#f7f7f7; display:flex; align-items:center; justify-content:center; font-size:12px; color:#111; box-shadow:0 6px 18px rgba(0,0,0,0.06); margin:0 auto; }
                .tech-icon{ font-size:22px; }

                @media (max-width:900px){ .about-inner{ flex-direction:column; } .about-right-tech{ flex: none; width:100%; } .tech-grid{ grid-template-columns:repeat(5,1fr); justify-items:center; } }
                </style>

                <!-- Banner with H2 + H3 on black background -->
                <div class="about-banner">
                    <h2>Who I Am</h2>
                </div>

                <div class="about-inner">
                    <div class="about-left">
                        <p style="font-size:1.1rem; color:#333; margin-bottom:18px; letter-spacing: 1px;">I am Quennie Rose B. Barbarona, an aspiring Software and Web Developer from Davao City, Philippines. I am passionate about learning new technologies and improving my skills through hands-on experience and real-world projects.</p>

                        <h3 style="font-size:1.6rem; margin-bottom:10px;">Development Works</h3>
                        <ul style="margin-left:18px; margin-bottom:20px; color:#333; font-size:1rem; letter-spacing: 0.5px;">
                            <li>Web development</li>
                            <li>Backend development</li>
                            <li>WordPress development</li>
                            <li>Database management</li>
                        </ul>

                        <a href="#" class="btn-more" style="display:inline-block;">Resume</a>
                    </div>

                    <aside class="about-right-tech">
                        <div class="tech-panel">
                            <h4>Technology I used</h4>
                            <div class="tech-grid">
                                <div class="tech-item" title="HTML5"><i class="fa-brands fa-html5 tech-icon" aria-hidden="true"></i></div>
                                <div class="tech-item" title="Tailwind CSS"><span style="font-weight:700;">TW</span></div>
                                <div class="tech-item" title="Blade"><span style="font-weight:700;">Blade</span></div>
                                <div class="tech-item" title="React (Vite)"><i class="fa-brands fa-react tech-icon" aria-hidden="true"></i></div>
                                <div class="tech-item" title="JavaScript"><i class="fa-brands fa-js tech-icon" aria-hidden="true"></i></div>

                                <div class="tech-item" title="Bootstrap"><i class="fa-brands fa-bootstrap tech-icon" aria-hidden="true"></i></div>
                                <div class="tech-item" title="Node.js"><i class="fa-brands fa-node-js tech-icon" aria-hidden="true"></i></div>
                                <div class="tech-item" title="ASP.NET (C#)"><span style="font-weight:700;">ASP.NET</span></div>
                                <div class="tech-item" title="MySQL"><i class="fa-solid fa-database tech-icon" aria-hidden="true"></i></div>
                                <div class="tech-item" title="Vite"><span style="font-weight:700;">Vite</span></div>
                            </div>
                        </div>
                    </aside>
                </div>

            </div>
        </div>

    </main>

    <aside class="right-icon-bar">

        <ul class="work-nav-icons">
            <li><a href="/about"><i class="fa-solid fa-user-tie"></i></a></li>
            <li><a href="/works"><i class="fa-solid fa-code"></i></a></li>
            <li><a href="/skills"><i class="fa-solid fa-gears"></i></a></li>
            <li><a href="/certificates"><i class="fa-solid fa-award"></i></a></li>
            <li><a href="/contact"><i class="fa-solid fa-envelope-open-text"></i></a></li>
        </ul>

    </aside>

</section>

<?php get_footer(); ?>
