<?php
/**
 * Customizer: every text, link and picture of the home page.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Section => [label, fields]. Field => [type, label]. */
function s24_customizer_map() {
	$m = array(
		's24_contacts' => array(
			'Контакти та шапка',
			array(
				'phone'            => array( 'text', 'Телефон для дзвінка (цифри)' ),
				'phone_label'      => array( 'text', 'Телефон, як його видно на сайті' ),
				'telegram'         => array( 'url', 'Telegram (посилання)' ),
				'lead_email'       => array( 'text', 'E-mail для заявок з форми (порожньо — e-mail адміністратора)' ),
				'logo_main'        => array( 'text', 'Логотип: текст' ),
				'logo_accent'      => array( 'text', 'Логотип: червона частина' ),
				'logo_sub'         => array( 'text', 'Логотип: підпис' ),
				'search_action'    => array( 'url', 'Пошук: адреса сайту, де шукати' ),
				'lang_ru_url'      => array( 'url', 'Посилання на російську версію' ),
				'meta_description' => array( 'textarea', 'Опис сторінки для Google' ),
			),
		),
		's24_hero'     => array( 'Слайдер (перший екран)', array() ),
		's24_features' => array( 'Чотири плитки під слайдером', array() ),
		's24_catalog'  => array(
			'Каталог',
			array(
				'cat_title'    => array( 'text', 'Заголовок' ),
				'cat_title_em' => array( 'text', 'Заголовок: червона частина' ),
			),
		),
		's24_why'      => array(
			'Чому Склад 24 і клієнти',
			array(
				'why_title'     => array( 'text', 'Заголовок' ),
				'why_title_em'  => array( 'text', 'Заголовок: червона частина' ),
				'clients_title' => array( 'text', 'Заголовок блоку клієнтів' ),
			),
		),
		's24_service'  => array(
			'Сервіс і форма заявки',
			array(
				'svc_title'  => array( 'text', 'Заголовок' ),
				'svc_img'    => array( 'image', 'Банер' ),
				'svc_url'    => array( 'url', 'Посилання банера' ),
				'svc_text'   => array( 'html', 'Текст (порожній рядок — новий абзац)' ),
				'form_title' => array( 'text', 'Форма: заголовок' ),
				'form_lead'  => array( 'text', 'Форма: підзаголовок' ),
				'form_ok'    => array( 'text', 'Форма: повідомлення після відправки' ),
			),
		),
		's24_nums'     => array(
			'У цифрах',
			array(
				'nums_title'       => array( 'text', 'Заголовок: початок' ),
				'nums_title_em'    => array( 'text', 'Заголовок: червона частина' ),
				'nums_title_after' => array( 'text', 'Заголовок: кінець' ),
			),
		),
		's24_sections' => array(
			'Новинки, відгуки, питання',
			array(
				'news_title'    => array( 'text', 'Заголовок новинок' ),
				'reviews_title' => array( 'text', 'Заголовок відгуків' ),
				'faq_title'     => array( 'text', 'Заголовок питань' ),
				'faq_sub'       => array( 'textarea', 'Текст під заголовком питань' ),
				'faq_ask'       => array( 'text', 'Посилання «Напишіть нам»' ),
			),
		),
		's24_map'      => array(
			'Контакти і карта',
			array(
				'contacts_title' => array( 'text', 'Заголовок' ),
				'cities'         => array( 'textarea', 'Міста: один рядок = Місто | телефон | адреса для карти' ),
			),
		),
		's24_footer'   => array(
			'Підвал',
			array(
				'footer_text'   => array( 'textarea', 'Текст під логотипом' ),
				'footer_copy'   => array( 'text', 'Копірайт ({year} — поточний рік)' ),
				'price_url'     => array( 'url', 'Посилання «Прайс-лист»' ),
				'soc_facebook'  => array( 'url', 'Facebook' ),
				'soc_youtube'   => array( 'url', 'YouTube' ),
				'soc_instagram' => array( 'url', 'Instagram' ),
				'soc_linkedin'  => array( 'url', 'LinkedIn' ),
			),
		),
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$m['s24_hero'][1][ "hero_{$i}_title" ] = array( 'textarea', "Слайд {$i}: заголовок (Enter — новий рядок)" );
		$m['s24_hero'][1][ "hero_{$i}_text" ]  = array( 'textarea', "Слайд {$i}: текст" );
		$m['s24_hero'][1][ "hero_{$i}_btn" ]   = array( 'text', "Слайд {$i}: текст кнопки" );
		$m['s24_hero'][1][ "hero_{$i}_url" ]   = array( 'url', "Слайд {$i}: посилання кнопки" );
		$m['s24_hero'][1][ "hero_{$i}_img" ]   = array( 'image', "Слайд {$i}: картинка" );
		$m['s24_hero'][1][ "hero_{$i}_mode" ]  = array( 'mode', "Слайд {$i}: як показати картинку" );
	}
	for ( $i = 1; $i <= 4; $i++ ) {
		$m['s24_features'][1][ "feat_{$i}_title" ] = array( 'text', "Плитка {$i}: заголовок" );
		$m['s24_features'][1][ "feat_{$i}_text" ]  = array( 'textarea', "Плитка {$i}: текст" );
		$m['s24_features'][1][ "feat_{$i}_url" ]   = array( 'url', "Плитка {$i}: посилання" );
	}
	for ( $i = 1; $i <= 8; $i++ ) {
		$m['s24_catalog'][1][ "cat_{$i}_title" ] = array( 'text', "Розділ {$i}: назва" );
		$m['s24_catalog'][1][ "cat_{$i}_url" ]   = array( 'url', "Розділ {$i}: посилання" );
		$m['s24_catalog'][1][ "cat_{$i}_img" ]   = array( 'image', "Розділ {$i}: картинка" );
	}
	for ( $i = 1; $i <= 8; $i++ ) {
		$m['s24_why'][1][ "why_{$i}" ] = array( 'textarea', "Перевага {$i}" );
	}
	for ( $i = 1; $i <= 5; $i++ ) {
		$m['s24_why'][1][ "client_{$i}_img" ] = array( 'image', "Клієнт {$i}: логотип" );
		$m['s24_why'][1][ "client_{$i}_alt" ] = array( 'text', "Клієнт {$i}: назва" );
	}
	for ( $i = 1; $i <= 5; $i++ ) {
		$m['s24_nums'][1][ "num_{$i}_value" ] = array( 'text', "Цифра {$i}" );
		$m['s24_nums'][1][ "num_{$i}_label" ] = array( 'textarea', "Цифра {$i}: підпис" );
	}
	return $m;
}

