<?php
/**
 * Small helpers used by the templates.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Value of an editable field (Customizer), falling back to the default. */
function s24_mod( $key ) {
	$d   = s24_defaults();
	$def = isset( $d[ $key ] ) ? $d[ $key ] : '';
	$val = get_theme_mod( 's24_' . $key, $def );
	if ( is_string( $val ) && 0 === strpos( $val, 'img:' ) ) {
		$val = S24_URI . '/assets/img/' . substr( $val, 4 );
	}
	return $val;
}

/** Text with line breaks turned into <br>, escaped. */
function s24_br( $text ) {
	return nl2br( esc_html( $text ), false );
}

/** Theme image URL. */
function s24_img( $file ) {
	return S24_URI . '/assets/img/' . $file;
}

/** Phone link (tel:). */
function s24_tel() {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', s24_mod( 'phone' ) );
}

/** Lucide icon placeholder. */
function s24_icon( $name ) {
	return '<i data-lucide="' . esc_attr( $name ) . '"></i>';
}

/**
 * Print a menu location as plain <a> links (or <li><a>), with defaults when the owner has not set a menu.
 *
 * @param string $location Menu location.
 * @param string $wrap     'a' — bare links, 'li' — list items.
 * @param array  $extra    Extra attributes per link, keyed by URL.
 */
function s24_links( $location, $wrap = 'a', $extra = array() ) {
	$items     = array();
	$locations = get_nav_menu_locations();
	if ( ! empty( $locations[ $location ] ) ) {
		$menu_items = wp_get_nav_menu_items( $locations[ $location ] );
		if ( $menu_items ) {
			foreach ( $menu_items as $mi ) {
				if ( 0 === (int) $mi->menu_item_parent ) {
					$items[] = array( $mi->title, $mi->url, $mi->target );
				}
			}
		}
	}
	if ( ! $items ) {
		$defaults = s24_default_menus();
		foreach ( $defaults[ $location ] as $it ) {
			$items[] = array( $it[0], $it[1], '' );
		}
	}
	$out = '';
	foreach ( $items as $it ) {
		$attrs = '';
		if ( ! empty( $it[2] ) ) {
			$attrs .= ' target="' . esc_attr( $it[2] ) . '" rel="noopener"';
		}
		if ( isset( $extra[ $it[1] ] ) ) {
			$attrs .= ' ' . $extra[ $it[1] ];
		}
		$a    = '<a href="' . esc_url( $it[1] ) . '"' . $attrs . '>' . esc_html( $it[0] ) . '</a>';
		$out .= ( 'li' === $wrap ) ? '<li>' . $a . '</li>' : $a;
	}
	echo $out; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
}

/** Parse the "cities" field: one line = "City | phone | map query". */
function s24_cities() {
	$out = array();
	foreach ( preg_split( '/\r\n|\r|\n/', (string) s24_mod( 'cities' ) ) as $line ) {
		$parts = array_map( 'trim', explode( '|', $line ) );
		if ( '' === $parts[0] ) {
			continue;
		}
		$out[] = array(
			'city'  => $parts[0],
			'phone' => isset( $parts[1] ) ? $parts[1] : '',
			'q'     => isset( $parts[2] ) && '' !== $parts[2] ? $parts[2] : $parts[0],
		);
	}
	return $out;
}

/** Google Maps embed URL. */
function s24_map_url( $q ) {
	return 'https://maps.google.com/maps?q=' . rawurlencode( $q ) . '&z=' . ( mb_strlen( $q ) > 20 ? 15 : 12 ) . '&output=embed';
}
