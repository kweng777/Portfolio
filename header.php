<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="navbar">

    <!-- LOGO -->
    <div class="logo">
        <?php 
        $logo = get_field('site_logo_text');
        echo $logo ? esc_html($logo) : 'PORTFOLIO';
        ?>
    </div>

    <!-- NAVIGATION -->
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

</header>

<main class="site-main">