add_action( 'customize_register', function ( $wp_customize ) {
	$defaults = s24_defaults();
	$wp_customize->add_panel(
		's24_home',
		array(
			'title'    => 'Головна сторінка Склад24',
			'priority' => 20,
		)
	);
	$prio = 0;
	foreach ( s24_customizer_map() as $section => $def ) {
		$wp_customize->add_section(
			$section,
			array(
				'title'    => $def[0],
				'panel'    => 's24_home',
				'priority' => ++$prio,
			)
		);
		foreach ( $def[1] as $key => $field ) {
			list( $type, $label ) = $field;
			$default              = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
			if ( is_string( $default ) && 0 === strpos( $default, 'img:' ) ) {
				$default = s24_img( substr( $default, 4 ) );
			}
			$sanitize = array(
				'text'     => 'sanitize_text_field',
				'textarea' => 'sanitize_textarea_field',
				'html'     => 'wp_kses_post',
				'url'      => 's24_sanitize_link',
				'image'    => 'esc_url_raw',
				'mode'     => 's24_sanitize_mode',
			);
			$wp_customize->add_setting(
				's24_' . $key,
				array(
					'default'           => $default,
					'sanitize_callback' => $sanitize[ $type ],
				)
			);
			if ( 'image' === $type ) {
				$wp_customize->add_control(
					new WP_Customize_Image_Control(
						$wp_customize,
						's24_' . $key,
						array(
							'label'   => $label,
							'section' => $section,
						)
					)
				);
			} elseif ( 'mode' === $type ) {
				$wp_customize->add_control(
					's24_' . $key,
					array(
						'label'   => $label,
						'section' => $section,
						'type'    => 'select',
						'choices' => array(
							'bg'  => 'На весь фон',
							'pic' => 'Праворуч на темному фоні',
						),
					)
				);
			} else {
				$wp_customize->add_control(
					's24_' . $key,
					array(
						'label'   => $label,
						'section' => $section,
						'type'    => ( 'html' === $type ) ? 'textarea' : $type,
					)
				);
			}
		}
	}
} );

/** Links: full URLs, or on-page anchors like #form. */
function s24_sanitize_link( $value ) {
	$value = trim( (string) $value );
	if ( '' !== $value && '#' === $value[0] ) {
		return '#' . preg_replace( '/[^A-Za-z0-9_-]/', '', substr( $value, 1 ) );
	}
	return esc_url_raw( $value );
}

function s24_sanitize_mode( $value ) {
	return in_array( $value, array( 'bg', 'pic' ), true ) ? $value : 'pic';
}
