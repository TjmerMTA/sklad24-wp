<?php
/**
 * Sklad24 theme.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'S24_VER', '1.0.0' );
define( 'S24_DIR', get_template_directory() );
define( 'S24_URI', get_template_directory_uri() );

require S24_DIR . '/inc/defaults.php';
require S24_DIR . '/inc/helpers.php';
require S24_DIR . '/inc/customizer.php';
require S24_DIR . '/inc/post-types.php';
require S24_DIR . '/inc/form.php';
require S24_DIR . '/inc/seed.php';

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'sklad24', S24_DIR . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo' );
	register_nav_menus(
		array(
			'top'     => 'Верхнє меню (над шапкою)',
			'catalog' => 'Меню каталогу (під шапкою, мобільне меню)',
			'footer'  => 'Каталог у підвалі',
			'legal'   => 'Посилання внизу підвалу',
		)
	);
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		's24-fonts',
		'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=Roboto+Condensed:wght@400;500;700&family=Montserrat:wght@700;800;900&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 's24-main', S24_URI . '/assets/css/main.css', array( 's24-fonts' ), S24_VER );
	wp_enqueue_style( 's24-wp', S24_URI . '/assets/css/wp.css', array( 's24-main' ), S24_VER );
	wp_enqueue_script( 'lucide', 'https://unpkg.com/lucide@0.460.0/dist/umd/lucide.min.js', array(), '0.460.0', true );
	wp_enqueue_script( 's24-main', S24_URI . '/assets/js/main.js', array( 'lucide' ), S24_VER, true );
	wp_localize_script(
		's24-main',
		'S24',
		array(
			'ajax'  => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 's24_lead' ),
		)
	);
} );

add_action( 'wp_head', function () {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	$desc = s24_mod( 'meta_description' );
	if ( $desc && ( is_front_page() || is_home() ) ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
}, 1 );
