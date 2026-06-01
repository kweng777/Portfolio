</main><!-- .site-main -->

<?php
// Pull contact/social data from the front page ACF fields
$front_page_id = get_option( 'page_on_front' );
$footer_email    = get_field( 'social_email', $front_page_id );
$footer_github   = get_field( 'social_github', $front_page_id );
$footer_linkedin = get_field( 'social_linkedin', $front_page_id );
$footer_twitter  = get_field( 'social_twitter', $front_page_id );

// Pull contact page data
$contact_pages = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/page-contact.php' ) );
$contact_page_id = ! empty( $contact_pages ) ? $contact_pages[0]->ID : 0;
$footer_phone    = $contact_page_id ? get_field( 'contact_phone', $contact_page_id ) : '';

// Get recent works
$footer_works = new WP_Query( array(
    'post_type'      => 'work',
    'posts_per_page' => 5,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-columns">
            <div class="footer-column footer-column-1">
                <img src="<?php echo get_template_directory_uri(); ?>/images/orange.PNG" alt="Logo" class="footer-logo">
                <h3>Quennie Rose Barbarona</h3>
                <p>Build, Learn, Grow</p>
            </div>
            <div class="footer-column footer-column-2">
                <h4>Navigations</h4>
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#works">Works</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#certificates">Certificates</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column footer-column-3">
                <h4>Contact Me</h4>
                <p class="footer-email">Email: <a href="https://mail.google.com/mail/?view=cm&fs=1&to=quenniebarbarona777@gmail.com" target="_blank" class="footer-link">quenniebarbarona777@gmail.com</a></p>
                <p class="footer-email"><a href="tel:+639297198867" class="footer-link">+63 929 719 8867</a></p>
                <p class="footer-email">Davao City, Philippines</p>
                <div class="footer-social">
                    <?php if ( $footer_github ) : ?>
                        <a href="<?php echo esc_url( $footer_github ); ?>" target="_blank">GitHub</a>
                    <?php endif; ?>
                    <?php if ( $footer_linkedin ) : ?>
                        <a href="<?php echo esc_url( $footer_linkedin ); ?>" target="_blank">LinkedIn</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <button class="back-to-top" onclick="scrollToAbout()">Back to Top</button>
            <p class="footer-copy">
                &copy; 2026 Porfolio. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<script>
function scrollToAbout() {
    const aboutSection = document.getElementById('about');
    if (aboutSection) {
        aboutSection.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>

<?php wp_footer(); ?>
</body>
</html>
