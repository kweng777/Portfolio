<?php
/**
 * Enqueue Styles & Scripts
 *
 * @package DevPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'devportfolio_enqueue_assets' );

function devportfolio_enqueue_assets() {

    // ─── Google Fonts ───────────────────────────────────────────────
    wp_enqueue_style(
        'devportfolio-google-fonts',
        'https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap',
        array(),
        null
    );

    // ─── Main Theme Stylesheet ──────────────────────────────────────
    wp_enqueue_style(
        'devportfolio-main',
        DEV_PORTFOLIO_URI . '/assets/css/style.css',
        array(),
        DEV_PORTFOLIO_VERSION
    );

    // ─── Main JS ────────────────────────────────────────────────────
    wp_enqueue_script(
        'devportfolio-main',
        DEV_PORTFOLIO_URI . '/assets/js/main.js',
        array(),
        DEV_PORTFOLIO_VERSION,
        true
    );
}
