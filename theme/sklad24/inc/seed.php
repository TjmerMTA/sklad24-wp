<?php
/**
 * First run: fill the site with the demo content (new products, reviews, FAQ, menus) once.
 * Runs only while the option "s24_seeded" is absent; deleting the content later does not bring it back.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function () {
	if ( get_option( 's24_seeded' ) ) {
		return;
	}
	update_option( 's24_seeded', S24_VER, false );
	s24_seed();
}, 20 );

/** Copy a theme picture into the Media Library, return attachment id. */
function s24_seed_image( $file, $title ) {
	static $cache = array();
	if ( isset( $cache[ $file ] ) ) {
		return $cache[ $file ];
	}
	$path = S24_DIR . '/assets/img/' . $file;
	if ( ! file_exists( $path ) ) {
		return 0;
	}
	$up = wp_upload_bits( $file, null, file_get_contents( $path ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	if ( ! empty( $up['error'] ) ) {
		return 0;
	}
	$type = wp_check_filetype( $up['file'] );
	$id   = wp_insert_attachment(
		array(
			'post_mime_type' => $type['type'],
			'post_title'     => $title,
			'post_status'    => 'inherit',
		),
		$up['file']
	);
	if ( $id && ! is_wp_error( $id ) ) {
		$size = @getimagesize( $up['file'] ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
		wp_update_attachment_metadata(
			$id,
			array(
				'width'  => $size ? $size[0] : 0,
				'height' => $size ? $size[1] : 0,
				'file'   => _wp_relative_upload_path( $up['file'] ),
				'sizes'  => array(),
			)
		);
		update_post_meta( $id, '_wp_attachment_image_alt', $title );
	}
	$cache[ $file ] = (int) $id;
	return $cache[ $file ];
}

function s24_seed() {
	$base = 'https://sklad24.com.ua';

	$products = array(
		array( 'Дизельний позашляховий навантажувач HELI', 'p1.jpg', 'Серія G3 CPCD30-KU1Y2G3', '3 000 кг', '3 000 мм', '', $base . '/katalog/pogruzchik/' ),
		array( 'Електричний вилочний навантажувач HELI з літій-іонною батареєю', 'p2.jpg', 'Серія G2 CPD16SQ-GE2LI', '1 600 кг', '4 700 мм', 'LI ION', $base . '/katalog/pogruzchik/' ),
		array( 'Електронавантажувач HELI з літій-іонною батареєю (Li-ion) серії H4 CPD35-A3LiH4-M, в/п 3,5 т', 'p3.jpg', 'Серія H4 CPD35-A3LiH4-M', '3 500 кг', '3 300 мм', '', $base . '/katalog/pogruzchik/' ),
		array( 'Електронавантажувач HELI з літій-іонною батареєю (Li-ion) серії H4 CPD30-A3LiH4-M, в/п 3 т', 'p4.jpg', 'Серія H4 CPD30-A3LiH4-M', '3 000 кг', '3 300 мм', '', $base . '/katalog/pogruzchik/' ),
		array( 'Електричний триколісний навантажувач EP TDL201 (2000 кг)', 'hero3.webp', 'Серія EP TDL201', '2 000 кг', '6 000 мм', '', $base . '/product/elektrychnyi-trykolisnyi-navantazhuvach-ep-tdl201/' ),
		array( 'Штабелер самохідний HELI CDD15J', 'hero2.webp', 'Серія CDD15J-3500', '1 500 кг', '3 500 мм', '', $base . '/product/shtabeler-samokhidnyy-heli-cdd15j-3500/' ),
	);
	foreach ( $products as $i => $p ) {
		$id = wp_insert_post(
			array(
				'post_type'   => 's24_product',
				'post_status' => 'publish',
				'post_title'  => $p[0],
				'menu_order'  => $i + 1,
			)
		);
		if ( ! $id || is_wp_error( $id ) ) {
			continue;
		}
		set_post_thumbnail( $id, s24_seed_image( $p[1], $p[0] ) );
		$meta = array(
			'series' => $p[2],
			'weight' => $p[3],
			'height' => $p[4],
			'badge'  => 'В наявності',
			'liion'  => $p[5],
			'link'   => $p[6],
		);
		foreach ( $meta as $k => $v ) {
			update_post_meta( $id, '_s24_' . $k, $v );
		}
	}

	$reviews = array(
		array( 'ТОВ "ЛАЙФСЕ ЛЛ"', 'Языджи Исмет', '18/02/2023', 'r1.jpg', "Покупали самоходный штабеллер у этой компании. Остались довольны возможностью посмотреть модель к моменту оплаты счета и выбрать из 2 предложенных вариантов.\n\nДоставили через 2 дня после оплаты счета, все четко, слаженно, организовано!\n\nСпасибо за сотрудничество и связи!" ),
		array( 'Завод металлических изделий', 'КУЗНІРСЬКИЙ АНДРІЙ', '20/02/2022', 'r2.jpg', "Спасибо за работу!\n\nНачали сотрудничать с компанией ТОВ \"Клебаер Украина\" еще в 2016 году и до сих пор не меняем поставщика по поставкам техники на завод.\n\nУдовлетворены качеством, сроками снабжения и сервисом." ),
		array( 'ТОВ "НОША"', 'ГНАТЕНКО СЕРГІЙ', '20/07/2018', 'r3.jpg', "Купили роклу в этой компании для разгрузки в машину, оплатили счет. Роклы доставили транспортной компанией в Ужгород через два дня, как и обещали. Тележка отличная, гидроузел, что нужно, но ручка пришла отдельно от тележки, пришлось самим собирать.\n\nСпасибо, что проконсультировали, как собрать)" ),
	);
	foreach ( $reviews as $i => $r ) {
		$id = wp_insert_post(
			array(
				'post_type'    => 's24_review',
				'post_status'  => 'publish',
				'post_title'   => $r[0],
				'post_content' => $r[4],
				'menu_order'   => $i + 1,
			)
		);
		if ( ! $id || is_wp_error( $id ) ) {
			continue;
		}
		set_post_thumbnail( $id, s24_seed_image( $r[3], 'Відгук: ' . $r[0] ) );
		update_post_meta( $id, '_s24_person', $r[1] );
		update_post_meta( $id, '_s24_date', $r[2] );
	}

	$faq = array(
		array( 'Чим відрізняється електрична рокла від гідравлічної?', 'Гідравлічну роклу оператор рухає і піднімає вручну — вона дешевша й не потребує зарядки, підходить для невеликих обсягів. Електрична рокла їде і піднімає вантаж від акумулятора: менше втоми, вища швидкість, вигідна при великому потоці палет і довгих маршрутах.' ),
		array( 'Як дізнатись ціну і купити роклу?', 'Залиште заявку у формі або зателефонуйте +38 093 177 5631 — менеджер підбере модель під ваше завдання, надішле рахунок і організує доставку по Україні.' ),
		array( 'Яка гарантія на обладнання для складу?', 'Гарантія — від 12 місяців, на вилочні навантажувачі — до 2 років. Гарантійне та післягарантійне обслуговування виконує наша сервісна служба.' ),
	);
	foreach ( $faq as $i => $q ) {
		wp_insert_post(
			array(
				'post_type'    => 's24_faq',
				'post_status'  => 'publish',
				'post_title'   => $q[0],
				'post_content' => $q[1],
				'menu_order'   => $i + 1,
			)
		);
	}

	// Menus, so the owner sees and edits them in Appearance → Menus.
	$names     = array(
		'top'     => 'Верхнє меню',
		'catalog' => 'Каталог',
		'footer'  => 'Каталог (підвал)',
		'legal'   => 'Підвал: документи',
	);
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	foreach ( s24_default_menus() as $loc => $items ) {
		if ( ! empty( $locations[ $loc ] ) ) {
			continue;
		}
		$name    = $names[ $loc ];
		$menu    = wp_get_nav_menu_object( $name );
		$menu_id = $menu ? $menu->term_id : wp_create_nav_menu( $name );
		if ( is_wp_error( $menu_id ) ) {
			continue;
		}
		if ( ! $menu ) {
			foreach ( $items as $it ) {
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'  => $it[0],
						'menu-item-url'    => $it[1],
						'menu-item-type'   => 'custom',
						'menu-item-status' => 'publish',
					)
				);
			}
		}
		$locations[ $loc ] = $menu_id;
	}
	set_theme_mod( 'nav_menu_locations', $locations );

	if ( 'Склад24' !== get_option( 'blogname' ) && in_array( get_option( 'blogname' ), array( 'My WordPress Website', 'WordPress', '' ), true ) ) {
		update_option( 'blogname', 'Склад24' );
		update_option( 'blogdescription', 'Техніка для складу' );
	}
}
