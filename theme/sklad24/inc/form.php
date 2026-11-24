<?php
/**
 * "Ask a question" form: stores the enquiry in the admin (Заявки) and e-mails it.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_ajax_s24_lead', 's24_handle_lead' );
add_action( 'wp_ajax_nopriv_s24_lead', 's24_handle_lead' );

function s24_handle_lead() {
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- checked right below.
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 's24_lead' ) ) {
		wp_send_json_error( array( 'message' => 'Сторінка застаріла, оновіть її і спробуйте ще раз.' ), 403 );
	}
	// Honeypot: real people leave it empty.
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success();
	}
	$get   = function ( $k, $max = 200 ) {
		$v = isset( $_POST[ $k ] ) ? sanitize_text_field( wp_unslash( $_POST[ $k ] ) ) : '';
		return mb_substr( $v, 0, $max );
	};
	$name  = $get( 'name', 100 );
	$phone = $get( 'phone', 40 );
	$city  = $get( 'city', 100 );
	$email = sanitize_email( $get( 'email', 150 ) );
	$msg   = isset( $_POST['msg'] ) ? mb_substr( sanitize_textarea_field( wp_unslash( $_POST['msg'] ) ), 0, 3000 ) : '';
	$page  = isset( $_POST['page'] ) ? esc_url_raw( wp_unslash( $_POST['page'] ) ) : '';
	// phpcs:enable

	$digits = preg_replace( '/\D/', '', $phone );
	if ( '' === $name || strlen( $digits ) < 9 || strlen( $digits ) > 15 ) {
		wp_send_json_error( array( 'message' => "Вкажіть ім'я і телефон." ), 422 );
	}

	// Simple flood guard: 5 enquiries per 10 minutes from one address.
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 's24_rl_' . md5( $ip );
	$n   = (int) get_transient( $key );
	if ( $n >= 5 ) {
		wp_send_json_error( array( 'message' => 'Забагато заявок. Спробуйте пізніше або зателефонуйте.' ), 429 );
	}
	set_transient( $key, $n + 1, 10 * MINUTE_IN_SECONDS );

	$id = wp_insert_post(
		array(
			'post_type'    => 's24_lead',
			'post_status'  => 'pending',
			'post_title'   => $name . ' — ' . $phone,
			'post_content' => $msg,
		),
		true
	);
	if ( is_wp_error( $id ) ) {
		wp_send_json_error( array( 'message' => 'Не вдалося зберегти заявку. Зателефонуйте нам, будь ласка.' ), 500 );
	}
	foreach ( compact( 'name', 'phone', 'city', 'email', 'page' ) as $k => $v ) {
		update_post_meta( $id, '_s24_' . $k, $v );
	}

	$to = s24_mod( 'lead_email' );
	if ( ! is_email( $to ) ) {
		$to = get_option( 'admin_email' );
	}
	$body = "Нова заявка з сайту\n\nІм'я: {$name}\nТелефон: {$phone}\nМісто: {$city}\nE-mail: {$email}\n\nПитання:\n{$msg}\n\nУсі заявки: " . admin_url( 'edit.php?post_type=s24_lead' );
	$headers = array();
	if ( $email ) {
		$headers[] = 'Reply-To: ' . $email;
	}
	wp_mail( $to, 'Заявка з сайту: ' . $name, $body, $headers );

	wp_send_json_success( array( 'message' => s24_mod( 'form_ok' ) ) );
}
