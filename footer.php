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
        <div class="footer-bottom">
            <p class="footer-copy">
                &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
