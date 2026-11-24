<?php
/**
 * Content types: new products, reviews, FAQ, form enquiries.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Meta fields per post type: key => label. */
function s24_meta_fields() {
	return array(
		's24_product' => array(
			'series' => 'Серія / модель',
			'weight' => 'Вантажопідйомність (напр. 3 000 кг)',
			'height' => 'Висота підйому (напр. 3 000 мм)',
			'badge'  => 'Плашка (напр. «В наявності», порожньо — без плашки)',
			'liion'  => 'Друга плашка (напр. «LI ION», порожньо — без неї)',
			'link'   => 'Посилання «Докладніше»',
		),
		's24_review'  => array(
			'person' => "Ім'я автора",
			'date'   => 'Дата (як показати, напр. 18/02/2023)',
		),
		's24_lead'    => array(
			'name'  => "Ім'я",
			'phone' => 'Телефон',
			'city'  => 'Місто',
			'email' => 'E-mail',
			'page'  => 'Сторінка',
		),
	);
}

add_action( 'init', function () {
	register_post_type(
		's24_product',
		array(
			'labels'        => array(
				'name'          => 'Новинки',
				'singular_name' => 'Новинка',
				'add_new'       => 'Додати новинку',
				'add_new_item'  => 'Нова новинка',
				'edit_item'     => 'Редагувати новинку',
				'all_items'     => 'Усі новинки',
			),
			'public'        => false,
			'show_ui'       => true,
			'menu_icon'     => 'dashicons-products',
			'menu_position' => 21,
			'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
		)
	);
	register_post_type(
		's24_review',
		array(
			'labels'        => array(
				'name'          => 'Відгуки',
				'singular_name' => 'Відгук',
				'add_new'       => 'Додати відгук',
				'add_new_item'  => 'Новий відгук',
				'edit_item'     => 'Редагувати відгук',
				'all_items'     => 'Усі відгуки',
			),
			'public'        => false,
			'show_ui'       => true,
			'menu_icon'     => 'dashicons-format-quote',
			'menu_position' => 22,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		)
	);
	register_post_type(
		's24_faq',
		array(
			'labels'        => array(
				'name'          => 'Питання',
				'singular_name' => 'Питання',
				'add_new'       => 'Додати питання',
				'add_new_item'  => 'Нове питання',
				'edit_item'     => 'Редагувати питання',
				'all_items'     => 'Усі питання',
			),
			'public'        => false,
			'show_ui'       => true,
			'menu_icon'     => 'dashicons-editor-help',
			'menu_position' => 23,
			'supports'      => array( 'title', 'editor', 'page-attributes' ),
		)
	);
	register_post_type(
		's24_lead',
		array(
			'labels'        => array(
				'name'          => 'Заявки',
				'singular_name' => 'Заявка',
				'edit_item'     => 'Заявка',
				'all_items'     => 'Усі заявки',
			),
			'public'        => false,
			'show_ui'       => true,
			'menu_icon'     => 'dashicons-email-alt',
			'menu_position' => 3,
			'supports'      => array( 'title', 'editor' ),
			'capabilities'  => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'  => true,
		)
	);
} );

// Block editor off for these simple types: classic screen is easier for the owner.
add_filter( 'use_block_editor_for_post_type', function ( $use, $type ) {
	return in_array( $type, array( 's24_product', 's24_review', 's24_faq', 's24_lead' ), true ) ? false : $use;
}, 10, 2 );

add_action( 'add_meta_boxes', function () {
	foreach ( array_keys( s24_meta_fields() ) as $type ) {
		add_meta_box( 's24_meta', 'Дані', 's24_meta_box', $type, 'normal', 'high' );
	}
} );

function s24_meta_box( $post ) {
	$fields = s24_meta_fields();
	wp_nonce_field( 's24_meta', 's24_meta_nonce' );
	echo '<table class="form-table">';
	foreach ( $fields[ $post->post_type ] as $key => $label ) {
		$val = get_post_meta( $post->ID, '_s24_' . $key, true );
		printf(
			'<tr><th><label for="s24_%1$s">%2$s</label></th><td><input type="text" class="regular-text" id="s24_%1$s" name="s24_meta[%1$s]" value="%3$s"></td></tr>',
			esc_attr( $key ),
			esc_html( $label ),
			esc_attr( $val )
		);
	}
	echo '</table>';
	if ( 's24_product' === $post->post_type ) {
		echo '<p class="description">Фото товару — «Зображення запису» праворуч. Порядок на сайті — поле «Порядок».</p>';
	}
	if ( 's24_review' === $post->post_type ) {
		echo '<p class="description">Заголовок — назва компанії, текст — сам відгук, «Зображення запису» — фото листа-відгуку.</p>';
	}
}

add_action( 'save_post', function ( $post_id ) {
	if ( ! isset( $_POST['s24_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['s24_meta_nonce'] ) ), 's24_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$type   = get_post_type( $post_id );
	$fields = s24_meta_fields();
	if ( ! isset( $fields[ $type ] ) || empty( $_POST['s24_meta'] ) || ! is_array( $_POST['s24_meta'] ) ) {
		return;
	}
	$in = wp_unslash( $_POST['s24_meta'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized per field.
	foreach ( array_keys( $fields[ $type ] ) as $key ) {
		$val = isset( $in[ $key ] ) ? (string) $in[ $key ] : '';
		$val = ( 'link' === $key ) ? s24_sanitize_link( $val ) : sanitize_text_field( $val );
		update_post_meta( $post_id, '_s24_' . $key, $val );
	}
} );

/** Lead list columns. */
add_filter( 'manage_s24_lead_posts_columns', function ( $cols ) {
	return array(
		'cb'        => $cols['cb'],
		'title'     => 'Заявка',
		's24_phone' => 'Телефон',
		's24_city'  => 'Місто',
		's24_email' => 'E-mail',
		'date'      => 'Дата',
	);
} );
add_action( 'manage_s24_lead_posts_custom_column', function ( $col, $post_id ) {
	if ( 0 === strpos( $col, 's24_' ) ) {
		echo esc_html( get_post_meta( $post_id, '_' . $col, true ) );
	}
}, 10, 2 );

/** Unread enquiries count in the admin menu. */
add_action( 'admin_menu', function () {
	global $menu;
	$count = (int) wp_count_posts( 's24_lead' )->pending;
	if ( ! $count || ! is_array( $menu ) ) {
		return;
	}
	foreach ( $menu as $i => $item ) {
		if ( isset( $item[2] ) && 'edit.php?post_type=s24_lead' === $item[2] ) {
			$menu[ $i ][0] .= ' <span class="awaiting-mod"><span class="pending-count">' . $count . '</span></span>'; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		}
	}
}, 99 );

/** Opening a pending enquiry marks it as read. */
add_action( 'load-post.php', function () {
	$id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( $id && 's24_lead' === get_post_type( $id ) && 'pending' === get_post_status( $id ) && current_user_can( 'edit_post', $id ) ) {
		wp_update_post(
			array(
				'ID'          => $id,
				'post_status' => 'private',
			)
		);
	}
} );

/** Get a meta value. */
function s24_meta( $post_id, $key ) {
	return get_post_meta( $post_id, '_s24_' . $key, true );
}
