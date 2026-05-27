<?php
/**
 * Template Name: About Page
 *
 * @package DevPortfolio
 */

get_header();

$resume    = get_field( 'about_resume_file' );

?>

<section class="about-page" style="padding:60px 20px;">
    <div class="container" style="max-width:1200px; margin:0 auto; display:flex; gap:40px; align-items:flex-start;">
        <!-- RIGHT: About content requested -->
        <main class="about-right" style="flex:1 1 auto;">
            <h2 style="font-size:2.25rem; margin-bottom:12px;">Who I Am</h2>
            <p style="font-size:1.1rem; color:#333; margin-bottom:18px;">I am <strong>Anne Melina</strong>, an aspiring Software and Web Developer from Davao City, Philippines. I am passionate about learning new technologies and improving my skills through hands-on experience and real-world projects.</p>

            <h3 style="font-size:1.25rem; margin-bottom:8px;">What I Do</h3>
            <ul style="margin-left:18px; margin-bottom:20px; color:#333; font-size:1.05rem;">
                <li>Web development</li>
                <li>Frontend development</li>
                <li>Backend development</li>
                <li>WordPress development</li>
                <li>Database management</li>
            </ul>

            <h3 style="font-size:1.25rem; margin-bottom:8px;">Education</h3>
            <p style="margin-bottom:20px;">Bachelor of Science in Information Technology<br>
            Davao Oriental State University</p>

            <?php if ( $resume ) : ?>
                <a href="<?php echo esc_url( $resume ); ?>" class="btn-more" style="display:inline-block;">Download Resume</a>
            <?php else: ?>
                <a href="#" class="btn-more" style="display:inline-block;">Resume</a>
            <?php endif; ?>
        </main>

    </div>
</section>

<?php get_footer(); ?>
