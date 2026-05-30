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
                <li><a href="<?php echo esc_url( home_url('/#works') ); ?>">WORKS</a></li>
                <li><a href="<?php echo esc_url( home_url('/#skills') ); ?>">SKILLS</a></li>
                <li><a href="<?php echo esc_url( home_url('/#certificates') ); ?>">CERTIFICATES</a></li>
                <li><a href="<?php echo esc_url( home_url('/#contact') ); ?>">CONTACT</a></li>
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

             

                <div class="about-inner">
                    <div class="about-left">

                        <!-- FULL WIDTH INTRO -->
                        <p class="about-intro">
                            <?php the_field('introduction'); ?>
                        </p>

                        <!-- TWO COLUMN WRAPPER -->
                        <div class="about-two-columns">

                            <!-- LEFT SIDE -->
                            <div class="about-col">

                                <h3 style="margin-bottom:10px; letter-spacing: 2px;"><span class="project-label">My Journey</span></h3>
                                <p class="about-text">
                                    <?php the_field('my_journey'); ?>
                                </p>

                                <h3 style="margin-bottom:10px; letter-spacing: 2px;"><span class="project-label">Learning Experience</span></h3>
                                <p class="about-text">
                                    <?php the_field('learning_experience'); ?>
                                </p>

                            </div>

                            <!-- RIGHT SIDE -->
                            <div class="about-col">

                                <h3 style="margin-bottom:10px; letter-spacing: 2px;"><span class="project-label">Mindset</span></h3>
                                <p class="about-text">
                                    <?php the_field('mindset'); ?>
                                </p>

                                <h3 style="margin-bottom:10px; letter-spacing: 2px;"><span class="project-label">Goals</span></h3>
                                <p class="about-text">
                                    <?php the_field('goals'); ?>
                                </p>

                                 <!-- RESUME BUTTON MOVED HERE -->
                                <?php 
                                $resume = get_field('about_resume_file');

                                if( $resume ) : 
                                ?>
                                    <a href="<?php echo esc_url($resume['url']); ?>" 
                                    class="btn-more resume-btn-edge"
                                    target="_blank">

                                        Resume

                                    </a>
                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                    
                </div>

            </div>
        </div>

    </main>

    <aside class="right-icon-bar">

        <ul class="work-nav-icons">
            <li><a href="<?php echo esc_url( home_url('/about/') ); ?>" class="active"><i class="fa-solid fa-user-tie"></i></a></li>
            <li><a href="<?php echo esc_url( home_url('/#works') ); ?>"><i class="fa-solid fa-code"></i></a></li>
            <li><a href="<?php echo esc_url( home_url('/#skills') ); ?>"><i class="fa-solid fa-gears"></i></a></li>
            <li><a href="<?php echo esc_url( home_url('/#certificates') ); ?>"><i class="fa-solid fa-award"></i></a></li>
            <li><a href="<?php echo esc_url( home_url('/#contact') ); ?>"><i class="fa-solid fa-envelope-open-text"></i></a></li>
        </ul>

    </aside>

</section>

<?php get_footer(); ?>
