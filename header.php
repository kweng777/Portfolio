<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=New+Amsterdam&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( ! is_front_page() ) : ?>

<header class="navbar">

    <!-- LOGO (hidden on About page per user request) -->
    <?php if ( ! is_page('about') ) : ?>
    <div class="logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/white.png" alt="Logo">
    </div>
    <?php endif; ?>

    <!-- NAVIGATION (hidden on About page per user request) -->
    <?php if ( ! is_page('about') ) : ?>
    <nav class="nav-links">

        <a href="#hero">
            <?php 
            $about = get_field('nav_about');
            echo $about ? esc_html($about) : 'ABOUT';
            ?>
        </a>

        <a href="#works">
            <?php 
            $works = get_field('nav_works');
            echo $works ? esc_html($works) : 'WORKS';
            ?>
        </a>

        <a href="#skills">
            <?php 
            $skills = get_field('nav_skills');
            echo $skills ? esc_html($skills) : 'SKILLS';
            ?>
        </a>

        <a href="#certificates">
            <?php 
            $cert = get_field('nav_certificates');
            echo $cert ? esc_html($cert) : 'CERTIFICATE';
            ?>
        </a>

        <a href="#contact">
            <?php 
            $contact = get_field('nav_contact');
            echo $contact ? esc_html($contact) : 'CONTACT';
            ?>
        </a>

    </nav>
    <?php endif; ?>

</header>
<?php endif; ?>

<main class="site-main">